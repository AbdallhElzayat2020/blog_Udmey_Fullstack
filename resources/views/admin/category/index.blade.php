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
                <h4>All Categories</h4>
                <div class="card-header-action">
                    <a href="{{route('admin.category.create')}}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create New
                    </a>
                </div>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    @foreach($languages as $key=> $language)
                        <li class="nav-item">
                            <a class="nav-link {{$loop->index===0?'active':''}}" id="home-tab2" data-toggle="tab"
                               href="#home-{{$language->lang}}"
                               role="tab" aria-controls="home" aria-selected="true">{{$language->name}}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content tab-bordered" id="myTab3Content">
                    @foreach($languages as $language)
                        @php
                            $categories=\App\Models\Category::where('language',$language->lang)->orderByDesc('id')->get();
                        @endphp
                        <div class="tab-pane fade show {{$loop->index === 0 ? 'active' : ''}}"
                             id="home-{{$language->lang}}"
                             role="tabpanel"
                             aria-labelledby="home-tab2">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-{{$language->lang}}">
                                        <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Name</th>
                                            <th>Language</th>
                                            <th>In Nav</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $key=> $category)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$category->name}}</td>
                                                <td>{{$category->language}}</td>
                                                <td>
                                                    @if($category->show_at_navbar ===1)
                                                        <span class="badge badge-success ">Yes</span>
                                                    @else
                                                        <span class="badge badge-danger ">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($category->status === 1)
                                                        <span class="badge badge-success ">Yes</span>
                                                    @else
                                                        <span class="badge badge-danger ">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary"
                                                       href="{{route('admin.category.edit',$category->id)}}">
                                                        <i class="fas fa-edit" style="font-size:15px"></i></a>
                                                    <a class="btn btn-danger delete-item"
                                                       href="{{route('admin.category.destroy',$category->id)}}">
                                                        <i class="fas fa-trash" style="font-size:15px"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
0/
                </div>
            </div>


        </div>
    </section>

@endsection
@section('js')
    <script>
        @foreach($languages as $language)
        $(document).ready(function () {
            $("#table-{{$language->lang}}").DataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [2, 3]}
                ]
            });
        });
        @endforeach

    </script>
@endsection
