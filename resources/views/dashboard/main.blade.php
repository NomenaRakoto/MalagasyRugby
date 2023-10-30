@extends('layouts.app')

@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
  <div class="row">
    <div class="row button-cont">
            <div class="col-md-2 mr-button mr-btn">
              <a href="{{route('stat')}}">
                <button class="btn btn-primary w-100" type="submit"><i class="ri-file-excel-2-fill"></i>Statistiques General</button>
              </a>
            </div>
          </div>
          <!-- Sales Card -->
            <div class="col-xxl-2 col-md-3">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Ligues</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-grid"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$data['ligue']}}</h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Customers Card -->
            <div class="col-xxl-2 col-md-3">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Section</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-grid"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$data['section']}}</h6>

                    </div>
                  </div>

                </div>
              </div>

            </div>

            <!-- Revenue Card -->
            <div class="col-xxl-2 col-md-3">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Clubs</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-menu-button-wide"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$data['club']}}</h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <div class="col-xxl-2 col-md-3">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Association</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-menu-button-wide"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$data['association']}}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            
            <div class="col-xxl-2 col-md-3">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">JOUEURS</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$data['joueurs']}}</h6>
                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-xxl-2 col-md-3">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">ARBITRES</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-fill-slash"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$data['arbitres']}}</h6>

                    </div>
                  </div>

                </div>
              </div>

            </div>
            <div class="col-xxl-2 col-md-3">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">EDUCATEURS</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-fill-gear"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$data['educateurs']}}</h6>

                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-xxl-2 col-md-3">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">DIRIGEANTS</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$data['dirigeants']}}</h6>

                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-xxl-2 col-md-3">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">MEDECINS</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-fill-add"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$data['medecins']}}</h6>

                    </div>
                  </div>

                </div>
              </div>

            </div>
            <div class="col-xxl-2 col-md-3">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">MUTATIONS</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-arrow-left-right-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$data['mutations']}}</h6>

                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-xxl-2 col-md-3">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">MATCHS</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bx bxs-ball"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$data['matchs']}}</h6>

                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-xxl-2 col-md-3">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">JEUNES</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{$data['jeunes']}}</h6>

                    </div>
                  </div>

                </div>
              </div>

            </div>

            
            <!-- End Customers Card -->
            

            <div class="col-4">
              <div class="card">
                <div class="card-body pb-0">
                  <h5 class="card-title">JOUEURS</h5>

                  <div id="joueurstrafficChart" style="min-height: 400px;" class="echart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      echarts.init(document.querySelector("#joueurstrafficChart")).setOption({
                        tooltip: {
                          trigger: 'item'
                        },
                        legend: {
                          top: '5%',
                          left: 'center'
                        },
                        series: [{
                          name: 'Access From',
                          type: 'pie',
                          radius: ['40%', '70%'],
                          avoidLabelOverlap: false,
                          label: {
                            show: false,
                            position: 'center'
                          },
                          emphasis: {
                            label: {
                              show: true,
                              fontSize: '18',
                              fontWeight: 'bold'
                            }
                          },
                          labelLine: {
                            show: false
                          },
                          data: [{
                              value: 1048,
                              name: 'U13'
                            },
                            {
                              value: 735,
                              name: 'U15'
                            },
                            {
                              value: 580,
                              name: 'U17'
                            },
                            {
                              value: 484,
                              name: 'U20'
                            },
                            {
                              value: 300,
                              name: 'Senior'
                            }
                          ]
                        }]
                      });
                    });
                  </script>

                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card">
                <div class="card-body pb-0">
                  <h5 class="card-title">JOUEURS</h5>

                  <div id="joueurssexetrafficChart" style="min-height: 400px;" class="echart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      echarts.init(document.querySelector("#joueurssexetrafficChart")).setOption({
                        tooltip: {
                          trigger: 'item'
                        },
                        legend: {
                          top: '5%',
                          left: 'center'
                        },
                        series: [{
                          name: 'Access From',
                          type: 'pie',
                          radius: ['40%', '70%'],
                          avoidLabelOverlap: false,
                          label: {
                            show: false,
                            position: 'center'
                          },
                          emphasis: {
                            label: {
                              show: true,
                              fontSize: '18',
                              fontWeight: 'bold'
                            }
                          },
                          labelLine: {
                            show: false
                          },
                          data: [
                            {
                              value: "{{$data['joueurs_femmes']}}",
                              name: 'Femmes'
                            },
                            {
                              value: "{{$data['joueurs_hommes']}}",
                              name: 'Hommes'
                            }
                          ]
                        }]
                      });
                    });
                  </script>

                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="card">
                <div class="card-body pb-0">
                  <h5 class="card-title">JEUNES</h5>

                  <div id="jeunestrafficChart" style="min-height: 400px;" class="echart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      echarts.init(document.querySelector("#jeunestrafficChart")).setOption({
                        tooltip: {
                          trigger: 'item'
                        },
                        legend: {
                          top: '5%',
                          left: 'center'
                        },
                        series: [{
                          name: 'Access From',
                          type: 'pie',
                          radius: ['40%', '70%'],
                          avoidLabelOverlap: false,
                          label: {
                            show: false,
                            position: 'center'
                          },
                          emphasis: {
                            label: {
                              show: true,
                              fontSize: '18',
                              fontWeight: 'bold'
                            }
                          },
                          labelLine: {
                            show: false
                          },
                          data: [
                            {
                              value: "{{$data['jeunes_femmes']}}",
                              name: 'Femmes'
                            },
                            {
                              value: "{{$data['jeunes_hommes']}}",
                              name: 'Hommes'
                            }
                          ]
                        }]
                      });
                    });
                  </script>

                </div>
              </div>
            </div>
            
  </div>
</section>
@endsection
