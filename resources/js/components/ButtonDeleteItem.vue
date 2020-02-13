<template>
    <button @click="removeItem($event, item)" class="btn btn-danger btn-sm" type="button">hapus</button>
</template>

<script>
    export default {
        name: "ButtonDeleteItem",
        props: {
            item: String,
        },
        methods: {
            async removeItem(e, item) {
                e.preventDefault();
                try {
                    await window.axios({
                        url: `/api/pembayaran/${item}`,
                        method: 'delete'
                    });
                    window.location.reload();
                } catch (err) {
                    console.log(err);
                }
            }
        }
    }
</script>

<style scoped>

</style>
