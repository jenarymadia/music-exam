<template>
  <div>
    <input type="text" class="form-control" placeholder="Search music" v-model="query" @keyup.enter="search()">
  </div>
</template>

<script>
import { mapActions } from 'vuex'; // Import mapActions helper from Vuex
import axios from 'axios';

export default {
  data() {
    return {
      query: '',
      result: []
    };
  },
  methods: {
    ...mapActions(['storeResults']), // Map the storeResults action from Vuex
    async search(column) {
      try {
        const response = await axios.post('/search', {
          searchBy: column,
          value: this.query
        });
        console.log(response.data.results);
        this.storeResults(response.data.results);
      } catch (error) {
        console.error('Error fetching albums:', error);
      }
    },
  },
  mounted() {
    console.log('Component mounted.');
  }
};
</script>
