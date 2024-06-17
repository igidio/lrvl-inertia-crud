<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, computed, watch } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import ErrorList from '@/Components/ErrorList.vue'

const minDate = computed(() => {
    const today = new Date();
    return new Date(today.setFullYear(today.getFullYear() - minAge));
});

const props = defineProps({
    clientes: {
        type: Array,
        required: true,
    },
    servicios: {
        type: Array,
        required: true,
    }
})

const form = ref({
    id_cliente: null,
    id_servicio: null,
    fecha: null,
    hora: null,
    notas: null,
});


const errors = ref({});
const submit = () => {
    if (!validate.value) return;
    router.post(`/appointment`, form.value);
}


const validate = computed(() => {
    if (form.value.id_cliente == null ||
        form.value.id_servicio == null ||
        form.value.fecha == null) {
        return false;
    }
    return true;
})


const DateToHour = (fecha) => {
    return fecha.toLocaleTimeString('en-GB', { hour12: false });
}

const dateFormated = computed(() => {
    if (!(form.value.fecha instanceof Date))
        return 'Selecciona una fecha';
    const date = form.value.fecha
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();

    day = day < 10 ? '0' + day : day;
    month = month < 10 ? '0' + month : month;

    return `${day}/${month}/${year} ${form.value.hora}`;
});

watch(
    () => form.value.fecha,
    () => { form.value.hora = DateToHour(form.value.fecha); }
)

</script>

<template>
    <AppLayout title="Crear cita">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Crear cita
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
                                <div class="row mb-3">
                                    <div class="col">

                                        <div class="mb-3">
                                            <label for="cliente">Cliente:</label>
                                            <select id="cliente" class="form-select" v-model="form.id_cliente">
                                                <option :value="cliente.id" v-for="cliente in clientes">{{
                                                    cliente.nombres + ' ' + cliente.apellidos }}</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="servicio">Servicio:</label>
                                            <select id="servicio" class="form-select" v-model="form.id_servicio">
                                                <option :value="`${servicio.id}`" v-for="servicio in servicios">{{
                                                    servicio.nombre }}</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="notas">Notas (opcional):</label>
                                            <textarea id="notas" class="form-control" v-model="form.notas" />
                                        </div>

                                        <div class="mb-3 row">
                                            <div class="col">
                                                <label for="fecha" class="mb-3">Fecha y Hora:</label>
                                                <VDatePicker v-model="form.fecha" mode="dateTime" :rules="{
                                                    hours: { min: 7, max: 20 },
                                                    minutes: { interval: 5 },
                                                }" :min-date="new Date()" locale="es">
                                                    <template #default="{ togglePopover }">
                                                        <div class="d-grid gap-2">
                                                            <button id="fecha" type="button"
                                                                class="px-3 py-2 bg-blue-500 text-sm text-white font-semibold rounded-md"
                                                                @click="togglePopover">
                                                                {{ dateFormated }}
                                                            </button>
                                                        </div>
                                                    </template>
                                                </VDatePicker>
                                            </div>
                                        </div>


                                        <!-- {{ clientes[1] }} -->


                                    </div>

                                </div>







                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-end m-2">
                                    <Link :href="route('appointment.index')" class="btn btn-secondary col-2 mr-2">
                                    Cancelar
                                    </Link>
                                    <button class="btn btn-primary col-2" :disabled="!validate">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>

    </AppLayout>
</template>