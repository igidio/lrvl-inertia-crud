<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {defineProps} from 'vue';
import {Link, router} from '@inertiajs/vue3';

defineProps({
  customers: {
    type: Array,
    required: true,
  }
})

const destroy = (id) => {
  if (confirm('Desea Eliminar?')) {
    router.delete(route('customer.destroy', id));
  }
};
</script>

<template>
  <AppLayout title="Clientes">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Clientes
      </h2>
    </template>

    <div class="py-12">
      <div class="container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

          <Link :href="route('customer.create')" class="d-flex justify-content-end mb-4">
            <button class="btn btn-primary">Crear nuevo cliente</button>
          </Link>

          <div class="card shadow-sm overflow-x-auto">
            <div class="card-body p-0">
              <table class="table table-striped mb-0 min-w-full">
                <thead class="table-dark">
                <tr>
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
                <tr v-for="customer in customers" :key="customer.id">
                  <td scope="row">
                    <Link :href="route('customer.show', { id: customer.id })">
                      {{ customer.nombre }}
                    </Link>
                  </td>
                  <td>{{ customer.ci }}</td>
                  <td>{{ customer.email }}</td>
                  <td>{{ customer.direccion }}</td>
                  <td>{{ customer.fecha_nacimiento }}</td>
                  <td>{{ customer.telefono }}</td>
                  <td>
                    <div class="btn-group gap-2" role="group">
                      <Link :href="route('customer.edit', { id: customer.id })">
                        <button class="btn btn-warning btn-sm">Modificar</button>
                      </Link>
                      <button class="btn btn-danger btn-sm" @click="destroy(customer.id)">
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
