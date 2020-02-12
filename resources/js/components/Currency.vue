<template>
    <div>
        {{ this.currencyFormat(price) }}
    </div>
</template>

<script>
    import numeral from 'numeral';
    export default {
        name: "Currency",
        props: {
            price: Number,
        },

        methods: {
            currencyFormat(price){
                return numeral(price).format('0,0')
            }
        }
    }
</script>

<style scoped>

</style>
