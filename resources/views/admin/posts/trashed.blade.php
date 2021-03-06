@extends('layouts.admin_layout')



@section('content')




<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">


        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Lists of trahsed posts</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                @if (count($posts)>0)
                <br>
                <div class="table-responsive">
                    <table class="table  table-hover  mb-4">
                      <caption>All posts: {{ count($posts) }}</caption>
                      <thead>
                            <tr>
                                <th >Image</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                @foreach ($posts as $post )
                                    <tr>
                                        <td><img class="rounded" width="70" height="70" src="{{asset('storage').'/'.$post->image}}" alt=""></td>
                                        <td>{{ $post->product_name }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td class="text-center">
                    
                                            <div class="dropdown custom-dropdown">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                </a>
                        
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                    <a class="dropdown-item" href="{{ route('posts.restore', ['id'=>$post->id] )}}">Restore</a>
                                                    <button  class="dropdown-item" onclick="handleDelete({{ $post }})">Delete</button>
                                                    {{-- <form action="{{ route('posts.destroy',$post) }}" method="POST">
                                                        @csrf
                                                        @method('Delete')
                                                        <button type="submit" class="dropdown-item">Delete</button>
                                                    </form> --}}
                                                      
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
                    <h3 class="text-center">Trash is empty!</h3>
                @endif
                    
            </div>
        </div>
    </div>  
</div>
<form action="" method="POST" id="deleteForm">
    @method('Delete')
    @csrf
    
    <div class="modal animated zoomInUp" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="DeleteModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="DeleteModelLabel">Delete Post</h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this post?
                </div>
                <div class="modal-footer justify-content-between border-0">
                    <button type="button" class="btn" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('scripts')
    <script>
         function handleDelete(post){
            
            var form=document.getElementById('deleteForm');
            form.action='/admin/posts/'+post.id;
             console.log(form);
            
            $('#deleteModel').modal('show');
        }
    </script>
@endsection
