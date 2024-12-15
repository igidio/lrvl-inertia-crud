<template>
  <AppLayout title="Inventario">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Inventario
      </h2>
    </template>

    <div class="py-12">
      <div class="container">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

          <Link :href="route('addition.create')" class="d-flex justify-content-end mb-4">
            <button class="btn btn-primary">Registrar ingreso de productos</button>
          </Link>


          <h5>Items en el inventario</h5>
          <div class="card shadow-sm">
            <div class="card-body p-0">

              <table class="table table-striped mb-0">
                <thead class="table-dark">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Producto</th>
                  <th scope="col">Cantidad</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in inventory_items" :key="item.id">
                  <td>{{ item.id }}</td>
                  <td>{{ item.producto }}</td>
                  <td>{{ item.cantidad }}</td>
<!--                  <td>-->
<!--                    <div class="btn-group gap-2" role="group">-->
<!--                      <Link :href="route('product.edit', {id: product.id})">-->
<!--                        <button class="btn btn-warning btn-sm" @click="">-->
<!--                          Modificar-->
<!--                        </button>-->
<!--                      </Link>-->

<!--                      <button class="btn btn-danger btn-sm" @click="destroy(product.id)">-->
<!--                        <i class="bi bi-trash me-1"></i>Eliminar-->
<!--                      </button>-->
<!--                    </div>-->
<!--                  </td>-->
                </tr>
                </tbody>
              </table>
            </div>
          </div>
          <br>

          <h5>Adiciones</h5>
          <div class="card shadow-sm">
            <div class="card-body p-0">

              <table class="table table-striped mb-0">
                <thead class="table-dark">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Fecha y hora</th>
                  <th scope="col">Proveedor</th>
                  <th scope="col">Producto</th>
                  <th scope="col">Cantidad</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="addition in additions" :key="addition.id">
                  <td>{{ addition.id }}</td>
                  <td>{{ addition.fecha }}</td>
                  <td>{{ addition.proveedor }}</td>
                  <td>{{ addition.inventario }}</td>
                  <td>{{ addition.cantidad }}</td>
                  <!--                  <td>-->
                  <!--                    <div class="btn-group gap-2" role="group">-->
                  <!--                      <Link :href="route('product.edit', {id: product.id})">-->
                  <!--                        <button class="btn btn-warning btn-sm" @click="">-->
                  <!--                          Modificar-->
                  <!--                        </button>-->
                  <!--                      </Link>-->

                  <!--                      <button class="btn btn-danger btn-sm" @click="destroy(product.id)">-->
                  <!--                        <i class="bi bi-trash me-1"></i>Eliminar-->
                  <!--                      </button>-->
                  <!--                    </div>-->
                  <!--                  </td>-->
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
defineProps({
  inventory_items: {
    type: Array,
    required: true,
  },
  additions: {
    type: Array,
    required: true,
  },
})


import {defineComponent, defineProps} from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import {Link} from "@inertiajs/vue3";

</script>
