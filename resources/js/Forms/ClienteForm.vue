<template>
    <div>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="Nome"
                    placeholder="Nome da cliente..."
                    v-model="form.nome"
                />
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="E-mail"
                    placeholder="E-mail da cliente..."
                    v-model="form.email"
                />
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="Telefone"
                    placeholder="Telefone da cliente..."
                    v-model="form.telefone"
                />
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="Tamanho"
                    placeholder="Manequim padrão da cliente..."
                    v-model="form.tamanho"
                />
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="Cidade"
                    placeholder="Cidade da cliente..."
                    v-model="form.cidade"
                />
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <select class="form-control" v-model="form.uf">
                    <option value="">Selecione o estado</option>
                    <option v-for="(u, i) in ufs" :key="i" :value="u">{{ u }}</option>
                </select>
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="CEP"
                    placeholder="CEP da cliente..."
                    v-model="form.cep"
                />
            </CCol>
        </CRow>
        <CRow>
            <CCol sm="12">
                <CInput
                    label="Endereço"
                    placeholder="Endereço da cliente..."
                    v-model="form.endereco"
                />
            </CCol>
        </CRow>
        <CRow v-if="!isEmpty($page.errors)">
            <CCol sm="12">
                <CAlert color="danger">
                    <h5>Erros encontrados</h5>
                    <ul>
                        <li v-for="(erro, index) in $page.errors" :key="index">
                            {{ erro }}
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
                <CAlert color="success" v-if="form.recentlySuccessful">
                    Dados Salvos com Sucesso!
                </CAlert>
                <CButton color="success" @click="submit" :disabled="form.processing">
                    {{ nameAction }}
                </CButton>
            </CCol>
        </CRow>
    </div>
</template>

<script>

import {ufs} from "../../assets/constants";

export default {
    name: "ClienteForm",

    props: ['data'],

    data() {
        return {
            ufs: ufs(),
            form: this.$inertia.form({
                nome: this.data.nome,
                email: this.data.email,
                telefone: this.data.telefone,
                tamanho: this.data.tamanho,
                cidade: this.data.cidade,
                cep: this.data.cep,
                uf: this.data.uf,
                endereco: this.data.endereco,
            }),
            nameAction: 'Salvar',
        }
    },

    mounted() {
        if (!this.isEmpty(this.data)) {
            this.nameAction = "Alterar";
        }
    },

    methods: {
        submit() {
            if (this.nameAction === 'Salvar') {
                this.form.post('/cliente', {
                    resetOnSuccess: true,
                    preserveScroll: true
                })
            } else {
                this.form.put(`/cliente/${this.data.id}`, {
                    resetOnSuccess: true,
                    preserveScroll: true
                })
            }
        },
        isEmpty(obj) {
            return this.$_.isEmpty(obj);
        }
    },
}
</script>
