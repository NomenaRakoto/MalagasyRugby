<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      


      <div class="row button-cont">
        <div class="col-md-2 mr-button mr-btn">
          <a href="javascript:">
            <button id="btn-nouv" class="btn btn-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#modal-scat"><i class="ri-add-box-fill"></i> Nouveau</button>
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
                          
                          <form method="post" id="formDelete" action="{{route('settings.delete.scat')}}">
                            {{ csrf_field() }}
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <input class="selectedScats" type="hidden" name="scats" value="[]">
                            <button type="submit" class="btn btn-danger"><i class="ri-delete-bin-2-fill"></i> Supprimer</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
      </div>

      <!-- Table with hoverable rows -->
      <div class="row">
          <div>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Designation</th>
                  <th scope="col">Age</th>
                  <th scope="col">Categorie</th>
                  <th scope="col">Sexe</th>
                  <th scope="col">Type</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($scats as $key => $scat)
                <tr id="{{$scat->id}}" class="tr-licence">
                  <th scope="row"> 
                    <input type="checkbox" class="check-select" name="">
                  </th>
                  <td class="designation">{{$scat->designation}}</td>
                  <td class="age" min_age="{{$scat->min_age}}" max_age="{{$scat->max_age}}">{{$scat->min_age}} à {{$scat->max_age}} ans</td>
                  <td class="categorie" data-val="@if(isset($scat->categorie)){{$scat->categorie->id}}@endif">@if(isset($scat->categorie)){{$scat->categorie->designation}}@endif</td>
                  <td class="sexe" data-val="@if(isset($scat->sexe)){{$scat->sexe->id}}@endif">@if(isset($scat->sexe)){{$scat->sexe->designation}}@endif</td>
                  <td class="type" data-val="@if(isset($scat->type)){{$scat->type->id}}@endif">@if(isset($scat->type)){{$scat->type->designation}}@endif</td>
                  <td>
                    <a href="javascript:" class="action-btn edit-scat"><i class="ri-edit-2-fill"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="modal fade modal-create" id="modal-scat" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Sous-Categorie</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  
                    <form method="POST" action="{{route('settings.scat.save')}}">
                    {{ csrf_field() }}
                    
                    <input type="hidden" id="id" name="id" value="">
                    
                    <div class="row mb-3">
                      <label for="inputText"  class="col-sm-2 col-form-label">Designation</label>
                      <div class="col-sm-10">
                        <input type="text" required id="designation" name="designation" class="form-control"
                        value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Age Min</label>
                      <div class="col-sm-10">
                        <input type="number" required id="min_age" name="min_age" class="form-control" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Age Max</label>
                      <div class="col-sm-10">
                        <input type="number" required id="max_age" name="max_age" class="form-control" value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Categorie</label>
                      <div class="col-sm-10">
                        <select class="form-select" id="select-categorie" aria-label="Selectionner Categorie" name='id_cat'>
                          @foreach($cats as $key => $cat)
                          <option value="{{$cat->id}}">{{$cat->designation}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Type</label>
                      <div class="col-sm-10">
                        <select class="form-select" id="select-type" aria-label="Selectionner Type" name='id_type'>
                          @foreach($types as $key => $type)
                          <option value="{{$type->id}}">{{$type->designation}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Sexe</label>
                      <div class="col-sm-10">
                        <select class="form-select" id="select-sexe" aria-label="Selectionner Sexe" name='id_sexe'>
                          @foreach($sexes as $key => $sexe)
                          <option value="{{$sexe->id}}">{{$sexe->designation}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-3 mr-button mr-btn">
                            <button class="btn btn-primary w-100" type="submit"><i class="ri-save-2-fill"></i> Enregistrer</button>
                      </div>
                       <div class="col-md-3 mr-button mr-btn">
                            <button class="btn btn-primary w-100" data-bs-dismiss="modal" type="button"><i class="ri-close-circle-line"></i> Annuler</button>
                      </div>
                  </form>
                </div>
                
              </div>
            </div>
          </div>
          <div class="col-md-6">
              <!-- End General Form Elements -->
          </div>
      </div>
      
      

    </div>
  </div>

</div>
@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
      var scats = [];
      $('.tr-licence').on('click', function(){

        if($(this).hasClass("active")) {
          $(this).removeClass('active');
          $(this).find(".check-select").prop("checked", false);
          var index = matchs.indexOf($(this).attr("id"));

          scats.splice(index, 1);
        } else {
          
          $(this).addClass('active');
          $(this).find(".check-select").prop("checked", true);
          scats.push($(this).attr("id"));

        }
        $('.selectedScats').val(JSON.stringify(scats));
      });
     
      $('#btn-nouv').on('click', function(){
        $('#id').val('');
        $('#designation').val('');
        $('#min_age').val('');
        $('#max_age').val('');
      });

      $('.edit-scat').on('click', function(){
        $('#designation').val($(this).parent().parent().children('.designation').text());
        $('#min_age').val($(this).parent().parent().children('.age').attr('min_age'));
        $('#max_age').val($(this).parent().parent().children('.age').attr('max_age'));
        $('#select-categorie').val($(this).parent().parent().children('.categorie').attr('data-val'));
        $('#select-sexe').val($(this).parent().parent().children('.sexe').attr('data-val'));
        $('#select-type').val($(this).parent().parent().children('.type').attr('data-val'));
        $('#id').val($(this).parent().parent().attr('id'));
        $('#modal-scat').modal('show');
      })
  });
</script>
@endpush