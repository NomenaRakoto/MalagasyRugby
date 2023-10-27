@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Paramètres</h1>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Federation
        </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            @include('settings.mr')
        </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingCat">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCat" aria-expanded="false" aria-controls="collapseCat">
          Categories
        </button>
        </h2>
        <div id="collapseCat" class="accordion-collapse collapse" aria-labelledby="headingCat" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          @include('settings.cat')
        </div>
        </div>
      </div>
      <div class="accordion-item">
          <h2 class="accordion-header" id="headingCat">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSCat" aria-expanded="false" aria-controls="collapseSCat">
              Sous-Categories
            </button>
          </h2>
          <div id="collapseSCat" class="accordion-collapse collapse" aria-labelledby="headingCat" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              @include('settings.scat')
            </div>
          </div>
      </div>

      <div class="accordion-item">
          <h2 class="accordion-header" id="headingEtude">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEtude" aria-expanded="false" aria-controls="collapseEtude">
              Niveau d'Etude
            </button>
          </h2>
          <div id="collapseEtude" class="accordion-collapse collapse" aria-labelledby="headingEtude" data-bs-parent="#accordionExample">
            <div class="accordion-body">
              @include('settings.niveau_etude')
            </div>
          </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingCpte">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCpte" aria-expanded="false" aria-controls="collapseTwo">
          Compte utilisateurs
        </button>
        </h2>
        <div id="collapseCpte" class="accordion-collapse collapse" aria-labelledby="headingCpte" data-bs-parent="#accordionExample">
        <div class="accordion-body">
          
        </div>
        </div>
      </div>

      
    </div>


    
    

    
  </div>
</section>
@endsection
