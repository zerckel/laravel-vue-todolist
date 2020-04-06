<template>
    <div
        style="margin: 5vh 20px;height: 90vh; background-color: whitesmoke ; border-radius: 10px; display: flex;  flex-direction: column; font-family: monospace; padding: 5px 10px">
        <header>
            <h1 style="text-align: center">
                Laravel Vue Todolist
            </h1>
            <form style="width: 80vw; display: flex; align-items: center">
                <div class="form-group">
                    <label for="exampleInputEmail1"></label>
                    <input v-model="newTask" type="email" class="form-control" id="exampleInputEmail1"
                           aria-describedby="emailHelp" placeholder="Enter a task..">
                </div>
                <button @click="addTask" type="button" class="btn btn-primary">Add</button>
            </form>
        </header>

        <div style="width: 100%; border-radius: 10px; display: flex; justify-content: center; flex-direction: column; ">
            <h2 style="text-align: center; margin-bottom: 10px">
                Task lists
            </h2>
            <ul style="list-style: none">
                <li v-for="task in tasks" style="background-color: white">
                    {{ task.task }}
                </li>
            </ul>
        </div>

        <!--        <p>
                    <router-link :to="{ name: 'home' }"> Wsh </router-link>
                    <router-link :to="{ name: 'hello' }"> Hello </router-link>
                </p>
                <div class="container">
                    <router-view></router-view>
                </div>-->
    </div>
</template>
<script>
    export default {
        name: 'app',
        data() {
            return {
                newTask: '',
                message: '',
                tasks:{

                }
            }
        },
        methods: {
            addTask: function () {
                if (this.newTask !== "") {
                    fetch('/task/add/' + this.newTask)
                        .then((res) => res.json())
                        .then((data) => {
                            this.message = data
                        })
                }
            },
            getTask:function () {
                fetch('/task/get')
                    .then((res) => res.json())
                    .then((data) => {
                        this.tasks = data
                    })
            }
        },
        created() {
            this.getTask()
        }
    }
</script>
