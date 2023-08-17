@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Mutations <span class="total">{{$mutations->total()}}</span></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Mutation</li>
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
              <a href="{{route('section.form')}}">
                <button class="btn btn-primary w-100" type="submit"><i class="ri-file-excel-2-fill"></i>Exporter</button>
              </a>
            </div>
          </div>

          <!-- Table with hoverable rows -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Nom Joueurs</th>
                <th scope="col">Categories</th>
                <th scope="col">Club de depart</th>
                <th scope="col">Transferé à</th>
                <th scope="col">Motif de transfert</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($mutations as $key => $mutation)
              <tr id="{{$mutation->id}}">
                <th scope="row">{{$mutations->lastItem() + $key + 1}}</th>
                <td>{{$mutation->date_mutation}}</td>
                <td>{{$mutation->joueur->nom}} {{$mutation->joueur->prenom}} </td>
                <td>{{$mutation->joueur->scat->designation}}</td>
                <td>{{$mutation->club_depart->nom}} </td>
                <td>{{$mutation->club_arrive->nom}} </td>
                <td>{{$mutation->motif}} </td>
                <td>
                  <a href="{{route('mutation.form', ['id' => $mutation->id])}}" class="action-btn"><i class="ri-eye-fill"></i></a>
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