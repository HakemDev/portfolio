@extends('layouts.app')
@section('content')
    <div class="aboutMe2">
        <h1 class="thirdinfotitle text-center fw-bold mb-4" >Add New Project: </h1>
        <form method="post" action="{{route('project.store')}}" id="ajouter" enctype="multipart/form-data">
            @csrf
            @method("POST")     
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <input type="text" id="form6Example2" class="form-control bg-dark" name="github_link"/>
                        <label class="form-label text-white" for="form6Example2">https://Github.com</label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                        <div class="form-outline">
                            <input type="text" id="form6Example1" class="form-control bg-dark" name="title"/>
                            <label class="form-label text-white" for="form6Example1">Project Title</label>
                        </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="file" class="form-control bg-dark" id="inputGroupFile02" name="file">
                <label class="input-group-text text-white bg-dark" for="inputGroupFile02">Upload Image </label>
            </div>
        

            <!-- Message input -->
            <div class="form-outline mb-4">
                <textarea class="form-control bg-dark" id="form6Example7" rows="4" name="description"></textarea>
                <label class="form-label text-white" for="form6Example7">Describe Your project</label>
            </div>

            <!-- Checkbox -->
            <div class="d-flex d-flex bd-highlight mb-2">
                <div class=" w-50 bd-highlight">
                    <label for="">Select Language(s) :</label>

                </div>
                <div class="flex-shrink-1 bd-highlight">
                    @foreach($languages as $language)  
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="{{$language->id}}" value="{{$language->id}}"  name="languages[]"/>
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
                             document.getElementById('ajouter').submit();"  
                          class="btn btn-light w-auto fw-bold text-dark" style="margin-left: auto;margin-right:auto;">💾 Add project</button>
            </div> 
            
        </form>
    </div>
@endsection
