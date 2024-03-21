<template>
    <div class="container">
        <div class="row justify-content-between mb-3">
            <div class="col-auto">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </div>
            <div class="col-auto">
                <button v-if="isFavorite" class="btn btn-danger" @click.prevent="removeFromFavorites()">Remove to Favorites</button>
                <button v-else class="btn btn-primary" @click.prevent="addToFavorites()">Add to Favorites</button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ artist.name }}</h1>
                <img :src="artist.image.extralarge" :alt="artist.name" class="img-fluid rounded mb-3">
                
                <h2>Biography:</h2>
                <p v-html="artist.bio.content"></p>
                <h2>Similar Artists:</h2>

                <ul class="list-inline">
                    <li v-for="similar in artist.similar" :key="similar.name" class="list-inline-item">
                        <img :src="similar.image.medium" :alt="similar.name" style="width:64px;height:64px;">
                        <a :href="similar.url">{{ similar.name }}</a>
                    </li>
                </ul>

                <h2>Tags:</h2>
                <ul class="list-inline">
                    <li v-for="tag in artist.tags" :key="tag.name" class="list-inline-item">
                        <a :href="tag.url" class="badge badge-primary">{{ tag.name }}</a>
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
            artist: {
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
                axios.post(endpoint, this.artist)
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