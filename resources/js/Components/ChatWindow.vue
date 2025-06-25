<template>
  <section>
    <div class="container px-0 shadow-xl">

      <div class="row d-flex justify-content-start">
        <div class="col-md-10 col-lg-8 col-xl-6">

          <div class="card w-[400px]" id="chat2">
            <div class="card-header d-flex justify-content-between align-items-center p-3 ">
              <h5 class="mb-0">Chat con asistente (IA)</h5>
              <button @click="clearHistory">Limpiar</button>
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

              <div class="d-flex flex-row justify-content-start mb-1" v-if="!is_completed">
                <div>
                  <p class="small p-2 ms-3 mb-1 rounded-3 bg-gray-200" v-if="streamed_message == '' && is_loading">
                    <i class="svg-spinners--3-dots-bounce opacity-40"></i>
                  </p>
                  <p class="small p-2 ms-3 mb-1 rounded-3 bg-gray-300 opacity-50"
                    v-else-if="streamed_message != '' && is_loading">
                    {{ streamed_message }}</p>
                </div>
              </div>


              <div class="d-flex flex-col justify-content-end mb-1" v-if="error_message">
                <div class="d-flex flex-row justify-content-end mb-1 items-center gap-2">
                  <button @click="send_message(error_message_content)">
                    <i class="ph--arrow-clockwise-bold"></i>
                  </button>
                  <div>
                    <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-sky-600/80 opacity-50">{{
                      error_message_content }}</p>
                  </div>
                </div>
                <span class="text-red-500 small self-end text-end inline-block">{{ error_message }}</span>
              </div>


            </div>
            <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
              <input type="text" class="form-control form-control-md" autocomplete="off" placeholder="Escriba algo"
                v-model="message_content" @keyup.enter="send_message(message_content.trim())">
              <button class="btn btn-primary ml-3 rounded-5 w-8 h-8 px-1" @click="send_message(message_content.trim())"
                :disabled="is_loading == true"><i class="famicons--paper-plane"></i></button>
            </div>
          </div>

        </div>
      </div>


    </div>
  </section>
</template>

<script setup>
import axios from 'axios';
import { ref, nextTick, onMounted, computed } from "vue";

const chatContainer = ref(null);

const streamed_message = ref('')
const message_content = ref('')
const is_loading = ref(false);
const error_message = ref('');
const error_message_content = ref('');
const is_completed = ref(false);

const loadMessages = () => {
  is_loading.value = true;
  const stored = localStorage.getItem('chat');
  if (stored) {
    try {
      const parsed = JSON.parse(stored);
      if (Array.isArray(parsed)) {
        return parsed;
      }
    } catch (e) {
    } finally {
      is_loading.value = false;
    }
  } else {
    localStorage.setItem('chat', JSON.stringify([]));
    return [];
      is_loading.value = false;

  }

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
  

  if (!message || is_loading.value) {
    return;
  }
  is_completed.value = false;
  error_message.value = '';
  is_loading.value = true;
  messages.value.push({ text: message, type: 'sent' });
  if (messages.value.length > 20) messages.value.shift();
  if (messages.value.length > 1 && messages.value[0].type === 'received') {
    messages.value.shift();
  }
  saveMessages();
  message_content.value = ''

  scrollToBottom();
  try {
    const response = await axios.post('/api/chat', { messages: mappedMessages.value });
    console.log(response.data);

    for (const char of response.data) {
      streamed_message.value += char
      await new Promise(res => setTimeout(res, 15))
      scrollToBottom();

    }
    messages.value.push({ text: streamed_message.value, type: 'received' });
    if (messages.value.length > 18) messages.value.shift();
    saveMessages();
    is_completed.value = true;
    streamed_message.value = ''


  } catch (error) {
    is_loading.value = false;
    console.error('Error sending message:', error);
    scrollToBottom();
    error_message.value = 'Error al enviar el mensaje.';
    error_message_content.value = message;
    messages.value.pop();
    saveMessages();
    is_completed.value = true;



  } finally {
    setTimeout(() => {
      is_loading.value = false
    }, 750);
  }


}

const mappedMessages = computed(() =>
  messages.value.map(msg => ({
    content: msg.text,
    role: msg.type === "received" ? "assistant" : "user"
  }))
);

const clearHistory = () => {
  messages.value = [];
  streamed_message.value = '';
  saveMessages();
  scrollToBottom();
};

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

.ph--arrow-clockwise-bold::after {
  display: inline-block;
  width: 1em;
  height: 1em;
  vertical-align: -0.125em;
  content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 256 256'%3E%3Cpath fill='%23151010' d='M244 56v48a12 12 0 0 1-12 12h-48a12 12 0 1 1 0-24h17.1l-19-17.38c-.13-.12-.26-.24-.38-.37A76 76 0 1 0 127 204h1a75.53 75.53 0 0 0 52.15-20.72a12 12 0 0 1 16.49 17.45A99.45 99.45 0 0 1 128 228h-1.37a100 100 0 1 1 71.88-170.94L220 76.72V56a12 12 0 0 1 24 0'/%3E%3C/svg%3E");
}

.svg-spinners--3-dots-bounce::after {
  display: inline-block;
  width: 1em;
  height: 1em;
  vertical-align: -0.125em;
  content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Ccircle cx='4' cy='12' r='3' fill='%23151010'%3E%3Canimate id='svgSpinners3DotsBounce0' attributeName='cy' begin='0;svgSpinners3DotsBounce1.end+0.25s' calcMode='spline' dur='0.6s' keySplines='.33,.66,.66,1;.33,0,.66,.33' values='12;6;12'/%3E%3C/circle%3E%3Ccircle cx='12' cy='12' r='3' fill='%23151010'%3E%3Canimate attributeName='cy' begin='svgSpinners3DotsBounce0.begin+0.1s' calcMode='spline' dur='0.6s' keySplines='.33,.66,.66,1;.33,0,.66,.33' values='12;6;12'/%3E%3C/circle%3E%3Ccircle cx='20' cy='12' r='3' fill='%23151010'%3E%3Canimate id='svgSpinners3DotsBounce1' attributeName='cy' begin='svgSpinners3DotsBounce0.begin+0.2s' calcMode='spline' dur='0.6s' keySplines='.33,.66,.66,1;.33,0,.66,.33' values='12;6;12'/%3E%3C/circle%3E%3C/svg%3E");
}
</style>
