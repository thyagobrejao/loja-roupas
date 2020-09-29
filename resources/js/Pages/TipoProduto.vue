<template>
    <the-container>
        <CRow>
            <CCol md="8">
                <CCard>
                    <CCardHeader>Tipo de Produtos</CCardHeader>
                    <CCardBody>
                        <CDataTable
                            :items="tipo"
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
                            :noItemsView="{noResults: 'Nenhum resultado encontrado.', noItems: 'Nenhuma tipo Cadastrada'}"
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
                    <CCardHeader>Cadastrar Tipo de Produto</CCardHeader>
                    <CCardBody>
                        <tipo-produto-form :data="{}"/>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
        <CModal
            title="Alterar tipos de Produto"
            color="primary"
            v-if="modal"
            :show.sync="modal"
        >
            <tipo-produto-form :data="atualData"/>
            <template #footer>
                <CButton @click="modal = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
    </the-container>
</template>

<script>
import TheContainer from "../containers/TheContainer";
import TipoProdutoForm from "../Forms/TipoProdutoForm";

const fields = [
    { key: 'descricao', label: 'Descrição'},
    {
        key: 'show_details',
        label: '',
        sorter: false,
        filter: false
    }
]

export default {
    name: "TipoProduto",

    props: ['tipo'],

    data () {
        return {
            fields,
            atualData: {},
            modal: false,
        }
    },

    mounted() {
        this.$root.$on('fechar-modal-tipo', () => {
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
        TipoProdutoForm,
        TheContainer,
    }
}
</script>
