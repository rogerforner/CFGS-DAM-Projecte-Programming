/*
|-------------------------------------------------------------------------------
| routes.js
|-------------------------------------------------------------------------------
| Contains all of the routes for the application
|
*/

// Imports Vue and VueRouter to extend with the routes.
import Vue from 'vue';
import VueRouter from 'vue-router';

// Extends Vue to use Vue Router.
Vue.use(VueRouter);

// Makes a new VueRouter that we will use to run all of the routes for the app.
export default new VueRouter({
    routes: [
        // Home
        {
            path: '/',
            name: 'home',
            component: Vue.component('Home', require('./pages/Home.vue'))
        },
        // Users
        {
            path: '/users',
            name: 'users',
            component: Vue.component('Users', require('./pages/Users.vue'))
        },
        {
            path: '/users/new',
            name: 'newuser',
            component: Vue.component('NewUser', require('./pages/NewUser.vue'))
        },
        {
            path: '/users/:id',
            name: 'user',
            component: Vue.component('User', require('./pages/User.vue'))
        },
        // Departments
        {
            path: '/programming/dp',
            name: 'dps',
            component: Vue.component('Departments', require('./pages/Departments.vue'))
        },
        {
            path: '/programming/dp/new',
            name: 'newdp',
            component: Vue.component('NewDepartment', require('./pages/NewDepartment.vue'))
        },
        {
            path: '/programming/dp/:id',
            name: 'dp',
            component: Vue.component('Department', require('./pages/Department.vue'))
        },
        // Professional Modules
        {
            path: '/programming/mp',
            name: 'mps',
            component: Vue.component('ProfessionalModules', require('./pages/ProfessionalModules.vue'))
        },
        {
            path: '/programming/mp/new',
            name: 'newmp',
            component: Vue.component('NewProfessionalModule', require('./pages/NewProfessionalModule.vue'))
        },
        {
            path: '/programming/mp/:id',
            name: 'mp',
            component: Vue.component('ProfessionalModule', require('./pages/ProfessionalModule.vue'))
        },
        // Training Units
        {
            path: '/programming/uf',
            name: 'ufs',
            component: Vue.component('TrainingUnits', require('./pages/TrainingUnits.vue'))
        },
        {
            path: '/programming/uf/new',
            name: 'newuf',
            component: Vue.component('NewTrainingUnit', require('./pages/NewTrainingUnit.vue'))
        },
        {
            path: '/programming/uf/:id',
            name: 'uf',
            component: Vue.component('TrainingUnit', require('./pages/TrainingUnit.vue'))
        },
        // Temaries
        {
            path: '/programming/nf',
            name: 'nfs',
            component: Vue.component('Temaries', require('./pages/Temaries.vue'))
        },
        {
            path: '/programming/nf/new',
            name: 'newnf',
            component: Vue.component('NewTemary', require('./pages/NewTemary.vue'))
        },
        {
            path: '/programming/nf/:id',
            name: 'nf',
            component: Vue.component('Temary', require('./pages/Temary.vue'))
        },
    ]
});