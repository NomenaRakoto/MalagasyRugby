@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Jeunes</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Jeunes</li>
      <li class="breadcrumb-item active">Form</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card card-form">
            <div class="card-body">
              <h5 class="card-title">Jeune Information</h5>
              <!-- General Form Elements -->
              @if($errors->any())
              <div class="alert alert-danger" role="alert">
                Veuillez s'il vous plait verifier les informations saisies
              </div>
              @endif
              <form method="POST" action="{{route('jeune.save')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if(isset($jeune)) <input type="hidden" name="id" value="{{$jeune->id}}"> @endif
                <div class="row mb-3">
                  <div class="col-sm-2">
                      <img id="section-logo" @if(isset($jeune)) src="/assets/img/app/jeunes/{{$jeune->identification}}" @else src="/assets/img/app/jeunes/pdp.jpg" @endif class="section-logo" />
                  </div>
                  <div class="col-sm-4">
                    <input class="form-control" name="identification" type="file" id="photo" onchange="encodeImageFileBase64(this)" accept="image/*">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nom</label>
                  <div class="col-sm-10">
                    <input type="text" name="nom" class="form-control  @error('nom') is-invalid @enderror"
                    @if($errors->any())  value="{{old('nom')}}" @else value="@if(isset($jeune)) {{$jeune->nom}} @endif" @endif  required>
                    @error('nom')
                    <div class="danger inp-error text-danger">{{$message}}</div>
                    @enderror
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">prenom</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="prenom"  @if($errors->any())  value="{{old('prenom')}}" @else value="@if(isset($jeune)) {{$jeune->prenom}} @endif" @endif>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Date de naissance</label>
                  <div class="col-sm-10">
                    <input type="date" name="date_naissance"  @if($errors->any())  value="{{old('date_naissance')}}" @else value="@if(isset($jeune)){{$jeune->date_naissance}}@endif" @endif class="form-control">
                  </div>
                  @error('nom')
                  <div class="danger inp-error text-danger">{{$message}}</div>
                  @enderror
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Sexe</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Selectionner Sexe" name='id_sexe'>
                      @foreach($sexes as $key => $sexe)
                      <option @if($errors->any()) @if(old('id_sexe') == $sexe->id) selected @endif @else @if(isset($jeune) && $sexe->id==$jeune->sexe->id) selected @else @if($key==0) selected @endif @endif  @endif value="{{$sexe->id}}">{{$sexe->designation}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Categorie</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Selectionner Categorie" name='id_cat'>
                      @foreach($categories as $key => $categorie)
                      <option @if($errors->any()) @if(old('id_categorie') == $categorie->id) selected @endif @else @if(isset($jeune) && $categorie->id==$jeune->categorie->id) selected @else @if($key==0) selected @endif @endif  @endif value="{{$categorie->id}}">{{$categorie->designation}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Association | Etablissement</label>
                  <div class="col-sm-10">
                    <select class="selectpicker form-control rounded" aria-label="Selectionner Association | Etablissement" name='id_club'>
                      @foreach($associations as $key => $association)
                      <option @if($errors->any()) @if(old('id_association') == $association->id) selected @endif @else @if(isset($jeune) && $association->id==$jeune->association->id) selected @else @if($key==0) selected @endif @endif  @endif value="{{$association->id}}">{{$association->nom}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Etude</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Selectionner Etude" name='id_etude'>
                      <option></option>
                      @foreach($etudes as $key => $etude)
                      <option @if($errors->any()) @if(old('id_etude') == $etude->id) selected @endif @else @if(isset($jeune) && $etude->id==$jeune->etude->id) selected @else @if($key==0) selected @endif @endif  @endif value="{{$etude->id}}">{{$etude->designation}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Adresse</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="adresse"  @if($errors->any())  value="{{old('nom')}}" @else value="@if(isset($jeune)) {{$jeune->adresse}} @endif" @endif>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Père</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="pere"  @if($errors->any())  value="{{old('nom')}}" @else value="@if(isset($jeune)) {{$jeune->pere}} @endif" @endif>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Mère</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="mere"  @if($errors->any())  value="{{old('nom')}}" @else value="@if(isset($jeune)) {{$jeune->mere}} @endif" @endif>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-3 mr-button mr-btn">
                        <button class="btn btn-primary w-100" type="submit"><i class="ri-save-2-fill"></i> Enregistrer</button>
                  </div>
                  @if(isset($jeune))
                  <div class="col-md-3 mr-btn">
                        <button class="btn btn-danger w-100" type="button" data-bs-toggle="modal" data-bs-target="#verticalycentered"><i class="ri-delete-bin-2-fill"></i> Supprimer</button>
                  </div>

                  @endif

                   <div class="col-md-3 mr-button mr-btn">
                      <a href="{{route('jeune.list')}}">
                        <button class="btn btn-primary w-100" type="button"><i class="ri-close-circle-line"></i> Annuler</button>
                      </a>
                  </div>
              </form><!-- End General Form Elements -->
              @if(isset($jeune))
              <div class="modal fade" id="verticalycentered" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Confirmation suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        
                        Voulez vous vraiment supprimer {{$jeune->nom}}? 
                        <br>Attention : Cette action est irreversible
                      </div>
                      <div class="modal-footer">
                        
                        <form method="post" id="formDelete" action="{{route('jeune.delete')}}">
                          {{ csrf_field() }}
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                          <input id="licences" type="hidden" name="jeunes" value="[{{$jeune->id}}]">
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
</script>
@endpush