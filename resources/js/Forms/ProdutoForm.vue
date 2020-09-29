<template>
    <div>
        <CRow>
            <CCol sm="12">
                <label>Tipo de Produto</label>
                <v-select
                    label="descricao"
                    :options="tipos_produtos"
                    autocomplete="on"
                    v-model="form.tipos_id"
                />
                <CButton
                    color="success"
                    @click="modalProduto = true"
                    class="mt-2">
                    Cadastrar Produto
                </CButton>
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <label>Fornecedor</label>
                <v-select
                    label="nome"
                    :options="fornecedores"
                    autocomplete="on" v-model="form.fornecedores_id"
                />
                <CButton
                    color="success"
                    @click="modalFornecedor = true"
                    class="mt-2">
                    Cadastrar Fornecedor
                </CButton>
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="Descrição"
                    placeholder="Descricao do produto..."
                    v-model="form.descricao"
                />
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="Cor"
                    placeholder="Cor do produto..."
                    v-model="form.cor"
                />
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="Código"
                    placeholder="Código do produto..."
                    v-model="form.codigo"
                />
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="Valor Sugerido"
                    placeholder="Valor sugerido do produto..."
                    v-model="form.valor_sugerido"
                />
            </CCol>
        </CRow>
        <CRow>
            <CCol md="12">
                <CButton
                    color="success"
                    @click="modalFotos = true">
                    Adicionar Fotos
                </CButton>
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
            title="Cadastrar Tipo de Produto"
            color="primary"
            v-if="modalProduto"
            :show.sync="modalProduto"
        >
            <tipo-produto-form :data="{}"/>
            <template #footer>
                <CButton @click="modalProduto = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
        <CModal
            title="Cadastrar Fornecedor"
            color="primary"
            v-if="modalFornecedor"
            :show.sync="modalFornecedor"
        >
            <fornecedores-form :data="{}"/>
            <template #footer>
                <CButton @click="modalFornecedor = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
    </div>
</template>

<script>

import Label from "../Jetstream/Label";
import TipoProdutoForm from "./TipoProdutoForm";
import FornecedoresForm from "./FornecedoresForm";

export default {
    name: "ProdutosForm",
    components: {FornecedoresForm, TipoProdutoForm, Label},
    props: ['data', 'fornecedores', 'tipos_produtos'],

    data() {
        return {
            form: this.$inertia.form({
                    tipos_id: this.data.tipos_id,
                    fornecedores_id: this.data.fornecedores_id,
                    descricao: this.data.descricao,
                    cor: this.data.cor,
                    codigo: this.data.codigo,
                    valor_sugerido: this.data.valor_sugerido,
                },
                {
                    resetOnSuccess: true,
                    preserveScroll: true
                }),
            nameAction: 'Salvar',
            modalProduto: false,
            modalFornecedor: false,
            modalFotos: false,
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
                this.$root.$emit('fechar-modal-produto')
            }
        }
    },

    mounted() {
        if (!this.isEmpty(this.data)) {
            this.nameAction = "Alterar";
        }
        this.$page.errors = {};

        this.$root.$on('fechar-modal-fornecedor', () => {
            this.modalFornecedor = false;
        });
        this.$root.$on('fechar-modal-tipo', () => {
            this.modalProduto = false;
        });
    },

    methods: {
        submit() {
            this.form.fornecedores_id = this.form.fornecedores_id.id;
            this.form.tipos_id = this.form.tipos_id.id;
            if (this.nameAction === 'Salvar') {
                this.form.post('/produto');
            } else {
                this.form.put(`/produto/${this.data.id}`);
            }
        },
        isEmpty(obj) {
            return this.$_.isEmpty(obj);
        },
    },
}
</script>
