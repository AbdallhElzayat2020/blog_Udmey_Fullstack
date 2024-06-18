@extends('admin.layouts.master');
@section('title')
    Create News Page
@endsection
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Create News Page</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Create News</h4>

            </div>
            <div class="card-body">
                <form action="{{route('admin.category.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="language-select">Language Name</label>
                        <select name="language" id="language-select" class="form-control select2">
                            <option>--Select--</option>
                            @foreach($languages as $lang)
                                <option value="{{$lang->lang}}">{{$lang->name}}</option>
                            @endforeach
                        </select>
                        @error('lang')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option>--Select--</option>
                            <option value=""></option>
                        </select>
                        @error('status')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" id="title" type="text" class="form-control">
                        @error('title')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Image</label>
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload">
                        </div>
                        @error('image')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" class="summernote"></textarea>
                        @error('content')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input name="meta_title" id="meta_title" type="text" class="form-control">
                        @error('meta_title')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" type="text"
                                  class="form-control"></textarea>
                        @error('meta_description')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="control-label">Status</div>
                                <label for="status" class="custom-switch mt-2">
                                    <input type="checkbox" id="status" name="is_breaking_news"
                                           class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="control-label">Is Breaking News</div>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="is_breaking_news" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="control-label">Show At Slider</div>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="show_at_slider" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="control-label">Show At Popular</div>
                                <label class="custom-switch mt-2">
                                    <input type="checkbox" name="show_at_popular" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <button class="btn btn-primary" type="submit">Create</button>
                </form>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#language-select').on('change', function () {
                $.ajax({

                })
            })
        });
    </script>
@endsection
