Nova.booting((Vue, router) => {
    Nova.inertia("ManageOrderTool", require("./components/Tool").default);

    Vue.component('manage-order-tool', require('./components/Tool'));
})
