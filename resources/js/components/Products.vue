<template>
    <div id="product-listing">
        <h1>Products Listing</h1>
        <logout></logout>
        <div id="filters">
            <select v-model="selectedAuthor" @change="onChange" >
                <option value="all">All Authors</option>
                <option v-for="author in authors" :value="author.id" :key="author.id">{{ author.name }}</option>
            </select>
            <input type="text" v-model="search" placeholder="Search by product name" />
            <datepicker v-model="dateFilter" placeholder="Select Date" format="yyyy-MM-dd" clear-button></datepicker>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Created On</th>
                </tr>
            </thead>
            <template v-if="products.length > 0">
                <tr v-for="product in products" :key="product.id" :id="product.id">
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.author.name }}</td>
                    <td>
                        <span v-if="product.is_active == 1">Active</span>
                        <span v-else>Inactive</span>
                    </td>
                    <td>{{ moment(product.created_at).format("DD-MM-YYYY") }}</td>
                </tr>
            </template>
            <template v-else>
                <tr><td colspan="5"><center>No Records Found</center></td></tr>
            </template>
        </table>
    </div>
</template>
<style scoped>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    #filters{
        float: right;
        margin-bottom: 10px;
    }

    input{ border: 1px solid #dddddd; }

    select{ padding: 2px; }

    .vdp-datepicker {
        display: inherit;
        float: left;
        border: 1px solid #dddddd;
        margin-right: 3px;
    }

    #product-listing{ min-height: 385px; }

    .vdp-datepicker__clear-button {
        position: absolute;
        right: 6px;
    }
</style>
<script>
    import productService from "../services/product.service";
    import Datepicker from 'vuejs-datepicker';
    import logout from "../components/Logout";
    import common from "../mixins/common";
    import moment from "moment";

    export default {
        name: "Product",
        data () {
            return {
                products: [],
                authors: [],
                selectedAuthor: 'all',
                search:'',
                dateFilter:'',
                moment:moment
            }
        },
        components: {
            Datepicker,
            logout
        },
        mixins: [common],
        methods: {
            async getProducts(){
                let vm = this;
                try {
                    let postdata = {'selectedAuthor' : this.selectedAuthor,'search': this.search, 'dateFilter' : this.dateFilter};
                    let response = await productService.getProduct(postdata);
                    vm.products = response.data.products;
                    vm.authors = response.data.authors;
                } catch (error) {
                    console.log(error);
                }  
            },
            onChange(event){
                this.selectedAuthor = event.target.value;
                this.getProducts(); 
            }            
        },
        watch: {
            search: function(val, oldVal) {
                if(val != oldVal){
                    this.search = val;
                    this.getProducts(); 
                }
            },
            dateFilter: function(val){
                this.dateFilter = val;
                this.getProducts(); 
            }
        },
        mounted() {
            this.getProducts();
        }
    }
</script>