import { createApp, h } from "vue";
import { createInertiaApp, Link, Head } from "@inertiajs/vue3";

import PublicLayout from "./Shared/PublicLayout.vue";
import CustomerDashboardLayout from "./Shared/CustomerDashboardLayout.vue";


createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        if (
            name.startsWith("Public/") ||
            name.startsWith("Auth/") ||
            name.startsWith("Cart/")
        ) {
            page.default.layout = PublicLayout;
        }
        if (name.startsWith("CustomerDashboard/")) {
            page.default.layout = CustomerDashboardLayout;
        }
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            // .use(router)
            .component("Link", Link)
            .component("Head", Head)
            .mount(el);
    },
    title: (title) => `My App - ${title}`,
});
