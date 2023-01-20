<template>
    <div v-if="!isDelete">
        <div class="image">
            <div v-for="(image, index) in this.scarf.images">
                <img v-if="image.main_image === 1" :src="image.path" :alt="image.name">
            </div>
            <div class="other-info text-secondary">Liczba zdjęć: {{ getCountImage }}</div>
        </div>
        <div class="info">
            <div class="title">{{ this.scarf.name }}</div>
            <div class="text-secondary">{{ this.scarf.description }}</div>

            <div class="other-info"><span
                class="fw-bold">Data utworzenia: </span>{{ getFormatData(this.scarf.created_at) }}
            </div>
            <div v-if="this.scarf.updated_at !== null" class="other-info"><span
                class="fw-bold">Data aktualizacji: </span>{{ getFormatData(this.scarf.updated_at) }}
            </div>
            <div class="button-details">
                <button type="button" class="btn btn-danger btn-sm" @click="deleteScarf(this.scarf)">Usuń</button>
                <a :href="getRouteEdit" class="btn btn-success btn-sm">Edytuj</a>
            </div>
        </div>
    </div>
</template>

<script>

import moment from 'moment';

export default {
    data() {
        return {
            isDelete: false
        }
    },

    props: ['scarf'],
    computed: {
        getCountImage() {
            return this.scarf.images.length
        },
        getRouteEdit() {
            return '/admin/scarves/' + this.$.vnode.key + '/edit'
        }
    },
    mounted() {

    },
    methods: {
        deleteScarf(scarf) {
            this.$swal({
                title: "Usuń apaszkę",
                text: "Czy napewno chcesz usunąć apaszkę",
                showCancelButton: true,
                confirmButtonText: "Tak",
                cancelButtonText: "Nie",
                icon: "question"
            }).then((result) => {
                if (result.isConfirmed === true) {
                    this.$emit('clickDeleteScarf', scarf);
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
    width: 250px;

    img {
        width: 100%;
        height: 100px;
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