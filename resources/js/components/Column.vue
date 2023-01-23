<template>
    <div class="column">
        <div class="column__header">
            <div class="column__header__title">{{ title }} </div>
            <div class="remove-button" @click="$emit('removeColumn', id)">X</div>
        </div>
        <div class="column__body">
            <Draggable group="tasks" :list="items" @change="log($event, id)">
                <CardItem v-for="item in items" :key="item.id">
                    {{ item.title }}
                </CardItem>
            </Draggable>
        </div>
        <div class="column__footer">
            <button class="button">Add a card</button>
        </div>
    </div>
</template>

<script>
import CardItem from './CardItem.vue';
import Draggable from 'vuedraggable';

export default {
    props: {
        id: Number,
        title: String,
        items: Array
    },
    data() {
        return {
            added: [],
            removed: [],
        }
    },
    components: {
        CardItem,
        Draggable
    },
    methods: {
        log(evt, columnId) {
            if (evt.added != undefined || evt.moved != undefined) {
                let type, id;

                if (evt.added != undefined) {
                    type = 'added';
                    id = evt.added.element.id;
                }
                if (evt.moved != undefined) {
                    type = 'moved';
                    id = evt.moved.element.id;
                }

                axios.post('/api/card/move', {
                   columnId: columnId,
                   id: id,
                   type: type,
                   cards: this.reOrder(columnId)
               });
            }
        },

        reOrder(newColumnId){
            this.items.forEach(function(el, index){
                el['order'] = index;
                el['column_id'] = newColumnId;

            });
            return this.items;
        },
    }
}

</script>