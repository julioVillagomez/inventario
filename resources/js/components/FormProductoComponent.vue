<template>
    <div class="container">
        <div class="row">
            <div class="col-6 m-auto">
                <form v-on:submit.prevent="newProduct()">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" v-model="form.nombre" id="nombre" >
                    </div>
                    <div class="mb-3">
                        <label for="sku" class="form-label">SKU</label>
                        <input type="text" class="form-control" v-model="form.sku" id="sku" >
                    </div>
        
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" v-model="form.cantidad" id="cantidad" >
                    </div>
        
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" v-model="form.precio" id="precio" >
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">¿Tiene Inventario?</label>
                        <select class="form-select" v-model="form.estado">
                            <option value="con inventario">SI</option>
                            <option value="sin inventario">NO</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="i" class="form-label">Categorias</label>
                        
                        <select class="form-select" multiple v-model="form.categorias" aria-label="multiple select example">
                            <option v-for="item in categorias" :key="item.id" :value="item.id" >{{item.nombre}}</option>
                        </select>
                    </div>

                     <div class="mb-3">
                        <label for="i" class="form-label">Imagen</label>
                        <input class="form-control" type="file" id="image" @change="uploadFile" ref="file">

                    </div>


                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <textarea class="form-control" id="descripcion" v-model="form.descripcion" rows="3"></textarea>
                    </div>


                    <div >
                        <ul>
                            <li v-for="(error, index) in errors" :key="error">
                                <label v-for="message in error" :key="item" class="text-danger">{{message}}</label>
                            </li>
                        </ul>
                    </div>
                    
                    
                   
                    <button type="Guardar" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                form: {
                    nombre: '',
                    sku: '',
                    cantidad: 1,
                    precio : 0,
                    descripcion: '',
                    estado:'con inventario',
                    images:null,
                    categorias: []
                },
                categorias: [],
                errors:[]
            }
        },
        mounted() {
            axios.get('/productos/categorias').then((response) => {
                this.categorias = response.data
            });
        },
        methods: {
            uploadFile() {
                this.form.images = this.$refs.file.files[0];
            },
            newProduct() {

                const params = new FormData();

                params.append('image',this.form.images);
                params.append('nombre',this.form.nombre);
                params.append('sku',this.form.sku);
                params.append('cantidad',this.form.cantidad);
                params.append('precio',this.form.precio);
                params.append('descripcion',this.form.descripcion);
                params.append('estado',this.form.estado);
                params.append('categorias',this.form.categorias);

                const headers = { 'Content-Type': 'multipart/form-data' };


                axios.post('/productos',params,headers)
                .then((response) =>{

                    this.form = {
                        nombre: '',
                        sku: '',
                        cantidad: 1,
                        precio : 0,
                        descripcion: '',
                        estado:'con inventario',
                        images:null,
                        categorias: []
                    }

                    this.errors = [];

                    window.location.href = '/';
                })
                .catch((error) => {
                    this.errors = error.response.data.errors

                    console.log(this.errors);
                });
            }
        }
       
    }
</script>
