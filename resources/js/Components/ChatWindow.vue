<template>
  <section>
    <div class="container px-0 ">

      <div class="row d-flex justify-content-start">
        <div class="col-md-10 col-lg-8 col-xl-6">

          <div class="card w-[400px]" id="chat2">
            <div class="card-header d-flex justify-content-between align-items-center p-3 ">
              <h5 class="mb-0">Chat con asistente (IA)</h5>
            </div>
            <div class="card-body  overflow-y-auto" data-mdb-perfect-scrollbar-init
                 style="position: relative; height: 400px" ref="chatContainer">

              <div v-for="message in messages">
                <div class="d-flex flex-row justify-content-start mb-1" v-if="message.type === 'received'">
                  <div>
                    <p class="small p-2 ms-3 mb-1 rounded-3 bg-gray-200">{{ message.text }}</p>
                  </div>
                </div>

                <div class="d-flex flex-row justify-content-end mb-1" v-if="message.type === 'sent'">
                  <div>
                    <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-sky-600/80">{{ message.text }}</p>
                  </div>
                </div>
              </div>

              <div class="d-flex flex-row justify-content-start mb-1">
                <div>
                  <p class="small p-2 ms-3 mb-1 rounded-3 bg-gray-300 opacity-50" v-if="streamed_message != ''">
                    {{ streamed_message }}</p>
                </div>
              </div>

              <div v-if="messages"></div>


            </div>
            <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
              <input type="text" class="form-control form-control-md"  autocomplete="off"
                     placeholder="Escriba algo" v-model="message_content" @keyup.enter="send_message(message_content)">
              <button class="btn btn-primary ml-3 rounded-5 w-8 h-8 p-2" @click="send_message(message_content)"><i
                class="famicons--paper-plane"></i></button>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
import axios from 'axios';
import {ref, nextTick, onMounted} from "vue";

const chatContainer = ref(null);

const streamed_message = ref('')
const message_content = ref('')

const loadMessages = () => {
  const stored = localStorage.getItem('chat');
  if (stored) {
    try {
      const parsed = JSON.parse(stored);
      if (Array.isArray(parsed)) {
        return parsed;
      }
    } catch (e) {}
  }
  return [
    { text: 'Hola, ¿cómo puedo ayudarte?', type: 'received' },
  ];
};

const saveMessages = () => {
  localStorage.setItem('chat', JSON.stringify(messages.value));
};

const scrollToBottom = () => {
  nextTick(() => {
    if (chatContainer.value) {
      chatContainer.value.scrollTop = chatContainer.value.scrollHeight;
    }
  });
};

const messages = ref([])

const send_message = async (message) => {
  if (!message) {
    return;
  }
  messages.value.push({text: message, type: 'sent'});
  if (messages.value.length > 20) messages.value.shift();
  saveMessages();
  message_content.value = ''

  scrollToBottom();
  try {
    const response = await axios.post('/api/chat', {message});
    console.log(response.data);

    for (const char of response.data) {
      streamed_message.value += char
      await new Promise(res => setTimeout(res, 15))
      scrollToBottom();

    }
    messages.value.push({text: streamed_message.value, type: 'received'});
    if (messages.value.length > 20) messages.value.shift();
    saveMessages();
    streamed_message.value = ''


  } catch (error) {
    console.error('Error sending message:', error);
  }

}

onMounted(() => {
  messages.value = loadMessages();

  scrollToBottom();
});
</script>

<style>
.famicons--paper-plane::after {
  display: inline-block;
  width: 1em;
  height: 1em;
  vertical-align: -0.0em;
  content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'%3E%3Cpath fill='%23fff' d='M473 39.05a24 24 0 0 0-25.5-5.46L47.47 185h-.08a24 24 0 0 0 1 45.16l.41.13l137.3 58.63a16 16 0 0 0 15.54-3.59L422 80a7.07 7.07 0 0 1 10 10L226.66 310.26a16 16 0 0 0-3.59 15.54l58.65 137.38c.06.2.12.38.19.57c3.2 9.27 11.3 15.81 21.09 16.25h1a24.63 24.63 0 0 0 23-15.46L478.39 64.62A24 24 0 0 0 473 39.05'/%3E%3C/svg%3E");
}
</style>
