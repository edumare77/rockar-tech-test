<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ customer.forename }}  {{ customer.surname }}</div>
                    <div class="card-body">
                        <ul style="list-style-type:none;"> 
                            <li> <span style="font-weight: bold;"> Email: </span> {{ customer.email }}</li>
                            <li> <span style="font-weight: bold;"> Phone: </span> {{ customer.contact_number }}</li> 
                            <li> <span style="font-weight: bold;"> Post Code: </span>{{ customer.postcode }}</li>
                        </ul>
                    </div>
                </div>
                <router-link class="link" to="/">Home</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {customersPath: {
            type: String,
            required: true}
        },
        data() {
            return { customer: [],
                    
            }
        },
        // Get resouce customer when page is loaded
        created() {
            const axios = require('axios');
            axios.get(this.customersPath + '/' + this.$route.params.id)
            .then(response => {
               this.customer = response.data;
            })
        },
    }
</script>
