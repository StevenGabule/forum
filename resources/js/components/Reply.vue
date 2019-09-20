<template>
    <div :id="'reply-'+id" class="card my-4">
        <div class="card-header">
            <div class="level d-flex justify-content-between">
                <h5><a :href="'/profiles/'+ data.owner.name" v-text="data.owner.name"></a>said <span v-text="ago"></span></h5>
                <div v-if="signedIn">
                    <favorite :reply="data"></favorite>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div v-if="editing">
                <form @submit="update">
                    <div class="form-group mt-3">
                        <textarea class="form-control" v-model="body" required></textarea>
                    </div>
                    <button class="btn btn-sm btn-primary">Update</button>
                    <button class="btn btn-sm btn-link" @click="editing = false" type="button">Cancel</button>
                </form>
            </div>
            <div v-else v-html="body"></div>
        </div>

        <div class="card-footer d-flex" v-if="canUpdate">
            <button class="btn btn-sm btn-info mr-2" @click="editing = true">Edit</button>
            <button class="btn btn-sm btn-danger mr-2" @click="destroy">Delete</button>
        </div>

    </div>

</template>
<script>
    import Favorite from './Favorite';
    import moment from 'moment';

    export default {
        props: ['data'],

        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body
            }
        },

        components: {Favorite},

        computed: {
            signedIn() {
                return window.App.signedIn;
            },
            canUpdate() {
                return this.authorize(user => this.data.user_id === user.id);
            },
            ago() {
                return moment(this.data.created_at).fromNow() + '...';
            }
        },

        methods: {
            update() {
                axios.patch(`/replies/${this.data.id}`, {
                    body: this.body
                }).catch(error => {
                    flash(error.response.data, 'danger');
                });
                this.editing = false;
                flash('Updated!!!');
            },
            destroy() {
                axios.delete(`/replies/${this.data.id}`);
                this.$emit('deleted', this.data.id);
                flash('You successfully deleted reply!!!', 'danger');
            }
        }
    }
</script>

