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
                    <CButton>
                        <font-awesome-icon icon="user-shield"/>
                        <b class="d-md-down-none">{{ $page.user.name }}</b>
                        <font-awesome-icon icon="angle-down"/>
                    </CButton>
                </div>
            </CHeaderNavItem>
        </template>
        <CDropdownItem>
            <inertia-link class="dropdown-item" role="menuitem" href="/user/profile">
                Perfil
            </inertia-link>
        </CDropdownItem>
        <CDropdownItem>
            <form @submit.prevent="logout">
                <button type="submit" class="dropdown-item" role="menuitem">
                    Sair
                </button>
            </form>
        </CDropdownItem>
    </CDropdown>
</template>

<script>

export default {
    name: 'TheHeaderDropdownAccnt',
    data() {
        return {
            itemsCount: 42,
        }
    },
    computed: {},
    methods: {
        logout() {
            axios.post('/logout').then(response => {
                window.location = '/';
            })
        },
    },
    components: {},
}
</script>
