<template>
    <CSidebar
        fixed
        :minimize="minimize"
        :show="show"
        @update:show="(value) => $store.commit('set', ['sidebarShow', value])"
    >
        <CSidebarBrand class="d-md-down-none" to="/">
            <CImg
                src="/img/semprelinda-117.png"
                :width="117"
                :height="'auto'"
                alt="SICOP"
                flat
                v-if="!minimize"
            />
            <CImg
                src="/img/semprelinda-41.png"
                :width="41"
                :height="'auto'"
                alt="SICOP"
                flat
                v-if="minimize"
            />
        </CSidebarBrand>

        <CSidebarNav>
            <nav-link icon="cil-speedometer" name="Teste" href="/user/profile"/>
        </CSidebarNav>
        <CSidebarMinimizer
            class="d-md-down-none"
            @click.native="$store.commit('set', ['sidebarMinimize', !minimize])"
        />
    </CSidebar>
</template>

<script>
    import NavLink from "../Coreui/NavLink";

    export default {
        name: 'TheSidebar',
        computed: {
            show () {
                return this.$store.state.sidebarShow
            },
            minimize () {
                return this.$store.state.sidebarMinimize
            }
        },
        components: {
            NavLink,
        }
    }
</script>
