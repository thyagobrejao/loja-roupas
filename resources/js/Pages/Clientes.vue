<template>
    <the-container>
        <CRow>
            <CCol md="8">
                <CCard>
                    <CCardHeader>Clientes</CCardHeader>
                    <CCardBody>
                        <CDataTable
                            :items="clientes"
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
                            :noItemsView="{noResults: 'Nenhum resultado encontrado.', noItems: 'Nenhuma Cliente Cadastrada'}"
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
                    <CCardHeader>Cadastrar Cliente</CCardHeader>
                    <CCardBody>
                        <cliente-form :data="{}"/>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
        <CModal
            title="Alterar dados da cliente"
            color="primary"
            v-if="modal"
            :show.sync="modal"
        >
            <cliente-form :data="atualData"/>
            <template #footer>
                <CButton @click="modal = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
    </the-container>
</template>

<script>
import TheContainer from "../containers/TheContainer";
import ClienteForm from "../Forms/ClienteForm";

const fields = [
    { key: 'nome', label: 'Nome'},
    { key: 'email', label: 'Email'},
    { key: 'telefone', label: 'Telefone'},
    { key: 'tamanho', label: 'Tamanho'},
    {
        key: 'show_details',
        label: '',
        sorter: false,
        filter: false
    }
]

export default {
    name: "Clientes",

    props: ['clientes'],

    data () {
        return {
            fields,
            atualData: {},
            modal: false,
        }
    },

    methods: {
        alterar: function(item) {
            this.atualData = item;
            this.modal = true;
        },
    },

    components: {
        TheContainer,
        ClienteForm,
    }
}
</script>
