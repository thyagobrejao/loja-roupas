<template>
    <the-container>
        <CRow>
            <CCol md="8">
                <CCard>
                    <CCardHeader>Clientes</CCardHeader>
                    <CCardBody>
                        <CDataTable
                            :items="clientes"
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
                            :noItemsView="{noResults: 'Nenhum resultado encontrado.', noItems: 'Nenhuma Cliente Cadastrada'}"
                        >
                            <template #show_details="{item, index}">
                                <td class="py-2">
                                    <CButton
                                        color="primary"
                                        variant="outline"
                                        square
                                        size="sm"
                                        @click="toggleDetails(item, index)"
                                    >
                                        Detalhes
                                    </CButton>
                                </td>
                            </template>
                        </CDataTable>
                    </CCardBody>
                </CCard>
            </CCol>
            <CCol md="4">
                <CCard>
                    <CCardHeader>Cadastrar Cliente</CCardHeader>
                    <CCardBody>
                        <CRow>
                            <CCol sm="12">
                                <CInput
                                    label="Nome"
                                    placeholder="Nome da cliente..."
                                />
                            </CCol>
                        </CRow>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
    </the-container>
</template>

<script>
import TheContainer from "../containers/TheContainer";

const fields = [
    { key: 'nome', label: 'Nome'},
    { key: 'email', label: 'Email'},
    { key: 'telefone', label: 'Telefone'},
    { key: 'tamanho', label: 'Tamanho'},
    {
        key: 'show_details',
        label: '',
        sorter: false,
        filter: false
    }
]

export default {
    name: "Clientes",

    props: ['clientes'],

    data () {
        return {
            fields,
        }
    },

    components: {
        TheContainer,
    }
}
</script>
