<template>
  <AppLayout title="Proveedores">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Proveedores
      </h2>
    </template>

    <div class="py-12">
      <div class="container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

          <!--          <Link :href="route('supplier.create')" class="d-flex justify-content-end mb-4">-->
          <!--            <button class="btn btn-primary">Crear nuevo proveedor</button>-->
          <!--          </Link>-->


          <div class="card shadow-sm">
            <div class="card-body p-0">

              <table class="table table-striped mb-0">
                <thead class="table-dark">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Teléfono</th>
                  <th scope="col">Correo electrónico</th>
                  <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="supplier in suppliers" :key="supplier.id">
                  <td>{{ supplier.id }}</td>
                  <td>{{ supplier.nombre }}</td>
                  <td>{{ supplier.telefono }}</td>
                  <td>{{ supplier.email }}</td>
                  <td>
                    <div class="btn-group gap-2" role="group">
                      <Link :href="route('supplier.edit', {id: supplier.id})">
                        <button class="btn btn-warning btn-sm" @click="">
                          Modificar
                        </button>
                      </Link>

                      <button class="btn btn-danger btn-sm" @click="destroy(supplier.id)">
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
import {defineProps, ref} from 'vue'
import 'bootstrap/dist/css/bootstrap.min.css'
import AppLayout from "@/Layouts/AppLayout.vue";
import {Link, router} from "@inertiajs/vue3";

const destroy = (id) => {
  if (confirm('Desea Eliminar?')) {
    router.delete(route('supplier.destroy', id));
  }
};

defineProps({
  suppliers: {
    type: Array,
    required: true,
  }
})
</script>

<style scoped>
/* Estilos adicionales si son necesarios */
</style>
