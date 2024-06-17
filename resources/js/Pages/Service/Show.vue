<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';

defineProps({
    servicio: Object,
});
</script>

<template>
    <AppLayout title="Servicio">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Servicio
            </h2>
        </template>

        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    Datos del Servicio
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>ID:</strong> {{ servicio.id }}</li>
                    <li class="list-group-item"><strong>Nombre:</strong> {{ servicio.nombre }}</li>
                    <li class="list-group-item"><strong>Descripción:</strong> {{ servicio.descripcion }}</li>
                    <li class="list-group-item"><strong>Duración:</strong> {{ servicio.duracion }} min.</li>
                    <li class="list-group-item"><strong>Precio:</strong> {{ servicio.precio }} Bs.</li>
                </ul>

            </div>

            <div v-if="servicio.appointments.length > 0">
                <h4 class="my-3">Clientes que tomaron este servicio</h4>
                <div class="row">
                    <div class="col" v-for="appointment in servicio.appointments" :key="appointment.id">
                        <div class="card mb-4">
                            <div class="card-body">

                                <p class="card-text">
                                    <Link :href="route('customer.show', { id: appointment.cliente.id })">
                                    {{ appointment.cliente.nombres + ' ' +
                                        appointment.cliente.apellidos }}
                                    </Link>
                                </p>
                                <p class="card-text"><strong>Fecha:</strong> {{ appointment.fecha }}</p>
                                <p class="card-text"><strong>Hora:</strong> {{ appointment.hora }}</p>
                                <p class="card-text" v-if="appointment.notas"><strong>Notas:</strong> {{
                                    appointment.notas }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>Este servicio no a sido empleado por ningún cliente todavía</div>

            <div>
                <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                </div>

            </div>
        </div>
    </AppLayout>
</template>
