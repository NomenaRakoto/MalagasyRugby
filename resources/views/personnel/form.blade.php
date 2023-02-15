@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>personnels</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">personnels</li>
      <li class="breadcrumb-item active">Form</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card card-form">
            <div class="card-body">
              <h5 class="card-title">personnel Information</h5>
              <!-- General Form Elements -->
              @if($errors->any())
              <div class="alert alert-danger" role="alert">
                Veuillez s'il vous plait verifier les informations saisies
              </div>
              @endif
              <form method="POST" action="{{route('personnel.save')}}@if($current_club)?current_club={{$current_club}}@endif" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if(isset($personnel)) <input type="hidden" name="id" value="{{$personnel->id}}"> @endif
                <div class="row mb-3">
                  <div class="col-sm-2">
                      <img id="section-logo" @if(isset($personnel)) src="/assets/img/app/personnels/{{$personnel->identification}}" @else src="/assets/img/app/personnels/default.jpg" @endif class="section-logo" />
                  </div>
                  <div class="col-sm-4">
                    <input class="form-control" name="identification" type="file" id="identification" onchange="encodeImageFileBase64(this)" accept="image/*">
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Type</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Selectionner Type" name='id_type'>
                      @foreach($types as $key => $type)
                      <option @if($errors->any()) @if(old('id_type') == $type->id) selected @endif @else @if(isset($personnel) && $type->id==$personnel->id_type) selected @else @if($key==0) selected @endif @endif  @endif value="{{$type->id}}">{{$type->designation}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nom</label>
                  <div class="col-sm-10">
                    <input type="text" id="nom" name="nom" class="form-control  @error('nom') is-invalid @enderror"
                    @if($errors->any())  value="{{old('nom')}}" @else value="@if(isset($personnel)) {{$personnel->nom}} @endif" @endif  required>
                    @error('nom')
                    <div class="danger inp-error text-danger">{{$message}}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Prénom</label>
                  <div class="col-sm-10">
                    <input type="text" id="prenom" class="form-control" name="prenom"  @if($errors->any())  value="{{old('prenom')}}" @else value="@if(isset($personnel)) {{$personnel->prenom}} @endif" @endif>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Date de naissance</label>
                  <div class="col-sm-10">
                    <input type="date" name="date_naissance"  @if($errors->any())  value="{{old('date_naissance')}}" @else value="@if(isset($personnel)){{$personnel->date_naissance}}@endif" @endif class="form-control">
                  </div>
                  @error('nom')
                  <div class="danger inp-error text-danger">{{$message}}</div>
                  @enderror
                </div>
                <div class="row mb-3">
                  <input type="hidden" name="" id="last_cin" value="@if(!isset($personnel)){{$last_cin}}@endif">
                  <label for="inputText" class="col-sm-2 col-form-label">CIN</label>
                  <div class="col-sm-10">
                    <label for="auto">Automatique</label>
                    <input type="checkbox" id="auto" name="">
                    <input type="text" id="cin" name="cin" class="form-control  @error('cin') is-invalid @enderror"
                    @if($errors->any())  value="{{old('cin')}}" @else value="@if(isset($personnel)) {{$personnel->cin}} @endif" @endif  required>
                    @error('cin')
                    <div class="danger inp-error text-danger">{{$message}}</div>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Licence</label>
                  <div class="col-sm-10">
                    <input type="text" name="licence" readonly class="form-control  @error('licence') is-invalid @enderror"
                    @if($errors->any())  value="{{old('licence')}}" @else value="@if(isset($personnel)){{$personnel->licence}}@else{{$licence}}@endif" @endif  required>
                    
                  </div>
                </div>


                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Sexe</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Selectionner Sexe" name='id_sexe'>
                      @foreach($sexes as $key => $sexe)
                      <option @if($errors->any()) @if(old('id_sexe') == $sexe->id) selected @endif @else @if(isset($personnel) && $sexe->id==$personnel->sexe->id) selected @else @if($key==0) selected @endif @endif  @endif value="{{$sexe->id}}">{{$sexe->designation}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                 <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Club</label>
                  <div class="col-sm-10">
                    <select class="selectpicker form-control rounded" aria-label="Selectionner Club" name='id_club'>
                      @foreach($clubs as $key => $club)
                      <option @if($errors->any()) @if(old('club') == $club->id) selected @endif @else @if(isset($personnel) && $club->id==$personnel->club_id) selected @else @if($key==0) selected @endif @endif  @endif value="{{$club->id}}">{{$club->nom}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Sous-categorie</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Selectionner Categorie" name='id_s_cat'>
                      @foreach($scats as $key => $categorie)
                      <option @if($errors->any()) @if(old('id_s_cat') == $categorie->id) selected @endif @else @if(isset($personnel) && $categorie->id==$personnel->id_s_cat) selected @else @if($key==0) selected @endif @endif  @endif value="{{$categorie->id}}">{{$categorie->designation}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Format du jeu</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Selectionner Format du jeu" name='id_format_jeu'>
                      @foreach($formats_jeu as $key => $format)
                      <option @if($errors->any()) @if(old('id_format_jeu') == $format->id) selected @endif @else @if(isset($personnel) && $format->id==$personnel->id_format_jeu) selected @else @if($key==0) selected @endif @endif  @endif value="{{$format->id}}">{{$format->designation}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Position du jeu</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Selectionner Position du jeu" name='id_position_jeu'>
                      @foreach($positions_jeu as $key => $position)
                      <option @if($errors->any()) @if(old('id_position_jeu') == $position->id) selected @endif @else @if(isset($personnel) && $position->id==$personnel->id_position_jeu) selected @else @if($key==0) selected @endif @endif  @endif value="{{$position->id}}">{{$position->designation}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Statut Regle 8</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Selectionner statut regle 8" name='id_statut_regle_8'>
                      @foreach($statuts_regle as $key => $statut_regle)
                      <option @if($errors->any()) @if(old('id_statut_regle_8') == $statut_regle->id) selected @endif @else @if(isset($personnel) && $statut_regle->id==$personnel->id_statut_regle_8) selected @else @if($key==0) selected @endif @endif  @endif value="{{$statut_regle->id}}">{{$statut_regle->designation}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Statut Citoyenneté</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Selectionner statut citoyenneté" name='id_statut_citoyennete'>
                      @foreach($statuts_citoyen as $key => $statut_citoyen)
                      <option @if($errors->any()) @if(old('id_statut_citoyennete') == $statut_citoyen->id) selected @endif @else @if(isset($personnel) && $statut_citoyen->id==$personnel->id_statut_citoyennete) selected @else @if($key==0) selected @endif @endif  @endif value="{{$statut_citoyen->id}}">{{$statut_citoyen->designation}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Niveau Equipe</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Selectionner Niveau equipe" name='id_niveau_equipe'>
                      @foreach($niveau_equipes as $key => $niveau_equipe)
                      <option @if($errors->any()) @if(old('id_niveau_equipe') == $niveau_equipe->id) selected @endif @else @if(isset($personnel) && $niveau_equipe->id==$personnel->id_niveau_equipe) selected @else @if($key==0) selected @endif @endif  @endif value="{{$niveau_equipe->id}}">{{$niveau_equipe->designation}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nb match</label>
                  <div class="col-sm-10">
                    <input type="number" name="nb_match_last" class="form-control  @error('nb_match_last') is-invalid @enderror"
                    @if($errors->any())  value="{{old('nb_match_last')}}" @else value="@if(isset($personnel)) {{$personnel->nb_match_last}} @else 0 @endif" @endif >
                  </div>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control textarea" name="observation" placeholder="Votre Observation" id="floatingTextarea">@if(isset($personnel)) {{$personnel->observation}} @endif</textarea>
                    <label for="floatingTextarea">Observation</label>
                </div>

                
                <div class="row">
                  <div class="col-md-3 mr-button mr-btn">
                        <button class="btn btn-primary w-100" type="submit"><i class="ri-save-2-fill"></i> Enregistrer</button>
                  </div>
                  @if(isset($personnel))
                  <div class="col-md-3 mr-btn">
                        <button class="btn btn-danger w-100" type="button" data-bs-toggle="modal" data-bs-target="#verticalycentered"><i class="ri-delete-bin-2-fill"></i> Supprimer</button>
                  </div>

                  @endif
                   

                   <div class="col-md-3 mr-button mr-btn">
                      <a href="@if($current_club){{route('club.personnel.list', ['id_club' => $current_club])}}@else{{route('personnel.list')}}@endif">
                        <button class="btn btn-primary w-100" type="button"><i class="ri-close-circle-line"></i> Annuler</button>
                      </a>
                  </div>
              </form><!-- End General Form Elements -->
              <div class="col-md-3 mr-button mr-btn">
                    <button id="btnDoute" class="btn btn-primary w-100" type="button"><i class="ri-alert-fill"></i> Doute</button>
                  
                </div>
              @if(isset($personnel))
              <div class="modal fade" id="verticalycentered" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Confirmation suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        
                        Voulez vous vraiment supprimer {{$personnel->nom}}? 
                        <br>Attention : Cette action est irreversible
                      </div>
                      <div class="modal-footer">
                        
                        <form method="post" id="formDelete" action="{{route('personnel.delete')}}">
                          {{ csrf_field() }}
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                          <input id="licences" type="hidden" name="personnels" value="[{{$personnel->id}}]">
                          <button type="submit" class="btn btn-danger"><i class="ri-delete-bin-2-fill"></i> Supprimer</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
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
<script type="text/javascript">

  const sorting = document.querySelector('.selectpicker');
  const commentSorting = document.querySelector('.selectpicker');
  const sortingchoices = new Choices(sorting, {
      placeholder: false,
      itemSelectText: ''
  });


  // Trick to apply your custom classes to generated dropdown menu
  let sortingClass = sorting.getAttribute('class');
  window.onload= function () {
      sorting.parentElement.setAttribute('class', sortingClass);
  }

  function encodeImageFileBase64(element) {
      var imagebase64 = "";
      var file = element.files[0];
      var reader = new FileReader();
      reader.onloadend = function() {
        imagebase64 = reader.result;
        $("#section-logo").attr("src", imagebase64)
      }
      reader.readAsDataURL(file);
    }

  $(document).ready(function(){
    $('#auto').on('click', function(){
        if($(this).is(':checked')) {
          $('#cin').val('10'+$('#last_cin').val());
        } else {
          $('#cin').val('');
        }
    });

    $('#btnDoute').on('click', function(){
      
        var name = $('#nom').val() + $('#prenom').val();
        var cin = $('#cin').val();
        if(name !== '' || cin !== '') {
          var url = "/personnel/doute/" + name + "/" + cin;
          window.open(url, '_blank');
        } 
    });
  });
</script>
@endpush