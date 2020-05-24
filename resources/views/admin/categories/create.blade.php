@extends('layouts.admin_layout')

@section('errors')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        @if (count($errors)>0)
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button> {{ $error }} 
        </div>
        @endforeach
    @endif
    </div>
</div>

@endsection

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Create new category</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area" >
                <form  action="{{ route('category.store') }}" method="POST"  >
                      @csrf
                        <div class="form-group mb-4">
                            <label for="name">Category</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Category name" >
                        </div>
                    
                      <button type="submit" class="btn btn-primary mt-1">Save</button>
                </form>
            </div>
        </div>
    </div>  
</div> 
@endsection