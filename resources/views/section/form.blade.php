@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Section</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Section</li>
      <li class="breadcrumb-item active">Form</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card card-form">
            <div class="card-body">
              <h5 class="card-title">Section Information</h5>
              <!-- General Form Elements -->
              @if($errors->any())
              <div class="alert alert-danger" role="alert">
                Veuillez s'il vous plait verifier les informations saisies
              </div>
              @endif
              <form method="POST" action="{{route('section.save')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if(isset($section)) <input type="hidden" name="id" value="{{$section->id}}"> @endif
                <div class="row mb-3">
                  <div class="col-sm-2">
                      <img id="section-logo" @if(isset($section)) src="/assets/img/app/section/{{$section->logo}}" @else src="/assets/img/app/section/defaultlogosection.jpg" @endif class="section-logo" />
                  </div>
                  <div class="col-sm-4">
                    <input class="form-control" name="logo" type="file" id="sectionLogo" onchange="encodeImageFileBase64(this)" accept="image/*">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nom</label>
                  <div class="col-sm-10">
                    <input type="text" name="nom" class="form-control  @error('nom') is-invalid @enderror" @error('nom') value="{{old('nom')}}" @else value="@if(isset($section)) {{$section->nom}} @endif" @enderror  required>
                    @error('nom')
                    <div class="danger inp-error text-danger">{{$message}}</div>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Ligue</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Selectionner Ligue" name='id_ligue'>
                      @foreach($ligues as $key => $ligue)
                      <option @if(isset($section) && $ligue->id==$section->ligue->id) selected @else @if($key==0) selected @endif  @endif value="{{$ligue->id}}">{{$ligue->nom}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Président</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="president" value="@if(isset($section)) {{$section->president}} @endif" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Contact</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="contact" value="@if(isset($section)) {{$section->contact}} @endif">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Adresse</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="adresse" value="@if(isset($section)) {{$section->adresse}} @endif">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Adresse Mail</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control @error('mail_adresse') is-invalid @enderror" name="mail_adresse" 
                    @error('mail_adresse') value="{{old('mail_adresse')}}" @else  value="@if(isset($section)) {{$section->mail_adresse}} @endif" @enderror >
                    @error('mail_adresse')
                    <div class="danger inp-error text-danger">{{$message}}</div>
                    @enderror
                  </div>

                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Facebook</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="fb_adresse" value="@if(isset($section)) {{$section->fb_adresse}} @endif">
                  </div>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control textarea" name="observation" placeholder="Votre Observation" id="floatingTextarea">@if(isset($section)) {{$section->observation}} @endif</textarea>
                    <label for="floatingTextarea">Observation</label>
                </div>
                
                <div class="row">
                  <div class="col-md-3 mr-button mr-btn">
                        <button class="btn btn-primary w-100" type="submit"><i class="ri-save-2-fill"></i> Enregistrer</button>
                  </div>
                  @if(isset($section))
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
                          Voulez vous vraiment supprimer {{$section->nom}}? 
                          <br>Attention : Cette action est irreversible
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                          <a href="{{route('section.delete', ['id' => $section->id])}}">
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
    @push('scripts')
    <script type="text/javascript">
        
        

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
@endsection