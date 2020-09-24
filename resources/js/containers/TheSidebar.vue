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
            <nav-link icon="cil-speedometer" name="Estoque" href="/dashboard"/>
            <nav-link icon="cil-airplane-mode" name="Saídas" href="/saidas"/>
            <nav-link href="/entradas" icon="cil-monitor" name="Entradas"/>
            <nav-link href="/produtos" icon="cil-hot-tub" name="Produtos"/>
            <nav-link href="/categorias" icon="cil-highlighter" name="Categorias"/>
            <nav-link href="/clientes" icon="cil-mood-very-good" name="Clientes"/>
            <nav-link href="/relatorios" icon="cil-money" name="Relatórios"/>
            <nav-link href="/fornecedores" icon="cil-sitemap" name="Fornecedores"/>
            <nav-link href="/vendedores" icon="cil-mug" name="Vendedores"/>
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
