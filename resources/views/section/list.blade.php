@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Section @if(isset($ligue)) de la ligue {{$ligue->nom}} : @endif<span class="total">{{$sections->total()}}</span></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Section</li>
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
                <button class="btn btn-primary w-100" type="submit"><i class="ri-add-box-fill"></i> Nouveau</button>
              </a>
            </div>
            <div class="col-md-2 mr-button mr-btn">
              <a href="{{route('section.export')}}@if(isset($ligue))?ligue_id={{$ligue->id}}@endif">
                <button class="btn btn-primary w-100" type="submit"><i class="ri-file-excel-2-fill"></i> Exporter</button>
              </a>
            </div>

            <div class="col-md-2 mr-button mr-btn">
              <a id='voir_section' @if(count($sections) > 0) href="{{route('section.club', ['id' => $sections[0]->id ])}}" @else href='javasctipt:' @endif>
                <button class="btn btn-primary w-100" type="submit"><i class="bi bi-grid"></i> Voir Clubs</button>
              </a>
            </div>
          </div>

          <!-- Table with hoverable rows -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Logo</th>
                <th scope="col">Nom</th>
                <th scope="col">Président</th>
                <th scope="col">Contact</th>
                <th scope="col">Adresse</th>
                <th scope="col">Email</th>
                <th scope="col">Facebook</th>
                <th scope="col">Observation</th>
                <th scope="col">Ligue</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($sections as $key => $section)
              <tr id="{{$section->id}}">
                <th scope="row">{{$key + 1}}
                   <input data-id="{{route('section.club', ['id' => $section->id ])}}" @if($key == 0) checked="" @endif type="checkbox" class="chk-select" name="">
                </th>
                <td>
                     <img id="td-section-logo" src="/assets/img/app/section/{{$section->logo}}" class="td-section-logo section-logo" />
                </td>
                <td>{{$section->nom}}</td>
                <td>{{$section->president}}</td>
                <td>{{$section->contact}}</td>
                <td>{{$section->adresse}}</td>
                <td>{{$section->mail_adresse}}</td>
                <td>{{$section->fb_adresse}}</td>
                <td>{{$section->observation}}</td>
                <td>@if($section->ligue) {{$section->ligue->nom}}@endif</td>
                <td><a href="{{route('section.form', ['id' => $section->id])}}" class="action-btn"><i class="ri-eye-fill"></i></a></td>
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

@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){
    $('.chk-select').on('click', function(){
        $('.chk-select').prop('checked', false);
        $(this).prop('checked', true);
        $('#voir_section').attr('href', $(this).attr('data-id')); 
    });
  });
</script>
@endpush

@endsection