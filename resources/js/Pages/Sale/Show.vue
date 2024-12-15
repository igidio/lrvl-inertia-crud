<template>
  <AppLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Detalles de la Venta
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <h3 class="text-lg font-medium">Venta ID: {{ sale.id }}</h3>
            <p><strong>Fecha:</strong> {{ sale.fecha }}</p>
            <p><strong>Cliente:</strong> {{ sale.cliente }}</p>
            <p><strong>Total:</strong> {{ sale.total }} Bs.</p>

            <h4 class="mt-4 text-md font-medium">Productos</h4>
            <table class="table-auto w-full mt-2">
              <thead>
              <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Cantidad</th>
                <th class="px-4 py-2">Precio</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="producto in sale.productos" :key="producto.id">
                <td class="border px-4 py-2">{{ producto.id }}</td>
                <td class="border px-4 py-2">{{ producto.nombre }}</td>
                <td class="border px-4 py-2">{{ producto.cantidad }}</td>
                <td class="border px-4 py-2">{{ producto.precio }} Bs.</td>
              </tr>
              </tbody>
            </table>

            <div class="mt-4">
              <Link :href="route('sale.index')" class="btn btn-secondary">Volver</Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { defineProps } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  sale: {
    type: Object,
    required: true,
  }
});
</script>
