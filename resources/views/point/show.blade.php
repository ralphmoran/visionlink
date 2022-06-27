<x-layout>

    <x-slot:title>
        Edit point #{{ $point->id }}
    </x-slot>


    <form action="/update/{{ $point->id }}" method="post" ref="point_form">
        @csrf
        <table class="table table-bordered table-hover">
            <caption class="text-right">
                <a href="/" class="">Home</a>
                <a href="/add" class="btn btn-info">Add new point</a>
            </caption>

            <thead>
                <tr>
                    <th colspan="2"> Edit point #{{ $point->id }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><label for="name">Name:</label></td>
                    <td><input
                            value="{{ $point->name }}"
                            @input="upperCase"
                            type="text"
                            name="name"
                            id="name"
                            required
                            placeholder="Add the new point name..."
                            pattern="[A-Za-z]+"
                        />
                    </td>
                </tr>
                <tr>
                    <td><label for="x">X:</label></td>
                    <td><input
                            value="{{ $point->x }}"
                            @input="getPointSiblings"
                            ref="point_x"
                            type="text"
                            name="x"
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
                            value="{{ $point->y }}"
                            @input="getPointSiblings"
                            ref="point_y"
                            type="text"
                            name="y"
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
                <td colspan="2" class="text-right">
                    <input name="update_btn" class="btn btn-success" type="submit" value="Update">
                    <input name="delete_btn" class="btn btn-danger" type="submit" @click="submitDelete" value="Delete">
                </td>
                </tr>
            </tfoot>
            <tfoot>
                <tr>
                <td colspan="4" class="text-center">Data retrieved from localhost.</td>
                </tr>
            </tfoot>
        </table>
    </form>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Nearest point(s) at distance {{ $point->name }}({{ $point->x }}, {{ $point->y }})</th>
            </tr>
        </thead>
        <tbody v-html="nearest"></tbody>
    </table>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Farthest point(s) at distance {{ $point->name }}({{ $point->x }}, {{ $point->y }})</th>
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
                }
            },
            mounted: function () {
                this.getPointSiblings();
            },
            methods: {
                upperCase: function(e) {
                    e.target.value = e.target.value.toUpperCase()
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
                                id: "{{ $point->id }}",
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
