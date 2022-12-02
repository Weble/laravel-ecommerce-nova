<template>
    <div>
        <div class="flex flex-row justify-left">
            <div :key="transition" v-for="(metadata, transition) in transitions" class="mr-2">
                <DefaultButton @click="apply(transition)" class=""
                        :class="metadata.classes ? metadata.classes : ''">
                    {{ metadata.title ? metadata.title : transition }}
                </DefaultButton>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['resourceName', 'resourceId', 'panel'],


        methods: {
            async apply(transaction) {
                let url = `change-order-status/${this.resourceId}/${transaction.replace(/\s/g, '_')}`;
                await Nova.request().post(`/nova-vendor/weble/laravel-ecommerce-nova/${url}`);

                Nova.success('Order status applied');
                Nova.visit(`/resources/${this.resourceName}/${this.resourceId}`)
            },
        },

        computed: {
            transitions() {
                return this.panel.fields[0].transitions;
            }
        }
    }
</script>

<style>
    /* Scoped Styles */
</style>
