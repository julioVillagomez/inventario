<template>
    <div class="container">
        <div class="row mb-3">
            <div class="col-8 m-auto">
                <div class="row">
                    <div class="col-5">
                        <img  v-bind:src="info.url"  class="img-fluid" alt="...">
                    </div>
                    <div class="col-7">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <label for="">{{info.nombre}}</label>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="">by {{info.categorias}}</label>
                            </div>
                            <div class="col-12 mb-2">
                                <span for="">${{info.precio}}</span>
                                <star-component></star-component>

                            </div>
                            <div class="col-12 mb-2">
                                <span for="">Disponible: <span class="badge rounded-pill bg-success">{{ info.estado }}</span></span>

                            </div>
                            <div class="col-12 mb-2">
                                <p>{{info.descripcion}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import StarComponent from './StarComponent.vue';
    export default {
  components: { StarComponent },
        data(){
            return {
                info: {}
            }
        },
        mounted() {
            const currentUrl = window.location.pathname;

            const element = currentUrl.split('/');

            axios.get('/productos/'+element[2]).then((response) =>{
                this.info = response.data.data;

            })

        },
      
       
    }
</script>
