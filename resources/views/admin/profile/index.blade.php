@extends('admin.layouts.master')
@section('title')
    Profile Page
@endsection
@section('css')
@endsection


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{__('admin.Profile')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">{{__('admin.Dashboard')}}</a></div>
                <div class="breadcrumb-item">{{__('admin.Profile')}}</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, {{$user->name}}</h2>
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">
                        <form method="post"
                              action="{{route('admin.profile.update',auth()->guard('admin')->user()->id)}}"
                              novalidate=""
                              enctype="multipart/form-data"
                              class="needs-validation">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>{{__('admin.Edit Profile')}}</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group col-md-12 col-12">
                                    <div id="image-preview" class="image-preview mb-3 ">
                                        <label for="image-upload" id="image-label">{{__('admin.Choose File')}}</label>
                                        <input type="file" name="image" id="image-upload"/>
                                        <input type="hidden" name="old_image" value="{{$user->image}}"/>
                                    </div>
                                    @error('image')
                                    <b class="text-danger  ">{{$message}}</b>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>{{__('admin.First Name')}}</label>
                                    <input type="text" class="form-control" name="name" value="{{$user->name}}"
                                           required="">
                                    @error('name')
                                    <b class="text-danger  ">{{$message}}</b>
                                    @enderror
                                    <div class="invalid-feedback">
                                        {{__('admin.Please fill in the First Name field')}}
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>{{__('admin.Email')}}</label>
                                    <input type="email" class="form-control" value="{{$user->email}}" name="email"
                                           required="">
                                    @error('email')
                                    <b class="text-danger  ">{{$message}}</b>
                                    @enderror
                                    <div class="invalid-feedback">
                                        {{__('admin.Please fill in the email')}}
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button class="btn btn-primary">{{__('admin.Save Changes')}}</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">

                        <form method="post" action="{{route('admin.profile-password.update',$user->id)}}"
                              class="needs-validation"
                              novalidate="">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>{{__('admin.Change Password')}}</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group col-md-12 col-12">
                                    <label>{{__('admin.Old Password')}}</label>
                                    <input type="password" placeholder="{{__('admin.Old Password')}}"
                                           name="current_password"
                                           class="form-control"
                                           required="">
                                    @error('current_password')
                                    <b class="text-danger  ">{{$message}}</b>
                                    @enderror
                                    <div class="invalid-feedback">
                                        {{__('admin.please fill in your password')}}
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-12">
                                    <label>{{__('admin.New Password')}}</label>
                                    <input type="password" class="form-control"
                                           name="password" placeholder="{{__('admin.Password')}}"
                                           required="">
                                    @error('password')
                                    <b class="text-danger  ">{{$message}}</b>
                                    @enderror
                                    <div class="invalid-feedback">
                                        {{__('admin.please fill in your New password')}}
                                    </div>
                                </div>

                                <div class="form-group col-md-12 col-12">
                                    <label>{{__('admin.Password Confirmation')}}</label>
                                    <input type="password" class="form-control"
                                           name="password_confirmation"
                                           placeholder="{{__('admin.Password Confirmation')}}"
                                           required="">
                                    @error('password_confirmation')
                                    <b class="text-danger">{{$message}}</b>
                                    @enderror
                                    <div class="invalid-feedback">
                                        {{__('admin.Please fill in your password confirmation')}}
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button class="btn btn-primary">{{__('admin.Save Changes')}}</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>


        </div>
    </section>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.image-preview').css({
                "background-image": "url({{asset($user->image)}}",
                "background-size": "cover",
                "background-position": "center",
            });
        });
    </script>
@endsection

