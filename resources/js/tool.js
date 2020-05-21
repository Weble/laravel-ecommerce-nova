Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'laravel-ecommerce-nova',
            path: '/laravel-ecommerce-nova',
            component: require('./components/Tool'),
        },
    ]);

    Vue.component('manage-order-tool', require('./components/Tool'));
})
