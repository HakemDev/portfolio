@if($errors->all())

      @foreach($errors->all() as $error)
        
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 {{$error}}
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>            
            </div>
       @endforeach

@endif

@if(session()-> has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                 {!!session()->get("success")!!}
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                </button>       
         </div>
        

@endif

@if(session()-> has("info"))
   
        
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{!!session()->get("info")!!}</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
       

@endif

@if(session()-> has("errorLink"))
   
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 {!!session()->get("errorLink")!!}
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                 </button>       
        </div>
        
        

@endif