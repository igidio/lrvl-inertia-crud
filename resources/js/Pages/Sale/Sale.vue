<template>
  <AppLayout title="Ventas">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Ventas
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

              <table class="table table-hover table-striped mb-0">
                <thead class="table-dark">
                <tr>
                  <th scope="col">Nombre del Cliente</th>
                  <th scope="col">Fecha y hora</th>
                  <th scope="col">Total</th>
<!--                  <th scope="col">Acciones</th>-->
                </tr>
                </thead>
                <tbody>
                <tr v-for="sale in paginatedSales" :key="sale.id">
                  <td @click="go_to_sale(sale.id)" class="cursor-pointer">{{ sale.cliente }}</td>
                  <td @click="go_to_sale(sale.id)" class="cursor-pointer">{{ sale.fecha }}</td>
                  <td @click="go_to_sale(sale.id)" class="cursor-pointer">{{ sale.total }} Bs.</td>
<!--                  <td>-->
<!--                    <div class="btn-group gap-2" role="group">-->
<!--                      <Link :href="route('sale.edit', {id: sale.id})">-->
<!--                        <button class="btn btn-warning btn-sm">-->
<!--                          Modificar-->
<!--                        </button>-->
<!--                      </Link>-->

<!--                      <button class="btn btn-danger btn-sm" @click="destroy(sale.id)">-->
<!--                        <i class="bi bi-trash me-1"></i>Eliminar-->
<!--                      </button>-->
<!--                    </div>-->
<!--                  </td>-->
                </tr>
                </tbody>
              </table>

              <nav aria-label="Page navigation" class="mt-3">
                <ul class="pagination justify-content-center">
                  <li class="page-item" :class="{ disabled: currentPage === 1 }">
                    <button class="page-link" @click="changePage(currentPage - 1)" :disabled="currentPage === 1">Anterior</button>
                  </li>
                  <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: currentPage === page }">
                    <button class="page-link" @click="changePage(page)">{{ page }}</button>
                  </li>
                  <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                    <button class="page-link" @click="changePage(currentPage + 1)" :disabled="currentPage === totalPages">Siguiente</button>
                  </li>
                </ul>
              </nav>

            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, router } from "@inertiajs/vue3";
import { defineProps, ref, computed } from "vue";

const props = defineProps({
  sales: {
    type: Array,
    required: true,
  }
});

const currentPage = ref(1);
const itemsPerPage = ref(10);

const totalPages = computed(() => {
  return Math.ceil(props.sales.length / itemsPerPage.value);
});

const paginatedSales = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value;
  const end = start + itemsPerPage.value;
  return props.sales.slice(start, end);
});

const changePage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page;
  }
};

const destroy = (id) => {
  if (confirm('Desea Eliminar?')) {
    router.delete(route('sale.destroy', id));
  }
};

const go_to_sale = (id) => {
  router.get(route('sale.show', id));
};
</script>
