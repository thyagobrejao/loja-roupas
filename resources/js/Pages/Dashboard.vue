<template>
    <the-container>
        <CRow>
            <CCol md="8">
                <CCard>
                    <CCardHeader>
                        Estoque
                    </CCardHeader>
                    <CCardBody>
                        <table class="table table-bordered table-striped table-responsive-sm">
                            <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Descriçao</th>
                                <th>Tipo</th>
                                <th>Fornecedor</th>
                                <th>Valor Sugerido</th>
                                <th>Entradas</th>
                                <th>Saídas</th>
                                <th>Estoque</th>
                                <th>Reservas</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(prod, index) in estoque" :key="index">
                                <td>{{ prod.codigo }}</td>
                                <td>{{ prod.descricao }}</td>
                                <td>{{ prod.tipo_produto.descricao }}</td>
                                <td>{{ prod.fornecedore.nome }}</td>
                                <td>R$ {{ prod.valor_sugerido }}</td>
                                <td>{{ prod.entradas }}</td>
                                <td>{{ prod.saidas }}</td>
                                <td>{{ prod.estoque }}</td>
                                <td>{{ prod.reservas }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </CCardBody>
                </CCard>
            </CCol>
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
                                <td>Peças de sadía</td>
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
    </the-container>
</template>

<script>
    import TheContainer from "../containers/TheContainer";

    export default {
        props: ['estoque', 'numeros'],
        components: {
            TheContainer,
        },
    }
</script>
