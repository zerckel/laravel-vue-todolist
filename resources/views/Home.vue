<template>
    <div>
        <div id="alert" style="text-align: center; border-radius: 5px; position: absolute; opacity: 0; width: 20vw; margin: 0 auto; transition: 1s" > {{message}} </div>
        <form style="width: 80vw; margin: 0 auto; display: flex; align-items: center">
            <div class="form-group">
                <label for="exampleInputEmail1"></label>
                <input v-model="newTask" type="text" class="form-control" id="exampleInputEmail1"
                       placeholder="Enter a task..">
            </div>
            <button @click="addTask" type="button" class="btn btn-primary">Add</button>
        </form>

        <div style="width: 100%; border-radius: 10px; display: flex; justify-content: center; flex-direction: column; ">
            <h2 style="text-align: center; margin-bottom: 10px">
                Task lists
            </h2>
            <ul style="list-style: none; max-height: 450px; overflow-y: auto">
                <li v-for="task in tasks"
                    style="border-radius: 5px; background-color: white; display: flex; justify-content: space-between; padding: 5px 10px;border-bottom: solid 1px lightgrey ; align-items: center">
                    <span>{{ task.task }}</span>
                    <div>
                        <button class="btn btn-primary"><router-link :to=" {name:'task', params:{id : task.id} }" style="color: white"> Modify </router-link></button>
                        <button class="btn btn-primary alert-danger" @click="deleteTask(task.id)">Delete</button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'app',
        data() {
            return {
                newTask: '',
                message: '',
                tasks: []
            }
        },
        methods: {
            addTask: function () {
                if (this.newTask !== "") {
                    fetch('/task/add/' + this.newTask)
                        .then((res) => res.json())
                        .then((data) => {
                            this.message = data[0]
                            data[0] ?  this.tasks.push({task: this.newTask, id: data[1]}) : false
                        })
                }
            },
            deleteTask: function(id){
                fetch('/task/delete/' + id)
                    .then((res) => res.json())
                    .then((data) => {
                        this.message = data
                        data ? this.tasks = this.tasks.filter(task => task.id !== id ) : false
                    })
            },
            getTask: function () {
                fetch('/task/get')
                    .then((res) => res.json())
                    .then((data) => {
                        this.tasks = data
                    })
            },
            alertUser: function () {
                let alert = document.querySelector('#alert')
                if (this.message){
                    alert.classList.remove('btn-danger')
                    alert.classList.add('btn-success')
                    this.message = 'success'
                }else{
                    alert.classList.remove('btn-success')
                    alert.classList.add('btn-danger')
                    this.message = 'error'

                }
                alert.style.opacity = '1'
                setTimeout(function () {
                    alert.style.opacity = '0'
                }, 3 * 1000)
            }
        },
        watch: {
            message: function () {
                this.alertUser()
            }
        },
        mounted() {
            this.getTask()
        }
    }
</script>
