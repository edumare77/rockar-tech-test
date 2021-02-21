<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Search custumers</div>

                    <div class="card-body">
                        <div class="dropdown">
                            <input v-model.trim="customerInput" @click="search(customersPath, customerInput, 'customer')" class="dropdown-input" type="text" placeholder="Find customer" />
                            <div v-show="showCustomerList" class="dropdown-list">
                                <div v-for="customer in searhCustumers" :key="customer.id" class="dropdown-item">
                                    <router-link :to="{name: 'customer', params: { id: customer.id }}" >{{ customer.email }}</router-link>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Search Products</div>

                    <div class="card-body">
                        <div class="dropdown">
                            <input v-model.trim="productInput" @click="search(productsPath, productInput, 'product')" class="dropdown-input" type="text" placeholder="Find product" />
                            <div v-show="showProductList" class="dropdown-list">
                                <div v-for="product in searchProducts" :key="product.id" class="dropdown-item">
                                    <router-link :to="{name: 'product', params: { id: product.id }}" >{{ product.make }} {{ product.model }}</router-link>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {customersPath: {
            type: String,
            required: true},

            productsPath: {
            type: String,
            required: true},
        },
         data() {
            return { customerInput: '',
                    productInput: '',
                    searhCustumers: [],
                    searchProducts: [],
                    showCustomerList: false,
                    showProductList: false,
            }
        },

        methods: {
            /*
            * Method search makes a HTTP requests 
            */
            search(path, input, type) {
                // Depending of the type - 'customer' or 'product' - hides and clears the other search bar input
                switch(type) {
                    case 'customer':
                        this.showCustomerList = true
                        this.showProductList = false;
                        this.productInput= '';
                        break;
                    case 'product':
                        this.showProductList = true;
                        this.showCustomerList = false;
                        this.customerInput = '';
                        break;
                    
                    }
                 axios.get(path + '/search/?search=' + input)
                 .then(response => {
                    //  add the response to the right data object property
                   switch(type) {
                    case 'customer':
                        this.searhCustumers = response.data.data;
                        break;
                    case 'product':
                        this.searchProducts = response.data.data;
                        break;
                    }
                })
            }
        },
        // These watchers act if the input search bars are clicked
        watch: {
            customerInput: function(newValue, oldValue) {
                this.showCustomerList = false;
                if (newValue !== oldValue && this.customerInput!== '') {
                    this.search(this.customersPath, this.customerInput, 'customer');
                }
            },
            productInput: function(newValue, oldValue) {
                this.showProductList = false;
                if (newValue !== oldValue && this.productInput !== '') {
                    this.search(this.productsPath, this.productInput, 'product');
                }
            }
        }
}
</script>
