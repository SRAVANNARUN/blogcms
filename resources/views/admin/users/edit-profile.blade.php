@extends('layouts.admin_layout')

@section('content')
    @section('page-title')
        {{-- <h3>Create new post</h3> --}}
    @endsection


    @section('content')
    @include('admin.includes.errors')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">                                
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>My profile</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form  action="{{ route('users.update',Auth::user())}}" method="POST" enctype="multipart/form-data" >
                          @csrf
                          @method('PUT')
                            <div class="form-group mb-4">
                                <label for="title">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $user->name }}" >
                            </div>
                            <div for="email" class="form-group mb-4">
                                <label for="email">EMAIL</label>
                                
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div id="password-field" class="form-group mb-4">
                                <div class="d-flex justify-content-between">
                                    <label for="password">NEW PASSWORD</label>
                                   
                                </div>
                                
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="Password" >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                            <div class="form-group mb-4">
                                <div class="custom-file-container" data-upload-id="image">
                                    <label>Profile picture <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file" >
                                        <input type="file" name='image' class="custom-file-container__custom-file__custom-file-input"  accept='image/*' >
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="content">About</label>
                                <textarea class="form-control" name="content" id="" cols="30" rows="10" placeholder="About" >{{ $user->profile->about }}</textarea>
                            </div>
                            
                            
                          <button type="submit" class="btn btn-primary mt-1">Update</button>
                        </form>
                </div>
            </div>
        </div>  
    </div> 
    @endsection
@endsection
@section('scripts')
    <script src="{{ asset('plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script>
        var secondUpload = new FileUploadWithPreview('image')
        $(".tagging").select2({
            tags: true,
            maximumSelectionLength: 5
        });
    </script>
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
@endsection