<template>
    <div>
        <div v-if="signedIn">
            <div class="form-group mt-3">
                <textarea name="body"
                          id="body"
                          rows="5"
                          class="form-control"
                          placeholder="Have something to say?"
                          required
                          v-model="body"></textarea>
            </div>
            <button type="submit" class="btn btn-danger btn-sm" @click.prevent="addReply">Post</button>
        </div>
        <p class="text-center" v-else>Please <a href="/login">sign in</a> to participate in the discussion.</p>
    </div>
</template>

<script>
    import 'jquery.caret';
    import 'at.js';

    export default {
        data() {
            return {
                body: '',
            }
        },

        mounted() {
            $('#body').atwho({
                at: "@",
                delay: 750,
                callbacks: {
                    remoteFilter: function (query, callback) {
                        $.getJSON("/api/users", {name: query}, function($usernames) {
                            callback($usernames)
                        })
                    }
                }
            })
        },

        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', {body: this.body})
                    .catch(error => {
                        flash(error.response.data, 'danger');
                    })
                    .then(({data}) => {
                        this.body = '';
                        flash('Your reply has been posted.');
                        this.$emit('created', data);
                    });
            }
        }
    }
</script>

