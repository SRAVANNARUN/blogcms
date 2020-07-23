@extends('layouts.frontend_layout')
@section('styles')
<style>
    .card {
        box-shadow: 4px 6px 10px -3px #bfc9d4;
        border-radius: 6px;
        border: 0px solid #e0e6ed;

    }

    .card:hover {

        box-shadow: 4px 6px 10px -3px black;
    }
</style>
@endsection
@section('content')

@if ($posts->count()==0)

<div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
    <h5 class="text-center">No Product Found!</h5>
</div>
@endif
@foreach ($posts as $post)
<div class="col-xl-2 col-lg-3 col-md-4 col-6 layout-spacing ">
    <a lass="card-block stretched-link text-decoration-none " href="{{ route('products.details', ['slug'=>$post->slug]) }}">
        <div class="card ">
            <img src="{{asset('storage').'/'.$post->image}}" height="185px" class="card-img-top" alt="No Image Found">

            <div class="card-body text-center">
                <h5 class="card-title">USD {{ $post->price }}</h5>
                <p class="card-text">{{ $post->product_name }}</p>
            </div>
        </div>
    </a>
</div>

@endforeach
<div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>

@endsection
