<template>
    <button class="btn" :class="active ? 'btn-primary' : 'btn-danger'" @click.prevent="subscribe">Subscribe</button>
</template>

<script>
    export default {
        props: ['active'],
        computed: {
            classes() {
                return ['btn', this.active ? 'btn-primary' : 'btn-danger'];
            }
        },
        methods: {
            subscribe() {
                axios[(this.active ? 'delete' : 'post')](location.pathname + '/subscriptions');
                this.active = !this.active;
            }
        }
    }
</script>
