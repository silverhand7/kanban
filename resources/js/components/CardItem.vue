<template>
    <router-link
        tag="div"
        :to="`/${id}`"
    >
        <div class="card" @click="$emit('showCardModal', id, title, description)">
            <slot></slot>
        </div>
    </router-link>
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