@extends('admin.layouts.master');
@section('title')
    Edit News Page
@endsection


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit News Page</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Edit News</h4>

            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" action="{{ route('admin.news.update', $news->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="language-select">Language Name</label>
                        <select name="language" id="language-select" class="form-control select2">
                            <option>--Select--</option>
                            @foreach ($languages as $lang)
                                <option
                                        {{$lang->lang === $news->language ? 'selected' : ''}} value="{{ $lang->lang}}">
                                    {{ $lang->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('language')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control select2">
                            <option>--Select--</option>
                            @foreach($categories as $category)
                                <option
                                        value="{{$category->id}}" {{$category->id === $news->category_id ? 'selected' : ''}}>
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Image</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload">
                        </div>
                        @error('image')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" value="{{$news->title}}" id="title" type="text" class="form-control">
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="content"
                                  class="form-control summernote-simple">{{ $news->content }}</textarea>
                        @error('content')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tags" class="d-block">Tags</label>

                        <input id="tags" value="{{formatTags($news->tags()->pluck('name')->toArray())}}" name="tags"
                               type="text" class="form-control inputtags">
                        @error('tags')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input name="meta_title" value="{{$news->meta_title}}" id="meta_title" type="text"
                               class="form-control">
                        @error('meta_title')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea name="meta_description" id="meta_description"
                                  class="form-control">{{ $news->meta_description }}</textarea>
                        @error('meta_description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="control-label">Status</div>
                                <label for="status" class="custom-switch mt-2">
                                    <input type="checkbox" {{$news->status === 1 ? 'checked' : ''}} value="1"
                                           id="status"
                                           name="status"
                                           class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="control-label">Is Breaking News</div>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" {{$news->is_breaking_news === 1 ? 'checked' : ''}} value="1"
                                           name="is_breaking_news"
                                           class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="control-label">Show At Slider</div>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" {{$news->show_at_slider === 1 ? 'checked' : ''}} value="1"
                                           name="show_at_slider" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="control-label">Show At Popular</div>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" {{$news->show_at_popular === 1 ? 'checked' : ''}} value="1"
                                           name="show_at_popular"
                                           class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            // Load Img
            $(document).ready(function () {
                $('.image-preview').css({
                    "background-image": "url({{asset($news->image)}}",
                    "background-size": "cover",
                    "background-position": "center",
                });
            });

            // Select Category with Language
            $('#language-select').on('change', function () {
                let lang = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: '{{ route('admin.fetch-new-category') }}',
                    data: {
                        lang: lang
                    },
                    success: function (data) {
                        $('#category').html("");
                        $('#category').html(`<option value=''>---Choose Category---</option>`);

                        $.each(data, function (index, data) {
                            $('#category').append(
                                `<option value="${data.id}">${data.name}</option>`);
                        })
                    },
                    error: function (error) {
                        console.log(error);
                    }
                })
            })
        });
    </script>
@endsection
