@extends('layouts.admin_layout')



@section('content')
@include('admin.includes.errors')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Update tag: {{ $tag->name }}</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area" >
                <form  action="{{ route('tags.update',$tag) }}" method="POST"  >
                      @csrf
                      @method('PUT')
                        <div class="form-group mb-4">
                            <label for="name">Tag</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $tag->name }}" placeholder="Tag name" >
                        </div>
                    
                      <button type="submit" class="btn btn-primary mt-1">Save</button>
                </form>
            </div>
        </div>
    </div>  
</div> 
@endsection