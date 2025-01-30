<script>
    export default{
        emits:["inputChange"],

        data(){
            return{
                inputs: {
                    name: "",
                    date: "",
                },

                today: (new Date()).toISOString().split("T")[0],
            }
        },

        watch:{
            inputs:{
                handler(newValue, oldValue){
                    this.$emit("inputChange", newValue);
                },

                deep: true,
            }
        }
    }
</script>

<template>
  <div class="mb-3 text-start">
    <label for="nev" class="form-label">Név</label>
    <input type="text" class="form-control" id="nev" v-model="inputs.name">
  </div>

  <div class="mb-3 text-start">
    <label for="datum" class="form-label">Dátum</label>
    <input type="date" class="form-control" id="datum" :min="today" v-model="inputs.date">
  </div>
</template>

<style>
</style>