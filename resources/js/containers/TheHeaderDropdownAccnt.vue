<template>
    <CDropdown
        inNav
        class="c-header-nav-items"
        placement="bottom-end"
        add-menu-classes="pt-0"
    >
        <template #toggler>
            <CHeaderNavItem only-link>
                <div class="text-uppercase">
                    <CButton style="color: white">
                        <font-awesome-icon icon="user-shield" style="margin-right: 10px;"/>
                        <b class="d-md-down-none">{{ getNome }}</b>
                        <font-awesome-icon icon="angle-down" style="margin-left: 10px;"/>
                    </CButton>
                </div>
            </CHeaderNavItem>
        </template>
        <CDropdownItem @click="logout">
            <i class="cui-lock-locked mr-2"/> Sair
        </CDropdownItem>
    </CDropdown>
</template>

<script>
    import { mapGetters } from 'vuex';
    export default {
        name: 'TheHeaderDropdownAccnt',
        data() {
            return {
                itemsCount: 42,
            }
        },
        computed:  {
            ...mapGetters(['getNome']),
        },
        methods: {
            logout: function () {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push('/pages/login')
                    })
            }
        },
    }
</script>
