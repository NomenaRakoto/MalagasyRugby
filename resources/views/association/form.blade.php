@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Associations | Etablissements</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Clubs</li>
      <li class="breadcrumb-item active">Form</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="ligue">
      <div class="row">
        <div class="col-lg-12">

          <div class="card card-form">
            <div class="card-body">
              <h5 class="card-title">Associations | Etablissements Informations</h5>
              <!-- General Form Elements -->
              @if($errors->any())
              <div class="alert alert-danger" role="alert">
                Veuillez s'il vous plait verifier les informations saisies
              </div>
              @endif
              <form method="POST" action="{{route('association.save')}}">
                {{ csrf_field() }}
                @if(isset($association)) <input type="hidden" name="id" value="{{$association->id}}"> @endif
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Type</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Selectionner Type" name='type'>
                      @foreach($types as $key => $type)
                      <option @if($errors->any()) @if(old('type') == $type->id) selected @endif @else @if(isset($association) && $association->type_association->id==$type->id) selected  @elseif($key==0) selected @endif  @endif value="{{$type->id}}">{{$type->designation}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nom</label>
                  <div class="col-sm-10">
                    <input type="text" name="nom" class="form-control  @error('nom') is-invalid @enderror" @error('nom') value="{{old('nom')}}" @else value="@if(isset($association)) {{$association->nom}} @endif" @enderror  required>
                    @error('nom')
                    <div class="danger inp-error text-danger">{{$message}}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Responsable</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="responsable" value="@if(isset($association)) {{$association->responsable}} @endif">
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Region</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Selectionner Region" name='id_region'>
                      @foreach($ligues as $key => $ligue)
                      <option @if(isset($association) && $ligue->id==$association->region->id) selected @else @if($key==0) selected @endif  @endif value="{{$ligue->id}}">{{$ligue->nom}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Contact</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="contact" value="@if(isset($association)) {{$association->contact}} @endif">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Adresse</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="adresse" value="@if(isset($association)) {{$association->adresse}} @endif">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Adresse Mail</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control @error('mail_adresse') is-invalid @enderror" name="mail_adresse" 
                    @error('mail_adresse') value="{{old('mail_adresse')}}" @else  value="@if(isset($association)) {{$association->mail_adresse}} @endif" @enderror >
                    @error('mail_adresse')
                    <div class="danger inp-error text-danger">{{$message}}</div>
                    @enderror
                  </div>

                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Facebook</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="fb_adresse" value="@if(isset($association)) {{$association->fb_adresse}} @endif">
                  </div>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control textarea" name="observation" placeholder="Votre Observation" id="floatingTextarea">@if(isset($association)) {{$association->observation}} @endif</textarea>
                    <label for="floatingTextarea">Observation</label>
                </div>
                
                <div class="row">
                  <div class="col-md-3 mr-button mr-btn">
                        <button class="btn btn-primary w-100" type="submit"><i class="ri-save-2-fill"></i> Enregistrer</button>
                  </div>
                  @if(isset($association))
                  <div class="col-md-3 mr-btn">
                        <button class="btn btn-danger w-100" type="button" data-bs-toggle="modal" data-bs-target="#verticalycentered"><i class="ri-delete-bin-2-fill"></i> Supprimer</button>
                  </div>
                  <div class="modal fade" id="verticalycentered" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Confirmation suppression</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Voulez vous vraiment supprimer {{$association->nom}}? 
                          <br>Attention : Cette action est irreversible
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                          <a href="{{route('association.delete', ['id' => $association->id])}}">
                            <button type="button" class="btn btn-danger"><i class="ri-delete-bin-2-fill"></i> Supprimer</button>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif

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