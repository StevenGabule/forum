<template>
    <li class="nav-item dropdown" v-if="notifications.length">
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-bell"></i> Notification</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div v-for="notification in notifications">
                <a class="dropdown-item" :href="notification.data.link" v-text="notification.data.message" @click="maskAsRead(notification)"></a>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                notifications:false
            }
        },
        created() {
            axios.get(`/profiles/${window.App.user.name}/notifications`).then(response => this.notifications = response.data);
        },
        methods: {
            maskAsRead(notification) {
                axios.delete(`/profiles/${window.App.user.name}/notifications/${notification.id}`);
            }
        }
    }
</script>
