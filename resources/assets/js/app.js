
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue         = require('vue');
window.toastr      = require('toastr');
window.moment      = require('moment');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Passport.
Vue.component('passport-clients', require('./components/passport/Clients.vue'));
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue'));
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));

// Paginació (importada en cada component).
Vue.component('pagination', require('./components/PaginationComponent.vue'));

// Users.
Vue.component('users', require('./components/UsersComponent.vue'));

// Scool Programming.
Vue.component('departments', require('./components/scool-programming/DepartmentsComponent.vue'));