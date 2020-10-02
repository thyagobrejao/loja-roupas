<template>
    <the-container>
        <CRow>
            <CCol md="8">
                <CCard>
                    <CCardHeader>Entradas</CCardHeader>
                    <CCardBody>
                        <CDataTable
                            :items="entradas"
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
                            :noItemsView="{noResults: 'Nenhum resultado encontrado.', noItems: 'Nenhuma Entrada Cadastrada'}"
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
                    <CCardHeader>Cadastrar Entrada</CCardHeader>
                    <CCardBody>
                        <entradas-form
                            :data="{}"
                            :notas_fiscais="notas_fiscais"
                            :produtos="produtos"
                        />
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
            <entradas-form
                :data="atualData"
                :notas_fiscais="notas_fiscais"
                :produtos="produtos"
            />
            <template #footer>
                <CButton @click="modal = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
    </the-container>
</template>

<script>
import TheContainer from "../containers/TheContainer";
import EntradasForm from "../Forms/EntradasForm";

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
    name: "Entradas",

    props: ['entradas', 'notas_fiscais', 'produtos'],

    data () {
        return {
            fields,
            atualData: {},
            modal: false,
        }
    },

    mounted() {
        this.$root.$on('fechar-modal-entrada', () => {
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
        EntradasForm,
        TheContainer,
    }
}
</script>
