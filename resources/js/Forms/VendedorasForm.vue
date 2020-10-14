<template>
    <div>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="Nome"
                    placeholder="Nome da Vendedora..."
                    v-model="form.nome"
                />
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="E-mail"
                    placeholder="E-mail da vendedora..."
                    v-model="form.email"
                />
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <label for="telefone" class="">Telefone</label>
                <the-mask
                    id="telefone"
                    :mask="['(##) ####-####', '(##) #####-####']"
                    class="form-control"
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
    </div>
</template>

<script>

export default {
    name: "VendedorasForm",

    props: ['data'],

    data() {
        return {
            form: this.$inertia.form({
                    nome: this.data.nome,
                    email: this.data.email,
                    telefone: this.data.telefone,
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
                this.$root.$emit('fechar-modal-vendedora')
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
    },
}
</script>
