@extends('layouts.admin_layout')

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
            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped mb-4">
                      <caption>List of all users</caption>
                      <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Category name</th>
                                <th>Created date</th>
                                <th class="text-center" style="width: 20%" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                @foreach ($categories as $category )
                                    <tr>
                                        <td>#</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td class="text-center"><button class="btn btn-warning mb-4 mr-2 btn-xs">Edit</button></td>
                                        <td class="text-center"><button class="btn btn-warning mb-4 mr-2 btn-xs">Edit</button></td>
                                        
                                    </tr>
                                @endforeach
                            
                            
                        </tbody>
                    </table>
                </div>
                    
            </div>
        </div>
    </div>  
</div>
@endsection