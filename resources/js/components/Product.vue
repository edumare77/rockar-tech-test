<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ product.make }}  {{ product.model }}</div>
                    <div class="card-body">
                        <ul style="list-style-type:none;"> 
                            <li> <span style="font-weight: bold;"> Vin: </span> {{ product.vin }}</li>
                            <li> <span style="font-weight: bold;"> Colour: </span> {{ product.colour }}</li> 
                             <li> <span style="font-weight: bold;"> Price: </span>{{ product.price }}</li>
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
        props: {productsPath: {
            type: String,
            required: true}
        },
        data() {
            return { product: [],
                    
            }
        },
        created() {
            const axios = require('axios');
            axios.get(this.productsPath + '/' + this.$route.params.id)
            .then(response => {
               this.product = response.data;
               this.product.price = (this.product.price).toLocaleString('en-UK', {
                style: 'currency',
                currency: 'GBP',
                });
            })
        },
    }
</script>
