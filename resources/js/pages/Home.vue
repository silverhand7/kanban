<template>
    <Column title="Hello World" :items="items" />
    <h1>Home Page</h1>
</template>

<script>
import Column from '../components/Column.vue';

export default {
    data() {
        return {
            items: [
                {
                    "id": 1,
                    "title": 'Hello world'
                },
                {
                    "id": 2,
                    "title": 'Hello world 2'
                },
                {
                    "id": 3,
                    "title": 'Hello world 3'
                }
            ]
        }
    },
    components: {
        Column
    }
}

</script>