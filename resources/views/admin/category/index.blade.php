@extends('admin.layouts.master')
@section('title')
    Categories Page
@endsection
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Categories Setting</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>All Language</h4>
                <div class="card-header-action">
                    <a href="" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create New
                    </a>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                        <tr>
                            <th class="text-center">
                                ID
                            </th>
                            <th>Language Name</th>
                            <th>Language Code</th>
                            <th>Default</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>


                        <tr>

                            <td>
                            </td>
                            <td>
                            </td>
                            <td>
                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <a class="btn btn-primary" href=""> <i
                                        class="fas fa-edit" style="font-size:15px"></i></a>
                                <a class="btn btn-danger delete-item"
                                   href=""><i
                                        class="fas fa-trash" style="font-size:15px"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#table-1").DataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [2, 3]}
                ]
            });
        });
    </script>
@endsection
