<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';

defineProps({
    customers: {
        type: Array,
        required: true,
    }
})

</script>

<template>
    <AppLayout title="Clientes">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Clientes
            </h2>
        </template>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg overflow-x-auto">

                    <!-- <div class="overflox-x-"> -->
                    <table class="tw-table min-w-full whitespace-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre Completo</th>
                                <th scope="col">CI</th>
                                <th scope="col">e-mail</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">F. de Nacimiento</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="customer in customers">
                                <th scope="row">1</th>
                                <td>{{ customer.nombre }}</td>
                                <td>{{ customer.ci }}</td>
                                <td>{{ customer.email }}</td>
                                <td>{{ customer.direccion }}</td>
                                <td>{{ customer.fecha_nacimiento }}</td>
                                <td>{{ customer.telefono }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning">Modificar</button>
                                    <button type="button" class="btn btn-danger">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- </div> -->
    </AppLayout>

    <div>
        <form @submit.prevent="submit">
            <label for="nombres">Nombres</label>
            <input type="text" v-model="form.nombres">
            <label for="nombres">apellidos</label>
            <input type="text" v-model="form.apellidos">
            <label for="ci">CI</label>
            <input type="text" v-model="form.ci">
            <label for="Nombre">telefono</label>
            <input type="text" v-model="form.telefono">
            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" v-model="form.direccion">
            <label for="email">Dirección</label>
            <input type="text" id="email" v-model="form.email">
            <label for="fecha_nacimiento">fecha nacimiento</label>
            <input type="text" id="fecha_nacimiento" v-model="form.fecha_nacimiento">
            <button>Enviar</button>
        </form>
    </div>

    <hr>


</template>

<style scoped>
.tw-table {
    @apply table-auto whitespace-nowrap border border-separate border-spacing-4;
}
</style>