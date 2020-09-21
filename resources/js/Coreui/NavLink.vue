<template>
    <li class="c-sidebar-nav-item">
        <inertia-link :href="href" class="c-sidebar-nav-link">
            <CIcon v-if="icon" v-bind="computedIcon"/>
            {{ name }}
        </inertia-link>
    </li>
</template>

<script>

import CIcon from '@coreui/icons-vue/src/CIconRaw.vue'

export default {
    props: ['href', 'icon', 'name'],

    computed: {

        computedIcon() {
            if (typeof this.icon === 'object') {
                const key = this.icon.size ? 'class' : 'customClasses'
                return {
                    ...this.icon,
                    [`${key}`]: this.icon.customClasses ||
                    ['c-sidebar-nav-icon', this.icon.className]
                }
            } else {
                return {customClasses: 'c-sidebar-nav-icon', name: this.icon}
            }
        }
    },
    components: {
        CIcon
    },
}
</script>
