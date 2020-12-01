<template>
    <div>
        <h4 class="m-4"><span class="font-weight-bold">Building:</span> {{building.name}}</h4>
        <hr>
        <div class="alert alert-success" role="alert" v-show="success">
            Manager edited successfully!
        </div>
        <h6>Choose managers to add:</h6>
        <form class="m-4">
            <div v-for="manager in managers">
                <input type="checkbox" name="selected[]" :value="manager.id" v-model="checkboxes">{{manager.name}}
            </div>
            <button @click.prevent="saveRelation()">Save</button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['building', 'managers', 'managers_id'],
        name: "Building-Relations-Component.vue",
        data() {
            return {
                checkboxes: [],
                success: false,
            }
        },
        created() {
            for (var i = 0; i < this.managers_id.length; i++) {
                this.checkboxes[i] = this.managers_id[i];
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
                axios.post('/buildings/saveRelations/' + this.building.id, input).then(function (response) {
                    if (response.status === 200) _this.success = true;
                }).catch(error => {
                    console.log("Error = " + error);
                    _this.success = false;
                });
            }
        }
    }
</script>
