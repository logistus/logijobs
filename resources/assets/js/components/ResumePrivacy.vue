<template>

</template>

<script>
    export default {
        data() {
          return {
            tasks: [],
            newTask: ''
          }
        },
        created() {
          //axios.get("/userlist").then(response => (this.tasks = response.data));
        },
        methods: {
          addTask() {
            axios.post("register", { body: this.newTask });
            this.tasks.push(this.newTask);
            this.newTask = '';
          }
        }
    }
</script>
