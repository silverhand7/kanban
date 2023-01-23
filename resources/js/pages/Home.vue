<template>
    <div>
        <Draggable class="columns" :list="columns">
            <Column v-for="column in columns" :key="column.id" :id="column.id" :title="column.name" :items="column.cards" />
        </Draggable>
        <h1>Home Page</h1>
    </div>
</template>

<script>
import Column from '../components/Column.vue';
import Draggable from 'vuedraggable';

export default {
    data() {
        return {
            items: [],
            columns: []
        }
    },
    components: {
        Column,
        Draggable
    },
    async created() {
        await axios.get('/api/columns').then(response => (this.columns = response.data));
    },
}

</script>