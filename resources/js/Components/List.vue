<script>
    export default{
        props: ["foglalasok", "input", "isVisible"], 
        emits: ["foglalas", "delete_foglalas"],

        data(){
            return{
                idopontok: ["8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00"],
                id: -1
            }
        },
        
        methods:{
            foglalas(time){   
                this.$emit("foglalas", {name: this.input.name, date: this.input.date, time: time});
            },

            deleteFoglalas(id){
                this.$emit("delete_foglalas", id);
            },
            checkFoglalas(idopont)
            {
                this.id = -1;
                for (let i = 0; i < this.foglalasok.length; i++) {
                    if (this.foglalasok[i].foglalo_neve == this.input.name && this.foglalasok[i].nap == this.input.date && this.foglalasok[i].ora == idopont) {
                        this.id = this.foglalasok[i].id;
                        return this.foglalasok[i].id;
                    }
                }
                return false;
            },
            checkFoglalas2(idopont)
            {
                for (let i = 0; i < this.foglalasok.length; i++) {
                    if (this.foglalasok[i].nap == this.input.date && this.foglalasok[i].ora == idopont) {
                        return true;
                    }
                }
                return false;
            }
        },

    }
</script>

<template>
    

    <div class="card p-3 mt-3" v-if="isVisible">
        <template v-for="(idopont, index) in idopontok">
            <button v-if = "checkFoglalas(idopont)" class="btn btn-warning mb-2" @click="deleteFoglalas(checkFoglalas(idopont))">{{ idopont }} (Saját foglalás)</button>
            <button v-else-if = "checkFoglalas2(idopont)" class="btn btn-danger mb-2" >{{ idopont }} (Foglalt)</button>
            <button v-else class="btn btn-success mb-2" @click="foglalas(idopont)">{{ idopont }} (Szabad)</button>
        </template>
    </div>
</template>

<style>
</style>