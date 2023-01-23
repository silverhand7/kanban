<template>
    <div>
        <Draggable class="columns" :list="columns" @change="log">
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
    methods: {
        log(evt) {
            axios.post('/api/columns/move', {
                id: evt.moved.element.id,
                newOrder: evt.moved.newIndex,
                oldOrder: evt.moved.oldIndex,
            })
            window.console.log(evt);
        }
    }
}

</script>