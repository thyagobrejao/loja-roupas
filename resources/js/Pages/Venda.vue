<template>
    <the-container>
        <CRow>
            <CCol md="8">
                <CCard>
                    <CCardHeader>Vendedoras</CCardHeader>
                    <CCardBody>
                        <CDataTable
                            :items="vendedoras"
                            :fields="fields"
                            column-filter
                            table-filter
                            items-per-page-select
                            :table-filter="{label: 'Filtrar', placeholder: '...'}"
                            :items-per-page-select="{label: 'Itens por página'}"
                            :items-per-page="10"
                            hover
                            sorter
                            pagination
                            :noItemsView="{noResults: 'Nenhum resultado encontrado.', noItems: 'Nenhuma Vendedora Cadastrada'}"
                        >
                            <template #show_details="{item}">
                                <td class="py-2">
                                    <CButton
                                        color="primary"
                                        variant="outline"
                                        square
                                        size="sm"
                                        @click="alterar(item)"
                                    >
                                        Alterar
                                    </CButton>
                                </td>
                            </template>
                        </CDataTable>
                    </CCardBody>
                </CCard>
            </CCol>
            <CCol md="4">
                <CCard>
                    <CCardHeader>Cadastrar Vendedora</CCardHeader>
                    <CCardBody>
                        <vendedoras-form :data="{}"/>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
        <CModal
            title="Alterar dados da Vendedora"
            color="primary"
            v-if="modal"
            :show.sync="modal"
        >
            <vendedoras-form :data="atualData"/>
            <template #footer>
                <CButton @click="modal = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
    </the-container>
</template>

<script>
import TheContainer from "../containers/TheContainer";
import VendedorasForm from "../Forms/VendedorasForm";

const fields = [
    { key: 'nome', label: 'Nome'},
    { key: 'email', label: 'Email'},
    { key: 'telefone', label: 'Telefone'},
    {
        key: 'show_details',
        label: '',
        sorter: false,
        filter: false
    }
]

export default {
    name: "Vendedoras",

    props: ['vendedoras'],

    data () {
        return {
            fields,
            atualData: {},
            modal: false,
        }
    },

    mounted() {
        this.$root.$on('fechar-modal-vendedora', () => {
            this.modal = false;
        });
    },

    methods: {
        alterar: function(item) {
            this.atualData = item;
            this.modal = true;
        },
    },

    components: {
        VendedorasForm,
        TheContainer,
    }
}
</script>
