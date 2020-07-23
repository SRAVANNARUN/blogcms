@extends('layouts.admin_layout')

@section('content')
@include('admin.includes.errors')
<div class="row ">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Lists Of Menu</h4>
                        
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                @if (count($mainmenus)>0)
                <div class="table-responsive mb-4 mt-4">
                    <table  class="table table-hover" style="width:100%">
                      <thead>
                            <tr>
                                <th>Main Menu</th>
                                <th>Submenu Count</th>
                                <th>Created date</th>
                                <th class="text-center" style="width: 20%" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                @foreach ($mainmenus as $mainmenu )
                                    <tr>
                                        
                                        <td>{{ $mainmenu->main_menu }}</td>
                                        <td>{{ $mainmenu->submenus->count() }}</td>
                                        <td>{{ $mainmenu->created_at }}</td>
                                        
                                        <td class="text-center">
                    
                                            <div class="dropdown custom-dropdown">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                </a>
                        
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                    <button  class="dropdown-item" onclick="handleEdit({{ $mainmenu }})">Edit</button>
                                                    <button  class="dropdown-item" onclick="handleDelete({{ $mainmenu }})">Delete</button>
                                                </div>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            
                            
                        </tbody>
                    </table> 
                </div>
                @else
                    <h3 class="text-center">No Menu Yet!</h3>
                @endif
                <button class="btn btn-info" onclick="handleAdd()" >Add Main Menu</button>
            </div>
        </div>
    </div>  
</div>

            <form action="{{ route('main_menus.store') }}" method="POST" id="addForm">
                @csrf
                <div class="modal animated zoomInUp" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title" id="addModelModelLabel">Add Main Menu</h5>
                            </div>
                            <div class="modal-body">
                                <label>Main Menu</label>
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control"  name="main_menu" >
                                </div>
                            </div>
                            <div class="modal-footer border-0 justify-content-between">
                                <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form action="" method="POST" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal animated zoomInUp" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title" id="addModelModelLabel">Edit Main Menu</h5>
                            </div>
                            <div class="modal-body">
                                <label>Main menu</label>
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control" id="main_menu" name="main_menu" >
                                </div>
                            </div>
                            <div class="modal-footer border-0 justify-content-between">
                                <button type="button" class="btn " data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form action="" method="POST" id="deleteForm">
                @method('DELETE')
                @csrf
                
                <div class="modal animated zoomInUp" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="DeleteModelLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title" id="DeleteModelLabel">Danger!</h5>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this main menu?
                                If you click yes, you will also lose all submenus and posts in that submenus too.
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
    function handleAdd(){
        
        
        $('#addModal').modal('show');
    }
    function handleEdit(mainmenu){
        var modal=document.getElementById('main_menu').value=mainmenu.main_menu;
        var form=document.getElementById('editForm');
        form.action='main_menus/'+mainmenu.id;
        $('#editModal').modal('show');
    }
    function handleDelete(mainmenu){
            var form=document.getElementById('deleteForm');
            form.action='main_menus/'+mainmenu.id;
            
            $('#deleteModel').modal('show');
        }
</script>
@endsection