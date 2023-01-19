<template>
    <div>
        <div class="image">
            <div v-for="(image, index) in this.images">
                <img v-if="image.main_image === 1" :src="image.path" :alt="image.name">
            </div>
            <div class="other-info text-secondary">Liczba zdjęć: {{ getCountImage }}</div>
        </div>
        <div class="info">
            <div class="title">{{ name }}</div>
            <div class="text-secondary">{{ description }}</div>

            <div class="other-info"><span class="fw-bold">Data utworzenia: </span>{{ getFormatData(created_at) }}</div>
            <div v-if="updated_at !== null" class="other-info"><span
                class="fw-bold">Data aktualizacji: </span>{{ getFormatData(updated_at) }}
            </div>
            <div class="button-details">
                <a :href="getRouteEdit" class="btn btn-success btn-sm">Edytuj</a>
            </div>
        </div>
    </div>
</template>

<script>

import moment from 'moment';

export default {
    props: ['name', 'description', 'created_at', 'updated_at', 'images'],
    computed: {
        getCountImage() {
            return this.images.length
        },
        getRouteEdit() {
            return '/admin/scarves/' + this.$.vnode.key + '/edit'
        }
    },
    mounted() {

    },
    methods: {
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
}

</style>