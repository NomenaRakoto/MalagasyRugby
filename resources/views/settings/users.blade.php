<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      


      <div class="row button-cont">
        <div class="col-md-2 mr-button mr-btn">
          <a href="javascript:">
            <button id="btn-nouvuser" class="btn btn-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#modal-user"><i class="ri-add-box-fill"></i> Nouveau</button>
          </a>
        </div>

        <div class="col-md-2 mr-btn">
                  <button class="btn btn-danger w-100" type="button" data-bs-toggle="modal" data-bs-target="#deleteuser"><i class="ri-delete-bin-2-fill"></i> Supprimer</button>
                  <div class="modal fade" id="deleteuser" tabindex="-1">
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
                          
                          <form method="post" id="formDeleteniveau" action="{{route('settings.delete.user')}}">
                            {{ csrf_field() }}
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <input class="selecteduser" type="hidden" name="users" value="[]">
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
                  <th scope="col">Login</th>
                  <th scope="col">Nom</th>
                  <th scope="col">Admin</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $key => $user)
                <tr id="{{$user->id}}" class="tr-user">
                  <th scope="row"> 
                    <input type="checkbox" class="check-select" name="">
                  </th>
                  <td class="designation">{{$user->email}}</td>
                  <td class="name">{{$user->name}}</td>
                  <td class="type">@if($user->admin) Oui @else Non @endif</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="modal fade modal-create" id="modal-user" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Utilisateur</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  
                  <form method="POST" action="{{route('settings.user.save')}}">
                    {{ csrf_field() }}
                    
                    <div class="row mb-3">
                      <label for="inputText"  class="col-sm-2 col-form-label">Login</label>
                      <div class="col-sm-10">
                        <input type="text" required id="loginuser" name="email" class="form-control"
                        value="">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputText"  class="col-sm-2 col-form-label">Nom user</label>
                      <div class="col-sm-10">
                        <input type="text" required id="nameuser" name="name" class="form-control"
                        value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="inputText"  class="col-sm-2 col-form-label">Mot de passe</label>
                      <div class="col-sm-10">
                        <input type="password" required id="password" name="password" class="form-control"
                        value="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Type Compte</label>
                      <div class="col-sm-10">
                        <select class="form-select" id="select-type" aria-label="Selectionner Type" name='admin'>
                         <option value="1">Admin</option>
                          <option value="0">Visiteur</option>
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
      var users = [];
      $('.tr-user').on('click', function(){

        if($(this).hasClass("active")) {
          $(this).removeClass('active');
          $(this).find(".check-select").prop("checked", false);
          var index = niveaus.indexOf($(this).attr("id"));

          users.splice(index, 1);
        } else {
          
          $(this).addClass('active');
          $(this).find(".check-select").prop("checked", true);
          users.push($(this).attr("id"));

        }
        $('.selecteduser').val(JSON.stringify(users));
      });
     
      $('#btn-nouvuser').on('click', function(){
        $('#login').val('');
        $('#nameuser').val('');
        $('#password').val('');
      });
  });
</script>
@endpush