@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Ligues <span class="total">{{$ligues->total()}}</span></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Ligues</li>
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
              <a href="{{route('ligue.form')}}">
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
                <th scope="col">Président</th>
                <th scope="col">Vice-président</th>
                <th scope="col">Ctr</th>
                <th scope="col">Contact</th>
                <th scope="col">Adresse</th>
                <th scope="col">Email</th>
                <th scope="col">Facebook</th>
                <th scope="col">Observation</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($ligues as $key => $ligue)
              <tr id="{{$ligue->id}}">
                <th scope="row">{{$key+1}}</th>
                <td>{{$ligue->nom}}</td>
                <td>{{$ligue->president}}</td>
                <td>{{$ligue->vpresident}}</td>
                <td>{{$ligue->ctr}}</td>
                <td>{{$ligue->contact}}</td>
                <td>{{$ligue->adresse}}</td>
                <td>{{$ligue->mail_adresse}}</td>
                <td>{{$ligue->fb_adresse}}</td>
                <td>{{$ligue->observation}}</td>
                <td><a href="{{route('ligue.form', ['id' => $ligue->id])}}" class="action-btn"><i class="ri-eye-fill"></i></a></td>
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