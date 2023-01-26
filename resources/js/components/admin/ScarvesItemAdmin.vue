<template>
    <tr>
        <td>{{ this.index + 1 }}</td>
        <td>
            <div class="flex-center-start">
                <div v-for="(image) in this.scarf.images">
                    <img v-if="image.main_image === 1" :src="image.path" :alt="image.name" class="m-r-10">
                </div>
                <div>{{ this.scarf.name }}</div>
            </div>
        </td>
        <td>{{ getCountImage }}</td>
        <td>{{ getFormatData(this.scarf.created_at) }}</td>
        <td>{{ getFormatData(this.scarf.updated_at) }}</td>
        <td>
            <div class="form-check form-switch">
                <input class="form-check-input" @change="changePublic($event)" type="checkbox" :checked="this.isPublic">
                <label class="form-check-label" for="public">Publikuj</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" :checked="this.isSoldOut" disabled>
                <label class="form-check-label" for="public">Wyprzedane</label>
            </div>
        </td>
        <td>
            <div class="button-details">
                <button type="button" class="btn btn-danger btn-sm" @click="deleteScarf(this.scarf, $event)">Usuń
                </button>
                <a :href="getRouteEdit" class="btn btn-primary btn-sm">Edytuj</a>
                <a :href="getRouteShow" target="_blank" class="btn btn-success btn-sm">Pokaż</a>
            </div>
        </td>
    </tr>
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

    props: ['index', 'scarf'],
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
        changePublic($event) {
            this.$swal({
                title: "Zmień status",
                text: "Czy napewno chcesz zmienić status publikacji opaszki",
                showCancelButton: true,
                confirmButtonText: "Tak",
                cancelButtonText: "Nie",
                icon: "question"
            }).then((result) => {
                if (result.isConfirmed === true) {
                    this.isPublic = !this.isPublic;
                    axios.put('/admin/scarves/' + this.scarf.id + '/change-public}')
                        .then(response => {
                            this.$swal({
                                title: 'Wspaniale',
                                text: response.data.message,
                                icon: "info",
                            })
                        })
                } else {
                    $event.target.checked = !$event.target.checked;
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
            if ($data === null) {
                return '--'
            }

            return moment(String($data)).format('YYYY-MM-DD HH:mm')
        }
    }
}
</script>
<style lang="scss" scoped>

img {
    width: 50px;
    height: auto;
    border-radius: 10px;
    margin-right: 10px;
}


.button-details {
    margin-top: 10px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px
}

</style>