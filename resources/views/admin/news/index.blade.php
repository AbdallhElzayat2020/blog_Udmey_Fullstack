@extends('admin.layouts.master')
@section('title')
    News Page
@endsection
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>News Setting</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>All News</h4>
                <div class="card-header-action">
                    <a href="{{route('admin.news.create')}}" class="btn btn-primary">
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
                            $news=\App\Models\News::with('category')
                            ->where('language',$language->lang)
                            ->orderBy('id','DESC')->get();
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
                                            <th class="text-center">#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>In Breaking</th>
                                            <th>In Slider</th>
                                            <th>In Popular</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($news as $key=> $item)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>
                                                    <img width="100" height="50" src="{{asset($item->image)}}" alt="">
                                                </td>
                                                <td>{{$item->title}}</td>
                                                <td>{{$item->category->name }}</td>
                                                <td>
                                                    <label class="custom-switch mt-2">
                                                        <input {{$item->is_breaking_news === 1 ? 'checked' : ''}}
                                                               type="checkbox" value="1"
                                                               data-id="{{$item->id}}"
                                                               data-name="is_breaking_news"
                                                               name="is_breaking_news"
                                                               class="custom-switch-input toggle-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="custom-switch mt-2">
                                                        <input {{$item->show_at_slider === 1 ? 'checked' : ''}}
                                                               type="checkbox" value="1"
                                                               data-id="{{$item->id}}"
                                                               data-name="show_at_slider"
                                                               name="show_at_slider"
                                                               class="custom-switch-input toggle-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="custom-switch mt-2">
                                                        <input {{$item->show_at_popular === 1 ? 'checked' : ''}}
                                                               type="checkbox" value="1"
                                                               data-id="{{$item->id}}"
                                                               data-name="show_at_popular"
                                                               name="show_at_popular"
                                                               class="custom-switch-input toggle-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="custom-switch mt-2">
                                                        <input {{$item->status === 1 ? 'checked' : ''}}
                                                               type="checkbox" value="1"
                                                               data-id="{{$item->id}}"
                                                               data-name="status"
                                                               name="status"
                                                               class="custom-switch-input toggle-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary"
                                                       href="{{route('admin.news.edit',$item->id)}}">
                                                        <i class="fas fa-edit" style="font-size:15px"></i></a>
                                                    <a class="btn btn-danger delete-item"
                                                       href="{{route('admin.news.destroy',$item->id)}}">
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
                ],
                "order": [[0, 'desc']]
            });
        });
        @endforeach


        $(document).ready(function () {
            $('.toggle-status').on('click', function () {
                let id = $(this).data('id');
                let url = "{{route('admin.toggle-news-status')}}";
                let name = $(this).data('name');
                let status = $(this).prop('checked') === true ? 1 : 0;
                // alert(status);
                $.ajax({
                    method: "GET",
                    url: url,
                    data: {
                        'id': id,
                        'name': name,
                        'status': status
                    },
                    success: function (data) {
                        if (data.status === 'success') {
                            Toast.fire({
                                icon: "success",
                                title: "Updated successfully"
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            });
        });

    </script>
@endsection
