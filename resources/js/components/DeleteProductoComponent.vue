<template>
   <div>
        <div class="col-12  d-grid gap-2">
            <button type="button" class="btn btn-danger" @click="modal.show()">
                Eliminar
            </button>
        </div>
        <div class="modal fade" ref="exampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                    <button type="button" class="btn-close" @click="modal.hide()" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        ¿Deses eliminar el producto?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="modal.hide()">No</button>
                        <button type="button" class="btn btn-primary" @click="save">Si</button>
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
            save(){
                axios.delete('/productos/'+this.producto).then((response) =>{
                    this.modal.hide()
                    alert('Se ha eliminado stock correctamente');

                    this.$emit('update');
                });
            }
        },
        mounted() {
            this.modal = new Modal(this.$refs.exampleModal)
        }
      
       
    }
</script>
