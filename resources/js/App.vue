<template>
  <div class="container">
    <router-view></router-view>
    <div class="export-db">
      <button class="export-db__button" @click="exportDB">Export DB</button>
    </div>
  </div>

</template>

<script>

export default {
  methods: {
    async exportDB() {
      await axios.post('/api/export-db').then(response => console.log('done'));
    }
  }
}

</script>

<style lang="scss">
  @import "../css/app.scss";
</style>