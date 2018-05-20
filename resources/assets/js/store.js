// Adds the promise polyfill for IE 11
require('es6-promise').polyfill();

// Imports Vue and Vuex
import Vue from 'vue'
import Vuex from 'vuex'

// Initializes Vuex on Vue.
Vue.use(Vuex)

// Exports our data store.
export default new Vuex.Store({
    modules: {

    }
});