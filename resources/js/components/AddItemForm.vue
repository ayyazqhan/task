<template>
    <div class="mt-3">
        <h2>create task</h2>
        <div class="container m-2 w-100">
            <input
                type="test"
                placeholder="add item"
                class="border"
                v-model="item.name"
            />
            <button
                :class="[item.name ? 'active' : 'notactive']"
                @click="addItem()"
            >
                add +
            </button>
        </div>
    </div>
</template>
<script>
export default {
    data: function() {
        return {
            token:'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjc1MzcyNjg0LCJleHAiOjE2NzUzNzYyODQsIm5iZiI6MTY3NTM3MjY4NCwianRpIjoiOXFmQmh6cER2Z3g4NzBSMSIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.Q9eul7jp1naVOdOjJbpS_NlBiL6MTyy29K_ZVv7HjZ0',
            item: {
                name: ""
                
            }
        };
    },
    methods: {
        addItem() {
            console.log('hhhhh');
            if (this.item.name == "") {
                return;
            }
            axios
                .post("api/create-task", {
                    name: this.item,
                    user_id: '1',
          headers: {
            Authorization: "Bearer" + this.token,
            "x-access-token": this.token
          },
                            })
                .then(res => {
                    if (res.status == 201) {
                        this.item.name = "";
                        this.$emit("reloadlist");
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>

<style scoped>
.active {
    color: white;
    background-color: blue;
}
.inactive {
    color: gray;
}
</style>