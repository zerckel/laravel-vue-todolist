<template>
    <div>
        <div class="btn-success" id="alert" style="text-align: center; border-radius: 5px; position: absolute; opacity: 0; width: 20vw; margin: 0 auto; transition: 1s" > {{message}} </div>
        <article>
            <form style="width: 80vw; margin: 0 auto; display: flex; align-items: center">
                <div class="form-group" style="width: 100%">
                    <label for="exampleInputEmail1"></label>
                    <input v-model="task.task" type="text" class="form-control" id="exampleInputEmail1"
                           placeholder="update your task..">
                </div>
                <button @click="modify" type="button" class="btn btn-primary">Update</button>
            </form>
        </article>
    </div>
</template>
<script>
    export default {
        name: 'task',
        props: [
            'id'
        ],
        data() {
            return {
                task: '',
                message: '',
            }
        },
        methods: {
            getTask: function () {
                fetch('/task/get/' + this.id)
                    .then((res) => res.json())
                    .then((data) => {
                        this.task = data[0]
                    })
            },
            modify: function () {
                fetch('/task/update/' + this.task.id + '/' + this.task.task)
                    .then((res) => res.json())
                    .then((data) => {
                        data ? this.$router.push({ path :'/'}) : this.message = 'error'
                    })
            }
        },
        watch:{
          message: function () {
                document.querySelector('#alert').style.opacity = '1'
          }
        },
        mounted() {
            this.getTask()
        }
    }
</script>
