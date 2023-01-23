<template>
    <div class="columns">
        <Column v-for="column in columns" :key="column.id" :id="column.id" :title="column.name" :items="column.cards" />
    </div>
    <h1>Home Page</h1>
</template>

<script>
import Column from '../components/Column.vue';

export default {
    data() {
        return {
            items: [],
            columns: []
        }
    },
    components: {
        Column,
    },
    async created() {
        await axios.get('/api/columns').then(response => (this.columns = response.data));
    },
}

</script>