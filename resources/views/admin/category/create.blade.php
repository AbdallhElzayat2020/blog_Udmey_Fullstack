@extends('admin.layouts.master');
@section('title')
    Create Category Page
@endsection
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Create Category Page</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Create Category</h4>

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
                        <label for="name">Name</label>
                        <input name="name" id="name" type="text" class="form-control">
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="show_at_navbar">Show At Navbar</label>
                        <select name="show_at_navbar" id="show_at_navbar" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('show_at_navbar')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">In Active</option>
                        </select>
                        @error('status')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <button class="btn btn-primary" type="submit">Create</button>
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
