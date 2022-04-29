<template>
   <div>
        <div class="col-12  d-grid gap-2">
            <button type="button" class="btn btn-primary" @click="modal.show()">
                Calificacion
            </button>
        </div>
        <div class="modal fade" ref="exampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Califica nuestro producto</h5>
                    <button type="button" class="btn-close" @click="modal.hide()" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <span class="fa fa-star hover"  @click="save(1)"></span>
                        <span class="fa fa-star hover"  @click="save(2)"></span>
                        <span class="fa fa-star hover"  @click="save(3)"></span>
                        <span class="fa fa-star hover"  @click="save(4)"></span>
                        <span class="fa fa-star hover"  @click="save(5)"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="modal.hide()">Cerrrar</button>
                    </div>
                </div>
            </div>
        </div>
   </div>
</template>

<script>
import { Modal } from 'bootstrap'

    export default {
        props: ['producto'],
        data: () => ({
            modal: null
        }),
        methods:{
            save(calification){
                const params = {
                    calification: calification
                }
                axios.post('/productos/calification/'+this.producto,params).then((response) =>{
                    this.modal.hide()
                    alert('Se ha calificado correctamente');

                    this.$emit('update');
                });
            }
        },
        mounted() {
            this.modal = new Modal(this.$refs.exampleModal)
        }
      
       
    }
</script>
