@extends('admin.layouts.master')
@section('title')
    Language Page
@endsection
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Languages Setting</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>All Language</h4>
                <div class="card-header-action">
                    <a href="{{route('admin.language.create')}}" class="btn btn-primary">
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

                        @foreach($languages as $key=> $language)

                            <tr>

                                <td>
                                    {{$key + 1}}
                                </td>
                                <td>
                                    {{$language->name}}
                                </td>
                                <td>
                                    {{$language->lang}}
                                </td>
                                <td>
                                    @if($language->default == 1)
                                        <span class="badge badge-success">Default</span>
                                    @else
                                        <span class="badge badge-warning">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if($language->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Not Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('admin.language.edit',$language->id)}}"> <i
                                            class="fas fa-edit" style="font-size:15px"></i></a>
                                    <a class="btn btn-danger delete-item"
                                       href="{{route('admin.language.destroy',$language->id)}}"><i
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
