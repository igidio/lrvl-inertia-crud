<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { reactive, ref, computed } from 'vue';

const props = defineProps({
    customer: {
        type: Object,
        required: true,
    },
    appointments: {
        type: Object,
        required: true,
    },
})
</script>

<template>
    <AppLayout title="Cliente">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cliente
            </h2>
        </template>

        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    {{ props }}

                </div>

            </div>
        </div> -->

        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    Datos del Usuario
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>ID:</strong> {{ props.customer.id }}</li>
                    <li class="list-group-item"><strong>Nombres:</strong> {{ props.customer.nombres }}</li>
                    <li class="list-group-item"><strong>Apellidos:</strong> {{ props.customer.apellidos }}</li>
                    <li class="list-group-item"><strong>CI:</strong> {{ props.customer.ci }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ props.customer.email }}</li>
                    <li class="list-group-item"><strong>Teléfono:</strong> {{ props.customer.telefono }}</li>
                    <li class="list-group-item"><strong>Dirección:</strong> {{ props.customer.direccion }}</li>
                    <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> {{ props.customer.fecha_nacimiento
                        }}</li>
                    <!-- <li class="list-group-item"><strong>Activo:</strong> {{ props.customer.active }}</li> -->
                    <li class="list-group-item"><strong>Creado el:</strong> {{ new Date(props.customer.created_at) }}
                    </li>
                    <li class="list-group-item"><strong>Última modificación:</strong> {{ new
                        Date(props.customer.created_at) }}
                    </li>
                </ul>
            </div>

            <div v-if="appointments.length > 0">
                <h4 class="my-3">Servicios</h4>
                <div class="row">
                    <!-- <div class="col-md-4" v-for="service in services" :key="item.id"> -->
                    <div class="col" v-for="appointment in appointments" :key="appointment.id">
                        <div class="card mb-4">
                            <div class="card-body">
                                <!-- <h5 class="card-title">Servicio #{{ appointment.id }}</h5> -->
                                <h5>{{ appointment.titulo }}</h5>
                                <p class="card-text"><strong>Fecha:</strong> {{ appointment.fecha }}</p>
                                <p class="card-text"><strong>Hora:</strong> {{ appointment.hora }}</p>
                                <p class="card-text"><strong>Notas:</strong> {{ appointment.notas }}</p>
                            </div>
                            <!-- <div class="card-footer text-muted">
                            Creado: {{ item.created_at }} | Actualizado: {{ item.updated_at }}
                        </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>Este usuario no tomó ningún servicio todavía</div>
        </div>


        <!-- </div> -->
    </AppLayout>
</template>