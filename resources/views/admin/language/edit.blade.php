@extends('admin.layouts.master');
@section('title')
    Edit Language Page
@endsection
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Edit Language</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Card Header</h4>
            </div>
            <div class="card-body">
                <form action="{{route('admin.language.update',$language->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="language-select">Language Name</label>
                        <select name="lang" id="language-select" class="form-control select2">
                            <option>--Select--</option>
                            @foreach(config('language') as $key => $lang)
                                <option
                                    @if($language->lang === $key)
                                        selected
                                    @endif
                                    value="{{$key}}">{{$lang['name']}}</option>
                            @endforeach
                        </select>
                        @error('lang')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" value="{{$language->name}}" readonly id="name" type="text"
                               class="form-control">
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input name="slug" value="{{$language->slug}}" readonly id="slug" type="text"
                               class="form-control">
                        @error('slug')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option {{$language->status === 1 ? 'active': ''}} value="1">Active</option>
                            <option {{$language->status === 0 ? 'Not active': ''}} value="0">In Active</option>
                        </select>
                        @error('status')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="default">Is It Default?</label>
                        <select name="default" id="default" class="form-control">
                            <option {{$language->default === 1 ? 'default' : ''}} value="1">Yes</option>
                            <option {{$language->default === 0 ? 'default' : ''}} value="0">No</option>
                        </select>
                        @error('default')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
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
            $('#language-select').on('change', function () {
                let value = $(this).val();
                let name = $(this).children(':selected').text();
                $('#slug').val(value);
                $('#name').val(name);
            })
        });
    </script>
@endsection
