@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Associations | Etablissements</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Associations | Etablissements</li>
      <li class="breadcrumb-item active">Liste</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    

    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row button-cont">
            <div class="col-md-2 mr-button mr-btn">
              <a href="{{route('association.form')}}">
                <button class="btn btn-primary w-100" type="submit"><i class="ri-add-box-fill"></i> Nouveau</button>
              </a>
            </div>
          </div>

          <!-- Table with hoverable rows -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Type</th>
                <th scope="col">Nom</th>
                <th scope="col">Responsable</th>
                <th scope="col">Region</th>
                <th scope="col">Contact</th>
                <th scope="col">Adresse</th>
                <th scope="col">Email</th>
                <th scope="col">Facebook</th>
                <th scope="col">Observation</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($associations as $key => $association)
              <tr id="{{$association->id}}">
                <th scope="row">{{$key+1}}</th>
                <td>{{$association->type}}</td>
                <td>{{$association->nom}}</td>
                <td>{{$association->responsable}}</td>
                <td>{{$association->region->nom}}</td>
                <td>{{$association->contact}}</td>
                <td>{{$association->adresse}}</td>
                <td>{{$association->mail_adresse}}</td>
                <td>{{$association->fb_adresse}}</td>
                <td>{{$association->observation}}</td>
                <td>
                  <a href="{{route('association.form', ['id' => $association->id])}}" class="action-btn"><i class="ri-eye-fill"></i></a>
                  <a href="{{route('association.form', ['id' => $association->id])}}" class="action-btn"><i class="bi bi-person-circle"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <!-- End Table with hoverable rows -->

        </div>
      </div>

    </div>
  </div>
</section>
@endsection