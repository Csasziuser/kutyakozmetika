<script>
import Input from '@/Components/Input.vue';
import List from '@/Components/List.vue';

export default {
  components: {
    Input,
    List,
  },

  data() {
    return {
      input: {},
      foglalasok: {},
      isVisible: false
    }
  },

  methods: {
    inputChange(newValue) {
      this.input = newValue;
    },
    getfoglalasok() {
      this.isVisible = !this.isVisible
      fetch('/api/foglalas/' + this.input.date)
        .then(response => response.json())
        .then(data => { this.foglalasok = data; console.log(this.foglalasok) })
        .catch(error => console.error(error));
    },

    foglalas(foglalasData) {
      if (foglalasData.name != undefined && foglalasData.date != undefined) {
        if (foglalasData.name.length > 0 && foglalasData.date.length > 0) {

          fetch("/api/foglalas/", { method: "POST", headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),'Content-Type': 'application/json'}, body: JSON.stringify(foglalasData) })
            .then(this.isVisible = !this.isVisible,this.getfoglalasok())
            .catch(error => console.log(error));
          console.log(foglalasData);
        }
      }


    },

    delete_foglalas(id) {
      fetch("/api/foglalas/"+id, { 
        method: "DELETE",
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),'Content-Type': 'application/json'
        }
      })
            .then(this.isVisible = !this.isVisible,this.getfoglalasok())
            .catch(error => console.log(error));
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
          <List :input="input" :foglalasok="foglalasok" @foglalas="foglalas" @delete_foglalas="delete_foglalas"
            :isVisible="isVisible"></List>
        </div>
      </div>
    </div>
  </div>
</template>

<style></style>
