@extends('layout')
@section('title','Task')
@section('content')

<div class="card">
     @include('nav') 
    <div class="row mx-5 my-4">
         <div class="col-12"> 
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control " placeholder="Search...">
                <div class="input-group-append"><span class="input-group-text"><i>Search</i></span></div>
            </div>
        </div>
    </div> 
    <div class="card-header">Report</div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Total Hours</th>
            </tr>
            </thead>
            <tbody id="tableBody">
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        function loadData(searchValue = '') {
            $.ajax({
                url: '{{ route("search") }}',
                method: 'GET',
                data: { search: searchValue },
                success: function (data) {
                    updateTable(data);
                },
                error: function (error) {
                    let data = [];
                    updateTable(data);
                }
            });
        };
        loadData();

        $('#searchInput').on('input', function () {
            var searchValue = $(this).val();
            loadData(searchValue);
        });

        function updateTable(data) {
            var tableBody = $('#tableBody');
            tableBody.empty();
            if (data.length !== 0) {
                var i = 1;
                $.each(data, function (key, project) {
                    tableBody.append('<tr><td>' + i + '</td><th>' + project.name + '</th><th>' + project.time + '</th></tr>');
                    $.each(project.tasks, function (key, task) {
                        tableBody.append('<tr><td></td><td>' + task.name + '</td><td>' + task.time + '</td></tr>');

                    })
                    i++;
                });
            } else {
                tableBody.append('<tr class="text-center"><td colspan="3">Empty</td></tr>');
            }
        }
    });
</script>

@endsection