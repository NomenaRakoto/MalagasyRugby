<!DOCTYPE html>
<html>
    <head>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

          <title>MR</title>
          <meta content="" name="description">
          <meta content="" name="keywords">

          <!-- Favicons -->
          <link href="/assets/img/malagasyrugby.png" rel="icon">

          
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
                              <div class="lc-div">
                                <table width="519" cellspacing="0" cellpadding="0" border="1" class="licence @if($key%2 == 0) impaire @endif">
                                    <tbody>
                                        <tr class="head bord-top bord-left bord-right">
                                            <td width="81" valign="top" class="img-head td-logo ">
                                                <div>
                                                    <img
                                                        src="/assets/img/qrcode.png"
                                                        alt="SectionLogo"
                                                    />
                                                </div>
                                            </td>
                                            <td colspan="7" width="357" valign="top" class="lc-title center no-left">
                                                <div>
                                                    <img
                                                        src="/assets/img/title_fmr.png"
                                                        width="400"
                                                        height="72"
                                                    />
                                                </div>
                                            </td>
                                            <td width="81" valign="top" class="img-head td-logo no-left">
                                                <div>
                                                    <img
                                                        src="/assets/img/app/section/{{$perso->club->section->logo}}"
                                                        alt="SectionLogo"
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="bord-bottom tr-info">
                                            <td class="no-top" colspan="9" width="519" valign="top">
                                                <div>
                                                    <span class="txt-info">LIGUE : @if($perso->club && $perso->club->section && $perso->club->section->ligue ) {{Str::limit($perso->club->section->ligue->nom, 75)}}@endif</span> 
                                                    <span class="txt-info">SECTION : @if($perso->club && $perso->club->section){{Str::limit($perso->club->section->nom, 75)}}@endif</span> 
                                                    <span class="txt-info num_licence">N° LICENCE : <strong>{{$perso->perso_licence()}}</strong></span>
                                                </div>
                                                <div>
                                                    <span class="txt-info">CLUB : @if($perso->club){{Str::limit($perso->club->nom, 75)}}@endif</span>
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
                                            <td class="s-title no-top" colspan="2" width="223" valign="center">
                                                <div align="center">
                                                    <strong>INFO-PERSO</strong>
                                                </div>
                                            </td>
                                            <td class="s-title center no-top no-left" colspan="2" width="223" valign="center">
                                                <div align="center">
                                                    2023
                                                </div>
                                            </td>
                                            <td class="s-title no-top no-left" colspan="6" width="223" valign="center">
                                                <div>
                                                    IMPRESSION : {{date("m/d/Y")}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="bord-bottom">
                                            <td class="bord-right td-img no-top photo-td"  >
                                                    <img class="img-lc" 
                                                        src="/assets/img/app/personnels/{{$perso->identification}}"
                                                        alt="Title: ImageLicence"
                                                    />

                                                    <img class="rugbyLogo" 
                                                        src="/assets/img/malagasyrugby.png"
                                                        alt="rugbyLogo"
                                                    />
                                            </td>
                                            <td class="no-top no-left" colspan="8" valign="top">
                                                <div class="div-inline">
                                                   <div>
                                                    <span class="info-perso">NOM : {{Str::limit($perso->nom, 75)}}</span>
                                                  </div>
                                                  <div>
                                                      <span class="info-perso">Né(e) le : {{$perso->date_naissance}}</span>
                                                  </div>
                                                  <div>
                                                      <span class="info-perso">N° PASSEPORT : {{$perso->passeport}}</span> 
                                                  </div>
                                                  <div>
                                                      <span class="info-perso">TYPE : @if($perso->type){{$perso->type->designation}}@endif</span>
                                                  </div>
                                                </div>
                                                <div class="div-inline">
                                                  <div>
                                                      <span class="info-perso">PRENOMS : {{ Str::limit($perso->prenom, 75) }}</span>
                                                  </div>
                                                  <div> 
                                                      <span class="info-perso">CIN : {{$perso->cin}}</span>
                                                  </div>
                                                  <div> 
                                                      <span class="info-perso">SEXE : {{$perso->sexe->designation}}</span>
                                                  </div>
                                                </div>
                                                
                                            </td>
                                        </tr>
                                        <tr class="bord-bottom lc-txt">
                                            <td class="bord-right no-top" colspan="7" width="403" valign="top">
                                                <div class="txt" align="center">
                                                    Ny tompon’ny kara-pilalaovana dia tsy
                                                    maintsy manaja manontolo ny rafitra mifehy
                                                    ny Malagasy Rugby. Tsy maintsy mahalala ny
                                                    amin’ny antsipirihany izay voalazan’ny
                                                    fiantohana
                                                </div>
                                            </td>
                                            <td class="center no-top no-left" colspan="2" width="116" valign="top">
                                                <div align="center">
                                                    <strong>
                                                        <em><u>Sonian’ny tompony</u></em>
                                                    </strong>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="center" height="80px">
                                            <td class="no-top" colspan="2" width="111" valign="top">
                                                <div>
                                                    <strong>
                                                        <em><u>VISA ASSURANCE</u></em>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td class="bord-left no-top no-left" colspan="1" width="136" valign="top">
                                                <div>
                                                    <strong>
                                                        <em><u> VISA MEDECIN</u></em>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td class="bord-left no-top no-left" colspan="2" width="137" valign="top">
                                                <div align="center">
                                                    <strong>
                                                        <em><u>VISA SECTION/LIGUE</u></em>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td class="bord-left no-top no-left" colspan="4" width="136" valign="top">
                                                <div align="center">
                                                    <strong>
                                                        <em><u>VISA FEDERATION</u></em>
                                                    </strong>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                              </div>
                              @endforeach
                              @endif
                          </div>


                         

                          


                          
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <style type="text/css">
                  .photo-td
                  {
                    display: block;
                    position: relative;
                  }

                  .rugbyLogo
                  {
                      position: absolute;
                      display: inline-block;
                      top: 65px;
                      width: 50px;
                      height: 50px;
                      left: 75px;
                      opacity: 0.65;
                      border: solid 0.5px gray;
                      border-radius: 50%;
                  }

                  .num_licence
                  {
                    font-size: 0.78em !important;
                  }
                  .div-inline
                  {
                    display: inline-block;
                  }
                  .s-title.center
                  {
                    /*border-right: solid 1px black;
                    border-left: solid 1px black;*/
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
                    margin-top: 3px;
                  }

                  .info-perso
                  {
                    margin-left: 15px;
                    margin-right: 20px;
                    width: 235px;
                    display: inline-block;
                    vertical-align: top;
                    margin-top: 3px;
                  }
                  .tr-info
                  {
                    height: 75px;
                  }
                  .td-title
                  {
                    height: 25px;
                  }
                  .lc-txt div
                  {
                    min-height: 65px;
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
                    margin: auto;
                  }

                  .td-img
                  {
                    padding: 0;
                    width: 110px;
                    height: 110px;
                  }

                  .td-img .img-lc
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
                    max-height: 500px;
                    min-height: 450px;
                    width: 672px;
                    margin-bottom: 15px;
                    margin-top: 5px;
                    display: inline-block;
                    border: none;
                  }

                  .head {
                    height: 80px;
                    /*border-bottom: solid 1px black;*/

                  }

                  .bord-bottom {
                    /*border-bottom: solid 1px black;*/
                  }

                  /*.lc-title {
                    border-right: solid 1px black;
                    border-left: solid 1px black;
                  }*/

                 /* .bord-left {
                    border-left: solid 1px black;
                  }

                  .bord-right {
                    border-right: solid 1px black;
                  }*/

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

                  td {
                    border: solid 1px black;
                  }

                  .no-top {
                    border-top: none;
                  }

                  .no-left {
                    border-left: none;
                  }

                  .no-right {
                    border-right: none;
                  }

                  .no-bottom {
                    border-bottom: none;
                  }

                  .impaire
                  {
                    margin-right: 25px;
                  }

                  .lc-div {
                    display: inline-block;
                    vertical-align: top;
                  }
              </style>

              
              
    </body>
</html>
