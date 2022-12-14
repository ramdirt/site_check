import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createPinia } from 'pinia'
import { createInertiaApp, Head } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import Breeze from "@/Plugins/Breeze";

// Locale
import ViewUIPlus from "view-ui-plus";
import locale from 'view-ui-plus/dist/locale/ru-RU';
import "view-ui-plus/dist/styles/viewuiplus.css";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

const pinia = createPinia()

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async (name) => {
        let page = await resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        );

        return page;
    },
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(pinia)
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(Breeze)
            .use(ViewUIPlus, { locale })
            .component("Head", Head)
            .mount(el)
    },
});


InertiaProgress.init({ color: "#4B5563" });
