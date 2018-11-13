<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Información de la reserva</title>
    <!-- <style> -->
    
     <style>
      @include('emails.proccessStyles')
      @include('emails.generalStyles')
    </style>
    
</head>

<body>
 
    <span class="preheader"></span>
    <table class="body row-table">
        <tr>
            <td class="center" align="center" valign="top">
                <center data-parsed="">

                    <table align="center" class="container float-center row-table">
                        <tbody>
                            <tr>
                                <td>
                                    <table class="row-table purple-background">
                                        <tbody>
                                            <tr>
                                                <th class="small-12 large-12 columns first last">
                                                    <table>
                                                        <tr><th style="height:35px"></th></tr>
                                                        <tr>
                                                            <th>
                                                                <h2 style="margin:0; mso-line-height-rule:exactly;">Información de tu reserva</h2>
                                                            </th>
                                                            <th class="expander"></th>
                                                        </tr>
                                                        <tr><th style="height:20px"></th></tr>

                                                        <tr>
                                                            <th>
                                                                <p>{{$place["name"]}}</p>
                                                            </th>
                                                            <th class="expander"></th>
                                                        </tr>
                                                         <tr>
                                                            <th>
                                                                <p>{{$place["address"]}}</p>
                                                            </th>
                                                            <th class="expander"></th>
                                                        </tr>
                                                        <tr><th style="height:5px"></th></tr>

                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="row-table">
                                        <tbody>
                                            <tr>
                                                <th class="small-12 large-12 columns first last no-padding">
                                                    <table>
                                                        <tr>
                                                            <th>
                                                                <center data-parsed="">
                                                                    <img width="100%" src="{{str_replace("thumbnails","full",$place["placeImages"][0]->url)}}" align="center" class="float-center"/>
                                                                </center>
                                                            </th>
                                                            <th class="expander"></th>
                                                        </tr>
                                                        <tr>
                                                           <th style="height: 10px; background-color:#37466E">
                                                               
                                                           </th>
                                                            <th class="expander"></th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="row-table">
                                        <tbody>
                                            <tr>
                                                <th class="small-12 large-8 columns first">
                                                    <table>
                                                        <tr>
                                                            <th>
                                                             
                                                                <p style="margin-top: 10px">
                                                                    <strong>{{$admin}}</strong> ha generado una reserva en este establecimiento y estas invitado, estamos verificando la disponibilidad de un espacio de trabajo, en pocos minutos te confirmaremos.
                                                                </p>
                                                               
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                          <th class="button-container">
                                                            <a style="margin-top: 10px" href="{{url("/reservations/".$data["reservation_id"])}}">Ver la reserva</a>
                                                          </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-12 large-4 columns last">
                                                    <table>
                                                        <tr>
                                                            <th>
                                                                <table class="date-container row-table">
                                                                  <tr><th class="date-text">{{$reservation["formatedDate"]["m"]}}</th></tr>
                                                                  <tr>
                                                                    <th class="number-date-cotainer">
                                                                      <table class="white-container row-table"><tr><th>{{$reservation["formatedDate"]["d"]}}</th></tr></table>
                                                                    </th>
                                                                  </tr>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th style="height:20px"></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @include('emails.socialEmail')
                                    <table>
                                      <tr><th style="height: 10px"></th></tr>
                                    </table>
                                    @include('emails.footerEmail')

                                  
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </center>
            </td>
        </tr>
    </table>
    <!-- prevent Gmail on iOS font size manipulation -->
    <div style="display:none; white-space:nowrap; font:15px courier; line-height:0;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>
</body>

</html>