<script>
    import Replies from '../components/Replies';
    import SubscribeButton from '../components/SubscribeButton';

    export default {
        props: ['thread'],

        components: {Replies, SubscribeButton},

        data() {
            return {
                repliesCount: this.thread.replies_count,
                locked: this.thread.locked,
                title: this.thread.title,
                body: this.thread.body,
                form: {},
                editing: false,
            }
        },

        created() {
            this.resetForm();
        },

        methods: {
            ToggleLock() {
                axios[this.locked ? 'delete' : 'post']('/locked-threads/' + this.thread.slug);
                this.locked = !this.locked;
            },

            update() {
                let uri = `/threads/${this.thread.channel.slug}/${this.thread.slug}`;
                axios.patch(uri, this.form).then(() => {
                    flash('Your thread has been updated.');
                    this.editing = false;
                    this.title = this.form.title;
                    this.body = this.form.body;
                });
            },

            resetForm() {
                this.form = {
                    title: this.thread.title,
                    body: this.thread.body
                };
                this.editing = false;
            },
        }
    }
</script>

