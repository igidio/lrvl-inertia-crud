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
      <div class="container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <Link :href="route('service.create')" class="d-flex justify-content-end mb-4">
            <button class="btn btn-primary">Crear nuevo servicio</button>
          </Link>

          <div class="card shadow-sm text-sm">
            <div class="card-body p-0">
              <table class="table table-striped mb-0">
                <thead class="table-dark">
                <tr>
                  <th scope="col">Nombre de Servicio</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Duración</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="service in services" :key="service.id">
                  <td>
                    <Link :href="route('service.show', { id: service.id })">
                      {{ service.nombre }}
                    </Link>
                  </td>
                  <td>{{ service.descripcion }}</td>
                  <td>{{ service.duracion }}</td>
                  <td>{{ service.precio }} Bs.</td>
                  <td>
                    <div class="btn-group gap-2" role="group">
                      <Link :href="route('service.edit', { id: service.id })">
                        <button class="btn btn-warning btn-sm">Modificar</button>
                      </Link>
                      <button class="btn btn-danger btn-sm" @click="destroy(service.id)">
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
