<template>
    <div class="column">
        <div class="column__header">
            <div class="column__header__title">{{ title }} </div>
            <div class="remove-button">X</div>
        </div>
        <div class="column__body">
            <Draggable group="tasks" :list="items">
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
    components: {
        CardItem,
        Draggable
    }
}

</script>