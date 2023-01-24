<template>
    <div class="scarves-list">
        <div v-for="(scarf) in getScarves" class="scarves-item-wrap">
            <scarves-item-admin :scarf="scarf" :key="scarf.id" @click-delete-scarf="deleteScarf"></scarves-item-admin>
        </div>
    </div>
</template>

<script>

import ScarvesItemAdmin from './ScarvesItemAdmin.vue';

export default {
    props: ['scarves'],
    components: {
        ScarvesItemAdmin
    },

    computed: {
        getScarves() {
            return JSON.parse(this.scarves);
        }
    },
    methods: {
        deleteScarf: function (scarf, $event) {
            let box = $event.target.closest('.scarves-item-wrap');
            axios.delete('/admin/scarves/' + scarf.id)
                .then(response => {
                    this.$swal({
                        title: 'Wspaniale',
                        text: response.data.message,
                        icon: "info",
                    });
                    box.remove()
                });
        }
    }
}
</script>

<style lang="scss" scoped>
.scarves-list {
    display: flex;
    justify-content: flex-start;
    flex-wrap: wrap;
    gap: 25px;

    .scarves-item-wrap {
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        flex-direction: column;
        gap: 10px;
        border-radius: 10px;
        border: 2px solid #11101d;
        padding: 10px;
        max-width: 400px;
    }
}
</style>