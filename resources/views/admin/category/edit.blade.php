@extends('admin.layouts.master');
@section('title')
    Update Category Page
@endsection
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Update Category Page</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Update Category</h4>
            </div>
            <div class="card-body">
                <form action="{{route('admin.category.update', $category->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="language-select">Language Name</label>
                        <select name="language" id="language-select" class="form-control select2">
                            <option>--Select--</option>
                            @foreach($languages as $lang)
                                <option {{$lang->lang === $category->language ? 'selected':''}} value="{{$lang->lang}}">
                                    {{$lang->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('lang')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" value="{{$category->name}}" id="name" type="text" class="form-control">
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="show_at_navbar">Show At Navbar</label>
                        <select name="show_at_navbar" id="show_at_navbar" class="form-control">
                            <option {{$category->show_at_navbar === 0 ?'selected' : ''}} value="0">No</option>
                            <option {{$category->show_at_navbar === 1 ?'selected' : ''}} value="1">Yes</option>
                        </select>
                        @error('show_at_navbar')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option {{$category->status === 0 ?'selected' : ''}} value="0">In Active</option>
                            <option {{$category->status === 1 ?'selected' : ''}} value="1">Active</option>
                        </select>
                        @error('status')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div>
        </div>
    </section>

@endsection

{{--@section('js')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#language-select').on('change', function () {--}}
{{--                let value = $(this).val();--}}
{{--                let name = $(this).children(':selected').text();--}}
{{--                $('#slug').val(value);--}}
{{--                $('#name').val(name);--}}
{{--            })--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
