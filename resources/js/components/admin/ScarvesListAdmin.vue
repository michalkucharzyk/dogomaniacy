<template>
    <div class="scarves-list">
        <div v-for="(scarf, index) in getScarves" class="scarves-item-wrap" v-if="!isDelete">
            <scarves-item-admin :scarf="scarf" :key="scarf.id" @click-delete-scarf="deleteScarf"></scarves-item-admin>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isDelete: false
        }
    },

    props: ['scarves'],
    computed: {
        getScarves() {
            return JSON.parse(this.scarves);
        }
    },
    methods: {
        deleteScarf: function (scarf) {
            axios.delete('/admin/scarves/' + scarf.id)
                .then(response => {
                    this.$swal({
                        title: 'Wspaniale',
                        text: response.data.message,
                        icon: "info",
                    });
                    this.isDelete = true
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
    }
}
</style>