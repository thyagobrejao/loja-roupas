<template>
    <the-container>
        <welcome/>
    </the-container>
</template>

<script>
    import TheContainer from "../containers/TheContainer";
    import Welcome from './../Jetstream/Welcome'

    export default {
        components: {
            TheContainer,
            Welcome,
        },
    }
</script>
