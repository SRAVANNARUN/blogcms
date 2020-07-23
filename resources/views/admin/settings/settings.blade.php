@extends('layouts.admin_layout')



@section('content')
@include('admin.includes.errors')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Site settings</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area" >
                <form  action="{{ route('settings.update') }}" method="POST"  >
                      @csrf
                        <div class="form-group mb-4">
                            <label for="site_name">Site name</label>
                            <input type="text" class="form-control" id="site_name" name="site_name"  value="{{ $settings->site_name }}">
                        </div>
                        <div class="form-group mb-4">
                            <label for="contact_number">Contact number</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ $settings->contact_number }}" >
                        </div>
                        <div class="form-group mb-4">
                            <label for="contact_email">Contact email</label>
                            <input type="text" class="form-control" id="contact_email" name="contact_email" value="{{ $settings->contact_email }}">
                        </div>
                        <div class="form-group mb-4">
                            <label for="contact_address">Contact address</label>
                            <input type="text" class="form-control" id="contact_address" name="contact_address" value="{{ $settings->contact_address }}">
                        </div>
                      <button type="submit" class="btn btn-primary mt-1">Update settings</button>
                </form>
            </div>
        </div>
    </div>  
</div> 
@endsection