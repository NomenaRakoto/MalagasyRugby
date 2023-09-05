<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      


      <div class="row button-cont">
        <div class="col-md-2 mr-button mr-btn">
          <a href="javascript:">
            <button id="btn-nouvCat" class="btn btn-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#modal-scat"><i class="ri-add-box-fill"></i> Nouveau</button>
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
                          
                          <form method="post" id="formDeleteCat" action="{{route('settings.delete.cat')}}">
                            {{ csrf_field() }}
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <input class="selectedCats" type="hidden" name="cats" value="[]">
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
                </tr>
              </thead>
              <tbody>
                @foreach($cats as $key => $cat)
                <tr id="{{$cat->id}}" class="tr-cat">
                  <th scope="row"> 
                    <input type="checkbox" class="check-select" name="">
                  </th>
                  <td class="designation">{{$cat->designation}}</td>
                  <td>
                    <a href="javascript:" class="action-btn edit-cat"><i class="ri-edit-2-fill"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="modal fade modal-create" id="modal-cat" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Categorie</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  
                  <form method="POST" action="{{route('settings.cat.save')}}">
                    {{ csrf_field() }}
                    
                    <input type="hidden" id="idCat" name="id" value="">
                    
                    <div class="row mb-3">
                      <label for="inputText"  class="col-sm-2 col-form-label">Designation</label>
                      <div class="col-sm-10">
                        <input type="text" required id="designationCat" name="designation" class="form-control"
                        value="">
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-3 mr-button mr-btn">
                            <button class="btn btn-primary w-100" type="submit"><i class="ri-save-2-fill"></i> Enregistrer</button>
                      </div>
                       <div class="col-md-3 mr-button mr-btn">
                            <button class="btn btn-primary w-100" data-bs-dismiss="modal" type="button"><i class="ri-close-circle-line"></i> Annuler</button>
                      </div>
                    </div>
                  </form>
                </div>
                
              </div>
            </div>
          </div>
      </div>
      
      

    </div>
  </div>

</div>
@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
      var cats = [];
      $('.tr-cat').on('click', function(){

        if($(this).hasClass("active")) {
          $(this).removeClass('active');
          $(this).find(".check-select").prop("checked", false);
          var index = cats.indexOf($(this).attr("id"));

          cats.splice(index, 1);
        } else {
          
          $(this).addClass('active');
          $(this).find(".check-select").prop("checked", true);
          cats.push($(this).attr("id"));

        }
        $('.selectedCats').val(JSON.stringify(cats));
      });
     
      $('#btn-nouvCat').on('click', function(){
        $('#idCat').val('');
        $('#designationCat').val('');
      });

      $('.edit-cat').on('click', function(){
        $('#designationCat').val($(this).parent().parent().children('.designation').text());
        $('#idCat').val($(this).parent().parent().attr('id'));
        $('#modal-cat').modal('show');
      })
  });
</script>
@endpush