<template>
    <div class="card-backdrop" @click.self="close" v-if="isOpen">
        <div class="card-modal">
            <div class="card-modal__header">
                <div>
                    <h3 v-if="showForm == false">{{ newTitle }}</h3>
                    <div v-else><input type="text" class="text-modal" v-model="newTitle"></div>
                </div>
                <div v-if="showForm == false">
                    <button @click="editForm">Edit</button>
                    <button @click="deleteCard">Delete</button>
                </div>
                <div v-else>
                    <button @click="saveForm">Save</button>
                </div>
            </div>
            <div class="card-modal__body">
                <div v-if="showForm == false">
                    {{ newDescription }}
                </div>
                <div v-else>
                    <textarea cols="30" rows="10" class="text-modal" v-model="newDescription">{{ newDescription }}</textarea>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';


export default {
    props: {
        id: Number,
        title: String,
        description: String,
        isOpen: {
            default: false,
            type: Boolean
        },
    },

    data() {
        return {
            showForm: false,
            newTitle: this.title,
            newDescription: this.description,
        }
    },

    methods: {
        deleteCard() {
            this.$emit('deleteCard', this.id);
            // if(confirm('are you sure?')) {
            // }
        },
        close() {
            this.showForm = false;
            this.$emit('close');
        },
        editForm() {
            this.showForm = true;
        },

        async saveForm(){
            await axios.put(`/api/card/${this.id}/update`, {
                title: this.newTitle,
                description: this.newDescription
            }).then(response => {
                this.$emit('updateCard', response.data.id, response.data.title, response.data.column_id);
                this.showForm = false;
            });
        },
    },
}
</script>
