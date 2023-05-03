import { createApp, h } from "vue";
import { createInertiaApp, Link, Head } from "@inertiajs/vue3";

import PublicPagesLayout from "./Shared/PublicPagesLayout/PublicPagesLayout.vue";
import CustomerDashboardLayout from "./Shared/CustomerDashboardLayout/CustomerDashboardLayout.vue";
import AdminDashboardLayout from "./Shared/AdminDashboardLayout/AdminDashboardLayout.vue";


createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        if (name.startsWith("Public/CustomerDashboard/")) {
            page.default.layout = CustomerDashboardLayout;
        }
        else if (
            name.startsWith("Public/") ||
            name.startsWith("Auth/") ||
            name.startsWith("Cart/") ||
            name.startsWith("Checkout/")
        ) {
            page.default.layout = PublicPagesLayout;
        }
        if (name.startsWith("AdminDashboard/")) {
            page.default.layout = AdminDashboardLayout;
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
