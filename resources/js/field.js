Nova.booting((Vue, router) => {
    Vue.component('index-nova-laravel-ecommerce-money-field', require('./components/IndexField'));
    Vue.component('detail-nova-laravel-ecommerce-money-field', require('./components/DetailField'));
    Vue.component('form-nova-laravel-ecommerce-money-field', require('./components/FormField'));
})
