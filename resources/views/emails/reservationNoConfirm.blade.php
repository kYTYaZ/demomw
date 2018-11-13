<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="css/app.css">
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
                                    <table class="row-table red-background">
                                        <tbody>
                                            <tr>
                                                <th class="small-12 large-12 columns first last">
                                                    <table>
                                                        <tr><th style="height:35px"></th></tr>
                                                        <tr>
                                                            <th>
                                                                <h2 style="margin:0; mso-line-height-rule:exactly;">¡ Seguimos creciendo !</h2>
                                                            </th>
                                                            <th class="expander"></th>
                                                        </tr>
                                                        <tr><th style="height:10px"></th></tr>

                                                        <tr>
                                                            <th>
                                                                <p>En este establecimiento ya hay muchos Coworkers trabajando.</p>
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
                                                                    <img src="https://gallery.mailchimp.com/66f592d473385e4197d8a9554/images/1bfb2be2-2be8-490c-9776-0611a68874e3.png" align="center" class="float-center"/>
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
                                                                
                                                                <h2 class="center"> No te preocupes, tenemos más espacios disponibles</h2>
                                                                <p class="center" style="margin-top: 10px">
                                                                    ¿Por favor indícanos qué hacemos por ti?

                                                                </p>
                                                               
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th style="height:20px"></th>
                                                        </tr>
                                                        <tr>
                                                          <th class="button-container">
                                                            <a style="margin-top: 10px" href="/mee">¿ Buscamos otro espacio ?</a>
                                                          </th>
                                                        </tr>
                                                    </table>
                                                </th>
                                                <th class="small-12 large-4 columns last">
                                                    <table>
                                                        <tr>
                                                            <th>
                                                                <table class="date-container row-table">
                                                                  <tr><th class="date-text">Febrero</th></tr>
                                                                  <tr>
                                                                    <th class="number-date-cotainer">
                                                                      <table class="white-container row-table"><tr><th>22</th></tr></table>
                                                                    </th>
                                                                  </tr>
                                                                </table>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                          <th class="button-container">
                                                            <a style="margin-top: 10px" href="/mee">Reagendamos</a>
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