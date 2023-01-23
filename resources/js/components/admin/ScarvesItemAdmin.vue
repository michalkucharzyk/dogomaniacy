<template>
    <div>
        <div class="image">
            <div v-for="(image, index) in this.scarf.images">
                <img v-if="image.main_image === 1" :src="image.path" :alt="image.name">
            </div>
            <div class="other-info text-secondary">Liczba zdjęć: {{ getCountImage }}</div>
        </div>
        <div class="info">
            <div class="title">{{ this.scarf.name }}</div>
            <div class="text-secondary" v-if="this.scarf.description.length < 150">{{ this.scarf.description }}</div>
            <div class="text-secondary" v-else>{{ this.scarf.description.substring(0, 150) + "..." }}</div>

            <div class="form-check form-switch">
                <input class="form-check-input" @change="changePublic()" type="checkbox" :checked="this.isPublic">
                <label class="form-check-label" for="public">Publikuj</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" :checked="this.isSoldOut" disabled>
                <label class="form-check-label" for="public">Wyprzedane</label>
            </div>

            <div class="other-info"><span
                class="fw-bold">Data utworzenia: </span>{{ getFormatData(this.scarf.created_at) }}
            </div>
            <div v-if="this.scarf.updated_at !== null" class="other-info"><span
                class="fw-bold">Data aktualizacji: </span>{{ getFormatData(this.scarf.updated_at) }}
            </div>
            <div class="button-details">
                <button type="button" class="btn btn-danger btn-sm" @click="deleteScarf(this.scarf, $event)">Usuń</button>
                <a :href="getRouteEdit" class="btn btn-primary btn-sm">Edytuj</a>
                <a :href="getRouteShow" target="_blank" class="btn btn-success btn-sm">Pokaż</a>
            </div>
        </div>
    </div>
</template>

<script>

import moment from 'moment';

export default {
    data() {
        return {
            isPublic: this.scarf.public,
            isSoldOut: this.scarf.sold_out
        }
    },

    props: ['scarf'],
    computed: {
        getCountImage() {
            return this.scarf.images.length
        },

        getRouteEdit() {
            return '/admin/scarves/' + this.$.vnode.key + '/edit'
        },

        getRouteShow() {
            return '/apaszki/' + this.scarf.slug
        }
    },
    mounted() {

    },
    methods: {
        changePublic() {
            this.isPublic = !this.isPublic;
            this.$swal({
                title: "Zmień status",
                text: "Czy napewno chcesz zmienić status publikacji opaszki",
                showCancelButton: true,
                confirmButtonText: "Tak",
                cancelButtonText: "Nie",
                icon: "question"
            }).then((result) => {
                if (result.isConfirmed === true) {
                    axios.put('/admin/scarves/'+ this.scarf.id+'/change-public}')
                        .then(response => {
                            this.$swal({
                                title: 'Wspaniale',
                                text: response.data.message,
                                icon: "info",
                            })
                        })
                }
            });
        },

        deleteScarf(scarf, $event) {
            this.$swal({
                title: "Usuń apaszkę",
                text: "Czy napewno chcesz usunąć apaszkę",
                showCancelButton: true,
                confirmButtonText: "Tak",
                cancelButtonText: "Nie",
                icon: "question"
            }).then((result) => {
                if (result.isConfirmed === true) {
                    this.$emit('clickDeleteScarf', scarf, $event);
                }
            });
        },

        getFormatData($data) {
            return moment(String($data)).format('YYYY-MM-DD HH:mm')
        }
    }
}
</script>
<style lang="scss" scoped>

.image {
    img {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }
}

.title {
    font-size: 20px;
    font-weight: bold;
}

.description {
    font-size: 16px;
    color: #777777
}

.button-details {
    margin-top: 10px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px
}

</style>