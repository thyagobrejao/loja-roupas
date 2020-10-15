<template>
    <the-container>
        <CRow>
            <CCol md="8">
                <CCard>
                    <CCardHeader>Notas Fiscais</CCardHeader>
                    <CCardBody>
                        <CDataTable
                            :items="notasFormat"
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
                            :noItemsView="{noResults: 'Nenhum resultado encontrado.', noItems: 'Nenhuma Nota Fiscal Cadastrada'}"
                        >
                            <template #caminho_foto="{item}">
                                <td class="py-2">
                                    <CLink @click="abreModalNota(item.caminho_foto)" v-if="item.caminho_foto">
                                        <CImg
                                            width="100"
                                            thumbnail
                                            fluid
                                            :src="`/images?path=/notas/${item.caminho_foto}`"
                                        />
                                    </CLink>
                                    <CBadge v-else color="info">Sem Foto</CBadge>
                                </td>
                            </template>
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
                    <CCardHeader>Cadastrar Nota Fiscal</CCardHeader>
                    <CCardBody>
                        <nota-fiscal-form :data="{}"/>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
        <CModal
            title="Alterar dados da Nota Fiscal"
            color="primary"
            v-if="modal"
            :show.sync="modal"
        >
            <nota-fiscal-form :data="atualData"/>
            <template #footer>
                <CButton @click="modal = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
        <CModal
            title="Detalhes da nota"
            color="primary"
            v-if="modalNotaId"
            :show.sync="modalNota"
        >
            <CImg
                fluid
                :src="`/images?path=/notas/${modalNotaId}`"
            />
            <template #footer>
                <CButton @click="modalNota = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
    </the-container>
</template>

<script>
import TheContainer from "../containers/TheContainer";
import NotaFiscalForm from "../Forms/NotaFiscalForm";

const fields = [
    { key: 'valor_total', label: 'Valor Total'},
    { key: 'data', label: 'Data'},
    { key: 'caminho_foto', label: 'Foto'},
    {
        key: 'show_details',
        label: '',
        sorter: false,
        filter: false
    }
]

export default {
    name: "NotaFiscal",

    props: ['notas_fiscais'],

    data () {
        return {
            fields,
            atualData: {},
            modal: false,
            modalNota: false,
            modalNotaId: null,
        }
    },

    mounted() {
        this.$root.$on('fechar-modal-notafiscal', () => {
            this.modal = false;
        });
    },

    computed: {
        notasFormat: function () {
            return this.notas_fiscais.map(item => {
                item.data = moment(item.data).format('DD/MM/YYYY');
                return item;
            });
        }
    },

    methods: {
        alterar: function(item) {
            this.atualData = item;
            this.modal = true;
        },
        abreModalNota: function (id) {
            this.modalNotaId = id;
            this.modalNota = true;
        }
    },

    components: {
        NotaFiscalForm,
        TheContainer,
    }
}
</script>
