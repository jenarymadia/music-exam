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

        const response = await axios.post('https://localhost/search', {
          searchBy: column,
          value: this.query
        });
        console.log(response.data.results);
        this.storeResults(response.data.results);

      } catch (error) {
        console.error('Error fetching albums:', error);
      }
    },
    buildLink(result,column) {
      if(column == 'artist') {
        let value = result.mbid ? result.mbid : result.name;
        return `/${column}/${value}`
      }else {
        let value = result.mbid !="" ? result.mbid : result.artist;
        return `/${column}/${result.name}?artist=${value}`
      }
    }
  },
  mounted() {
    console.log('Component mounted.');
  }
};
</script>
