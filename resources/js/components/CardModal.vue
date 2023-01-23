<template>
    <div class="card-backdrop" @click.self="close" v-if="isOpen">
        <div class="card-modal">
            <div class="card-modal__header">
                <div>
                    <h3>{{ title }}</h3>
                </div>
                <div>
                    <button>Edit</button>
                    <button @click="deleteCard">Delete</button>
                </div>
            </div>
            <div class="card-modal__body">
                {{ description }}
            </div>
        </div>
    </div>
</template>

<script>

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
    methods: {
        deleteCard() {
            this.$emit('deleteCard', this.id);
            // if(confirm('are you sure?')) {
            // }
        },
        close() {
            this.$emit('close');
        }
    },
}
</script>
