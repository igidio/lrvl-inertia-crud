<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';
import { Link, router } from '@inertiajs/vue3';

defineProps({
    services: {
        type: Array,
        required: true,
    }
})

const destroy = (id) => {
    if (confirm('Desea Eliminar?')) {
        router.delete(route('service.destroy', id));
    }
};
</script>

<template>
    <AppLayout title="Servicios">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Servicios
            </h2>
        </template>



        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link :href="route('service.create')" class="d-grid gap-2 mb-4">
                <button class="btn btn-primary">Crear nuevo servicio</button>
                </Link>

                <div class="bg-white shadow-xl sm:rounded-lg overflow-x-auto">

                    <!-- <div class="overflox-x-"> -->
                    <table
                        class="table-auto whitespace-nowrap border border-separate border-spacing-4; min-w-full whitespace-nowrap">
                        <thead>
                            <tr>
                                <!-- <th scope="col">#</th> -->

                                <th scope="col">Nombre de Servicio</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Duración</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="service in services">
                                <!-- <td scope="row">1</td> -->

                                <td>

                                    <Link :href="route('service.show', { id: service.id })">
                                    {{ service.nombre }}
                                    </Link>
                                </td>
                                <td>{{ service.descripcion }}</td>
                                <td>{{ service.duracion }}</td>
                                <td>{{ service.precio }}</td>
                                <td>
                                    <Link :href="route('service.edit', { id: service.id })">
                                    <button type="button" class="btn btn-warning">Modificar</button>
                                    </Link>
                                    <button type="button" class="btn btn-danger"
                                        @click="destroy(service.id)">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


        <!-- </div> -->
    </AppLayout>

</template>