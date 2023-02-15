@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Personnels @if(isset($club)) du club : {{$club->nom}}@endif <span class="total">Global : {{$personnels->total()}}    @if(isset($male)) M : {{$male}} F : {{$female}} @endif</span></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Personnels</li>
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
              <a href="{{route('personnel.form')}}@if(isset($club))?id_club={{$club->id}}@endif">
                <button class="btn btn-primary w-100" type="submit"><i class="ri-add-box-fill"></i> Nouveau</button>
              </a>
            </div>
            <div class="col-md-2 mr-button mr-btn">
              <form method="post" id="formLicence" action="{{route('personnel.licence.print')}}">
                  {{ csrf_field() }}
                  <input class="licences" type="hidden" name="personnels" value="[]">
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
                          
                          <form method="post" id="formDelete" action="{{route('personnel.delete')}}">
                            {{ csrf_field() }}
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <input class="licences" type="hidden" name="personnels" value="[]">
                            <button type="submit" class="btn btn-danger"><i class="ri-delete-bin-2-fill"></i> Supprimer</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
          </div>

          <!-- End Table with hoverable rows -->
          <div class="row mb-3">
            <div class="col-sm-10">
            @if(isset($query))
            {{ $personnels->appends(['query' => $query])->links() }}
            @else
            {{ $personnels->links() }}
            @endif
            </div>
          </div>

          <!-- Table with hoverable rows -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Type</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Date de naissance</th>
                <th scope="col">Sexe</th>
                <th scope="col">CIN</th>
                <th scope="col">Club</th>
                <th scope="col">Sous-Categorie</th>
                <th scope="col">Licence</th>
                <th scope="col">Passeport</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($personnels as $key => $personnel)
              <tr id="{{$personnel->id}}" class="tr-licence">
                <th scope="row">
                {{$personnels->firstItem() + $key }}
                <input type="checkbox" class="check-select" name="">
                </th>
                <td>@if($personnel->type){{$personnel->type->designation}}@endif</td>
                <td>{{$personnel->nom}}</td>
                <td>{{$personnel->prenom}}</td>
                <td>{{$personnel->date_naissance}}</td>
                <td>{{$personnel->sexe->designation}}</td>
                <td>{{$personnel->cin}}</td>
                <td>@if($personnel->club){{$personnel->club->nom}}@endif</td>
                <td>@if($personnel->scat){{$personnel->scat->designation}}@endif</td>
                <td>{{$personnel->perso_licence()}}</td>
                <td>{{$personnel->passeport}}</td>

                <td>
                  <a href="{{route('personnel.form', ['id' => $personnel->id])}}@if(isset($club))?id_club={{$club->id}}@endif" class="action-btn"><i class="ri-eye-fill"></i></a>
                  <a data-id="{{$personnel->id}}" href="javascript:" class="action-btn lc-print"><i class="ri-printer-fill"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          
          
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