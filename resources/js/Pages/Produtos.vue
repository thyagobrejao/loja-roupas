<template>
    <the-container>
        <CRow>
            <CCol md="8">
                <CCard>
                    <CCardHeader>Produtos</CCardHeader>
                    <CCardBody>
                        <CDataTable
                            :items="produtosFormat"
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
                            :noItemsView="{noResults: 'Nenhum resultado encontrado.', noItems: 'Nenhum Produto Cadastrado'}"
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
                            <template #ativo="{item}">
                                <td class="py-2 text-center">
                                    <div v-if="item.ativo === 1">
                                        <CBadge color="success">Sim</CBadge>
                                        <inertia-link
                                            :href="`/produto/ativo/${item.id}`"
                                            class="btn btn-danger btn-sm"
                                            method="put"
                                        >
                                            Desativar
                                        </inertia-link>
                                    </div>
                                    <div v-else>
                                        <CBadge color="warning">Não</CBadge>
                                        <inertia-link
                                            :href="`/produto/ativo/${item.id}`"
                                            class="btn btn-success btn-sm"
                                            method="put"
                                        >
                                            Ativar
                                        </inertia-link>
                                    </div>
                                </td>
                            </template>
                        </CDataTable>
                    </CCardBody>
                </CCard>
            </CCol>
            <CCol md="4">
                <CCard>
                    <CCardHeader>Cadastrar Produto</CCardHeader>
                    <CCardBody>
                        <produto-form :data="{}" :fornecedores="fornecedores" :tipos_produtos="tipos_produtos"/>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
        <CModal
            title="Alterar dados do Produto"
            color="primary"
            v-if="modal"
            :show.sync="modal"
        >
            <produto-form :data="atualData" :fornecedores="fornecedores" :tipos_produtos="tipos_produtos"/>
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
import ProdutoForm from "../Forms/ProdutoForm";

const fields = [
    {key: 'codigo', label: 'Código'},
    {key: 'descricao', label: 'Descrição'},
    {key: 'tipo_produto', label: 'Tipo de Produto'},
    {key: 'cor', label: 'Cor'},
    {key: 'fornecedor_nome', label: 'Fornecedor'},
    {key: 'valor_sugerido', label: 'Valor Para Venda'},
    {key: 'caminho_foto', label: 'Foto'},
    {key: 'ativo', label: 'Ativo',},
    {
        key: 'show_details',
        label: '',
        sorter: false,
        filter: false
    }
]

export default {
    name: "Produtos",

    props: ['produtos', 'fornecedores', 'tipos_produtos'],

    data() {
        return {
            fields,
            atualData: {},
            modal: false,
            modalFotos: false,
        }
    },

    computed: {
        produtosFormat: function () {
            return this.produtos.map(item => {
                item.tipo_produto = item.tipo_produto.descricao;
                item.fornecedor_nome = item.fornecedore.nome;
                if (item.foto.length > 0) {
                    item.caminho_foto = item.foto[0].caminho
                }
                return item;
            });
        }
    },

    mounted() {
        this.$root.$on('fechar-modal-produto', () => {
            this.modal = false;
        });
    },

    methods: {
        alterar: function (item) {
            this.atualData = item;
            this.modal = true;
        },
        abreFotos: function (item) {
            this.atualData = item;
            this.modalFotos = true;
        },
    },

    components: {
        ProdutoForm,
        TheContainer,
    }
}
</script>
