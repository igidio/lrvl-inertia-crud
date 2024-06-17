<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';

defineProps({
    service: Object,
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
                    <li class="list-group-item"><strong>Nombres:</strong> {{ servicio.nombre }}</li>
                    <li class="list-group-item"><strong>Nombres:</strong> {{ servicio.descripcion }}</li>
                    <li class="list-group-item"><strong>Duración:</strong> {{ servicio.duracion }} min.</li>
                    <li class="list-group-item"><strong>Duración:</strong> {{ servicio.precio }} Bs.</li>

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

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                {{ service }}
                <!-- {{ appointments }} -->


            </div>

        </div>
    </AppLayout>
</template>
