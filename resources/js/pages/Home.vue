<template>
    <div>
        <div class="columns-wrapper">
            <Draggable class="columns" :list="columns" @change="log">
                <Column v-for="column in columns"
                    :key="column.id"
                    :id="column.id"
                    :title="column.name"
                    :items="column.cards"
                    @removeColumn="removeColumn"
                    @updateColumn="updateColumn"
                />
            </Draggable>
            <div>
                <button class="add-new-button" @click="addNewColumn">+ Add new column</button>
            </div>
        </div>
    </div>
</template>

<script>
import Column from '../components/Column.vue';
import Draggable from 'vuedraggable';
import CardModal from '../components/CardModal.vue';


export default {
    data() {
        return {
            items: [],
            columns: []
        }
    },
    components: {
        Column,
        Draggable,
        CardModal
    },
    async created() {
        await axios.get('/api/columns').then(response => (this.columns = response.data));
    },
    methods: {
        log(evt) {
            axios.post('/api/column/move', {
                id: evt.moved.element.id,
                newOrder: evt.moved.newIndex,
                oldOrder: evt.moved.oldIndex,
            })
        },

        async addNewColumn() {
            await axios.post('/api/column/store', {
                name: 'New Column',
            }).then(response => (this.columns.push(response.data)));
        },

        async removeColumn(id) {
            await axios.delete(`/api/column/${id}/delete`).then(response => this.columns = this.columns.filter(column => column.id != id));
        },

        updateColumn(id, newName) {
            this.columns.find(el => el.id == id).name = newName;
        }
    }
}

</script>