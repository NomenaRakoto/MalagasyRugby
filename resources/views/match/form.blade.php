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
                  <label for="inputDate" class="col-sm-2 col-form-label">Date du match</label>
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
                    <select id="selectpickerClub"  class="form-control rounded club club1" aria-label="Selectionner Club" name='id_club_home'>
                      @foreach($clubs as $key => $club)
                      <option @if($errors->any()) @if(old('id_club_home') == $club->id) selected @endif @else @if(isset($match) && $match->club_home->id==$club->id) selected  @elseif($key==0) selected @endif  @endif value="{{$club->id}}">{{$club->nom}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">VS</label>
                  <div class="col-sm-10">
                    <select id="selectpicker" class=" form-control club rounded club2" aria-label="Selectionner Club" name='id_club_guest'>
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
                      @foreach($cats as $key => $cat)
                      <option @if($errors->any()) @if(old('id_categorie') == $cat->id) selected @endif @else @if(isset($match) && $match->categorie->id==$cat->id) selected  @elseif($key==0) selected @endif  @endif value="{{$cat->id}}">{{$cat->designation}}</option>
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
                    <input type="number" id="nb_joueurs_essai" name="nb_essai" class="form-control" value="@if(isset($match)){{$match->nb_essai}}@endif">
                  </div>
                </div>

                <div class="form-floating mb-3">
                  <a href="javascript:">
                    <button data='joueurs_essai' class="btn btn-primary w-100 btn-pick-joueurs" type="button"><i class="ri-user-add-fill"></i>Selectionner</button>
                  </a>
                </div>
                 <div class="form-floating mb-3">
                    <select class="select-joueurs" multiple="" name="joueurs_essai[]" id='joueurs_essai'>
                        @if(isset($persos) && isset($joueursEssai))
                        @foreach($persos as $key => $joueur)
                        <option @if(in_array($joueur->id, $joueursEssai)) selected="" @endif value="{{$joueur->id}}">{{$joueur->nom}} {{$joueur->prenom}}</option>
                        @endforeach
                        @endif
                    </select>
                    <textarea id="nom_joueurs_essai" disabled="true" class="form-control textarea" placeholder="Nom des joueurs ayant marqués essai" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Nom des joueurs ayant marqués essai (Cliquer le bouton pour selectionner)</label>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nb Carton Jaune</label>
                  <div class="col-sm-10">
                    <input type="number" id="nb_joueurs_carton_jaune" name="nb_carton_jaune" class="form-control" value="@if(isset($match)){{$match->nb_carton_jaune}}@endif">
                  </div>
                </div>
                <div class="form-floating mb-3">
                  <a href="javascript:">
                    <button data='joueurs_carton_jaune' class="btn btn-primary w-100 btn-pick-joueurs" type="button"><i class="ri-user-add-fill"></i>Selectionner</button>
                  </a>
                </div>
                 <div class="form-floating mb-3">
                    <select class="select-joueurs" multiple="" name="joueurs_carton_jaune[]" id='joueurs_carton_jaune'>
                      @if(isset($persos) && isset($joueursCartonJaune))
                      @foreach($persos as $key => $joueur)
                      <option @if(in_array($joueur->id, $joueursCartonJaune)) selected="" @endif value="{{$joueur->id}}">{{$joueur->nom}} {{$joueur->prenom}}</option>
                      @endforeach
                      @endif
                    </select>
                    <textarea id="nom_joueurs_carton_jaune" disabled="true" class="form-control textarea" placeholder="" id="floatingTextarea">@if(isset($match)) {{$match->joueurs_essai}} @endif</textarea>
                    <label for="floatingTextarea">Nom des joueurs ayant reçu carton jaune (Cliquer le bouton pour selectionner)</label>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nb Carton Rouge</label>
                  <div class="col-sm-10">
                    <input type="number" id="nb_joueurs_carton_rouge" name="nb_carton_rouge" class="form-control" value="@if(isset($match)){{$match->nb_carton_rouge}}@endif">
                  </div>
                </div>
                <div class="form-floating mb-3">
                  <a href="javascript:">
                    <button data='joueurs_carton_rouge' class="btn btn-primary w-100 btn-pick-joueurs" type="button"><i class="ri-user-add-fill"></i>Selectionner</button>
                  </a>
                </div>
                
                 <div class="form-floating mb-3">
                     <select class="select-joueurs" multiple="" name="joueurs_carton_rouge[]" id='joueurs_carton_rouge'>
                      @if(isset($persos) && isset($joueursCartonRouge))
                      @foreach($persos as $key => $joueur)
                      <option @if(in_array($joueur->id, $joueursCartonRouge)) selected="" @endif value="{{$joueur->id}}">{{$joueur->nom}} {{$joueur->prenom}}</option>
                      @endforeach
                      @endif
                     </select>
                    <textarea id="nom_joueurs_carton_rouge" disabled="true" class="form-control textarea" placeholder="Nom des joueurs ayant marqués essai (separes par /)" id="floatingTextarea">@if(isset($match)) {{$match->joueurs_essai}} @endif</textarea>
                    <label for="floatingTextarea">Nom des joueurs ayant reçu carton rouge (Cliquer le bouton pour selectionner)</label>
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

      <div class="modal fade modal-create" data-bs-backdrop="static" id="modal-joueurs" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Joueurs</h5>
              
            </div>
            <div class="modal-body">

                <input type="hidden" id="type" name="id" value="">
                
                <div class="row mb-3">
                  <label for="inputText"  class="col-sm-6 col-form-label">Nom des joueurs</label>
                  <div class="pick-joueurs">
                   <select multiple="" id="selectpickerJoueurs" class="form-control rounded" aria-label="Selectionner Joueurs">
                      
                    </select>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-3 mr-button mr-btn">
                        <button id="valider-joueurs" class="btn btn-primary w-100" type="submit"><i class="ri-save-2-fill"></i>Valider</button>
                  </div>
                </div>
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
<script>
  
  $(document).ready(function(){
      var ClubChanged = true;
      var joueurs = '';
      $("#joueurs_essai option:selected").each(function () {
         var $this = $(this);
         if ($this.length) {
          joueurs += $this.text() + "\n";
          $('#nom_joueurs_essai').val(joueurs);
         }
      });
      var joueurs = '';
      $("#joueurs_carton_jaune option:selected").each(function () {
         var $this = $(this);
         if ($this.length) {
          joueurs += $this.text() + "\n";
          $('#nom_joueurs_carton_jaune').val(joueurs);
         }
      });

      var joueurs = '';
      $("#joueurs_carton_rouge option:selected").each(function () {
         var $this = $(this);
         if ($this.length) {
          joueurs += $this.text() + "\n";
          $('#nom_joueurs_carton_rouge').val(joueurs);
         }
      });


      $('.btn-pick-joueurs').on('click', function(){
          $('#type').val($(this).attr('data'));
          getJoueurs($('#selectpickerClub').val(), $('.club2').val(), $('#type').val(), $('#' + $('#type').val()).val()); 
          
            
      })

      $('.club').on('change', function(){
          ClubChanged = true;

      });

      $("#valider-joueurs").on('click', function(){

          if($('#selectpickerJoueurs').val().length !=  $('#nb_' + $('#type').val()).val()) {
            if($('#nb_' + $('#type').val()).val().trim() == '') {
                alert("vous devez selectionner aucun joueurs")
            }
            else alert("vous devez selectionner " + $('#nb_' + $('#type').val()).val() + " joueurs")
            return;
          }
          $('#' + $('#type').val()).val($('#selectpickerJoueurs').val());

          var selectedJoueurs = '';
          $("#selectpickerJoueurs option:selected").each(function () {
             var $this = $(this);
             if ($this.length) {
              selectedJoueurs += $this.text() + "\n";
              $('#nom_' + $('#type').val()).val(selectedJoueurs);
             }
          });
          
          $('#modal-joueurs').modal('hide');
      });
  });

  function getJoueurs(id_club1, id_club2, selectJoueursId, selectedValues = []) {
      $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "/match/joueurs",
          type : 'POST',
          data : {'id_club1' : id_club1, 'id_club2' : id_club2},
          success: function (result) {
              if(result) {
                $('#' + selectJoueursId).html(result);
                $('.pick-joueurs').html('');
                $('.pick-joueurs').html('<select multiple="" id="selectpickerJoueurs" class="form-control rounded" aria-label="Selectionner Joueurs">'+result+'</select>');
                $('#selectpickerJoueurs').val(selectedValues);
                const sorting = document.querySelector('#selectpickerJoueurs');
                const commentSorting = document.querySelector('#selectpickerJoueurs');
                const sortingchoices = new Choices(sorting, {
                  placeholder: false,
                  itemSelectText: ''
                });


                // Trick to apply your custom classes to generated dropdown menu
                let sortingClass = sorting.getAttribute('class');
                sorting.parentElement.setAttribute('class', sortingClass);
                $('#modal-joueurs').modal('show');
               
              }
              
          },
          error: function (xhr, status, error) {
              console.log(error);
              //alert('error encountered, please check connection or \n' + error);
          }
      });
    }
</script>



@endpush