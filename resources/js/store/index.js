import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

const state = {
    sidebarShow: 'responsive',
    sidebarMinimize: true
}

const mutations = {
    toggleSidebarDesktop (state) {
        const sidebarOpened = [true, 'responsive'].includes(state.sidebarShow)
        state.sidebarShow = sidebarOpened ? false : 'responsive'
    },
    toggleSidebarMobile (state) {
        const sidebarClosed = [false, 'responsive'].includes(state.sidebarShow)
        state.sidebarShow = sidebarClosed ? true : 'responsive'
    },
    set (state, [variable, value]) {
        state[variable] = value
    }
}

export default new Vuex.Store({
    state,
    mutations,
});
