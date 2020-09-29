<template>
    <div>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="Descrição da Forma de pagamento"
                    placeholder="Débito, crédito, pagseguro, etc..."
                    v-model="form.descricao"
                />
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="Taxa"
                    type="number"
                    step="0.01"
                    placeholder="Taxa paga nessa forma de pagamento..."
                    v-model="form.taxa"
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
    </div>
</template>

<script>

export default {
    name: "FormaPagamentoForm",

    props: ['data'],

    data() {
        return {
            form: this.$inertia.form({
                    descricao: this.data.descricao,
                    taxa: this.data.taxa,
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
                this.$root.$emit('fechar-modal-forma-pagamento')
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
                this.form.post('/formaPagamento');
            } else {
                this.form.put(`/formaPagamento/${this.data.id}`);
            }
        },
        isEmpty(obj) {
            return this.$_.isEmpty(obj);
        },
    },
}
</script>
