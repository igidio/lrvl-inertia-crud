<script setup>
import { ScheduleXCalendar } from '@schedule-x/vue'
import {
    createCalendar,
    viewDay,
    viewWeek,
    viewMonthGrid,
    viewMonthAgenda,
} from '@schedule-x/calendar'
import '@schedule-x/theme-default/dist/index.css'
import { createDragAndDropPlugin } from '@schedule-x/drag-and-drop'
import { createEventsServicePlugin } from '@schedule-x/events-service'
import { defineProps, ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
    appointments: {
        type: Array,
        required: true,
    }
})

console.log(props.appointments);

const selected = ref({
    id: null,
    titulo: null,
    inicio: null,
    fin: null,
    tiempo: null,
    cliente: null,
    servicio: null,
    descripcion: null,
    precio: null,
    notas: null,
})

const eventsServicePlugin = createEventsServicePlugin();

const calendarApp = createCalendar({
    plugins: [createDragAndDropPlugin(), eventsServicePlugin, /*createEventModalPlugin()*/],
    views: [viewDay, viewWeek, viewMonthGrid, viewMonthAgenda],
    defaultView: viewMonthGrid.name,

    //events: props.appointments,
    events: [
        {
            id: 1,
            title: 'Coffee with John',
            start: '2024-06-04 10:05',
            end: '2024-06-04 10:35',
        },
        {
            id: 2,
            title: 'Ski trip',
            start: '2024-06-05 10:05',
            end: '2024-06-05 12:05',
        },
        {
            id: 3,
            title: 'Ski trip',
            start: '2024-06-06 10:05',
            end: '2024-06-06 12:05',
        },
    ],

    locale: 'es-ES',
    callbacks: {
        onEventUpdate(updatedEvent) {
            moveAndUpdate(updatedEvent);
        },

        onEventClick(calendarEvent) {
            console.log(calendarEvent);
            // selected.value = {
            //     id: calendarEvent.id,
            //     titulo: calendarEvent.title,
            //     inicio: calendarEvent.start,
            //     fin: calendarEvent.end,
            //     tiempo: getOnlyHours(calendarEvent.start, calendarEvent.end),
            //     cliente: {
            //         nombre: calendarEvent.cliente.nombres + ' ' + calendarEvent.cliente.apellidos,
            //         telefono: calendarEvent.cliente.telefono,
            //         email: calendarEvent.cliente.email,
            //         direccion: calendarEvent.cliente.direccion,
            //         ci: calendarEvent.cliente.ci,
            //     },
            //     descripcion: calendarEvent.servicio.descripcion,
            //     notas: calendarEvent.notas,
            //     precio: calendarEvent.servicio.precio + ' Bs.',
            // }
        },
    },
})

const getOnlyHours = (start, end) => {
    return `${getHourFromDate(start)} - ${getHourFromDate(end)}`;
}

const getHourFromDate = (fromHour) => {
    const hour = new Date(fromHour);
    const format = { hour: '2-digit', minute: '2-digit' };
    return hour.toLocaleTimeString('es-ES', format);
}

const destroy = (id) => {
    if (confirm('Desea Eliminar?')) {
        router.delete(route('appointment.destroy', id));
        eventsServicePlugin.remove(id);
        resetSelected()
    }
};

const moveAndUpdate = (data) => {
    console.log(data);
    router.put(`/appointment/move-and-update/${data.id}`, {
        fecha: data.start + ':00',
        hora: getHourFromDate(data.start) + ':00',
    });
    console.log({
        fecha: data.start,
        hora: getHourFromDate(data.start),
    });
}

const resetSelected = () => {
    selected.value = {
        id: null,
        titulo: null,
        inicio: null,
        fin: null,
        tiempo: null,
        cliente: null,
        servicio: null,
        descripcion: null,
        precio: null,
        notas: null,
    }
}
</script>

<template>
    <AppLayout title="Citas">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Citas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <Link :href="route('appointment.create')" class="d-grid gap-2 mb-4">
                <button class="btn btn-primary">Crear nueva cita</button>
                </Link>

                <div class="bg-white shadow-xl sm:rounded-lg">

                    <div>
                        <ScheduleXCalendar :calendar-app="calendarApp" />
                    </div>

                </div>

                <div class="card mt-3" v-if="selected.titulo">
                    <div class="card-body">
                        <h5 class="card-title">{{ selected.titulo }}</h5>
                        <div v-if="selected.notas" class="mb-3">
                            <b>Notas</b>

                            <p class="card-text">{{ selected.notas }}
                            </p>
                        </div>

                        <b class="card-title">Información de servicio</b>
                        <div class="d-flex flex-column mb-3">
                            <span><b class="mr-3">Precio:</b>{{ selected.precio }}</span>
                            <span><b class="mr-3">Tiempo:</b>{{ selected.tiempo }}</span>
                            <span><b class="mr-3">Tiempo:</b>{{ selected.descripcion }}</span>
                        </div>

                        <b class="card-title">Información de cliente</b>
                        <div class="d-flex flex-column">
                            <span><b class="mr-3">Cliente:</b>{{ selected.cliente.nombre }}</span>
                            <span><b class="mr-3">Teléfono:</b>{{ selected.cliente.telefono }}</span>
                            <span><b class="mr-3">Dirección:</b>{{ selected.cliente.direccion }}</span>
                            <span><b class="mr-3">Dirección:</b>{{ selected.cliente.email }}</span>
                            <span><b class="mr-3">CI:</b>{{ selected.cliente.ci }}</span>

                        </div>

                        <div class="mt-3">
                            <Link :href="route('appointment.edit', { id: selected.id })">
                            <button class="btn btn-warning mr-3">Editar</button>
                            </Link>
                            <button href="#" class="btn btn-danger" @click="destroy(selected.id)">Eliminar</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>



    </AppLayout>

</template>