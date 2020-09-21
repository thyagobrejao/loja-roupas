<template>
    <CHeader fixed light>
        <CToggler
            in-header
            class="ml-3 d-lg-none"
            @click="$store.commit('toggleSidebarMobile')"
        />
        <CToggler
            in-header
            class="ml-3 d-md-down-none"
            @click="$store.commit('toggleSidebarDesktop')"
        />
        <CHeaderNav class="mr-auto">
            <h2 class="topo">Sempre Linda</h2>
            <!--      <CHeaderNavItem class="px-3" to="/dashboard">Dashboard</CHeaderNavItem>-->
            <!--      <CHeaderNavItem class="px-3" to="/users" exact>Users</CHeaderNavItem>-->
            <!--      <CHeaderNavItem class="px-3">Settings</CHeaderNavItem>-->
        </CHeaderNav>
        <CHeaderNav class="mr-4">
            <!--      <CHeaderNavItem class="d-md-down-none mx-2">-->
            <!--        <i class="cui-bell"></i>-->
            <!--      </CHeaderNavItem>-->
            <!--      <CHeaderNavItem class="d-md-down-none mx-2">-->
            <!--        <i class="cui-list"></i>-->
            <!--      </CHeaderNavItem>-->
            <!--      <CHeaderNavItem class="d-md-down-none mx-2">-->
            <!--        <i class="cui-envelope-open"></i>-->
            <!--      </CHeaderNavItem>-->
            <TheHeaderDropdownAccnt v-if="exibeNome"/>
        </CHeaderNav>
    </CHeader>
</template>

<script>
    import TheHeaderDropdownAccnt from './TheHeaderDropdownAccnt'

    export default {
        name: 'TheHeader',
        data: function () {
            return {
                exibeNome: true,
            }
        },
        created: function () {
            this.exibeNome = this.$page.user.name;
        },
        components: {
            TheHeaderDropdownAccnt
        }
    }
</script>
