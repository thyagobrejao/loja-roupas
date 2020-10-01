<template>
    <div>
        <CRow>
            <CCol sm="12">
                <label>Produto</label>
                <select v-model="form.produtos_id"
                        class="form-control"
                >
                    <option v-for="(prod, index) in produtos"
                            :value="prod.id"
                            :key="index"
                            @click="fotoProduto(prod)"
                    >
                        {{ prod.descricao }}
                    </option>
                </select>
                <CImg
                    v-if="prod_foto"
                    thumbnail
                    width="300"
                    fluid
                    :src="`/images?path=${prod_foto}`"
                />
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <label>Nota fiscal</label>
                <select v-model="form.nota_fiscals_id"
                        class="form-control"
                >
                    <option v-for="(nota, index) in notas_fiscais"
                            :value="nota.id"
                            :key="index"
                            @click="fotoNota(nota)"
                    >
                        {{ formataData(nota.data) }} - R$ {{ nota.valor_total }}
                    </option>
                </select>
                <CImg
                    v-if="nota_foto"
                    thumbnail
                    width="300"
                    fluid
                    :src="`/images?path=/notas/${nota_foto}`"
                />
                <CButton
                    color="success"
                    @click="modalNota = true"
                    class="mt-2">
                    Cadastrar Nota
                </CButton>
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="Telefone"
                    placeholder="Telefone da vendedora..."
                    v-model="form.telefone"
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
    name: "EntradasForm",
    components: {NotaFiscalForm},
    props: ['data', 'notas_fiscais', 'produtos'],

    data() {
        return {
            form: this.$inertia.form({
                    produtos_id: this.data.produtos_id,
                    nota_fiscals_id: this.data.nota_fiscals_id,
                    telefone: this.data.telefone,
                },
                {
                    resetOnSuccess: true,
                    preserveScroll: true
                }),
            nameAction: 'Salvar',
            prod_foto: null,
            nota_foto: null,
            modalNota: false,
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
                this.$root.$emit('fechar-modal-entrada')
            }
        }
    },

    mounted() {
        if (!this.isEmpty(this.data)) {
            this.nameAction = "Alterar";
        }
        this.$page.errors = {};
    },

    methods: {
        submit() {
            if (this.nameAction === 'Salvar') {
                this.form.post('/vendedora');
            } else {
                this.form.put(`/vendedora/${this.data.id}`);
            }
        },
        isEmpty(obj) {
            return this.$_.isEmpty(obj);
        },
        fotoProduto(produto) {
            if (!this.isEmpty(produto.foto)) {
                this.prod_foto = produto.foto[0].caminho
            } else {
                this.prod_foto = null;
            }
        },
        fotoNota(nota) {
            if (!this.isEmpty(nota.caminho_foto)) {
                this.nota_foto = nota.caminho_foto
            } else {
                this.nota_foto = null;
            }
        },
        formataData(date) {
            return moment(date).format("DD/MM/YYYY");
        }
    },
}
</script>
