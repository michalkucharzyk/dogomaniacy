<template>
    <div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Liczba zdjęć</th>
                <th scope="col">Data dodania</th>
                <th scope="col">Data aktualizacji</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <scarves-item-admin v-for="(scarf, index) in getScarves" :scarf="scarf" :index="index" :key="scarf.id"
                                @click-delete-scarf="deleteScarf"></scarves-item-admin>
            </tbody>
        </table>
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
            let box = $event.target.closest('tr');
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

</style>