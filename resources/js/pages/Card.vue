<template>
    <div>
        <div v-if="isCardModalOpen == true">
            <!-- <CardModal
                :id="cardId"
                :title="cardTitle"
                :description="cardDescription"
                :isOpen="isCardModalOpen"
                :isShowForm="isShowCardForm"
                :columnId="cardColumnId"
                @close="closeCardModal"
                @deleteCard="deleteCard"
                @updateCard="updateCard"
            /> -->
            <div v-if="resolved">
                <CardModal
                    :id="cardId"
                    :title="cardTitle"
                    :description="cardDescription"
                    :columnId="cardColumnId"
                    :isOpen="true"
                    @deleteCard="deleteCard"
                />
            </div>
        </div>
    </div>
</template>


<script>
import CardModal from '../components/CardModal.vue';
import axios from 'axios';

export default {
    props: {
        id: String
    },
    data() {
        return {
            cardId: 0,
            cardTitle: '',
            cardDescription: '',
            cardColumnId: 0,
            isShowCard: false,
            isShowCardForm: false,
            isCardModalOpen: true,
            resolved: false,
        }
    },
    components: {
        CardModal
    },
    async created() {
        await axios.get(`/api/card/${this.id}`).then(response => {
            let card = response.data;
            this.cardId = card.id;
            this.cardTitle = card.title;
            this.cardDescription = card.description;
            this.cardColumnId = card.column_id;
            this.resolved = true;
        });
    },
    methods: {
        async deleteCard(cardId) {
            await axios.delete(`api/card/${cardId}/delete`).then(res => {
                // let column = this.columns.find(column => column.id == this.cardColumnId);
                // let cardIndex = column.cards.findIndex(card => card.id == this.cardId);
                // column.cards.splice(cardIndex, 1);
                // this.isShowCard = false;
                this.$router.push('/');
            });
        },
    }
}
</script>