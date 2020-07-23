@extends('layouts.admin_layout')

@section('content')
@include('admin.includes.errors')
<div class="row ">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Lists Of Submenus</h4>
                        
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                @if (count($submenus)>0)
                <div class="table-responsive mb-4 mt-4">
                    <table  class="table table-hover" style="width:100%">
                      <thead>
                            <tr>
                                <th>Submenu</th>
                                <th>Inside</th>
                                <th>Post Count</>
                                <th>Created date</th>
                                <th class="text-center" style="width: 20%" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                @foreach ($submenus as $submenu )
                                    <tr>
                                        
                                        <td>{{ $submenu->submenu }}</td>
                                        <td>{{ $submenu->mainmenu->main_menu }}</td>
                                        <td>{{ $submenu->posts->count() }}</td>
                                        <td>{{ $submenu->created_at }}</td>
                                        
                                        <td class="text-center">
                    
                                            <div class="dropdown custom-dropdown">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                </a>
                        
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                    <button  class="dropdown-item" onclick="handleEdit({{ $submenu }})">Edit</button>
                                                    <button  class="dropdown-item" onclick="handleDelete({{ $submenu }})">Delete</button>
                                                </div>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            
                            
                        </tbody>
                    </table> 
                </div>
                @else
                    <h3 class="text-center">No Submenu Yet!</h3>
                @endif
                <button class="btn btn-info" onclick="handleAdd()" >Add Submenu</button>
            </div>
        </div>
    </div>  
</div>

            <form action="{{ route('submenus.store') }}" method="POST" id="addForm">
                @csrf
                <div class="modal animated zoomInUp" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title" id="addModelModelLabel">Add Submenu</h5>
                            </div>
                            <div class="modal-body">
                                <label>Submenu</label>
                                <div class="form-group mb-2">
                                    <select class="form-control  basic" name="mainmenu_id">
                                        @foreach ($mainmenus as $mainmenu)
                                            <option value="{{ $mainmenu->id }}">{{ $mainmenu->main_menu }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label>Submenu</label> 
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control"  name="submenu" >
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
                                <h5 class="modal-title" id="addModelModelLabel">Edit Sunmenu</h5>
                            </div>
                            <div class="modal-body">
                                <label>Main Menu</label>
                                <select class="form-control  basic" name="mainmenu_id">
                                    @foreach ($mainmenus as $mainmenu )
                                    <option value="{{ $mainmenu->id }}">{{ $mainmenu->main_menu }}</option>
                                    @endforeach
                                </select>
                                <label>Submenu</label>
                                <div class="form-group mb-2">
                                    <input type="text" class="form-control" id="submenu" name="submenu" >
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
                                Are you sure you want to delete this submenu menu?
                                If you click yes, you will also lose all posts in submenu too.
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
    function handleEdit(submenu){
        var modal=document.getElementById('submenu').value=submenu.submenu;
        var form=document.getElementById('editForm');
        form.action='submenus/'+submenu.id;
        $('#editModal').modal('show');
    }
    function handleDelete(submenu){
            var form=document.getElementById('deleteForm');
            form.action='submenus/'+submenu.id;
            
            $('#deleteModel').modal('show');
        }
</script>
@endsection