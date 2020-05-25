@extends('layouts.admin_layout')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Lists of Posts</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                @if (count($posts)>0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped mb-4">
                      <caption>All posts: {{ count($posts) }}</caption>
                      <thead>
                            <tr>
                                <th class="text-center">Image</th>
                                <th>Title</th>
                                <th>Created at</th>
                                <th class="text-center" style="width: 20%" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                @foreach ($posts as $post )
                                    <tr>
                                        <td><img src="{{ $post->image }}" class="rounded" alt="{{ $post->title }}" width="70px" height="70px"></td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td class="text-center"><a href="{{ route('post.edit', $post) }}" class="btn btn-info btn-sm" >Edit</a></td>
                                        <td class="text-center">
                                            <form action="{{ route('post.destroy',$post) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm">Delele</button>
                                            </form>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            
                            
                        </tbody>
                    </table>
                </div>
                @else
                    <h3 class="text-center">No posts yet!</h3>
                @endif
                    
            </div>
        </div>
    </div>  
</div>
@endsection