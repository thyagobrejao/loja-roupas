<template>
    <the-container>
        <CRow>
            <CCol md="12">
                <CCard>
                    <CCardHeader>
                        Estoque
                    </CCardHeader>
                    <CCardBody>
                        <CDataTable
                            :items="estoqueFormat"
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
                            <template #estoque="{item}">
                                <td class="py-2">
                                    <ul v-if="!isEmpty(item.tamanhos)">
                                        <li v-for="(tamanho, index) in item.tamanhos" :key="index">
                                            {{ index }} - {{ tamanho }}
                                        </li>
                                    </ul>
                                    <CBadge v-else color="warning">Sem Estoque</CBadge>
                                </td>
                            </template>
                            <template #reservas="{item}">
                                <td class="py-2">
                                    <ul v-if="!isEmpty(item.reservas)">
                                        <li v-for="(tamanho, index) in item.reservas" :key="index">
                                            {{ index }} - {{ tamanho }}
                                        </li>
                                    </ul>
                                    <CBadge v-else color="info">Sem Reserva</CBadge>
                                </td>
                            </template>
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
                        </CDataTable>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
        <CRow>
            <CCol md="4">
                <CCard>
                    <CCardHeader>
                        Números
                    </CCardHeader>
                    <CCardBody>
                        <table class="table table-bordered table-striped table-hover">
                            <tbody>
                            <tr>
                                <td>Peças de entrada</td>
                                <td>{{ numeros.entradas.qts }}</td>
                            </tr>
                            <tr>
                                <td>Valor gasto de entrada</td>
                                <td>R$ {{ numeros.entradas.valor }}</td>
                            </tr>
                            <tr>
                                <td>Peças de saída</td>
                                <td>{{ numeros.saidas.qts }}</td>
                            </tr>
                            <tr>
                                <td>Valor recebido pelas vendas</td>
                                <td>R$ {{ numeros.saidas.valor }}</td>
                            </tr>
                            <tr>
                                <td>Total em caixa</td>
                                <td>R$ {{ numeros.saidas.valor - numeros.entradas.valor }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
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

    const fields = [
        {key: 'codigo', label: 'Código'},
        {key: 'descricao', label: 'Descrição'},
        {key: 'tipo', label: 'Tipo de Produto'},
        {key: 'fornecedor', label: 'Fornecedor'},
        {key: 'valor_sugerido', label: 'Valor Para Venda'},
        {key: 'entradas', label: 'Entradas'},
        {key: 'saidas', label: 'Saídas'},
        {key: 'estoque', label: 'Estoque'},
        {key: 'reservas', label: 'Reservas'},
        {
            key: 'caminho_foto',
            label: '',
            sorter: false,
            filter: false
        }
    ]

    export default {
        name: "Dashboard",
        props: ['estoque', 'numeros'],

        data() {
            return {
                fields,
                atualData: {},
                modalFotos: false,
            }
        },

        computed: {
            estoqueFormat: function () {
                return this.estoque.map(item => {
                    item.tipo = item.tipo_produto.descricao;
                    item.fornecedor = item.fornecedore.nome;
                    if (item.foto.length > 0) {
                        item.caminho_foto = item.foto[0].caminho;
                    } else {
                        item.caminho_foto = null;
                    }
                    return item;
                });
            }
        },

        methods: {
            abreFotos: function (item) {
                this.atualData = item;
                this.modalFotos = true;
            },
            isEmpty(obj) {
                return this.$_.isEmpty(obj);
            },
        },
        components: {
            TheContainer,
        },
    }
</script>
