@extends('layouts.app')
@section('content')
    
    <div class="aboutMe">
            <div class="mb-5">
                <div class="aboutmetext">
                    <h1 class="aboutmename text-center mb-3" >My Name is {{$user->name}}</h1>
                    <h3 class="aboutmename2 text-center">I am {{$user->developer_type}}</h3>
                    <p class="fw-bold text-center" >I am a developer with {{$user->year_experience}} years of experience</p>
                    <div class="d-flex justify-content-center">
                        <a class="btn text-white fw-bold mr-2" style="background-color: #333333;" href="{{$user->github_link}}" role="button">
                            <i class="fab fa-github"></i>
                            Github
                        </a>
                        <a class="btn text-white fw-bold" style="background-color: #0082ca;" href="{{$user->linekdin}}" role="button">
                            <i class="fab fa-linkedin-in"></i>
                            Linkedin
                        </a>
                    </div>   
                </div>
                 
            </div>
            
            <div class='secondinfo mb-5'>
                <div class="div_image">
                    <img src="{{URL::asset($user->about_me)}}" class="card-img-top imagee" alt="..." height="2%">
                </div> 
                <div>
                    <h1 class="aboutmename3 pl-5">About Me: </h1>
                    <p class="textAboutMe" >
                        {{$user->descritpion}}          
                    </p>
                </div>
            </div>

            <h1 class="thirdinfotitle text-center fw-bold mb-4" >My Remamble Works: </h1>

            <div class="thisrdinfo">
                    <div class="select_div mb-5">
                        <label class="select_div_label ml-5 mr-2 mt-2" for="select_language">Select Your Project Language: </label>
                        @auth
                            <form  method="post" action="{{route('do.filter')}}" class="form_language row " enctype="multipart/form-data">
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
                        @endauth

                        @guest
                            <form  method="post" action="{{route('home.filter')}}" class="form_language row " enctype="multipart/form-data">
                                @csrf
                                @method("POST")    
                                <input type="hidden" name="notauth" value="notauth">
                                <input type="hidden" name="userId" value="{{$user->id}}">
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
                        @endguest
                           
                            
                    </div>
                    
                    @auth
                        @if($user->id==Auth::user()->id)
                            <div class="add projet mb-3 d-flex justify-content-center" style="margin-right:auto;margin-left:auto;">
                                <a href="{{route('project.create')}}" class="btn btn-light fw-bold">✒ Add New Projet</a>
                            </div>
                        @endif
                    @endauth

                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($projets as $projet)
                            <div class="col">
                                <div class="card h-100">
                                    <img src="{{URL::asset($projet->image)}}" class="card-img-top image_projet_user" alt="{{$projet->title}}" />
                                    <div class="card-body">
                                        <h5 class="card-title">{{$projet->title}}  </h5>
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
                                    </div>
                                    @auth
                                       @if($user->id==Auth::user()->id)
                                            <div class="card-footer d-flex">
                                                <form action="{{route('delete.projet',$projet->id)}}" method="POST"  id="delete{{$projet->id}}" class="delete ml-2 mr-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-light btn-rounded fw-bold text-black w-auto" style="background-color: #cbd5e1;" onclick="
                                                                    event.preventDefault();
                                                                    if(confirm('are you sure?'))
                                                                    document.getElementById('delete{{$projet->id}}').submit();" >
                                                                🗑 Delete</a>
                                                </form>
                                                <a class="btn btn-light btn-rounded fw-bold text-black" style="background-color: #94a3b8;" href="{{route('upd.projet',$projet->id)}}">🧾 Update</a>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                        
                    </div>

                    
            </div>

    </div>

@endsection
