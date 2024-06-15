@extends('admin.layouts.master');
@section('title')
    Create Language Page
@endsection
@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Create Language</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Card Header</h4>

            </div>
            <div class="card-body">
                <form action="">
                    <div class="form-group">
                        <label for="language">Language Name</label>
                        <input required id="language" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="language">Slug</label>
                        <input readonly id="language" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="language">Status</label>
                        <input required id="language" type="text" class="form-control">
                    </div>

                </form>
            </div>
        </div>
    </section>

@endsection
