<template>
    <div>
        <CRow>
            <CCol sm="12">
                <label>Produto</label>
                <v-select
                    :options="produtosSelect"
                    v-model="selected"
                    @input="fotoProduto"
                />
                <CImg
                    v-if="prod_foto"
                    thumbnail
                    width="300"
                    fluid
                    :src="`/images?path=${prod_foto}`"
                />
            </CCol>
        </CRow>
        <CRow v-if="form.produtos_id">
            <CCol sm="12">
                <label>Tamanho</label>
                <select class="form-control" v-model="form.tamanho">
                    <option v-for="(u, i) in atual.tamanhos" :key="i" :value="i">{{ i }}</option>
                </select>
            </CCol>
        </CRow>
        <CRow v-if="form.tamanho">
            <CCol sm="12">
                <label>Quantidade</label>
                <select class="form-control" v-model="form.quantidade">
                    <option v-for="i in atual.tamanhos[form.tamanho]" :key="i" :value="i">{{ i }}</option>
                </select>
            </CCol>
        </CRow>
        <CRow v-if="form.quantidade">
            <CCol sm="12">
                <label>Reserva</label>
                <select class="form-control" v-model="form.reserva">
                    <option value="0" selected>Não</option>
                    <option value="1">Sim</option>
                </select>
            </CCol>
        </CRow>
        <CRow v-if="form.reserva">
            <CCol sm="12">
                <label for="valor_venda" class="">Valor de Venda</label>
                <money
                    id="valor_venda"
                    v-model="form.valor_venda"
                    class="form-control"/>
                <small>Valor para venda cadastrado: R$ {{ atual.valor_sugerido }}</small>
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
        <CRow v-if="form.valor_venda">
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
            title="Cadastrar Nota"
            color="primary"
            v-if="modalNota"
            :show.sync="modalNota"
        >
            <nota-fiscal-form :data="{}"/>
            <template #footer>
                <CButton @click="modalNota = false" color="danger">Fechar</CButton>
            </template>
        </CModal>
    </div>
</template>

<script>

import NotaFiscalForm from "./NotaFiscalForm";

export default {
    name: "SaidaForm",
    components: {NotaFiscalForm},
    props: ['data', 'notas_fiscais', 'produtos'],

    data() {
        return {
            form: this.$inertia.form({
                    produtos_id: this.data.produtos_id,
                    quantidade: this.data.quantidade,
                    tamanho: this.data.tamanho,
                    reserva: this.data.reserva,
                    valor_venda: this.data.valor_venda,
                },
                {
                    resetOnSuccess: true,
                    preserveScroll: true
                }),
            selected: null,
            nameAction: 'Salvar',
            prod_foto: null,
            nota_foto: null,
            modalNota: false,
            atual: null,
        }
    },

    computed: {
        produtosSelect() {
            return this.produtos.map(item => {
                return {
                    label: `${item.codigo} - ${item.descricao}`, id: item.id, data: item
                }
            })
        },
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
                this.prod_foto = null;
                this.nota_foto = null;
                this.$root.$emit('fechar-modal-entrada');
            }
        }
    },

    mounted() {
        if (!this.isEmpty(this.data)) {
            this.nameAction = "Alterar";
            this.selected = this.produtosSelect.find(obj => {
                return obj.id === this.data.produtos_id
            });
            this.fotoProduto(this.selected);
        }
        this.$page.errors = {};

        this.$root.$on('fechar-modal-notafiscal', () => {
            this.modalNota = false;
        });
    },

    methods: {
        submit() {
            this.form.prod = this.atual;
            this.$root.$emit('salvar-saida', this.form)
            // if (this.nameAction === 'Salvar') {
            //     this.form.post('/entrada');
            // } else {
            //     this.form.put(`/entrada/${this.data.id}`);
            // }
        },
        isEmpty(obj) {
            return this.$_.isEmpty(obj);
        },
        fotoProduto(produto) {
            this.atual = produto.data;
            this.form.produtos_id = produto.id;
            if (!this.isEmpty(produto.data.foto)) {
                this.prod_foto = produto.data.foto[0].caminho
            } else {
                this.prod_foto = null;
            }
        },
        formataData(date) {
            return moment(date).format("DD/MM/YYYY");
        },
        quantidades() {

        },
    },
}
</script>
