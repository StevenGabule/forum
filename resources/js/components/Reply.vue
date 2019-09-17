<template>
    <div :id="'reply-'+id" class="card my-4">
        <div class="card-header">
            <div class="level d-flex justify-content-between">
                <h5>
                    <a :href="'/profiles/'+ data.owner.name" v-text="data.owner.name"></a>
                    said {{ data.created_at }}...
                </h5>
                <div v-if="signedIn">
                    <favorite :reply="data"></favorite>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <button class="btn btn-sm btn-primary" @click="update">Update</button>
                <button class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
            </div>
            <div v-else v-text="body"></div>
        </div>

        <div class="card-footer d-flex" v-if="canUpdate">
            <button class="btn btn-sm btn-info mr-2" @click="editing = true">Edit</button>
            <button class="btn btn-sm btn-danger mr-2" @click="destroy">Delete</button>
        </div>

    </div>

</template>
<script>
    import Favorite from './Favorite';

    export default {
        props: ['data'],

        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body
            }
        },

        components: { Favorite },

        computed: {
           signedIn() {
               return window.App.signedIn;
           },
            canUpdate() {
               return this.authorize(user => this.data.user_id === user.id);
            }
        },

        methods: {
            update() {
                axios.patch(`/replies/${this.data.id}`, {
                    body: this.body
                });
                this.editing = false;
                flash('Updated!!!');
            },
            destroy() {
                axios.delete(`/replies/${this.data.id}`);
                this.$emit('deleted', this.data.id);
            }
        }
    }
</script>

