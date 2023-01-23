<template>
    <Draggable :list="id" group="tasks">
        <div class="column">
            <div class="column__header">
                <div class="column__header__title">{{ title }} </div>
                <div class="remove-button">X</div>
            </div>
            <div class="column__body">
                <CardItem v-for="item in items" :key="item.id">
                    {{ item.title }}
                </CardItem>
            </div>
            <div class="column__footer">
                <button class="button">Add a card</button>
            </div>
        </div>
    </Draggable>
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