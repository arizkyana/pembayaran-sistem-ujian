<template>
    <div @drop.prevent="drop"
         @dragstart.prevent="dragstart"
         @dragend.prevent="dragend"
         @dragenter.prevent="dragenter"
         @dragover.prevent
         @dragleave.prevent="dragleave">
        <label for="upload-file"
               class="border border-dark rounded p-2 w-100 bg-white">
            <div class="text-center" v-if="!file">
                <div>Upload bukti pembayaran</div>
                <div class="text-muted">Drag file ke sini</div>
            </div>
            <div class="text-center" v-else>
                {{ file.name }}
            </div>
        </label>
        <input ref="uploadFile" type="file" :name="name" id="upload-file" style="display: none;" @change="changeFile($event)"/>
    </div>
</template>

<script>
    export default {
        name: "Dragger",
        props: {
            name: String,
        },
        data: () => ({
            drag: {
                isDragOver: false,
                isDragEnter: false,
                isDragLeave: false,
                isDragStart: false
            },
            file: null,
            isAllowed: true,
            accept: null,
            uploadId: null,
            loading: true
        }),
        methods: {
            fileHandler(file) {
                if (file) {
                    this.loading = true;
                    const ext = file.name.split(".")[1];

                    console.log("ext >>> ", {ext, file});

                    this.file = file;
                    this.$emit("onFileReceived", file);

                    // this.$refs.uploadFile.values = "";
                }
            },

            changeFile(e) {
                const file = e.target.files[0];

                if (file) {
                    this.drag = {
                        isDragOver: false,
                        isDragEnter: true,
                        isDragLeave: false,
                        isDragStart: false
                    };
                    this.fileHandler(file);
                }
            },
            drop(e) {
                e.stopPropagation();
                const file = e.dataTransfer.files[0];
                if (file) {
                    this.fileHandler(file);
                }
            },
            dragstart(e) {
                console.log("masuk drag start", {e});
                this.drag = {
                    isDragOver: false,
                    isDragEnter: false,
                    isDragLeave: false,
                    isDragStart: true
                };
            },
            dragenter(e) {
                console.log("masuk drag enter", {e});
                this.drag = {
                    isDragOver: false,
                    isDragEnter: true,
                    isDragLeave: false,
                    isDragStart: false
                };
            },
            dragover(e) {
                console.log("masuk drag over", {e});
                this.drag = {
                    isDragOver: true,
                    isDragEnter: false,
                    isDragLeave: false,
                    isDragStart: false
                };
            },
            dragleave(e) {
                console.log("masuk drag leave", {e});
                this.drag = {
                    isDragOver: false,
                    isDragEnter: false,
                    isDragLeave: true,
                    isDragStart: false
                };
            }
        }
    }
</script>

<style scoped>

</style>
