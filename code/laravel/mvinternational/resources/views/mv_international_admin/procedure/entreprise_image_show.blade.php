@extends('layouts.app_custom')
 
@section('content')

<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Consultation du logo</h1>
     
</div> 
<!-- PAGE-HEADER END -->


<!-- formulaire -->
<div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
             </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-xl-12 mb-3">
                        @if($file->extension == '.jpg' || $file->extension == '.png')
                            <img  id="{{$file->file_name}}"  src="data:application/octet-stream;base64,{{base64_encode($file->binaire)}}"  style="position:fixed; top:0; left:0; bottom:0; right:0; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999; background: white;">
                        @endif
                        
                        @if($file->extension == '.pdf')
                            <iframe  title="{{$file->file_name}}"  src="data:application/pdf;base64,{{base64_encode($file->binaire)}}"  style="position:fixed; top:0; left:0; bottom:0; right:0; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;">       
                        @endif
                    </div>
                        
                </div>  
             </div>
        </div>
    </div> 

@endsection
@livewireScripts 