<template>
    <div>
        <div class="flex flex-row justify-left">
            <div :key="transition" v-for="(metadata, transition) in field.transitions" class="mr-2">
                <button @click="apply(transition)" type="button" class=""
                        :class="metadata.classes ? metadata.classes : 'btn btn-default btn-primary'">
                    {{ metadata.title ? metadata.title : transition }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import {FormField} from 'laravel-nova'
    export default {
        props: ['resourceName', 'resourceId', 'field'],

        methods: {
            async apply(transaction) {
                let url = `change-order-status/${this.resourceId}/${transaction.replace(/\s/g, '_')}`;
                await Nova.request().post(`/nova-vendor/weble/laravel-ecommerce-nova/${url}`);

                this.$toasted.show('Order status applied', {type: 'success'});
                this.$router.push({
                    name: 'index',
                    params: {
                        resourceName: this.resourceName,
                        resourceId: this.resourceId,
                    },
                })
            },
        }
    }
</script>

<style>
    /* Scoped Styles */
</style>
