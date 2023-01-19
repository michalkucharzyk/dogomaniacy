<template>
    <div class="scarves-list">
        <div v-for="(scarf, index) in getScarves" class="scarves-item-wrap">
            <scarves-item-admin v-bind="scarf" :key="scarf.id"></scarves-item-admin>
        </div>
    </div>
</template>

<script>
export default {
    props: ['scarves'],
    computed: {
        getScarves() {
            return JSON.parse(this.scarves);
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