<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const listings = ref([])
const newListing = ref({
    title: '',
    address: '',
    city: '',
    state: '',
    price: 0,
    description: ''
})

async function fetchListings() {
    try {
        const res = await axios.get('/api/listings')
        listings.value = res.data
    } catch (error) {
        console.error(error)
    }
}

async function createListing() {
    try {
        await axios.post('/api/listings', newListing.value)
        // Clear form
        newListing.value = {
            title: '',
            address: '',
            city: '',
            state: '',
            price: 0,
            description: ''
        }
        // Reload
        fetchListings()
    } catch (error) {
        console.error(error)
    }
}

async function deleteListing(id) {
    try {
        await axios.delete(`/api/listings/${id}`)
        fetchListings()
    } catch (error) {
        console.error(error)
    }
}

onMounted(() => {
    fetchListings()
})
</script>

<template>
    <div>
        <h2>Listings</h2>
        <ul>
            <li v-for="listing in listings" :key="listing.id">
                <strong>{{ listing.title }}</strong> - {{ listing.address }},
                {{ listing.city }}, {{ listing.state }} - ${{ listing.price }}
                <button @click="deleteListing(listing.id)">Delete</button>
            </li>
        </ul>

        <h2>Create New Listing</h2>
        <form @submit.prevent="createListing">
            <div>
                <label>Title:</label>
                <input v-model="newListing.title" />
            </div>
            <div>
                <label>Address:</label>
                <input v-model="newListing.address" />
            </div>
            <div>
                <label>City:</label>
                <input v-model="newListing.city" />
            </div>
            <div>
                <label>State:</label>
                <input v-model="newListing.state" />
            </div>
            <div>
                <label>Price:</label>
                <input type="number" v-model="newListing.price" />
            </div>
            <div>
                <label>Description:</label>
                <textarea v-model="newListing.description"></textarea>
            </div>
            <button type="submit">Create</button>
        </form>
    </div>
</template>

<style scoped>
/* Basic styling */
</style>
