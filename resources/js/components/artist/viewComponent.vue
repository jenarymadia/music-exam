<template>
    <div class="container">
        <div class="row justify-content-between mb-3">
            <div class="col-auto">
            </div>
            <div class="col-auto">
                <button v-if="isFavorite" class="btn btn-danger" @click.prevent="removeFromFavorites()">Remove to Favorites</button>
                <button v-else class="btn btn-primary" @click.prevent="addToFavorites()">Add to Favorites</button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ info.name }}</h1>
                <img :src="info.image.extralarge" :alt="info.name" class="img-fluid rounded mb-3">
                
                <h2>Biography:</h2>
                <p v-html="info.bio.content"></p>
                <h2>Similar Artists:</h2>

                <ul class="list">
                    <li v-for="similar in info.similar" :key="similar.name" class="list-item">
                        <a :href="similar.url">{{ similar.name }}</a>
                    </li>
                </ul>

                <h2>Top Albums:</h2>
                <ul class="list">
                    <li v-for="album in albums" :key="album.name" class="list-item">
                        <a :href="album.url" target="_blank">{{ album.name }}</a>
                    </li>
                </ul>

                <h2>Top Tracks:</h2>
                <ul class="list">
                    <li v-for="track in tracks" :key="track.name" class="list-item">
                        <a :href="track.url" target="_blank">{{ track.name }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2';
    export default {
        props: {
            info: {
                type: Object,
                required: true
            },
            tracks: {
                type: Object,
                required: true
            },
            albums: {
                type: Object,
                required: true
            },
            favorite: {
                type: Number,
                required: true
            }
        },
        data() {
            return {
                isFavorite: null,
                id: 0// Initialize as null initially
            };
        },
        mounted() {
            // Set the value of isFavorite to the value of favorite prop
            this.isFavorite = this.favorite ? true : false;
            this.id = this.favorite;
        },
        methods: {
            addToFavorites() {
                // Example endpoint for adding to favorites
                const endpoint = '/artist';

                // Send a POST request using Axios
                axios.post(endpoint, this.info)
                    .then(response => {
                        this.isFavorite = true;
                        this.id = response.data.id;
                        Swal.fire({
                            icon: "success",
                            title: "Successfully added to favorites",
                            showConfirmButton: false,
                        });
                        // Optionally, perform any actions after adding to favorites
                    })
                    .catch(error => {
                        console.error('Error adding to favorites:', error);
                        // Optionally, handle errors
                    });
            },

            removeFromFavorites() {
                const endpoint = `/artist/${this.id}`; // Assuming you have the favorite's ID
                // Send a DELETE request using Axios
                axios.delete(endpoint)
                .then(response => {

                    this.isFavorite = false;
                    Swal.fire({
                        icon: "success",
                        title: "Successfully removed from favorites",
                        showConfirmButton: false,
                    });
                    // Optionally, perform any actions after removing from favorites
                })
                .catch(error => {
                    console.error('Error removing from favorites:', error);
                    // Optionally, handle errors
                });
            }
        }
    }
</script>