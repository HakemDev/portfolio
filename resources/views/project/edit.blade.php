@extends('layouts.app')
@section('content')
    <div class="aboutMe2">
        <h1 class="thirdinfotitle text-center fw-bold mb-4" >Add New Project: </h1>
        <form method="post" action="{{route('project.update')}}" id="update" enctype="multipart/form-data">
            @csrf
            @method("PUT")     
            <input type="hidden" name="id_proje" class="d-none" value="{{$projet->id}}">
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="form6Example2" value="{{$projet->github_link}}" class="form-control bg-dark text-white" name="github_link"/>
                        <label class="form-label text-white" for="form6Example2">https://Github.com</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                        <div class="form-outline">
                            <input type="text" id="form6Example1" value="{{$projet->title}}" class="form-control bg-dark text-white" name="title"/>
                            <label class="form-label text-white" for="form6Example1">Project Title</label>
                        </div>
                </div>
            </div>
              <input type="hidden" name="file2" value="{{URL::asset($projet->image)}}">                  
            <div class="input-group mb-3">
                <input type="file" class="form-control bg-dark" id="inputGroupFile02" name="file" >
                <label class="input-group-text text-white bg-dark" for="inputGroupFile02">Upload Image </label>
            </div>
            <div class="input-group mb-3">
               <img src="{{URL::asset($projet->image)}}"  class="image_update mx-auto" alt="">
            </div>

            <!-- Message input -->
            <div class="form-outline mb-4">
                <textarea class="form-control bg-dark text-white" id="form6Example7"  rows="4" name="description">{{$projet->description}}</textarea>
                <label class="form-label text-white" for="form6Example7">Describe Your project</label>
            </div>

            <!-- Checkbox -->
            <div class="d-flex d-flex bd-highlight mb-2">
                <div class=" w-50 bd-highlight">
                    <label for="">Select Language(s) :</label>

                </div>
                <div class="flex-shrink-1 bd-highlight">
                    <small class="text-muted">
                        <span class="fw-bold">Languages: </span>                
                        @foreach($projet->languages as $language)
                            {{$language->libelle}}
                        @endforeach
                    </small>
                </div>
                <div class="flex-shrink-1 bd-highlight">
                    @foreach($languages as $language)  
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="{{$language->id}}" value="{{$language->id}}" name="languages[]"  
                                @foreach($projet->languages as $lang)
                                    @if($language->libelle==$lang->libelle)
                                       checked=checked
                                    @endif
                                @endforeach
                                />
                            <label class="form-check-label" for="{{$language->id}}">{{$language->libelle}}</label>
                        </div>
                    @endforeach
                </div>
            </div>

          
            <!-- Submit button -->
            <div class="row">
            <button onclick="
                                event.preventDefault();
                                if(confirm('are you sure of your informtaion?'))
                             document.getElementById('update').submit();"  
                          class="btn btn-light w-auto fw-bold text-dark" style="margin-left: auto;margin-right:auto;">💾 update project</button>
            </div> 
            
        </form>
    </div>
@endsection
