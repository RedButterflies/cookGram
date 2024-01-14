import './bootstrap';
import { createApp } from 'vue';
import Alpine from 'alpinejs';
import FollowButton from './components/FollowButton.vue'

createApp({})
    .component('follow-button', FollowButton)
    .mount('#app')
window.Alpine = Alpine;
Alpine.start();
