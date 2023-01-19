<template>
    <div class="form-image-wrap" v-if="!isDelete">
        <div class="image">
            <img :src="image.path" :alt="image.original_name">
        </div>
        <button type="button" class="btn btn-danger" @click="destroy()">Usuń</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isDelete: false
        }
    },

    props: ['image', 'routeDelete'],
    mounted() {
    },
    methods: {
        destroy() {
            this.$swal({
                title: "Usuń zdjęcie",
                text: "Czy napewno chcesz usunąć zdjęcie",
                showCancelButton: true,
                confirmButtonText: "Tak",
                cancelButtonText: "Nie",
                icon:"question"
            }).then((result) => {
                if (result.isConfirmed === true) {
                    axios.delete(this.routeDelete)
                        .then(response => {
                            this.$swal({
                                title: 'Wspaniale',
                                text: response.data.message,
                                icon: "info",
                            });
                            this.isDelete = true
                        });
                }
            });

        }
    }
}
</script>

<style lang="scss" scoped>
.form-image-wrap {
    width: 150px;

    img {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }

    button {
        margin: 5px 0;
        width: 100%;
    }
}
</style>