import './bootstrap';
import '../css/app.css';

//import 'bootstrap/dist/css/bootstrap.min.css';
import '../css/bootstrap.css';
import '../css/fontawesome.css';
import 'bootstrap';

import VCalendar from 'v-calendar';
import 'v-calendar/style.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(VCalendar, {
                locales: {
                    'pt-PT': {
                        firstDayOfWeek: 1,
                        masks: {
                            L: 'YYYY-MM-DD',
                            // ...optional `title`, `weekdays`, `navMonths`, etc
                        }
                    }
                }
            })
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
