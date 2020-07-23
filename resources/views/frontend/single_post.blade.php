@extends('layouts.frontend_layout')
@section('styles')
<style>
    .card {
        /* box-shadow: 4px 6px 10px -3px #bfc9d4; */
        border-radius: 4px;
        border: 2px solid #e0e6ed;

    }
</style>
@endsection
@section('content')
<div class="col-xl-4 col-lg-4 col-md-4 col-12 layout-spacing">
    <div class="card ">
        <img src="{{asset('storage').'/'.$post->image}}" class="card-img-top" alt="No Image Found">
    </div>
</div>
<div class="col-xl-8 col-lg-8 col-md-8 col-12 layout-spacing">
    
    {{-- <div class="card"> --}}
    <div class="card-body">
        <h5>Product Information</h5>
        <p>{!! $post->product_detail !!}</p>
    </div>
    {{-- </div> --}}


</div>

@endsection