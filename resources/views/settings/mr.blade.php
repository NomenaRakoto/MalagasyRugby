<form method="POST" action="{{route('section.save')}}" enctype="multipart/form-data">
{{ csrf_field() }}
	<div class="row mb-3">
	  <div class="col-sm-2">
	      <img id="section-logo" src="/assets/img/malagasyrugby.jpg" class="section-logo" />
	  </div>
	  <div class="col-sm-4">
	    <input class="form-control" name="logo" type="file" id="sectionLogo" onchange="encodeImageFileBase64(this)" accept="image/*">
	  </div>
	</div>

	<div class="row mb-3">
      <label for="inputText" class="col-sm-2 col-form-label">Nom Federation</label>
      <div class="col-sm-10">
        <input type="text" name="nom_federation" class="form-control  @error('nom_federation') is-invalid @enderror" @error('nom_federation') value="{{old('nom_federation')}}" @else value="" @enderror  required>
      </div>
    </div>
    <div class="row mb-3">
      <label for="inputText" class="col-sm-2 col-form-label">Acronyme</label>
      <div class="col-sm-10">
        <input type="text" name="acronyme_federation" class="form-control  @error('acronyme_federation') is-invalid @enderror" @error('acronyme_federation') value="{{old('acronyme_federation')}}" @else value="" @enderror  required>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-2 mr-button mr-btn">
            <button class="btn btn-primary w-100" type="submit"><i class="ri-save-2-fill"></i> Enregistrer</button>
      </div>
       <div class="col-md-2 mr-button mr-btn">
          <a href="{{url()->previous()}}">
            <button class="btn btn-primary w-100" type="button"><i class="ri-close-circle-line"></i> Annuler</button>
          </a>
      </div>
     </div>
</form>
@push('scripts')
<script type="text/javascript">
  
  

  function encodeImageFileBase64(element) {
    var imagebase64 = "";
    var file = element.files[0];
    var reader = new FileReader();
    reader.onloadend = function() {
      imagebase64 = reader.result;
      $("#section-logo").attr("src", imagebase64)
    }
    reader.readAsDataURL(file);
  }

</script>
@endpush