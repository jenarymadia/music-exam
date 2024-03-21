<template>
  <div>
    <template v-if="artists.results">
      <h2>Artists:</h2>
      <ul>
        <li v-for="artist in artists.results" :key="artist.id" style="padding : 5px">
          <!-- Display small thumbnail and artist name -->
          <div>
            <!-- <img :src="artist.image.small ?? 'https://lastfm.freetls.fastly.net/i/u/34s/2a96cbd8b46e442fc41c2b86b821562f.png'" alt="Artist Thumbnail" style="width: 50px; height: 50px;"> -->
            <a :href="'https://localhost/artist/'+artist.name" target="_blank">{{ artist.name }}</a>
          </div>
        </li>
      </ul>
    </template>
    <template v-if="artists.results">
    <h2>Albums:</h2>
      <ul>
        <!-- Loop through albums -->
        <li v-for="album in albums.results" :key="album.id" style="padding : 5px">
          <!-- Use <a> tag with proper href attribute -->
          <a :href="'https://localhost/album/'+album.name+'?artist='+album.artist" target="_blank">{{ album.name }} - {{ album.artist }}</a>
        
        </li>
      </ul>
  </template>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  computed: {
    ...mapState({
      artists: state => state.results.artists ?? [],
      albums: state => state.results.albums ?? []
    })
  },
  mounted() {
    console.log(this.artists);
    console.log(this.albums);
  }
};
</script>
