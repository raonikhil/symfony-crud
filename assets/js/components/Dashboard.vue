<template>
    <div>
        <b-table striped hover :items="items"></b-table>
        <b-button variant="info" @click.prevent="onSubmit">Add Item</b-button>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            items: []
        }
    },
    async created () {
        const response = await axios.get('http://local.symfony-project.com/items')
        this.items = response.data
    },
    
    methods: {
        onSubmit() {
            const response = axios.post('http://local.symfony-project.com/items', {name:"TEST"})
        },
    } 
}
</script>