<script>
  import Input from '@/Components/Input.vue';
  import List from '@/Components/List.vue';

  export default{
    components: {
      Input,
      List,
    },

    data(){
      return{
        input: {},
        foglalasok: {},
      }
    },

    methods:{
      inputChange(newValue){
        this.input = newValue;
      },
      getfoglalasok()
      {
        this.isVisible = !this.isVisible
        fetch('/api/foglalas/'+this.input.date)
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error(error));
      }
      ,

      foglalas(foglalasData){
        if (foglalasData.name != undefined && foglalasData.date != undefined){
          if (foglalasData.name.length > 0 && foglalasData.date.length > 0){
            if (!this.foglalasok[foglalasData.date]){
              this.foglalasok[foglalasData.date] = {};
            }

            this.foglalasok[foglalasData.date][foglalasData.time] = foglalasData.name;

            console.log(this.foglalasok);
          }
        }
       
        
      },

      delete_foglalas(foglalasData){
        this.foglalasok[foglalasData.date][foglalasData.time] = false;
      }
    }
  }
</script>

<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="card w-50 text-center mx-auto mt-4 p-4">
          <h1 class="mb-3">Kutyakozmetikus Foglalás</h1>

          <Input @inputChange="inputChange"></Input>

          <button class="btn btn-primary" @click=" getfoglalasok()">Időpontok megtekintése</button>
          <List :input="input" :foglalasok="foglalasok" @foglalas="foglalas" @delete_foglalas="delete_foglalas"></List>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
</style>
