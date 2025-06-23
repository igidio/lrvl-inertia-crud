<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import ChatWindow from '@/Components/ChatWindow.vue';

defineProps({
  title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
  router.put(route('current-team.update'), {
    team_id: team.id,
  }, {
    preserveState: false,
  });
};

const logout = () => {
  router.post(route('logout'));
};

const showChat = ref(false);

const toggleChat = () => {
  showChat.value = !showChat.value;
};
</script>

<template>
  <div>

    <Head :title="title" />

    <Banner />

    <div class="min-h-screen bg-[#e8f3f4]">
      <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex">
              <!-- Logo -->
              <div class="shrink-0 flex items-center">
                <Link :href="route('appointment.index')" class="text-reset text-decoration-none">
                <ApplicationMark class="block h-9 w-auto" />
                </Link>
              </div>

              <!-- Navigation Links -->
              <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <!-- <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                    Dashboard
                </NavLink> -->
                <!-- <Link href="/">Home</Link> -->
                <NavLink :href="route('appointment.index')" :active="route().current('appointment.index')">
                  Citas
                </NavLink>
                <NavLink :href="route('customer.index')" :active="route().current('customer.index')">
                  Clientes
                </NavLink>
                <NavLink :href="route('service.index')" :active="route().current('service.index')">
                  Servicios
                </NavLink>
                <NavLink :href="route('sale.index')" :active="route().current('sale.index')">
                  Ventas
                </NavLink>
                <NavLink :href="route('supplier.index')" :active="route().current('supplier.index')">
                  Proveedores
                </NavLink>
                <NavLink :href="route('product.index')" :active="route().current('product.index')">
                  Productos
                </NavLink>
                <NavLink :href="route('inventory.index')" :active="route().current('inventory.index')">
                  Inventario
                </NavLink>

                <!--
                <Link :href="route('service.index')">Servicios</Link>
                <Link :href="route('appointment.index')">Citas</Link> -->
                <!-- <Link href="/customer">Customer</Link> -->

                <!-- <NavLink :href="route('customer')" :active="route().current('customer')">
                    Customer
                </NavLink> -->
              </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
              <div class="ms-3 relative">
                <!-- Teams Dropdown -->
                <Dropdown v-if="$page.props.jetstream.hasTeamFeatures" align="right" width="60">
                  <template #trigger>
                    <span class="inline-flex rounded-md">
                      <button type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                        {{ $page.props.auth.user.current_team.name }}

                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <div class="w-60">
                      <!-- Team Management -->
                      <div class="block px-4 py-2 text-xs text-gray-400">
                        Manage Team
                      </div>

                      <!-- Team Settings -->
                      <DropdownLink :href="route('teams.show', $page.props.auth.user.current_team)">
                        Team Settings
                      </DropdownLink>

                      <DropdownLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')">
                        Create New Team
                      </DropdownLink>

                      <!-- Team Switcher -->
                      <template v-if="$page.props.auth.user.all_teams.length > 1">
                        <div class="border-t border-gray-200" />

                        <div class="block px-4 py-2 text-xs text-gray-400">
                          Switch Teams
                        </div>

                        <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                          <form @submit.prevent="switchToTeam(team)">
                            <DropdownLink as="button">
                              <div class="flex items-center">
                                <svg v-if="team.id == $page.props.auth.user.current_team_id"
                                  class="me-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                                <div>{{ team.name }}</div>
                              </div>
                            </DropdownLink>
                          </form>
                        </template>
                      </template>
                    </div>
                  </template>
                </Dropdown>
              </div>

              <!-- Settings Dropdown -->
              <div class="ms-3 relative">
                <Dropdown align="right" width="48">
                  <template #trigger>
                    <button v-if="$page.props.jetstream.managesProfilePhotos"
                      class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                      <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url"
                        :alt="$page.props.auth.user.name">
                    </button>

                    <span v-else class="inline-flex rounded-md">
                      <button type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                        {{ $page.props.auth.user.name }}

                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                      </button>
                    </span>
                  </template>
                  º
                  <template #content>
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                      Administrar cuenta
                    </div>

                    <DropdownLink :href="route('profile.show')">
                      Perfil
                    </DropdownLink>

                    <!-- <DropdownLink v-if="$page.props.jetstream.hasApiFeatures"
                        :href="route('api-tokens.index')">
                        API Tokens
                    </DropdownLink> -->

                    <div class="border-t border-gray-200" />

                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                      <DropdownLink as="button">
                        Cerrar sesión
                      </DropdownLink>
                    </form>
                  </template>
                </Dropdown>
              </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
              <button
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                @click="showingNavigationDropdown = !showingNavigationDropdown">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path :class="{ 'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  <path :class="{ 'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }" class="sm:hidden">
          <div class="pt-2 pb-3 space-y-1">
            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
              Dashboard
            </ResponsiveNavLink>
          </div>

          <!-- Responsive Settings Options -->
          <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
              <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 me-3">
                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url"
                  :alt="$page.props.auth.user.name">
              </div>

              <div>
                <div class="font-medium text-base text-gray-800">
                  {{ $page.props.auth.user.name }}
                </div>
                <div class="font-medium text-sm text-gray-500">
                  {{ $page.props.auth.user.email }}
                </div>
              </div>
            </div>

            <div class="mt-3 space-y-1">
              <ResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
                Perfil
              </ResponsiveNavLink>

              <!-- <ResponsiveNavLink v-if="$page.props.jetstream.hasApiFeatures"
                  :href="route('api-tokens.index')" :active="route().current('api-tokens.index')">
                  API Tokens
              </ResponsiveNavLink> -->

              <!-- Authentication -->
              <form method="POST" @submit.prevent="logout">
                <ResponsiveNavLink as="button">
                  Cerrar sesión
                </ResponsiveNavLink>
              </form>

              <!-- Team Management -->
              <template v-if="$page.props.jetstream.hasTeamFeatures">
                <div class="border-t border-gray-200" />

                <!-- <div class="block px-4 py-2 text-xs text-gray-400">
                    Manage Team
                </div> -->

                <!-- Team Settings -->
                <!-- <ResponsiveNavLink :href="route('teams.show', $page.props.auth.user.current_team)"
                    :active="route().current('teams.show')">
                    Team Settings
                </ResponsiveNavLink>

                <ResponsiveNavLink v-if="$page.props.jetstream.canCreateTeams"
                    :href="route('teams.create')" :active="route().current('teams.create')">
                    Create New Team
                </ResponsiveNavLink> -->

                <!-- Team Switcher -->
                <template v-if="$page.props.auth.user.all_teams.length > 1">
                  <div class="border-t border-gray-200" />

                  <div class="block px-4 py-2 text-xs text-gray-400">
                    Switch Teams
                  </div>

                  <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                    <form @submit.prevent="switchToTeam(team)">
                      <ResponsiveNavLink as="button">
                        <div class="flex items-center">
                          <svg v-if="team.id == $page.props.auth.user.current_team_id"
                            class="me-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>
                          <div>{{ team.name }}</div>
                        </div>
                      </ResponsiveNavLink>
                    </form>
                  </template>
                </template>
              </template>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header v-if="$slots.header" class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main>

        <div v-if="$page.props.flash.status" class="alert alert-success">
          {{ $page.props.flash.status }}
        </div>
        <div v-if="$page.props.flash.error" class="alert alert-danger">
          {{ $page.props.flash.error }}
        </div>






        <slot />

      </main>

    </div>
  </div>
  <button @click="toggleChat" style="position: fixed; bottom: 32px; right: 32px; z-index: 1000;"
    class="btn btn-primary rounded-5 h-16 w-16 shadow-xl">
    <!--    class="bg-blue-600 text-white rounded-full shadow-lg h-16 w-16 hover:bg-blue-700 transition"-->
    <i class="ri--chat-smile-ai-fill"></i>
  </button>


  <div class="" style="position: fixed; bottom: 32px; right: 120px; z-index: 1000;">
    <ChatWindow v-if="showChat" @close="showChat = false" />
  </div>
</template>
<style>
.ri--chat-smile-ai-fill::after {
  display: inline-block;
  width: 2em;
  height: 2em;
  vertical-align: -0.325em;
  content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23fff' d='m20.713 8.128l-.246.566a.506.506 0 0 1-.934 0l-.246-.566a4.36 4.36 0 0 0-2.22-2.25l-.759-.339a.53.53 0 0 1 0-.963l.717-.319a4.37 4.37 0 0 0 2.251-2.326l.253-.611a.506.506 0 0 1 .942 0l.253.61a4.37 4.37 0 0 0 2.25 2.327l.718.32a.53.53 0 0 1 0 .962l-.76.338a4.36 4.36 0 0 0-2.219 2.251M20 11c.67 0 1.313-.11 1.915-.312Q22 11.333 22 12c0 5.523-4.477 10-10 10a9.96 9.96 0 0 1-4.709-1.176L2 22l1.176-5.291A9.96 9.96 0 0 1 2 12C2 6.477 6.477 2 12 2c.906 0 1.783.12 2.617.346A6 6 0 0 0 20 11M7 12a5 5 0 0 0 10 0h-2a3 3 0 1 1-6 0z'/%3E%3C/svg%3E");
}
</style>
