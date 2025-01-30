<script>
    export default{
        props: ["foglalasok", "input"], 
        emits: ["foglalas", "delete_foglalas"],

        data(){
            return{
                idopontok: ["8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00"],
                isVisible: false,
            }
        },
        
        methods:{
            foglalas(time){   
                this.$emit("foglalas", {name: this.input.name, date: this.input.date, time: time});
            },

            deleteFoglalas(time){
                this.$emit("delete_foglalas", {name: this.input.name, date: this.input.date, time: time});
            }
        },

        watch:{
            input:{
                handler(){
                    this.isVisible = false;
                },

                deep: true,
            }
        }
    }
</script>

<template>
    <button class="btn btn-primary" @click="isVisible = !isVisible">Időpontok megtekintése</button>

    <div class="card p-3 mt-3" v-if="isVisible">
        <template v-for="(idopont, index) in idopontok">
            <button v-if = "foglalasok[input.date] && foglalasok[input.date][idopont] == input.name" class="btn btn-warning mb-2" @click="deleteFoglalas(idopont)">{{ idopont }} (Saját foglalás)</button>
            <button v-else-if = "foglalasok[input.date] && foglalasok[input.date][idopont] " class="btn btn-danger mb-2" >{{ idopont }} (Foglalt)</button>
            <button v-else class="btn btn-success mb-2" @click="foglalas(idopont)">{{ idopont }} (Szabad)</button>
        </template>
    </div>
</template>

<style>
</style>