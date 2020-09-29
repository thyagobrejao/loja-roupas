<template>
    <the-container>
        <CRow>
            <CCol md="8">
                <CCard>
                    <CCardHeader>Formas de Pagamento</CCardHeader>
                    <CCardBody>
                        <CDataTable
                            :items="forma_pagamento"
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
                            :noItemsView="{noResults: 'Nenhum resultado encontrado.', noItems: 'Nenhuma Forma de Pagamento Cadastrada'}"
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
                    <CCardHeader>Cadastrar Forma de Pagamento</CCardHeader>
                    <CCardBody>
                        <forma-pagamento-form :data="{}"/>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
        <CModal
            title="Alterar dados da Forma de Pagamento"
            color="primary"
            v-if="modal"
            :show.sync="modal"
        >
            <forma-pagamento-form :data="atualData"/>
            <template #footer>
                <CButton @click="modal = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
    </the-container>
</template>

<script>
import TheContainer from "../containers/TheContainer";
import FormaPagamentoForm from "../Forms/FormaPagamentoForm";

const fields = [
    { key: 'descricao', label: 'Descrição'},
    { key: 'taxa', label: 'Taxa'},
    {
        key: 'show_details',
        label: '',
        sorter: false,
        filter: false
    }
]

export default {
    name: "FormaPagamento",

    props: ['forma_pagamento'],

    data () {
        return {
            fields,
            atualData: {},
            modal: false,
        }
    },

    mounted() {
        this.$root.$on('fechar-modal-forma-pagamento', () => {
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
        FormaPagamentoForm,
        TheContainer,
    }
}
</script>
