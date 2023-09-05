@foreach($persos as $key => $perso)
<option value="{{$perso->id}}">{{$perso->nom}} {{$perso->prenom}}</option>
@endforeach