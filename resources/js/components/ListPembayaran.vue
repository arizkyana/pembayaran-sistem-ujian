<template>
    <section>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">

                <div class="my-3">
                    <form action>
                        <div class="form-group">
                            <select
                                name="semester"
                                id="semester"
                                class="form-control"
                                v-model="semester"
                                @change="changeSemester"
                            >
                                <option
                                    v-for="semester in listPembayaranSemester"
                                    :value="semester.id"
                                    :key="semester.id"
                                >{{ semester.label }}
                                </option
                                >
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div
                class="col-md-4 mt-4"
                v-for="item in listPembayaran"
                :key="item.id"
            >
                <div class="card">
                    <div class="card-body">
                        <div>{{ item.nama }}</div>
                        <div>{{ item.harga }}</div>
                    </div>
                    <div class="card-footer">
                        <button
                            type="button"
                            class="btn btn-outline-primary btn-sm btn-block"
                            @click="addItemPembayaran(item)"
                        >
                            Bayar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
    export default {
        name: "list-pembayaran",

        data: () => ({
            listPembayaran: [],
            listPembayaranSemester: [],
            loading: false,
            semester: {}
        }),

        async beforeMount() {
            await this.fetchListPembayaranSemester();
            await this.fetchListPembayaran();
        },

        methods: {
            async addItemPembayaran(item) {
                try {
                    await window.axios({
                        url: "/api/pembayaran",
                        method: "post",
                        data: {
                            ...item,
                            user: this.$userId
                        }
                    });

                    item.added = true;

                    alert("sukses menambahkan ke checkout");
                } catch (err) {
                    console.log(err.response.data.message);
                    alert(err.response.data.message);
                }
            },
            async fetchListPembayaran(params = {semester: 1}) {
                const fetchListPembayaran = await window.axios({
                    url: "/api/pembayaran",
                    method: "get",
                    params
                });

                this.listPembayaran = fetchListPembayaran.data.map(d => {
                    d.harga = window.helpers.currency(d.harga);
                    return d;
                });
            },
            async fetchListPembayaranSemester() {
                const fetchListPembayaranSemester = await window.axios({
                    url: "/api/pembayaran/semester",
                    method: "get"
                });

                this.listPembayaranSemester = fetchListPembayaranSemester.data;
            },

            async changeSemester() {
                await this.fetchListPembayaran({semester: this.semester});
            }
        }
    };
</script>
