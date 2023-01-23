<template>
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
</template>

<script>

export default {
    props: {
        id: Number,
        title: String,
        description: String
    }
}
</script>
