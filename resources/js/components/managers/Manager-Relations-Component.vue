<template>
    <div>
        <h4 class="m-4"><span class="font-weight-bold">Manager:</span> {{manager.name}}</h4>
        <hr>
        <div class="alert alert-success" role="alert" v-show="success">
            Buildings edited successfully!
        </div>
        <h6>Choose buildings to manage:</h6>
        <form class="m-4">

            <div v-for="building in buildings">
                <input type="checkbox" name="selected[]" :value="building.id" v-model="checkboxes">{{building.name}}
            </div>
            <button @click.prevent="saveRelation()">Save</button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['manager', 'buildings', 'buildings_id'],
        name: "Manager-Relations-Component.vue",
        data() {
            return {
                checkboxes: [],
                success: false,
            }
        },
        created() {
            for (var i = 0; i < this.buildings_id.length; i++) {
                this.checkboxes[i] = this.buildings_id[i];
            }
        },
        methods: {
            saveRelation() {
                var input = {
                    body: [],
                };
                var _this = this;
                this.success = false;
                input['body'] = this.checkboxes;
                axios.post('/managers/saveRelations/' + this.manager.id, input).then(function (response) {
                    if (response.status === 200) _this.success = true;
                }).catch(error => {
                    console.log("Error = " + error);
                    _this.success = false;
                });
            }
        }
    }
</script>
