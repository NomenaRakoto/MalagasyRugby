<!DOCTYPE html>
<html>
    <head>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

          <title>MR</title>
          <meta content="" name="description">
          <meta content="" name="keywords">

          <!-- Favicons -->
          <link href="/assets/img/malagasyrugby.png" rel="icon">
          <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

          
          <!-- Vendor CSS Files -->
          <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
          <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
          <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
          <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
          <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
          <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
          <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">

          <!-- Template Main CSS File -->
          <link href="/assets/css/style.css" rel="stylesheet">

          
    </head>

    <body>
            <section class="section">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card card-licence">
                      <div class="card-body">
                          <div class="row">
                              @if(isset($persos))
                              @foreach($persos as $key => $perso)
                              <table width="519" cellspacing="0" cellpadding="0" border="1" class="licence">
                                  <tbody>
                                      <tr class="head">
                                          <td width="81" valign="top" class="img-head td-logo">
                                              <div>
                                                  <img
                                                      src="/assets/img/qrcode.png"
                                                      alt="SectionLogo"
                                                  />
                                              </div>
                                          </td>
                                          <td colspan="7" width="357" valign="top" class="lc-title center">
                                              <div>
                                                  <img
                                                      src="/assets/img/title_fmr.png"
                                                      width="339"
                                                      height="52"
                                                  />
                                              </div>
                                          </td>
                                          <td width="81" valign="top" class="img-head td-logo">
                                              <div>
                                                  <img
                                                      src="/assets/img/app/section/{{$perso->club->section->logo}}"
                                                      alt="SectionLogo"
                                                  />
                                              </div>
                                          </td>
                                      </tr>
                                      <tr class="bord-bottom tr-info">
                                          <td colspan="9" width="519" valign="top">
                                              <div>
                                                  <span class="txt-info">LIGUE : @if($perso->club && $perso->club->section && $perso->club->section->ligue ) {{$perso->club->section->ligue->nom}}@endif</span> 
                                                  <span class="txt-info">SECTION : @if($perso->club && $perso->club->section){{$perso->club->section->nom}}@endif</span> 
                                                  <span class="txt-info">N° LICENCE : <strong>{{$perso->perso_licence()}}</strong></span>
                                              </div>
                                              <div>
                                                  <span class="txt-info">CLUB : @if($perso->club){{$perso->club->nom}}@endif</span>
                                                  <span class="txt-info">Sous-Catégorie : @if($perso->scat){{$perso->scat->designation}}@endif</span>
                                              </div>
                                              <div>
                                                  <span class="txt-info">Format du Jeu : @if($perso->format_jeu){{$perso->format_jeu->designation}}@endif</span>
                                                  <span class="txt-info">POSITION DU JEU : @if($perso->position_jeu){{$perso->position_jeu->designation}}@endif</span> 
                                                  <span class="txt-info">Règle 8 : @if($perso->statut_regle){{$perso->statut_regle->designation}}@endif</span>
                                              </div>
                                          </td>
                                      </tr>
                                      <tr class="bord-bottom td-title">
                                          <td class="s-title" colspan="2" width="223" valign="center">
                                              <div align="center">
                                                  <strong>INFO-PERSO</strong>
                                              </div>
                                          </td>
                                          <td class="s-title center" colspan="2" width="223" valign="center">
                                              <div align="center">
                                                  2023
                                              </div>
                                          </td>
                                          <td class="s-title" colspan="4" width="223" valign="center">
                                              <div>
                                                  IMPRESSION : {{date("m/d/Y")}}
                                              </div>
                                          </td>
                                      </tr>
                                      <tr class="bord-bottom">
                                          <td class="bord-right td-img"  >
                                                  <img class="img-lc" 
                                                      src="/assets/img/app/personnels/{{$perso->identification}}"
                                                      alt="Title: ImageLicence"
                                                  />
                                          </td>
                                          <td colspan="7" width="409" valign="top">
                                              <div>
                                                  <span class="info-perso">NOM : {{$perso->nom}}</span>
                                                  <span class="info-perso">PRENOMS : {{$perso->prenom}}</span>
                                              </div>
                                              <div>
                                                  <span class="info-perso">Né(e) le : {{$perso->date_naissance}}</span> 
                                                  <span class="info-perso">CIN : {{$perso->cin}}</span>
                                              </div>
                                              <div>
                                                  <span class="info-perso">N° PASSEPORT : {{$perso->passeport}}</span> 
                                                  <span class="info-perso">SEXE : {{$perso->sexe->designation}}</span>
                                              </div>
                                              <div>
                                                  <span class="info-perso">TYPE : @if($perso->type){{$perso->type->designation}}@endif</span>
                                              </div>
                                          </td>
                                      </tr>
                                      <tr class="bord-bottom lc-txt">
                                          <td class="bord-right" colspan="7" width="403" valign="top">
                                              <div align="center">
                                                  Ny tompon’ny kara-pilalaovana dia tsy
                                                  maintsy manaja manontolo ny rafitra mifehy
                                                  ny Malagasy Rugby. Tsy maintsy mahalala ny
                                                  amin’ny antsipirihany izay voalazan’ny
                                                  fiantohana
                                              </div>
                                          </td>
                                          <td class="center" colspan="2" width="116" valign="top">
                                              <div align="center">
                                                  <strong>
                                                      <em><u>Sonian’ny tompony</u></em>
                                                  </strong>
                                              </div>
                                          </td>
                                      </tr>
                                      <tr class="center" height="80px">
                                          <td  colspan="2" width="111" valign="top">
                                              <div>
                                                  <strong>
                                                      <em><u>VISA ASSURANCE</u></em>
                                                  </strong>
                                              </div>
                                          </td>
                                          <td class="bord-left" colspan="2" width="136" valign="top">
                                              <div>
                                                  <strong>
                                                      <em><u> VISA MEDECIN</u></em>
                                                  </strong>
                                              </div>
                                          </td>
                                          <td class="bord-left" colspan="2" width="137" valign="top">
                                              <div align="center">
                                                  <strong>
                                                      <em><u>VISA SECTION/LIGUE</u></em>
                                                  </strong>
                                              </div>
                                          </td>
                                          <td class="bord-left" colspan="3" width="136" valign="top">
                                              <div align="center">
                                                  <strong>
                                                      <em><u>VISA FEDERATION</u></em>
                                                  </strong>
                                              </div>
                                          </td>
                                      </tr>
                                      
                                  </tbody>
                              </table>
                              @endforeach
                              @endif

                              @if(isset($jeunes))
                              @foreach($jeunes as $key => $jeune)
                              <table width="519" cellspacing="0" cellpadding="0" border="1" class="licence">
                                  <tbody>
                                      <tr class="head">
                                          <td width="81" valign="top" class="img-head td-logo">
                                              <div>
                                                  <img
                                                      src="/assets/img/qrcode.png"
                                                      alt="SectionLogo"
                                                  />
                                              </div>
                                          </td>
                                          <td colspan="7" width="357" valign="top" class="lc-title center">
                                              <div>
                                                  <img
                                                      src="/assets/img/title_fmr.png"
                                                      width="339"
                                                      height="52"
                                                  />
                                              </div>
                                          </td>
                                          <td width="81" valign="top" class="img-head td-logo">
                                              <div>
                                                  
                                              </div>
                                          </td>
                                      </tr>
                                      <tr class="bord-bottom tr-info">
                                          <td colspan="9" width="519" valign="top">
                                              <div>
                                                  <span class="txt-info">REGION : {{$jeune->association->region->nom}}</span> 
                                                  <!-- <span class="txt-info">N° LICENCE : <strong>{{$jeune->licence}}</strong></span> -->
                                              </div>
                                              <div>
                                                  <span class="txt-info">
                                                    @if($jeune->association->type == "Etablissement")
                                                    Etablissemet : {{$jeune->association->nom}}
                                                    @else
                                                    Association : {{$jeune->association->nom}}
                                                    @endif
                                                  </span>
                                                  <span class="txt-info">Catégorie : {{$jeune->categorie->designation}}</span>
                                                  @if($jeune->association->type == "Etablissement")
                                                  <span class="txt-info">Niveau d'étude : {{$jeune->etude->designation}}</span> 
                                                  @endif
                                              </div>
                                          </td>
                                      </tr>
                                      <tr class="bord-bottom td-title">
                                          <td class="s-title" colspan="2" width="223" valign="center">
                                              <div align="center">
                                                  <strong>INFO-PERSO</strong>
                                              </div>
                                          </td>
                                          <td class="s-title center" colspan="2" width="223" valign="center">
                                              <div align="center">
                                                  2023
                                              </div>
                                          </td>
                                          <td class="s-title" colspan="4" width="223" valign="center">
                                              <div>
                                                  IMPRESSION : {{date("m/d/Y")}}
                                              </div>
                                          </td>
                                      </tr>
                                      <tr class="bord-bottom">
                                          <td class="bord-right td-img"  >
                                                  <img class="img-lc" 
                                                      src="/assets/img/app/jeunes/{{$jeune->photo}}"
                                                      alt="Title: ImageLicence"
                                                  />
                                          </td>
                                          <td colspan="7" width="409" valign="top">
                                              <div>
                                                  <span class="info-perso">NOM : {{$jeune->nom}}</span>
                                                  <span class="info-perso">PRENOMS : {{$jeune->prenom}}</span>
                                              </div>
                                              <div>
                                                  <span class="info-perso">Né(e) le : {{date("d/m/Y",strtotime($jeune->date_naissance))}}</span> 
                                                  <span class="info-perso">SEXE : {{$jeune->sexe->designation}}</span>
                                                  
                                              </div>
                                              <div>
                                                  <span class="info-perso">Père  : {{$jeune->pere}}</span> 
                                                  <span class="info-perso">Mère : {{$jeune->mere}}</span>
                                              </div>
                                              <div>
                                                  <span class="info-perso">TYPE : JEUNE</span>
                                              </div>
                                          </td>
                                      </tr>
                                      <tr class="bord-bottom lc-txt">
                                          <td class="bord-right" colspan="7" width="403" valign="top">
                                              <div align="center">
                                                  Ny tompon’ny kara-pilalaovana dia tsy
                                                  maintsy manaja manontolo ny rafitra mifehy
                                                  ny Malagasy Rugby. Tsy maintsy mahalala ny
                                                  amin’ny antsipirihany izay voalazan’ny
                                                  fiantohana
                                              </div>
                                          </td>
                                          <td class="center" colspan="2" width="116" valign="top">
                                              <div align="center">
                                                  <strong>
                                                      <em><u>Sonian’ny tompony</u></em>
                                                  </strong>
                                              </div>
                                          </td>
                                      </tr>
                                      <tr class="center" height="80px">
                                          <td  colspan="2" width="111" valign="top">
                                              <div>
                                                  <strong>
                                                      <em><u>VISA ASSURANCE</u></em>
                                                  </strong>
                                              </div>
                                          </td>
                                          <td class="bord-left" colspan="2" width="136" valign="top">
                                              <div>
                                                  <strong>
                                                      <em><u> VISA MEDECIN</u></em>
                                                  </strong>
                                              </div>
                                          </td>
                                          <td class="bord-left" colspan="2" width="137" valign="top">
                                              <div align="center">
                                                  <strong>
                                                      <em><u>VISA SECTION/LIGUE</u></em>
                                                  </strong>
                                              </div>
                                          </td>
                                          <td class="bord-left" colspan="3" width="136" valign="top">
                                              <div align="center">
                                                  <strong>
                                                      <em><u>VISA FEDERATION</u></em>
                                                  </strong>
                                              </div>
                                          </td>
                                      </tr>
                                      
                                  </tbody>
                              </table>
                              @endforeach
                              @endif
                          </div>


                         

                          


                          
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <style type="text/css">

                  .s-title.center
                  {
                    border-right: solid 1px black;
                    border-left: solid 1px black;
                    min-width: 223px;
                  }
                  .s-title
                  {
                    text-align: center;
                  }
                  .txt-info
                  {
                    margin-left: 15px;
                    margin-right: 20px;
                    display: inline-block;
                    width: 180px;
                    vertical-align: top;
                    margin-top: 5px;
                  }

                  .info-perso
                  {
                    margin-left: 15px;
                    margin-right: 20px;
                    width: 200px;
                    display: inline-block;
                    vertical-align: top;
                    margin-top: 5px;
                  }
                  .tr-info
                  {
                    height: 75px;
                  }
                  .td-title
                  {
                    height: 25px;
                  }
                  .lc-txt
                  {
                    height: 60px;
                  }
                  

                  .td-logo
                  {
                    padding: 0;
                    width: 80px;
                    height: 80px;
                  }

                  .td-logo img
                  {
                    display: block;
                    width: 80px;
                    height: 80px;
                    max-width: 80px;
                    max-height: 80px;
                  }

                  .td-img
                  {
                    padding: 0;
                    width: 100px;
                    height: 100px;
                  }

                  .td-img img
                  {
                    display: block;
                    width: 100%;
                    height: 100%;
                    max-width: 100%;
                    max-height: 100%;
                  }
                  p
                  {
                    margin-bottom: 5px;
                  }
                  .card-licence
                  {
                     width : 1400px;
                     margin: auto;
                  }

                  .licence {
                    max-height: 455px;
                    width: 672px;
                    margin-top: 20px;
                    margin-right: 15px;
                  }

                  .head {
                    height: 80px;
                    border-bottom: solid 1px black;

                  }

                  .bord-bottom {
                    border-bottom: solid 1px black;
                  }

                  .lc-title {
                    border-right: solid 1px black;
                    border-left: solid 1px black;
                  }

                  .bord-left {
                    border-left: solid 1px black;
                  }

                  .bord-right {
                    border-right: solid 1px black;
                  }

                  .center {
                    text-align: center;
                  }

                  .licence {
                    font-size: 0.8em;
                  }

                  .img-lc
                  {
                    width: 50px;
                    height: 100%;
                  }
              </style>

              
    </body>
</html>
