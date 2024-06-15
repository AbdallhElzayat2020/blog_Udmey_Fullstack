@extends('admin.layouts.master');
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
                <p>Write something here</p>
            </div>
        </div>
    </section>

@endsection
