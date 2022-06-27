<x-layout>
    <x-slot:title>
        Add new point
    </x-slot>

    <form action="/store" method="post">
        @csrf
        <table class="table table-bordered table-hover">
            <caption class="text-right">
                <a href="/" class="">Home</a>
            </caption>

            <thead>
                <tr>
                    <th colspan="2">Add new point</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="name">Name:</label></td>
                    <td><input
                            type="text"
                            @input="upperCase"
                            name="name"
                            v-model="new_point.name"
                            id="name"
                            required
                            placeholder="Add the new point name..."
                            pattern="[A-Za-z0-9]+"
                        />
                    </td>
                </tr>
                <tr>
                    <td><label for="x">X:</label></td>
                    <td><input
                            type="text"
                            name="x"
                            @input="getPointSiblings"
                            v-model="new_point.x"
                            ref="point_x"
                            id="x"
                            required
                            placeholder="X position"
                            pattern="[0-9]{1,}"
                        />
                    </td>
                </tr>
                <tr>
                    <td><label for="y">Y:</label></td>
                    <td><input
                            type="text"
                            name="y"
                            @input="getPointSiblings"
                            v-model="new_point.y"
                            ref="point_y"
                            id="y"
                            required
                            placeholder="Y position"
                            pattern="[0-9]{1,}"
                        />
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                <td colspan="2" class="text-right"><input class="btn btn-success" type="submit" value="Add"></td>
                </tr>
            </tfoot>
        </table>
    </form>

    <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Nearest point(s) at distance @{{ new_point.name }}(@{{ new_point.x }}, @{{ new_point.y }})</th>
            </tr>
        </thead>
        <tbody v-html="nearest"></tbody>
    </table>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Farthest point(s) at distance @{{ new_point.name }}(@{{ new_point.x }}, @{{ new_point.y }})</th>
            </tr>
        </thead>
        <tbody v-html="farthest"></tbody>
    </table>

    <!-- Vue instance -->
    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    nearest: null,
                    farthest: null,
                    new_point: {
                        name: '',
                        x: 0,
                        y: 0
                    },
                }
            },
            mounted: function () {
                this.getPointSiblings();
            },
            methods: {
                upperCase: function(e) {
                    this.new_point.name = e.target.value = e.target.value.toUpperCase()
                },
                getPointSiblings: function() {

                    var app = this;
                    var point_x = app.$refs.point_x.value;
                    var point_y = app.$refs.point_y.value;

                    fetch("/siblings/", {
                        method: 'POST',
                        headers: {
                            "Content-Type" : "application/json",
                            "accept" : "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                                id: 0,
                                px: point_x,
                                py: point_y
                        })
                    })
                        .then(response => response.json())
                        .then(function(data) {
                            app.nearest = data.nearest;
                            app.farthest = data.farthest;
                        });
                },
                submitDelete: function(e) {
                    // if (confirm()) {

                    // }
                    console.log(e.targe.value);
                    e.stopPropagation();
                    e.preventDefault();
                }
            }
        }).mount('#app');
    </script>

</x-layout>
