@extends('layouts.admin_layout')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Lists of users</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                @if (count($users)>0)
                <div class="table-responsive">
                    <table class="table  table-hover  mb-4">
                      <caption>All users: {{ count($users) }}</caption>
                      <thead>
                            <tr>
                                <th class="text-left">Photo</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th class="text-center" style="width: 20%" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                @foreach ($users as $user )
                                    <tr>
                                        <td class="text-left">
                                            @if ($user->profile->image!=null)
                                            <img class="rounded" style="margin-left: 10px;" width="70" height="70" src="{{asset('storage').'/'.$user->profile->image}}" alt="">
                                            @else
                                            <img class="rounded"  width="95" height="95" src="{{asset('storage').'/default/broken_image.svg'}}" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            @if ($user->admin)
                                                Admin
                                            @else
                                                Not admin
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if (!$user->admin)
                                                <div class="dropdown custom-dropdown">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                    </a>
                            
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                        <a class="dropdown-item" href="">Edit</a>
                                                        <form action="" method="POST">
                                                            @csrf
                                                            @method('Delete')
                                                            <button type="submit" class="dropdown-item">Delete</button>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                            @else
                                                No action needed 
                                            @endif
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            
                            
                        </tbody>
                    </table>
                </div>
                @else
                    {{-- <h3 class="text-center">No tags yet!</h3> --}}
                @endif
                    
            </div>
        </div>
    </div>  
</div>
@endsection