@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Clubs</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Clubs</li>
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
              <a href="{{route('club.form')}}">
                <button class="btn btn-primary w-100" type="submit"><i class="ri-add-box-fill"></i> Nouveau</button>
              </a>
            </div>
          </div>

          <!-- Table with hoverable rows -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Responsable</th>
                <th scope="col">Section</th>
                <th scope="col">Contact</th>
                <th scope="col">Adresse</th>
                <th scope="col">Email</th>
                <th scope="col">Facebook</th>
                <th scope="col">Observation</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($clubs as $key => $club)
              <tr id="{{$club->id}}">
                <th scope="row">{{$key+1}}</th>
                <td>{{$club->nom}}</td>
                <td>{{$club->responsable}}</td>
                <td>@if($club->section){{$club->section->nom}}@endif</td>
                <td>{{$club->contact}}</td>
                <td>{{$club->adresse}}</td>
                <td>{{$club->mail_adresse}}</td>
                <td>{{$club->fb_adresse}}</td>
                <td>{{$club->observation}}</td>
                <td>
                  <a href="{{route('club.form', ['id' => $club->id])}}" class="action-btn"><i class="ri-eye-fill"></i></a>
                  <a target="__blank" href="{{route('club.personnels', ['id_club' => $club->id])}}" class="action-btn"><i class="bi bi-person-circle"></i></a>
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

