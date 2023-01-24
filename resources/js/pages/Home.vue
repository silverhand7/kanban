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
                    @showCardModalForm="showCardModalForm"
                />
            </Draggable>
            <div>
                <button class="add-new-button" @click="addNewColumn">+ Add new column</button>
            </div>
        </div>

        <div v-if="isCardModalOpen == true">
            <CardModal
                :id="cardId"
                :title="cardTitle"
                :description="cardDescription"
                :isOpen="isCardModalOpen"
                :isShowForm="isShowCardForm"
                :columnId="cardColumnId"
                @close="closeCardModal"
                @deleteCard="deleteCard"
                @updateCard="updateCard"
            />
        </div>

        <router-view></router-view>
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
            isShowCard: false,
            isShowCardForm: false,
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
            if (this.isShowCard == false) {
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

        showCardModal(id, title, description, cardColumnId, isOpen) {
            this.cardId = id;
            this.cardTitle = title;
            this.cardDescription = description;
            this.cardColumnId = cardColumnId;
            this.isShowCard = isOpen;
        },

        async deleteCard(cardId) {
            await axios.delete(`api/card/${cardId}/delete`).then(res => {
                let column = this.columns.find(column => column.id == this.cardColumnId);
                let cardIndex = column.cards.findIndex(card => card.id == this.cardId);
                column.cards.splice(cardIndex, 1);
                this.isShowCard = false;
            });
        },

        updateCard(id, title, description, columnId){
            let column = this.columns.find(column => column.id == columnId);
            let card = column.cards.find(card => card.id == id);
            if (card !== undefined) {
                card.title = title;
                card.description = description;
            } else {
                column.cards.push({
                    id: id,
                    title: title,
                    description: description,
                    column_id: columnId
                });
            }
        },

        closeCardModal() {
            this.isShowCard = false;
            this.cardId = 0;
            this.cardTitle = '';
            this.cardDescription = '';
            this.cardColumnId = '';
            this.isShowCardForm = false;
        },

        showCardModalForm(cardColumnId) {
            this.isShowCard = true;
            this.isShowCardForm = true;
            this.cardColumnId = cardColumnId;
        }
    }
}

</script>