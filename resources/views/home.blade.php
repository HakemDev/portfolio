@extends('layouts.app')

@section('content')
    <div class="aboutMe">
        <div class="thisrdinfo">
                    <div class="select_div mb-5">
                        <label class="select_div_label ml-5 mr-2 mt-2" for="select_language">Select Your Project Language: </label>
                        <form  method="post" action="{{route('home.filter')}}" class="form_language row " enctype="multipart/form-data">
                            @csrf
                            @method("POST") 
                            <div class="d-flex">
                                <div class="mr-2">
                                    <select id="select_language" name="select_language" class="form-select fw-bold mr-3" aria-label="Default select example" >
                                        <option selected value="all project">All Project</option>
                                        @foreach($languages as $languag) 
                                            <option value="{{$languag->libelle}}">{{$languag->libelle}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button type="Submit" class="btn btn-dark btn-rounded" data-mdb-ripple-color="dark"><span style="font-size: 1rem;">🔍</span> Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($projets as $projet)
                            <div class="col">
                                <div class="card h-100">
                                    <img src="{{URL::asset($projet->image)}}" class="card-img-top image_projet_user" alt="{{$projet->title}}"/>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$projet->title}}</h5>
                                        <p class="card-text">
                                             {{$projet->description}}
                                        </p>
                                        <small class="text-muted"><span class="fw-bold">Languages: </span>                
                                                @foreach($projet->languages as $language)
                                                    {{$language->libelle}}
                                                @endforeach
                                        </small>
                                        <br><small class="text-muted">
                                            <span class="fw-bold">Check Code Source: </span>
                                            <a href="{{$projet->github_link}}" class="text-muted"><i class="fab fa-github me-1"></i>Github</a>
                                        </small>
                                        
                                        <br><small class="text-muted">
                                            <span class="fw-bold">Check Profile: </span>
                                            <a href="{{route('profil',$projet->user_id)}}" class="text-muted">👨‍💻 {{$projet->user->name}}</a>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>

                    
            </div>    
        </div>

@endsection

