<template>
    <the-container>
        <CRow>
            <CCol md="8">
                <CCard>
                    <CCardHeader>Fornecedores</CCardHeader>
                    <CCardBody>
                        <CDataTable
                            :items="fornecedores"
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
                            :noItemsView="{noResults: 'Nenhum resultado encontrado.', noItems: 'Nenhum Fornecedor Cadastrada'}"
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
                    <CCardHeader>Cadastrar Fornecedor</CCardHeader>
                    <CCardBody>
                        <fornecedores-form :data="{}"/>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
        <CModal
            title="Alterar dados do Fornecedor"
            color="primary"
            v-if="modal"
            :show.sync="modal"
        >
            <fornecedores-form :data="atualData"/>
            <template #footer>
                <CButton @click="modal = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
    </the-container>
</template>

<script>
import TheContainer from "../containers/TheContainer";
import FornecedoresForm from "../Forms/FornecedoresForm";

const fields = [
    { key: 'nome', label: 'Nome'},
    { key: 'endereco', label: 'Endereço'},
    { key: 'telefone', label: 'Telefone'},
    {
        key: 'show_details',
        label: '',
        sorter: false,
        filter: false
    }
]

export default {
    name: "Fornecedores",

    props: ['fornecedores'],

    data () {
        return {
            fields,
            atualData: {},
            modal: false,
        }
    },

    mounted() {
        this.$root.$on('fechar-modal-fornecedor', () => {
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
        FornecedoresForm,
        TheContainer,
    }
}
</script>
