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
                            <h4> Create new post</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form  action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" >
                          @csrf
                            <div class="form-group mb-4">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" ">
                            </div>
                            <div class="form-group mb-4">
                                <div class="custom-file-container" data-upload-id="image">
                                    <label>Select image <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file" >
                                        <input type="file" name='image' class="custom-file-container__custom-file__custom-file-input"  accept='image/*' >
                                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="category">Please select a category</label>
                                <select class="form-control  basic" name="category_id" id="category">
                                    @foreach ($categories as $category )
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="category">Please select or type new tags</label>
                                <select name="tags[]" class=" form-control tagging" multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{$tag->name}}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="content">Content</label>
                                <textarea name="content" class="editor"></textarea>
                            </div>
                          <button type="submit" class="btn btn-primary mt-1">Save</button>
                        </form>
                </div>
            </div>
        </div>  
    </div> 
    @endsection
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('ckeditor5/sample/styles.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('ckeditor5/build/ckeditor.js') }}">
    </script><script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    
    <script>
        var secondUpload = new FileUploadWithPreview('image')
        $(".tagging").select2({
            tags: true,
            maximumInputLength: 5
        });   
     
        ClassicEditor
			.create( document.querySelector( '.editor' ), {
				ckfinder: {
			        uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                },
                fontFamily: {
                 options: [
                    'default',
                    'Ubuntu, Arial, sans-serif',
                    'Ubuntu Mono, Courier New, Courier, monospace',
                    'Khmer Os',
                    'Khmer Os Muol Light',
                    'Khmer OS Metal Chrieng',
                    'BAUHS93',
                    'TACTENG'
                 ]
                 },
				toolbar: {
					items: [
						'heading',
						'|',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'indent',
						'outdent',
						'|',
						'imageUpload',
						
						'blockQuote',
						'insertTable',
						'mediaEmbed',
						'undo',
						'redo',
						'alignment',
						'fontBackgroundColor',
						'fontColor',
						'underline',
						'strikethrough',
						'fontSize',
						'fontFamily',
						'highlight',
						'horizontalLine',
						'subscript',
						'superscript',
						'specialCharacters',
						'exportPdf'
					]
				},
				language: 'km',
				image: {
					toolbar: [
						'imageTextAlternative',
						'imageStyle:full',
						'imageStyle:side'
					]
				},
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells',
						'tableCellProperties',
						'tableProperties'
					]
				},
				licenseKey: '',
				
			} )
			.then( editor => {
				window.editor = editor;
		
				
				
				
			} )
			.catch( error => {
				console.error( 'Oops, something gone wrong!' );
				console.error( 'Please, report the following error in the https://github.com/ckeditor/ckeditor5 with the build id and the error stack trace:' );
				console.warn( 'Build id: jgni85lvuwhe-yp83hqk49slc' );
				console.error( error );
			} );
    </script>
    

@endsection
