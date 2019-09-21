<template>
    <div class="jumbotron jumbotron-fluid">
        <h1 class="display-6 text-capitalize" v-text="user.name"></h1>
        <form v-if="canUpdate">
            <image-upload name="avatar" class="mr-1" @loaded="onLoad"></image-upload>
        </form>
        <img :src="avatar" alt="" width="50" height="50">
    </div>
</template>

<script>
    import ImageUpload from './ImageUpload';

    export default {
        props: ['user'],
        components: {ImageUpload},
        data() {
            return {
                avatar: this.user.avatar_path,
            }
        },
        computed: {
            canUpdate() {
                return this.authorize(user => user.id === this.user.id);
            }
        },
        methods: {
            onLoad(avatar) {
                this.avatar = avatar.src;
                this.persist(avatar.file);
            },
            persist(avatar) {
                let data = new FormData();
                data.append('avatar', avatar);
                axios.post(`/api/users/${this.user.name}/avatar`, data).then(() => flash('Avatar was uploaded')).catch(error => flash(error.message, 'danger'))
            }
        }
    }
</script>
