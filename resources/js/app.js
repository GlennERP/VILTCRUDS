import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import AdminLayout from './Pages/Layouts/AdminLayout.vue';
import GuestLayout from './Pages/Layouts/GuestLayout.vue';
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
            
        ),
        
    setup({ el, App, props, plugin }) {
        const vueApp = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy);

        vueApp.component('Head', Head);
        vueApp.component('Link', Link);
        vueApp.component('AdminLayout', AdminLayout);
        vueApp.component('GuestLayout', GuestLayout);

        vueApp.mount(el);
    },
    progress: {
        color: 'white',
        showSpinner: true,
    },
});