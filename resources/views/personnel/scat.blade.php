@foreach($scats as $key => $categorie)
<option @if($errors->any()) @if(old('id_s_cat') == $categorie->id) selected @endif @else @if(isset($personnel) && $categorie->id==$personnel->id_s_cat) selected @else @if($key==0) selected @endif @endif  @endif value="{{$categorie->id}}">{{$categorie->designation}}</option>
@endforeach