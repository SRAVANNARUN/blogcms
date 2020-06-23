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
                    <form  action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" >
                          @csrf
                            <div class="form-group mb-4">
                                <label for="title">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"  >
                            </div>
                            <div for="email" class="form-group mb-4">
                                <label for="email">EMAIL</label>
                                
                                <input id="email" type="email" class="form-control " name="email"   autocomplete="email" placeholder="Email">


                            </div>
                            <div  class="form-group mb-4">
                                <div class="d-flex justify-content-between">
                                    <label for="password">NEW PASSWORD</label>
                                   
                                </div>
                                
                                <input id="password" type="password" class="form-control " name="password"  autocomplete="password" placeholder="Password" >

                                
                                
                            </div>
                            <div class="form-group mb-4">
                                <div class="custom-file-container" data-upload-id="image">
                                    <label>Profile photo <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file" >
                                        <input type="file" name='photo' class="custom-file-container__custom-file__custom-file-input"  accept='image/*' >
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                            </div>
                          
                            
                            
                          <button type="submit" class="btn btn-primary mt-1">Save</button>
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