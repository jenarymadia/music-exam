<template>
  <div>
    <template v-if="artists.results">
      <h2>Artists:</h2>
      <ul>
        <li v-for="artist in artists.results" :key="artist.id" style="padding : 5px">
          <!-- Display small thumbnail and artist name -->
          <div>
            <!-- <img :src="artist.image.small ?? 'https://lastfm.freetls.fastly.net/i/u/34s/2a96cbd8b46e442fc41c2b86b821562f.png'" alt="Artist Thumbnail" style="width: 50px; height: 50px;"> -->
            <a :href="'/artist/'+artist.name" target="_blank">{{ artist.name }}</a>
            <svg v-if="isFaveArtist(artist.name)" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
              <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
            </svg>
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
          <a :href="'/album/'+album.name+'?artist='+album.artist" target="_blank">{{ album.name }} - {{ album.artist }}</a>
          <svg v-if="isFaveAlbum(album.name)" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
          </svg>
        </li>
      </ul>
  </template>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  props: {
      favoriteartists: {
          type: Object
      },
      favoritealbums: {
          type: Object
      },
  },
  data() {
      return {
          isFavorite: null,
          id: 0// Initialize as null initially
      };
  },
  computed: {
    ...mapState({
      artists: state => state.results.artists ?? [],
      albums: state => state.results.albums ?? []
    }),
  },
  methods: {
    isFaveArtist(name) {
        return this.favoriteartists.some(artist => artist.name === name);
    },
    isFaveAlbum(name) {
        return this.favoritealbums.some(album => album.name === name);
    }
  }
};
</script>
