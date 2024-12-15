<template>
  <AppLayout title="Detalle de venta">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Detalle de venta
      </h2>
    </template>

    <div class="py-12">
      <div class="container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

          <Link :href="route('sale.create')" class="d-flex justify-content-end mb-4">
            <button class="btn btn-primary">Crear nueva venta</button>
          </Link>

          <div class="card shadow-sm">
            <div class="card-body p-0">

              <table class="table table-striped mb-0">
                <thead class="table-dark">
                <tr>
                  <th scope="col">Nombre del Cliente</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Total</th>
                  <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="sale in sales" :key="sale.id">
                  <td>{{ sale.cliente_nombre }}</td>
                  <td>{{ sale.fecha }}</td>
                  <td>{{ sale.total }} Bs.</td>
                  <td>
                    <div class="btn-group gap-2" role="group">
                      <Link :href="route('sale.edit', {id: sale.id})">
                        <button class="btn btn-warning btn-sm">
                          Modificar
                        </button>
                      </Link>

                      <button class="btn btn-danger btn-sm" @click="destroy(sale.id)">
                        <i class="bi bi-trash me-1"></i>Eliminar
                      </button>
                    </div>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {Link, router} from "@inertiajs/vue3";
import {defineProps} from "vue";

defineProps({
  sales: {
    type: Array,
    required: true,
  }
})

const destroy = (id) => {
  if (confirm('Desea Eliminar?')) {
    router.delete(route('sale.destroy', id));
  }
};
</script>
