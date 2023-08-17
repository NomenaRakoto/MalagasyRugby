@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Match</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">match</li>
      <li class="breadcrumb-item active">Form</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card card-form">
            <div class="card-body">
              <h5 class="card-title">Match Information</h5>
              <!-- General Form Elements -->
              @if($errors->any())
              <div class="alert alert-danger" role="alert">
                Veuillez s'il vous plait verifier les informations saisies
              </div>
              @endif
              <form method="POST" action="{{route('match.save')}}">
                {{ csrf_field() }}
                @if(isset($match)) 
                <input type="hidden" name="id" value="{{$match->id}}"> 
                @endif
                
                

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Date match</label>
                  <div class="col-sm-10">
                    <input type="date" name="date_match"  @if($errors->any())  value="{{old('date_match')}}" @else value="@if(isset($match)){{$match->date_match}}@endif" @endif class="form-control">
                  </div>
                  @error('date_match')
                  <div class="danger inp-error text-danger">{{$message}}</div>
                  @enderror
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Heure du match</label>
                  <div class="col-sm-10">
                    <input type="time" name="heure"  @if($errors->any())  value="{{old('heure')}}" @else value="@if(isset($match)){{$match->heure}}@endif" @endif class="form-control">
                  </div>
                  @error('heure')
                  <div class="danger inp-error text-danger">{{$message}}</div>
                  @enderror
                </div>


                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Clubs</label>
                  <div class="col-sm-10">
                    <select id="selectpickerClub" class="form-control rounded" aria-label="Selectionner Club" name='id_club_home'>
                      @foreach($clubs as $key => $club)
                      <option @if($errors->any()) @if(old('id_club_home') == $club->id) selected @endif @else @if(isset($match) && $match->club_home->id==$club->id) selected  @elseif($key==0) selected @endif  @endif value="{{$club->id}}">{{$club->nom}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">VS</label>
                  <div class="col-sm-10">
                    <select id="selectpicker" class=" form-control rounded" aria-label="Selectionner Club" name='id_club_guest'>
                      @foreach($clubs as $key => $club)
                      <option @if($errors->any()) @if(old('id_club_guest') == $club->id) selected @endif @else @if(isset($match) && $match->club_guest->id==$club->id) selected  @elseif($key==0) selected @endif  @endif value="{{$club->id}}">{{$club->nom}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Categorie</label>
                  <div class="col-sm-10">
                    <select class="form-control rounded" aria-label="Selectionner Club" name='id_categorie'>
                      @foreach($scats as $key => $scat)
                      <option @if($errors->any()) @if(old('id_categorie') == $scat->id) selected @endif @else @if(isset($match) && $match->scat->id==$scat->id) selected  @elseif($key==0) selected @endif  @endif value="{{$scat->id}}">{{$scat->designation}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Terrain</label>
                  <div class="col-sm-10">
                    <input type="text" id="terrain" name='terrain'  class="form-control"
                    value="@if(isset($match)) {{$match->terrain}} @endif">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nb Essai</label>
                  <div class="col-sm-10">
                    <input type="number" name="nb_essai" class="form-control" value="@if(isset($match)){{$match->nb_essai}}@endif">
                  </div>
                </div>

                 <div class="form-floating mb-3">
                    <textarea class="form-control textarea" name="joueurs_essai" placeholder="Nom des joueurs ayant marqués essai (separes par /)" id="floatingTextarea">@if(isset($match)) {{$match->joueurs_essai}} @endif</textarea>
                    <label for="floatingTextarea">Nom des joueurs ayant marqués essai (separes par /)</label>
                </div>
                
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Bonus Offensive</label>
                  <div class="col-sm-10">
                    <input type="number" name="bonus_offensive" class="form-control  @error('bonus_offensive') is-invalid @enderror" value="@if(isset($match)){{$match->bonus_offensive}}@endif">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Bonus Defensive</label>
                  <div class="col-sm-10">
                    <input type="number" name="bonus_defensive" class="form-control  @error('bonus_defensive') is-invalid @enderror" value="@if(isset($match)){{$match->bonus_defensive}}@endif">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label"> Nombre de Blessures</label>
                  <div class="col-sm-10">
                    <input type="number" name="nb_blessure" class="form-control  @error('nb_blessure') is-invalid @enderror" value="@if(isset($match)){{$match->nb_blessure}}@endif">
                  </div>
                </div>

                 <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Commotion Cerebrale</label>
                  <div class="col-sm-10">
                    <input type="number" name="commotion_cerebrale" class="form-control  @error('commotion_cerebrale') is-invalid @enderror" value="@if(isset($match)){{$match->commotion_cerebrale}}@endif">
                  </div>
                </div>
                
                
                <div class="row">
                  <div class="col-md-3 mr-button mr-btn">
                        <button class="btn btn-primary w-100" type="submit"><i class="ri-save-2-fill"></i> Enregistrer</button>
                  </div>
                   <div class="col-md-3 mr-button mr-btn">
                      <a href="{{url()->previous()}}">
                        <button class="btn btn-primary w-100" type="button"><i class="ri-close-circle-line"></i> Annuler</button>
                      </a>
                  </div>
              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>
    </section>
@endsection
@push('styles')
<link href="/assets/css/choices.min.css" rel="stylesheet">
@endpush

@push("scripts")
<script src="/assets/js/choices.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/script.js"></script>
@endpush