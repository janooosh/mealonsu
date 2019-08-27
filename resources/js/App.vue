<template>
  <div id="app">
    <div>Mini Heart: <rating v-model="miniHeart" type="mini heart" /></div>
  </div>
</template>

<script>
import Rating from "v-rating";

export default {
  name: "App",
  components: {
    Rating
  },
  data() {
    return {
      miniHeart: 1
    };
  }
};
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
