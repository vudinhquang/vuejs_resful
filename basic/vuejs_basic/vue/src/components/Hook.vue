<template>
    <div class="hook">
        <h1>{{ title }}</h1>
        <button @click="ChangeTitle">Click Me</button>
        <h1>Posts</h1>
        <input type="text" v-model="searchTerm" placeholder="Search">
        <div v-for="post in filtersearch" :key="post.id">
            <h2>{{ post.title }}</h2>
            <p>{{ post.body | snippet }}</p>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
  name: 'Hook',
  data() {
      return {
        title: 'VueJs Axios Request',
        posts: [],
        searchTerm: ''
      }
  },
  computed: {
      filtersearch() {
          return this.posts.filter(post => {
              return post.title.match(this.searchTerm);
          });
      }
  },
  methods: {
      ChangeTitle() {
          this.title = "easy to learning"
      }
  },
  beforeCreate() {
      alert("beforeCreate Hook");
  },
  created() {
      axios.get("https://jsonplaceholder.typicode.com/posts")
            .then(response => {
                this.posts = response.data;
            })
            .catch(error => {
                console.log(error);
            });
  },
  beforeUpdate() {
      alert("beforeUpdate");
  },
  updated() {
      alert("updated");
  }
}
</script>

<style>
h1 {
    color: red;
    text-align: center;
}
</style>
