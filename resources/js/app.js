import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import GuestLayout from './Pages/Layouts/GuestLayout.vue';
import AdminLayout from './Pages/Layouts/AdminLayout.vue';
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

        vueApp.component('GuestLayout', GuestLayout);
        vueApp.component ('AdminLayout', AdminLayout);
        vueApp.component('Head', Head);
        vueApp.component('Link', Link);

        vueApp.mixin({
            methods: {
                setTitle(title) {
                    return `${title}`;
                }
            }
        });

        vueApp.mount(el);
    },
    progress: {
        color: 'orange',
        includeCSS: true,
        showSpinner: false,
    },
});
