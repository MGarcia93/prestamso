<template>
    <div>
        <h1 class="bg-success"  >asd</h1>
        <button v-on:click="pedir">a</button>
    </div>
</template>
<script>
export default {
    data(){
        return{
            prestano:'',
        }
    },
    methods:{
        pedir(){
             axios
            .get('/prestamo/32')
            .then(response => (console.log( this.prestamo=response.data)));
            console.log(this.prestamo);
        }
    }
}
</script>