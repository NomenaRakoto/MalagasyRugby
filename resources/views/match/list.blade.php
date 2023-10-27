@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Matchs <span class="total">{{$matchs->total()}}</span></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">match</li>
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
              <a href="{{route('match.form')}}">
                <button class="btn btn-primary w-100" type="submit"><i class="ri-add-box-fill"></i> Nouveau</button>
              </a>
            </div>
            <div class="col-md-2 mr-button mr-btn">
              <a href="{{route('match.export')}}">
                <button class="btn btn-primary w-100" type="submit"><i class="ri-file-excel-2-fill"></i>Exporter</button>
              </a>
            </div>
            <div class="col-md-2 mr-btn">
                  <button class="btn btn-danger w-100" type="button" data-bs-toggle="modal" data-bs-target="#verticalycentered"><i class="ri-delete-bin-2-fill"></i> Supprimer</button>
                  <div class="modal fade" id="verticalycentered" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Confirmation suppression</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          
                          Voulez vous vraiment supprimer? 
                          <br>Attention : Cette action est irreversible
                        </div>
                        <div class="modal-footer">
                          
                          <form method="post" id="formDelete" action="{{route('match.delete')}}">
                            {{ csrf_field() }}
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <input class="selectedMatch" type="hidden" name="matchs" value="[]">
                            <button type="submit" class="btn btn-danger"><i class="ri-delete-bin-2-fill"></i> Supprimer</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>

          <!-- Table with hoverable rows -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Date du match</th>
                <th scope="col">Terrain</th>
                <th scope="col">Categories</th>
                <th scope="col">Clubs</th>
                <th scope="col">Details du Match</th>
                <th scope="col">Blessures</th>
                <th scope="col">Commotion cerebrale</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($matchs as $key => $match)
              <tr id="{{$match->id}}" class="tr-licence">
                <th scope="row">{{$matchs->lastItem() + $key}} 
                  <input type="checkbox" class="check-select" name="">
                </th>
                <td>{{$match->date_match}} à {{$match->heure}}</td>
                <td>{{$match->terrain}}</td>
                <td>{{$match->categorie->designation}}</td>
                <td>{{$match->club_home->nom}}<br>VS<br>{{$match->club_guest->nom}}</td>
                <td>
                  Nb Essai : {{$match->nb_essai}}<br>
                  Nb Carton Jaune : {{$match->nb_carton_jaune}}<br>
                  Nb Carton Rouge : {{$match->nb_carton_rouge}}<br>
                  Bonus Offensive : {{$match->bonus_offensive}}<br> 
                  Bonus Defensive : {{$match->bonus_defensive}}<br> 
                </td>
                <td>{{$match->nb_blessure}} </td>
                <td>{{$match->commotion_cerebrale}} </td>
                <td>
                  <a href="{{route('match.form', ['id' => $match->id])}}" class="action-btn"><i class="ri-eye-fill"></i></a>
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
@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
      var matchs = [];
      $('.tr-licence').on('click', function(){
        if($(this).hasClass("active")) {
          $(this).removeClass('active');
          $(this).find(".check-select").prop("checked", false);
          var index = matchs.indexOf($(this).attr("id"));

          matchs.splice(index, 1);
        } else {
          $(this).addClass('active');
          $(this).find(".check-select").prop("checked", true);
          matchs.push($(this).attr("id"));
        }
        $('.selectedMatch').val(JSON.stringify(matchs));
      });
  });
</script>
@endpush