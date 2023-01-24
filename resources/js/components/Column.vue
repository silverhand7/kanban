<template>
    <div>
        <div class="column">
            <div class="column__header" @click="showRenameForm">
                <div class="column__header__title">
                    <div v-if="isForm == false">
                        {{ title }}
                    </div>
                    <div v-else>
                        <input type="text" id="title" v-model="newName" v-on:keyup.enter="onEnter"> <button @click="save">Save</button>
                    </div>
                </div>
                <div class="remove-button" @click="$emit('removeColumn', id)">X</div>
            </div>
            <div class="column__body">
                <Draggable group="tasks" :list="items" @change="log($event, id)">
                    <CardItem
                        v-for="item in items"
                        :key="item.id"
                        :id="item.id"
                        :title="item.title"
                        :description="item.description"
                        @showCardModal="showCardModal"
                    >
                        {{ item.title }}
                    </CardItem>
                </Draggable>
            </div>
            <div class="column__footer">
                <button class="button" @click="showCardModalForm">Add a card</button>
            </div>
        </div>
    </div>
</template>

<script>
import CardItem from './CardItem.vue';
import Draggable from 'vuedraggable';
import axios from 'axios';

export default {
    props: {
        id: Number,
        title: String,
        items: {
            default: [],
            type: Array,
        }
    },
    data() {
        return {
            added: [],
            removed: [],
            isForm: false,
            newName: this.title,
        }
    },
    components: {
        CardItem,
        Draggable,
    },
    methods: {
        async log(evt, columnId) {
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

                await axios.post('/api/card/move', {
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

        async showRenameForm() {
            this.isForm = true;
            await this.$nextTick()
            document.getElementById('title').focus();
        },

        hideRenameForm() {
            this.isForm = false;
            this.$el.blur();
        },

        async save() {
            await axios.put(`/api/column/${this.id}/update`, {
                name: this.newName,
            }).then(response => this.$emit('updateColumn', this.id, this.newName));
            this.hideRenameForm();
        },

        onEnter() {
            this.save();
        },

        showCardModal(id, title, description) {
            // this.$emit('showCardModal', id, title, description, this.id, true);
        },

        showCardModalForm() {
            this.$emit('showCardModalForm', this.id);
        }
    },
}

</script>