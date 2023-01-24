<template>
    <div class="card-backdrop" @click.self="close" v-if="isOpen">
        <div class="card-modal">
            <div class="card-modal__header">
                <div>
                    <h3 v-if="newShowForm == false">{{ newTitle }}</h3>
                    <div v-else><input type="text" class="text-modal" v-model="newTitle"></div>
                </div>
                <div v-if="newShowForm == false">
                    <button @click="editForm">Edit</button>
                    <button @click="deleteCard">Delete</button>
                </div>
                <div v-else>
                    <button @click="saveForm">Save</button>
                </div>
            </div>
            <div class="card-modal__body">
                <div v-if="newShowForm == false">
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
        isShowForm: {
            default: false,
            type: Boolean,
        },
        columnId: Number,
    },

    data() {
        return {
            newShowForm: this.isShowForm,
            newTitle: this.title,
            newDescription: this.description,
        }
    },

    created() {
        console.log(this.columnId);
    },

    methods: {
        deleteCard() {
            if(confirm('are you sure?')) {
                this.$emit('deleteCard', this.id);
            }
        },
        close() {
            this.newShowForm = false;
            this.$emit('close');
            //this.$router.push('/');
            window.location.href = '/';
        },
        editForm() {
            this.newShowForm = true;
        },

        async saveForm(){
            if (this.id != 0) {
                await axios.put(`/api/card/${this.id}/update`, {
                    title: this.newTitle,
                    description: this.newDescription
                }).then(response => {
                    this.$emit('updateCard', response.data.id, response.data.title, response.data.description, response.data.column_id);
                    this.newShowForm = false;
                });
            } else {
                await axios.post(`/api/card/store`, {
                    title: this.newTitle,
                    description: this.newDescription,
                    column_id: this.columnId,
                }).then(response => {
                    this.$emit('updateCard', response.data.id, response.data.title, response.data.description, response.data.column_id);
                    this.newShowForm = false;
                });
            }
        },
    },
}
</script>
