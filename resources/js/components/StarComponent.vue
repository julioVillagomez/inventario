<template>
    <div class="">

        <span class="fa fa-star" :class="calificacion >= 1 ? 'checked' : ''"></span>
        <span class="fa fa-star" :class="calificacion >= 2 ? 'checked' : ''"></span>
        <span class="fa fa-star" :class="calificacion >= 3 ? 'checked' : ''"></span>
        <span class="fa fa-star" :class="calificacion >= 4 ? 'checked' : ''"></span>
        <span class="fa fa-star" :class="calificacion >= 5 ? 'checked' : ''"></span>

    </div>
</template>

<script>
    export default {
        props: ['calificacion'],
       
        mounted() {
            
        },
      
       
    }
</script>
