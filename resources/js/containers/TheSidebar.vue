<template>
    <CSidebar
        fixed
        :minimize="minimize"
        :show="show"
        @update:show="(value) => $store.commit('set', ['sidebarShow', value])"
    >
        <CSidebarBrand class="d-md-down-none" to="/">
            <CImg
                src="img/brand/prf.png"
                :width="117"
                :height="42"
                alt="SICOP"
                flat
                v-if="!minimize"
            />
            <CImg
                src="img/brand/PRF-brasao.png"
                :width="41"
                :height="50"
                alt="SICOP"
                flat
                v-if="minimize"
            />
        </CSidebarBrand>

        <CRenderFunction flat :content-to-render="$options.nav"/>
        <CSidebarMinimizer
            class="d-md-down-none"
            @click.native="$store.commit('set', ['sidebarMinimize', !minimize])"
        />
    </CSidebar>
</template>

<script>
    import nav from './_nav'
    export default {
        name: 'TheSidebar',
        nav,
        computed: {
            show () {
                return this.$store.state.sidebarShow
            },
            minimize () {
                return this.$store.state.sidebarMinimize
            }
        }
    }
</script>
