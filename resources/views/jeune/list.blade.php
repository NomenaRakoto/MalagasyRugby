@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Jeunes <span class="total">Global : {{$jeunes->total()}}   @if(isset($male)) M : {{$male}} F : {{$female}} @endif</span></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Jeunes</li>
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
              <a href="{{route('jeune.form')}}">
                <button class="btn btn-primary w-100" type="submit"><i class="ri-add-box-fill"></i> Nouveau</button>
              </a>
            </div>
            <div class="col-md-2 mr-button mr-btn">
              <form method="post" id="formLicence" action="{{route('jeune.licence.print')}}">
                  {{ csrf_field() }}
                  <input class="licences" type="hidden" name="jeunes" value="[]">
                  <button class="btn btn-primary w-100" type="submit"><i class="ri-printer-fill"></i> Licence</button>
              </form>
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
                          
                          <form method="post" id="formDelete" action="{{route('jeune.delete')}}">
                            {{ csrf_field() }}
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <input class="licences" type="hidden" name="jeunes" value="[]">
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
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Date de naissance</th>
                <th scope="col">Club</th>
                <th scope="col">Type Club</th>
                <th scope="col">Adresse</th>
                <th scope="col">Sexe</th>
                <th scope="col">Categorie</th>
                <th scope="col">Etude</th>
                
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($jeunes as $key => $jeune)
              <tr id="{{$jeune->id}}" class="tr-licence">
                <th scope="row">
                {{$key+1}}
                <input type="checkbox" class="check-select" name="">
                </th>
                <td>{{$jeune->nom}}</td>
                <td>{{$jeune->prenom}}</td>
                <td>{{$jeune->date_naissance}}</td>
                <td>{{$jeune->association->nom}}</td>
                <td>{{$jeune->association->type_association->designation}}</td>
                <td>{{$jeune->adresse}}</td>
                <td>{{$jeune->sexe->designation}}</td>
                <td>{{$jeune->categorie->designation}}</td>
                <td>@if($jeune->etude){{$jeune->etude->designation}}@endif</td>

                <td>
                  <a href="{{route('jeune.form', ['id' => $jeune->id])}}" class="action-btn"><i class="ri-eye-fill"></i></a>
                   <a href="{{route('mutation.form')}}?id_perso={{$jeune->id}}" class="action-btn lc-print"><i class="ri-arrow-left-right-fill"></i></a>
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
      var licences = [];
      $('.lc-print').on('click', function(){
         licences = [];
         licences.push($(this).attr("data-id"));
         $('.licences').val(JSON.stringify(licences));
         $('#formLicence').submit();
      });


      $('.tr-licence').on('click', function(){
        if($(this).hasClass("active")) {
          $(this).removeClass('active');
          $(this).find(".check-select").prop("checked", false);
          var index = licences.indexOf($(this).attr("id"));
          licences.splice(index, 1);

        } else {
          $(this).addClass('active');
          $(this).find(".check-select").prop("checked", true);
          licences.push($(this).attr("id"));
        }
        $('.licences').val(JSON.stringify(licences));
      });
  });
</script>
@endpush