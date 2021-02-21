import Customer from './components/Customer';
import Product from './components/Product';
import Home from './components/Home';
import VueRouter from 'vue-router';

let customersPath = 'http://127.0.0.1:8000/customers';
let productsPath = 'http://127.0.0.1:8000/products';
let routes =  [
    {
        path:'/',
        component: Home,
        props: {
            customersPath: customersPath,
            productsPath: productsPath
        }
    },

    {
        path:'/customer/:id',
        component: Customer,
        name: 'customer',
        props: {
            customersPath: customersPath
        }
        
    },

    {
        path:'/product/:id',
        component: Product,
        name: 'product',
        props: {
            productsPath: productsPath
        }
        
        
    },

   

    
];

export default new VueRouter({
   
    routes
});