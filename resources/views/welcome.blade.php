<x-layout>

    <table class="table table-bordered table-hover">
        <caption class="text-right margin-right-md">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <a href="/add" class="btn btn-info">Add new point</a>
        </caption>

        <thead>
            <tr>
                <th>Name</th>
                <th data-priority="1">X</th>
                <th data-priority="2">Y</th>
                <th data-priority="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (! count($points))
                <div class="alert alert-danger">
                    No resutls were found.
                </div>
            @endif
            @foreach ($points as $point)
                <tr>
                    <td>{{ $point->name }}</td>
                    <td>{{ $point->x }}</td>
                    <td>{{ $point->y }}</td>
                    <td>
                        <a href="/edit/{{ $point->id }}" class="btn btn-primary">edit</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
            <td colspan="4" class="text-center">Data retrieved from localhost.</td>
            </tr>
        </tfoot>
    </table>


</x-layout>
