<template>
        <div class="container">
        <div class="col-8 m-auto">
            <div class="row bg-white mb-3 pt-3" v-for="item in lists" :key="item.id">
                <div class="col-8">

                    <div class="row">
                        <div class="col-4">
                            <img  v-bind:src="item.url" class="img-fluid" alt="...">
                        </div>
                        <div class="col-8">
                            <div class="row mb-2">
                                
                                <div class="col-12">
                                    <a v-bind:href="'/productos/'+item.id" class="text-decoration-underline">
                                        {{item.nombre}}
                                    </a>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12">
                                    <label class="text-primary">{{ item.categorias }}</label>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12">
                                    <label for="">{{ item.sku }}</label>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-12">
                                    <star-component v-bind:calificacion="item.calificacion" ></star-component>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-12">
                            <label for="" class="text-primary">${{ item.precio }}</label>
                        </div>
                    </div>
        
        
                    <div class="row mb-3">
                        <div class="col-12">
                            <span class="badge rounded-pill bg-success">{{ item.estado }}</span>
                        </div>
                    </div>
        
                    <div class="row mb-2">
                        <div class="col-12  d-grid">
                            <button class="btn btn-light">Eliminar</button>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <stock-component v-bind:producto="item.id" v-bind:stock="item.estado" v-on:update="updateLists" ></stock-component>

                    </div>
        
        
        
                    <div class="row mb-2">
                        <calification-component v-bind:producto="item.id" v-on:update="updateLists" ></calification-component>
                    </div>
        
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
         return {
            lists: []
         }   
        },
        mounted() {
            axios.get('/productos').then((response) =>{
                this.lists = response.data.data;
            })
        },
        methods:{
            updateLists(){
                axios.get('/productos').then((response) =>{
                    this.lists = response.data.data;
                })
            }
        }
    }
</script>
