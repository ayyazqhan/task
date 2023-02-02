<template>
    <div class="container w-100 m-auto text-center mt-3">
        <h1 class="text-danger">Task list</h1>
        <add-item-form v-on:reloadlist="getItems()" />
        <list-view
            :items="items"
            v-on:reloadlist="getItems()"
            class="text-center"
        />
    </div>
</template>

<script>
import addItemForm from "./addItemForm";
import listView from "./listView";

export default {
    components: {
        addItemForm,
        listView
    },

    data: function() {
        return {
            items: [],
            token:'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjc1MzcyNjg0LCJleHAiOjE2NzUzNzYyODQsIm5iZiI6MTY3NTM3MjY4NCwianRpIjoiOXFmQmh6cER2Z3g4NzBSMSIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.Q9eul7jp1naVOdOjJbpS_NlBiL6MTyy29K_ZVv7HjZ0'
        };
    },
    methods: {
        getItems() {
            axios.get('api/list-tasks', {
                headers: {
                  'Authorization': 'Bearer ' + this.token
                }
              }).then(res => {
                    this.items = res.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    created() {
        this.getItems();
    }
};
</script>

<style scoped></style>