<template>
  <AppLayout title="Modificar producto">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Crear producto
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg">

          <form @submit.prevent="submit">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title mb-4">
                  Llena los campos del formulario
                </h5>
                <div class="row">
                  <div class="col">
                    <div class="row mb-3">
                      <div class="col">
                        <label for="nombre">Nombre:</label>
                        <input id="nombre" type="text" class="form-control capitalize" v-model="form.nombre"
                          @input="validateOne('nombre', form.nombre)">
                        <ErrorList :errors="errors.nombre" />
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col">
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" type="text" class="form-control resize-none"
                          v-model="form.descripcion" @input="validateOne('descripcion', form.descripcion)"
                          maxlength="255" rows="5"></textarea>
                        <ErrorList :errors="errors.descripcion" />
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col">
                        <label for="precio">Precio:</label>
                        <input id="precio" type="number" class="form-control" v-model="form.precio" step=".01"
                          @input="validateOne('precio', form.precio)">
                        <ErrorList :errors="errors.precio" />
                      </div>
                    </div>


                    <div class="row mb-3">
                      <div class="col">
                        <label for="id_categoria">Categoría:</label>
                        <select id="id_categoria" class="form-control" v-model="form.id_categoria"
                          @change="validateOne('id_categoria', form.id_categoria)">

                          <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.nombre }}
                          </option>
                        </select>
                        <ErrorList :errors="errors.id_categoria" />
                      </div>
                    </div>


                  </div>


                  <div class="col justify-center flex flex-row gap-4 mt-4">
                    <div class="flex flex-col gap-4 grow">
                      <img :src="image_url || `/images/image_placeholder.jpg`" alt="Imagen del producto"
                        class="border border-gray-600 w-32 h-32 rounded-md fit aspect-square object-cover" />
                      <button class="btn btn-secondary btn-sm w-32" v-if="suggest_data"
                        @click="set_data_to_form(suggest_data)">Aplicar</button>
                    </div>

                    <div class="row mb-3">
                      <div class="w-full flex flex-col mt-2 gap-2">
                        <div class="flex flex-row justify-between" for="imagen">
                          <span>Imagen:</span>
                          <button type="button" @click="on_delete()" class="text-primary self-end"
                            v-if="image_url">Eliminar</button>
                        </div>

                        <input id="imagen" type="file" class="form-control w-72" @change="on_file_change" ref="ref_file"
                          accept="image/*" :disabled="is_loading">

                        <div class="flex items-center gap-2 mt-2">
                          <input id="sugerir" type="checkbox" class="form-checkbox h-4 w-4" v-model="suggest" @change="() => {
                            if (suggest && image) {
                              submit_image();
                            }
                          }" />
                          <label for="sugerir" class="text-sm select-none">Sugerir de acuerdo a la imagen</label>
                        </div>

                        <span class="text-xs text-red-600" v-if="show_error_when_sending_image">No se pudo conectar
                          con
                          el
                          servicio de reconocimiento de imágenes. <span class="font-bold hover:underline cursor-pointer"
                            @click="submit_image">Reintentar</span>
                        </span>

                        <div class="flex flex-col w-72" v-if="suggest_data">
                          <span class="font-bold text-lg">Sugerencia</span>
                          <span class="font-bold text-">Nombre</span>
                          <span>{{ suggest_data.name }}</span>
                          <span class="font-bold text-sm">Descripción</span>
                          <span>{{ suggest_data.description }}</span>
                          <span class="font-bold text-sm">Categoría</span>
                          <span>{{ suggest_data.category }}</span>
                        </div>




                      </div>



                    </div>



                  </div>


                </div>

              </div>
              <div class="card-footer">
                <div class="flex flex-row justify-between m-2 ">
                  <div>
                    <button class="btn btn-light" @click.prevent="clear">Limpiar</button>
                  </div>
                  <div>
                    <Link :href="route('product.index')" class="btn btn-secondary mr-2">
                      Cancelar
                    </Link>
                    <button class="btn btn-primary" type="submit"
                      :disabled="Object.keys(errors).length !== 0">Enviar</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

        </div>

      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, router } from "@inertiajs/vue3";
import ErrorList from "@/Components/ErrorList.vue";
import { ref } from "vue";
import { z } from "zod";
import axios from "axios";
import { data } from "autoprefixer";

const props = defineProps({
  categories: {
    type: Array,
    required: true,
  }
})

const formSchema = z.object({
  nombre: z.string({ invalid_type_error: 'El campo está vacío' }).min(1, 'El nombre es requerido').regex(/^[a-zA-Z0-9\s]+$/, 'El nombre no es válido'),
  descripcion: z.string({ invalid_type_error: 'El campo está vacío' }).min(1, 'La descripción es requerida'),
  precio: z.number({ invalid_type_error: 'Introduzca un número válido' }).min(0, 'El precio debe ser mayor o igual a 0'),
  id_categoria: z.number({ invalid_type_error: 'Seleccione una categoría válida' }).min(1, 'La categoría es requerida'),
})

const form = ref({
  nombre: '',
  descripcion: '',
  precio: undefined,
  id_categoria: '',
})

const errors = ref({});

const submit = async () => {
  validate();
  if (Object.keys(errors.value).length !== 0) return;
  router.post(`/product`, form.value);
}

const validate = () => {
  try {
    formSchema.parse(form.value);
    errors.value = {};
  } catch (error) {
    if (error instanceof z.ZodError) {
      errors.value = error.flatten().fieldErrors;
    }
  }
}

const validateOne = (field, value) => {
  try {
    formSchema.shape[field].parse(value);
    delete errors.value[field]
  } catch (error) {
    if (error instanceof z.ZodError) {
      errors.value[field] = error.flatten().formErrors;
    }
  }
}

const image_url = ref("");
const image = ref(null);
const is_loading = ref(false);
const ref_file = ref(null);
const show_error_when_sending_image = ref(false);
const suggest = ref(false);
const suggest_data = ref(null);


const on_file_change = async (e) => {
  const target = e.target;
  console.log(target.files[0]);
  const file = target.files[0];
  if (file) {
    image.value = file;
    image_url.value = URL.createObjectURL(file);
    await submit_image();
  }
};

const on_delete = () => {

  image.value = null;
  image_url.value = "";
  ref_file.value.value = "";
  suggest_data.value = null;
  show_error_when_sending_image.value = false;
  if (suggest_data.value.name === form.value.nombre) form.value.nombre = '';
  if (suggest_data.value.description === form.value.descripcion) form.value.descripcion = '';
  if (suggest_data.value.category) form.value.id_categoria = '';
  is_loading.value = false;
}

const set_data_to_form = (data) => {
  if (data.name) form.value.nombre = data.name;
  if (data.description) form.value.descripcion = data.description;
  if (data.category) props.categories.forEach(category => {
    if (category.nombre.toLowerCase() === data.category.toLowerCase()) {
      form.value.id_categoria = category.id;
    }
  });
}

const set_data_to_suggest = (data) => {
  suggest_data.value = data;
}


const submit_image = async () => {
  if (!image.value) return;
  show_error_when_sending_image.value = false;
  is_loading.value = true;
  if (!suggest.value) {
    is_loading.value = false;
    return;
  }
  const formData = new FormData();
  formData.append('image', image.value);

  await axios.post('/api/image', formData, {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  }).then((image) => {

    set_data_to_suggest(image.data);
  })
    .catch((error) => {
      show_error_when_sending_image.value = true;
    })
    .finally(() => {
      is_loading.value = false;
    });
}

const clear = () => {
  form.value.nombre = '';
  form.value.descripcion = '';
  form.value.precio = undefined;
  form.value.id_categoria = '';
  on_delete();
  errors.value = {};

}
</script>
