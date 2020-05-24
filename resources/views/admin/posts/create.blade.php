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
                            <h4>Create new post</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form  action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data" >
                          @csrf
                            <div class="form-group mb-4">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" >
                            </div>
                            <div class="form-group mb-4">
                                <div class="custom-file-container" data-upload-id="image">
                                    <label>Image upload (Allow Multiple) <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file" >
                                        <input type="file" name='image' class="custom-file-container__custom-file__custom-file-input"  accept='image/*' >
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="content">Content</label>
                                <textarea class="form-control" name="content" id="" cols="30" rows="10" placeholder="Content" ></textarea>
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
    <script>
        var secondUpload = new FileUploadWithPreview('image')
    </script>
@endsection