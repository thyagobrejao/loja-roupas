<template>
    <div>
        <CRow>
            <CCol sm="12">
                <label for="valor_total" class="">Valor Total</label>
                <money
                    id="valor_total"
                    v-model="form.valor_total"
                    class="form-control"/>
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="Data"
                    type="date"
                    placeholder="Data da nota..."
                    v-model="form.date"
                />
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <label for="foto" class="">Foto</label>
                <input
                    id="foto"
                    ref="file"
                    type="file"
                    class="form-control-file"
                    v-on:change="onChangeFileUpload()">
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
    </div>
</template>

<script>

export default {
    name: "NotaFiscalForm",

    props: ['data'],

    data() {
        return {
            form: this.$inertia.form({
                    valor_total: this.data.valor_total,
                    date: moment(this.data.data, "DD/MM/YYYY").format("YYYY-MM-DD"),
                    foto: this.data.caminho_foto,
                    _method: 'post'
                },
                {
                    resetOnSuccess: true,
                    preserveScroll: true
                }),
            nameAction: 'Salvar',
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
                this.$root.$emit('fechar-modal-notafiscal')
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
                this.form.post('/notaFiscal',
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                );
            } else {
                this.form._method = 'put';
                this.form.post(`/notaFiscal/${this.data.id}`,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                );
            }
        },
        isEmpty(obj) {
            return this.$_.isEmpty(obj);
        },
        onChangeFileUpload() {
            this.form.foto = this.$refs.file.files[0];
        }
    },
}
</script>
