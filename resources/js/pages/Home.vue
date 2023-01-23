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
                    @showCardModal="showCardModal"
                />
            </Draggable>
            <div>
                <button class="add-new-button" @click="addNewColumn">+ Add new column</button>
            </div>
        </div>

        <div v-if="cardId != 0">
            <CardModal
                :id="cardId"
                :title="cardTitle"
                :description="cardDescription"
                :isOpen="isCardModalOpen"
                @close="cardId = 0"
                @deleteCard="deleteCard"
                @updateCard="updateCard"
            />
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
            columns: [],
            cardId: 0,
            cardTitle: '',
            cardDescription: '',
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
    computed: {
        isCardModalOpen() {
            if (this.cardId == '') {
                return false
            }
            return true;
        }
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
        },

        showCardModal(id, title, description, cardColumnId) {
            this.cardId = id;
            this.cardTitle = title;
            this.cardDescription = description;
            this.cardColumnId = cardColumnId;
        },

        async deleteCard(cardId) {
            await axios.delete(`api/card/${cardId}/delete`).then(res => {
                let column = this.columns.find(column => column.id == this.cardColumnId);
                let cardIndex = column.cards.findIndex(card => card.id == this.cardId);
                column.cards.splice(cardIndex, 1);
                this.cardId = '';
            });
        },

        updateCard(id, title, columnId){
            let column = this.columns.find(column => column.id == columnId);
            column.cards.find(card => card.id == id).title = title;
        }
    }
}

</script>