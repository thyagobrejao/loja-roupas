<template>
    <the-container>
        <CRow>
            <CCol md="8">
                <CCard>
                    <CCardHeader>Vendas</CCardHeader>
                    <CCardBody>
                        <CDataTable
                            :items="vendasFormat"
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
                            :noItemsView="{noResults: 'Nenhum resultado encontrado.', noItems: 'Nenhuma Venda Cadastrada'}"
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
                    <CCardHeader>Cadastrar Nova Venda</CCardHeader>
                    <CCardBody>
                        <vendas-form
                            :data="{}"
                            :clientes="clientes"
                            :vendedoras="vendedoras"
                            :produtos="produtos"
                            :formas_pagamento="formas_pagamento"
                        />
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
        <CModal
            title="Alterar dados da Venda"
            color="primary"
            v-if="modal"
            :show.sync="modal"
        >
            <vendas-form
                :data="atualData"
                :clientes="clientes"
                :vendedoras="vendedoras"
                :produtos="produtos"
                :formas_pagamento="formas_pagamento"
            />
            <template #footer>
                <CButton @click="modal = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
    </the-container>
</template>

<script>
import TheContainer from "../containers/TheContainer";
import VendasForm from "../Forms/VendaForm";

const fields = [
    {key: 'id', label: 'Cod Venda'},
    {key: 'cliente', label: 'Cliente'},
    {key: 'vendedora', label: 'Vendedora'},
    {key: 'forma_pagamento', label: 'Forma de Pagamento'},
    {
        key: 'show_details',
        label: '',
        sorter: false,
        filter: false
    }
]

export default {
    name: "Vendas",

    props: ['vendas', 'clientes', 'vendedoras', 'formas_pagamento', 'produtos'],

    data() {
        return {
            fields,
            atualData: {},
            modal: false,
        }
    },

    computed: {
        vendasFormat: function () {
            return this.vendas.map(item => {
                item.cliente = item.cliente.nome;
                item.vendedora = item.vendedora.nome;
                item.forma_pagamento = item.forma_pagamento.descricao;
                return item;
            });
        }
    },

    mounted() {
        this.$root.$on('fechar-modal-vendas', () => {
            this.modal = false;
        });
    },

    methods: {
        alterar: function (item) {
            this.atualData = item;
            this.modal = true;
        },
    },

    components: {
        VendasForm,
        TheContainer,
    }
}
</script>
