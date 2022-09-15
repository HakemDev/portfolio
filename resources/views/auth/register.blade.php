@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-md-8">
            <div class="card-header">
                <div class="text-center fw-bold" style="font-size: xx-large; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">{{ __('Create New Account:') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data"> 
                        @csrf
                        @method("POST")     
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Nom Complet') }}:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Email Address') }}:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Adresse') }}:</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="developer_type" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Domaine Work') }}:</label>

                            <div class="col-md-6">
                                <select name="developer_type" id="developer_type" class="form-control @error('developer_type') is-invalid @enderror" value="{{ old('developer_type') }}" required>
                                        <option value="Full Stack developer">Full Stack developer</option>
                                        <option value="Front End developer">Front End developer</option>
                                        <option value="Back End developer">Back End developer</option>

                                </select>
                                @error('developer_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="year_experience" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Experience Year') }}:</label>

                            <div class="col-md-6">
                                <input type="number" min=0 name="year_experience" id="year_experience" class="form-control @error('year_experience') is-invalid @enderror"value="{{ old('year_experience') }}" required autocomplete="year_experience" autofocus>
                                @error('year_experience')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="github_link" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Github') }}:</label>

                            <div class="col-md-6">
                                <input id="github_link" type="text" class="form-control @error('github_link') is-invalid @enderror" name="github_link" value="{{ old('github_link') }}" required autocomplete="github_link" autofocus>

                                @error('github_link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="linekdin" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('linekdin') }}:</label>

                            <div class="col-md-6">
                                <input id="linekdin" type="text" class="form-control @error('linekdin') is-invalid @enderror" name="linekdin" value="{{ old('linekdin') }}" required autocomplete="linekdin" autofocus>

                                @error('linekdin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="about_me" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Upload Your Image profil') }}:</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" id="about_me" name="file" class="form-control @error('about_me') is-invalid @enderror" value="{{ old('about_me') }}" required autocomplete="description">
                                @error('about_me')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <input type="number" class="d-none" name="role_id" value="1">
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Descritpion') }}:</label>

                            <div class="col-md-6">
                                <textarea class="form-control" id="description" name="description" class="form-control @error('descritpion') is-invalid @enderror" value="{{ old('linekdin') }}" required autocomplete="description"></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Mot de passe') }}:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Confirmer Votre mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
