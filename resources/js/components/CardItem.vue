<template>
    <div class="card" @click="$emit('showCardModal', id, title, description)">
        <slot></slot>
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