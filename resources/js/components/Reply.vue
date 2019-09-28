<template>

    <div :id="'reply-'+id" class="card my-4">
        <div class="card-header" :class="isBest ? 'bg-success text-white' : ''">
            <div class="level d-flex justify-content-between">
                <h5><a :href="'/profiles/'+ reply.owner.name" v-text="reply.owner.name" class="text-dark"></a> said
                    <span v-text="ago"></span></h5>
                <div v-if="signedIn">
                    <favorite :reply="reply"></favorite>
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

        <div class="card-footer d-flex" v-if="authorize('owns', reply) || authorize('owns', reply.thread)">
            <div v-if="authorize('owns', reply)">
                <button class="btn btn-sm btn-info mr-2" @click="editing = true" v-if="! editing">Edit</button>
                <button class="btn btn-sm btn-danger mr-2" @click="destroy">Delete</button>
            </div>

            <button class="btn btn-sm btn-light ml-auto" @click.prevent="maskBestReply" v-if="authorize('owns', reply.thread)">Mark as Best</button>

        </div>

    </div>

</template>
<script>
    import Favorite from './Favorite';
    import moment from 'moment';

    export default {
        props: ['reply'],

        components: {Favorite},

        data() {
            return {
                editing: false,
                id: this.reply.id,
                body: this.reply.body,
                isBest: this.reply.isBest,
            }
        },

        created() {
          window.events.$on('best-reply-selected', id => {
              this.isBest = (id === this.id);
          })
        },

        computed: {
            ago() {
                return moment(this.reply.created_at).fromNow() + '...';
            }
        },

        methods: {
            update() {
                axios.patch(`/replies/${this.id}`, {
                    body: this.body
                }).catch(error => {

                });
                this.editing = false;
                flash('Updated!!!');
            },

            destroy() {
                axios.delete(`/replies/${this.id}`);
                this.$emit('deleted', this.id);
                flash('You successfully deleted reply!!!', 'danger');
            },

            maskBestReply() {
                axios.post(`/replies/${this.id}/best`).catch(error => flash(error.response.data, 'danger'));
                window.events.$emit('best-reply-selected', this.id);
            }
        }
    }
</script>

