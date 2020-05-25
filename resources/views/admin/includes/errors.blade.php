@if (count($errors)>0)
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">

            
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Error!</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger mb-2" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button> {{ $error }} 
                        </div>
                        @endforeach
                    </div>
                </div>
            
            
    
        </div>
    </div>
@endif