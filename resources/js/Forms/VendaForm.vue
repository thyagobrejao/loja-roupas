<template>
    <div>
        <CRow>
            <CCol sm="12">
                <label>Vendedora</label>
                <select v-model="form.vendedoras_id"
                        class="form-control"
                >
                    <option v-for="(vendedora, index) in vendedoras"
                            :value="vendedora.id"
                            :key="index"
                    >
                        {{ vendedora.nome }}
                    </option>
                </select>
                <CButton
                    color="success"
                    @click="modalVendedora = true"
                    class="mt-2">
                    Cadastrar Vendedora
                </CButton>
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <label>Cliente</label>
                <select v-model="form.clientes_id"
                        class="form-control"
                >
                    <option v-for="(cliente, index) in clientes"
                            :value="cliente.id"
                            :key="index"
                    >
                        {{ cliente.nome }} - {{ cliente.telefone }}
                    </option>
                </select>
                <CButton
                    color="success"
                    @click="modalCliente = true"
                    class="mt-2">
                    Cadastrar Cliente
                </CButton>
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <label>Forma de Pagamento</label>
                <select v-model="form.formas_pagamentos_id"
                        class="form-control"
                >
                    <option v-for="(pagamento, index) in formas_pagamento"
                            :value="pagamento.id"
                            :key="index"
                    >
                        {{ pagamento.descricao }} - {{ pagamento.taxa }} %
                    </option>
                </select>
                <CButton
                    color="success"
                    @click="modalPagamento = true"
                    class="mt-2">
                    Cadastrar Forma de Pagamento
                </CButton>
            </CCol>
        </CRow>
        <CRow>
            <CCol md="12">
                <hr/>
                <h4>Produtos</h4>
                <table class="table table-bordered table-responsive-sm">
                    <thead>
                    <tr>
                        <th>Cod</th>
                        <th>Desc</th>
                        <th>Tm</th>
                        <th>Qtd</th>
                        <th>X</th>
                    </tr>
                    </thead>
                    <tbody v-if="!isEmpty(form.saidas)">
                    <tr v-for="(produto, index) in form.saidas" :key="index">
                        <td>{{ produto.prod.codigo }}</td>
                        <td>{{ produto.prod.descricao }}</td>
                        <td>{{ produto.tamanho }}</td>
                        <td>{{ produto.quantidade }}</td>
                        <td>
                            <CButton color="danger" @click="removeProduto(index)">
                                <CIcon name="cil-trash"/>
                            </CButton>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <CButton
                    color="primary"
                    class="mt-2"
                    @click="modalSaida = true"
                >
                    Adicionar Produto
                </CButton>
                <hr/>
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <CInput
                    type="number"
                    label="Desconto"
                    placeholder="Desconto em percentagem..."
                    v-model="form.desconto"
                />
            </CCol>
        </CRow>
        <CRow v-if="!isEmpty(formError)">
            <CCol sm="12">
                <CAlert color="danger">
                    <h5>Erros encontrados</h5>
                    <ul>
                        <li v-for="error in formError">
                            {{ error }}
                        </li>
                    </ul>
                </CAlert>
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12" class="text-right">
                <CAlert color="info" v-if="form.processing">
                    <CSpinner color="warning" grow/>
                    Carregando...
                </CAlert>
                <CButton color="success" @click="submit" :disabled="form.processing">
                    {{ nameAction }}
                </CButton>
            </CCol>
        </CRow>
        <CModal
            title="Cadastrar Vendedora"
            color="primary"
            v-if="modalVendedora"
            :show.sync="modalVendedora"
        >
            <vendedoras-form :data="{}"/>
            <template #footer>
                <CButton @click="modalVendedora = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
        <CModal
            title="Cadastrar Cliente"
            color="primary"
            v-if="modalCliente"
            :show.sync="modalCliente"
        >
            <cliente-form :data="{}"/>
            <template #footer>
                <CButton @click="modalCliente = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
        <CModal
            title="Cadastrar Forma de Pagamento"
            color="primary"
            v-if="modalPagamento"
            :show.sync="modalPagamento"
        >
            <forma-pagamento-form :data="{}"/>
            <template #footer>
                <CButton @click="modalPagamento = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
        <CModal
            title="Adicionar Produto"
            color="primary"
            v-if="modalSaida"
            :show.sync="modalSaida"
        >
            <saida-form :data="{}" :produtos="produtos"/>
            <template #footer>
                <CButton @click="modalSaida = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
    </div>
</template>

<script>

import VendedorasForm from "./VendedorasForm";
import ClienteForm from "./ClienteForm";
import FormaPagamentoForm from "./FormaPagamentoForm";
import SaidaForm from "./SaidaForm";
export default {
    name: "VendasForm",
    components: {FormaPagamentoForm, ClienteForm, VendedorasForm, SaidaForm},
    props: ['data', 'clientes', 'vendedoras', 'formas_pagamento', 'produtos'],

    data() {
        return {
            form: this.$inertia.form({
                    vendedoras_id: this.data.vendedoras_id,
                    clientes_id: this.data.clientes_id,
                    formas_pagamentos_id: this.data.formas_pagamentos_id,
                    desconto: this.data.desconto,
                    saidas: [],
                },
                {
                    resetOnSuccess: true,
                    preserveScroll: true
                }),
            nameAction: 'Salvar',
            modalVendedora: false,
            modalCliente: false,
            modalPagamento: false,
            modalSaida: false,
        }
    },

    computed: {
        formSaved() {
            return this.form.recentlySuccessful;
        },
        formError() {
            return this.$page.errors;
        },
    },
    watch: {
        formSaved() {
            if (this.formSaved) {
                this.$alertify.success("Dados Salvos com Sucesso!");
                this.$root.$emit('fechar-modal-vendas')
            }
        }
    },

    mounted() {
        if (!this.isEmpty(this.data)) {
            this.nameAction = "Alterar";
        }
        this.$page.errors = {};

        this.$root.$on('fechar-modal-cliente', () => {
            this.modalCliente = false;
        });

        this.$root.$on('fechar-modal-vendedora', () => {
            this.modalVendedora = false;
        });
        this.$root.$on('fechar-modal-forma-pagamento', () => {
            this.modalPagamento = false;
        });
        this.$root.$on('salvar-saida', (form) => {
            this.form.saidas.push(form);
            this.modalSaida = false;
        });
    },

    methods: {
        submit() {
            if (this.nameAction === 'Salvar') {
                this.form.post('/venda');
            } else {
                this.form.put(`/venda/${this.data.id}`);
            }
        },
        isEmpty(obj) {
            return this.$_.isEmpty(obj);
        },
        removeProduto(index) {
            this.form.saidas.splice(index, 1);
        }
    },
}
</script>
