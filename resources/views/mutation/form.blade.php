@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>mutation</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Mutation</li>
      <li class="breadcrumb-item active">Form</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card card-form">
            <div class="card-body">
              <h5 class="card-title">Mutation Information</h5>
              <!-- General Form Elements -->
              @if($errors->any())
              <div class="alert alert-danger" role="alert">
                Veuillez s'il vous plait verifier les informations saisies
              </div>
              @endif
              <form method="POST" action="{{route('mutation.save')}}">
                {{ csrf_field() }}
                @if(isset($mutation)) 
                <input type="hidden" name="id" value="{{$mutation->id}}"> 
                <input type="hidden" name="id_joueur" value="{{$mutation->id_joueur}}">
                @else
                <input type="hidden" name="id_joueur" value="{{$personnel->id}}">
                @endif
                
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nom du joueur</label>
                  <div class="col-sm-10">
                    <input type="text" id="nom" disabled='true' class="form-control"
                    value="@if(isset($mutation)) {{$mutation->joueur->nom}} {{$mutation->joueur->prenom}} @else {{$personnel->nom}} {{$personnel->prenom}} @endif">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Date Mutation</label>
                  <div class="col-sm-10">
                    <input type="date" name="date_mutation"  @if($errors->any())  value="{{old('date_mutation')}}" @else value="@if(isset($mutation)){{$mutation->date_mutation}}@endif" @endif class="form-control">
                  </div>
                  @error('date_mutation')
                  <div class="danger inp-error text-danger">{{$message}}</div>
                  @enderror
                </div>



                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Club/Association Actuel</label>
                  <div class="col-sm-10">
                    <select disabled="" class="form-control rounded" aria-label="Selectionner Club" name='id_ancien_club'>
                      @if(isset($mutation))
                      <option value="{{$mutation->club_depart->id}}">{{$mutation->club_depart->nom}}</option>
                      @else
                      <option value="{{$personnel->club->id}}">{{$personnel->club->nom}}</option>
                      @endif
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Transferer à</label>
                  <div class="col-sm-10">
                    <select id='selectpicker' class="selectpicker form-control rounded" aria-label="Selectionner Club" name='id_new_club'>
                      @foreach($clubs as $key => $club)
                      <option @if($errors->any()) @if(old('id_new_club') == $club->id) selected @endif @else @if(isset($mutation) && $mutation->club_arrive->id==$club->id) selected  @elseif($key==0) selected @endif  @endif value="{{$club->id}}">{{$club->nom}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control textarea" name="motif" placeholder="Motifs du transfert" id="floatingTextarea">@if(isset($mutation)) {{$mutation->motif}} @endif</textarea>
                    <label for="floatingTextarea">Motifs</label>
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
<script>
  
  const sorting = document.querySelector('#selectpicker');
  const commentSorting = document.querySelector('#selectpicker');
  const sortingchoices = new Choices(sorting, {
    placeholder: false,
    itemSelectText: ''
  });


  // Trick to apply your custom classes to generated dropdown menu
  let sortingClass = sorting.getAttribute('class');
  window.onload= function () {
    sorting.parentElement.setAttribute('class', sortingClass);
  }

</script>
@endpush