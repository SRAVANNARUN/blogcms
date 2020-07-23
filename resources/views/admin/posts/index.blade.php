@extends('layouts.admin_layout')
@section('style')
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('assets/css/elements/search.css') }}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
@endsection
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">

                <div class="row ml-0">
                    <h4>Lists of Posts</h4>
                     
                </div>
                
            </div> 
            <div class="widget-content widget-content-area">
                <form >
                    <div class="form-row ">
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Search...">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-lg">Search</button>
                        </div>
                    </div>
                    
                </form> 
                @if (count($posts)>0)
                <br>
                <div class="table-responsive">
                    <table class="table  table-hover  mb-4">
                        {{-- <caption>All posts: {{ $posts->count()}}</caption> --}}
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Published Date</>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($posts as $post )
                            <tr>
                                <td><img class="rounded" width="70" height="70"
                                        src="{{asset('storage').'/'.$post->image}}" alt=""></td>
                                <td>{{ $post->product_name }}</td>
                                <td>USD {{ $post->price }}</td>
                                <td>{{ $post->created_at }}</>
                                    {{-- <td class="text-center"><a href="{{ route('posts.edit', $post) }}" class="btn
                                    btn-info btn-sm" >Edit</a></td>
                                <td class="text-center">
                                    <a href="{{ route('posts.trash', $post) }}" class="btn btn-danger btn-sm">Trash</a>
                                </td> --}}
                                <td class="text-center">

                                    <div class="dropdown custom-dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-more-horizontal">
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="19" cy="12" r="1"></circle>
                                                <circle cx="5" cy="12" r="1"></circle>
                                            </svg>
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">

                                            <a class="dropdown-item" href="{{ route('posts.edit', $post) }} ">Edit</a>
                                            <a class="dropdown-item" href="{{ route('posts.trash', $post) }}">Trash</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                            @endforeach


                        </tbody>
                    </table>
                    <br>
                </div>
                @else
                <h3 class="text-center">No posts yet!</h3>
                @endif
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                    <div class="d-flex justify-content-center ">
                        {{ $posts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
