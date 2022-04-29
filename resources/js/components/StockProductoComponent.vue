<template>
   <div>
        <div class="col-12  d-grid gap-2">
            <button type="button" class="btn btn-info" @click="modal.show()">
                Stock
            </button>
        </div>
        <div class="modal fade" ref="exampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualiza inventario</h5>
                    <button type="button" class="btn-close" @click="modal.hide()" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        {{ stock == 'Con stock' ? 'Dejar este producto sin stock' : 'Dejar este producto con stock'  }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="modal.hide()">Cerrrar</button>
                        <button type="button" class="btn btn-primary" @click="save">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
   </div>
</template>

<script>
import { Modal } from 'bootstrap'

    export default {
        props: ['producto','stock'],
        data: () => ({
            modal: null
        }),
        methods:{
            save(){
                axios.post('/productos/stock/'+this.producto).then((response) =>{
                    this.modal.hide()
                    alert('Se ha actualizado stock correctamente');

                    this.$emit('update');
                });
            }
        },
        mounted() {
            this.modal = new Modal(this.$refs.exampleModal)
        }
      
       
    }
</script>
