<template>
    <the-container>
        <CRow>
            <CCol md="8">
                <CCard>
                    <CCardHeader>Entradas</CCardHeader>
                    <CCardBody>
                        <CDataTable
                            :items="entradasFormat"
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
                            <template #caminho_foto="{item}">
                                <td class="py-2">
                                    <CLink
                                        v-if="item.caminho_foto"
                                        @click="abreFotos(item)"
                                    >
                                        <CImg
                                            width="200"
                                            thumbnail
                                            fluid
                                            :src="`/images?path=${item.caminho_foto}`"
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
            title="Alterar dados da Entrada"
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
        <CModal
            title="Fotos do produto"
            color="primary"
            v-if="modalFotos"
            :show.sync="modalFotos"
            size="xl"
        >
            <CRow v-for="(foto, index) in atualData.foto" :key="index">
                <CImg
                    fluid
                    block
                    align="center"
                    :src="`/images?path=${foto.caminho}`"
                />
                <inertia-link
                    :href="`/foto/${foto.id}`"
                    method="delete"
                    class="btn btn-danger btn-block"
                >
                    Apagar
                </inertia-link>
            </CRow>
            <template #footer>
                <CButton @click="modalFotos = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
    </the-container>
</template>

<script>
import TheContainer from "../containers/TheContainer";
import EntradasForm from "../Forms/EntradasForm";

const fields = [
    { key: 'codigo', label: 'Código'},
    { key: 'descricao', label: 'Descrição'},
    { key: 'tipo_produto', label: 'Tipo'},
    { key: 'cor', label: 'Cor'},
    { key: 'quantidade', label: 'Qtd'},
    { key: 'tamanho', label: 'Tamanho'},
    { key: 'valor_unitario', label: 'Valor Unitário'},
    { key: 'caminho_foto', label: '', sorter: false, filter: false},
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
            modalFotos: false,
        }
    },

    computed: {
        entradasFormat: function () {
            return this.entradas.map(item => {
                item.codigo = item.produto.codigo;
                item.descricao = item.produto.descricao;
                item.tipo_produto = item.produto.tipo_produto.descricao;
                item.cor = item.produto.cor;
                if (item.produto.foto.length > 0) {
                    item.caminho_foto = item.produto.foto[0].caminho
                }
                return item;
            });
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
        abreFotos: function (item) {
            this.atualData = item;
            this.modalFotos = true;
        },
    },

    components: {
        EntradasForm,
        TheContainer,
    }
}
</script>
