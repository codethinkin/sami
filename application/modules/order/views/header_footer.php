<html>
  <head>
      <link rel="stylesheet" type="text/css" href="./assets/css/dompdf.css">
      <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>


  </head>

<body>

  <header>
      <table>
          <tr>
              <td id="header_logo">
                  <img id="logo" src="./assets/images/logo.jpg">
              </td>


              <td id="header_texto">
                  <div>CARGAR S.A</div>
                  <div>NIT: 890919352-2</div>
                  <div>TEL: 444 7773 EXT 113</div>
                  <div>CALLE 31 No. 41 51 ITAGUI - ANTIOQUIA</div>
              </td>
              <td id="header_orden">
                  <h2>ORDEN DE TRABAJO </h2>

                  <span>MANTENIMIENTO  <?php if($activity == "PREVENTIVO"){
                  echo "PREVENTIVO CADA ".$frequency. " HORAS";
                  }else {
                    echo "CORRECTIVO";
                  } ?>  </span>
              </td>

              <td id="header_logos">
                <h3>ORDEN No. <?php echo $code; ?></h3>
                <p>FECHA: <?php echo $startActivity; ?></p>
              </td>
          </tr>
      </table>
<hr>


  </header>
<table id="conte">
  <tr>
    <th style="width: 400px;">
<div class="clearfix">
      <div id="project">
        <div ><span >CLIENTE</span>  <?php echo $customers; ?> </div>
        <div><span>EQUIPO:</span>  <?php echo $equipmentType; ?> </div>
        <div><span>MARCA:</span>   <?php echo $mark; ?> </div>
        <div><span>MODELO:</span> <?php echo $model ?>  </div>
        <div><span>SERIE</span>  <?php echo $serie; ?> </div>
        <div><span>HOROMETRO:</span>____________ </div>
        <div><span>AUTORIZADO POR:</span> <?php echo $autorized; ?> </div>
      </div>
  </div>
</th>
<th style="width: 250px;">
<div class="clearfix">
  <div id="project2">
    <div><span>COTIZACIÓN No.:</span><?php echo $cotizacion; ?>  </div>
    <div><span>ORDEN DE COMPRA No.:</span> <?php echo $ordencompra; ?>   </div>
    <div><span>SDC No.:</span> <?php echo $sdc; ?>   </div>
</div>
</div>
</th>
  </tr>
</table>




<!--
  <footer>
      <div id="footer_texto">CARGAR S.A | CALLE 31 No. 41 51, ITAGUI ANTIOQUIA | 444 7773 EXT 113</div>
  </footer>
-->
<br>
<hr>

<div class="250" <?php if($frequency==1250){echo 'style="display: none;"' ;}if($frequency==2500){echo 'style="display: none;"' ;}if($activity=="CORRECTIVO"){echo 'style="display: none;"' ; } ?> >
  <table class="demo">
  <thead>
<tr>
<th colspan="6">DESCRIPCIÓN DEL SERVICIO Y REPUESTOS NECESARIOS</th>
</tr>
    <tr>
      <th id="detalle" class="fondo">DETALLE</th>
      <th class="fondo">CANT</th>
      <th id="precio" class="fondo">PRECIO</th>
      <th id="detalle" class="fondo">DETALLE</th>
      <th class="fondo">CANT</th>
      <th id="precio" class="fondo">PRECIO</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <td>* ACEITE MOTOR</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>

      <td>* FILTRO GLP</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
        <td>* FILTRO AIRE</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* LUBRICANTE CADENA</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* GRASA</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* FILTRO GASOLINA</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* FILTRO MOTOR</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th colspan="6" class="fondo">ACTIVIDADES ADICIONALES REALIZADAS</th>
      </tr>
    <tr>
      <th colspan="4" class="descripcion">&nbsp;</th>
      <th class="descripcion" >&nbsp;</th>
      <th class="descripcion">&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>

    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="6" class="fondo">PENDIENTES POR REALIZAR</th>
      </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>

    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>




    <tbody>
  </table>
</div>

<!---Fin Servicios de 250 horas--->


<div class="1250" <?php if($frequency==250){echo 'style="display: none;"' ;}if($frequency==2500){echo 'style="display: none;"' ;}if($activity=="CORRECTIVO"){echo 'style="display: none;"' ; } ?>>
  <table class="demo">
  <thead>
<tr>
<th colspan="6">DESCRIPCIÓN DEL SERVICIO Y REPUESTOS NECESARIOS</th>
</tr>
    <tr>
      <th id="detalle" class="fondo">DETALLE</th>
      <th class="fondo">CANT</th>
      <th id="precio" class="fondo">PRECIO</th>
      <th id="detalle" class="fondo">DETALLE</th>
      <th class="fondo">CANT</th>
      <th id="precio" class="fondo">PRECIO</th>
    </tr>
    </thead>
    <tbody>
<tr>
      <td>* ACEITE MOTOR</td>
      <td></td>
      <td></td>
     <td>* LIMPIADOR CARBURADOR</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
<td>* FILTRO MOTOR</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>* TAPA DISTRIBUIDOR</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
        <td>* FILTRO AIRE</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
        <td>* FILTRO CAJA</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
    <td>* LUBRICANTE CADENA</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>* FILTRO DIFERENCIAL</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* GRASA</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>* ROTOR DISTRIBUIDOR</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* FILTRO GASOLINA</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* FILTRO GLP</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* ACEITE DIFERENCIAL</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* ACEITE CAJA</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* LIQUIDO DE FRENOS</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* CABLES DE ALTA</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* JUEGO DE BUJIAS</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th colspan="6" class="fondo">ACTIVIDADES ADICIONALES REALIZADAS</th>
      </tr>
    <tr>
      <th colspan="4" class="descripcion">&nbsp;</th>
      <th class="descripcion" >&nbsp;</th>
      <th class="descripcion">&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>

    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="6" class="fondo">PENDIENTES POR REALIZAR</th>
      </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>

    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>




    <tbody>
  </table>
</div>

<!---Fin servicios de 1250 horas---->




<div class="2500" <?php if($frequency==1250){echo 'style="display: none;"' ;}if($frequency==250){echo 'style="display: none;"' ;}if($activity=="CORRECTIVO"){echo 'style="display: none;"' ; } ?>>
  <table class="demo">
  <thead>
<tr>
<th colspan="6">DESCRIPCIÓN DEL SERVICIO Y REPUESTOS NECESARIOS</th>
</tr>
    <tr>
      <th id="detalle" class="fondo">DETALLE</th>
      <th class="fondo">CANT</th>
      <th id="precio" class="fondo">PRECIO</th>
      <th id="detalle" class="fondo">DETALLE</th>
      <th class="fondo">CANT</th>
      <th id="precio" class="fondo">PRECIO</th>
    </tr>
    </thead>
    <tbody>
<tr>
      <td>* ACEITE MOTOR</td>
      <td></td>
      <td></td>
     <td>* LIMPIADOR CARBURADOR</td>
      <td></td>
      <td></td>
    </tr>
    <tr>
<td>* FILTRO MOTOR</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>* TAPA DISTRIBUIDOR</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
        <td>* FILTRO AIRE</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
        <td>* FILTRO CAJA</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
    <td>* LUBRICANTE CADENA</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>* FILTRO DIFERENCIAL</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* GRASA</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>* ROTOR DISTRIBUIDOR</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* FILTRO GASOLINA</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>* ACEITE HIDRÁULICO</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* FILTRO GLP</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>* FILTRO HIDRÁULICO</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* ACEITE DIFERENCIAL</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* ACEITE CAJA</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* LIQUIDO DE FRENOS</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* CABLES DE ALTA</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>* JUEGO DE BUJIAS</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th colspan="6" class="fondo">ACTIVIDADES ADICIONALES REALIZADAS</th>
      </tr>
    <tr>
      <th colspan="4" class="descripcion">&nbsp;</th>
      <th class="descripcion" >&nbsp;</th>
      <th class="descripcion">&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>

    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="6" class="fondo">PENDIENTES POR REALIZAR</th>
      </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>

    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>
    <tr>
      <th colspan="4" >&nbsp;</th>
      <th  >&nbsp;</th>
      <th >&nbsp;</th>
    </tr>




    <tbody>
  </table>
</div>

<div class="correctivo" <?php if($activity=="PREVENTIVO"){echo 'style="display: none;"' ;} ?>>

  <table id="contenido" >
      <thead>
        <tr>
          <th colspan="3" id="contenido">DESCRIPCIÓN DEL SERVICIO Y REPUESTOS NECESARIOS</th>
          <th style=" width: 1px;" id="contenido">Cant.</th>
          <th style=" width: 85px;" id="contenido">Precio</th>
        </tr>
      </thead>
      <tbody>

        <tr>
            <td colspan="3" style="height:17px; "id="contenido">  </td>
            <td style="height:17px;"id="contenido">  </td>
            <td style="height:17px; "id="contenido">  </td>
        </tr>
        <tr>
            <td colspan="3" style="height:17px; "id="contenido">  </td>
            <td style="height:17px;"id="contenido">  </td>
            <td style="height:17px; "id="contenido">  </td>
        </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>

  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>

  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px;"id="contenido">  </td>
      <td style="height:17px; "id="contenido">  </td>
  </tr>
  <tr>
      <td colspan="3" style="height:17px; "id="contenido">  </td>
      <td style="height:17px; width:35px;"id="contenido">  </td>
      <td style="height:17px; width:50px; " id="contenido">  </td>
  </tr>


      </tbody>
    </table>

</div>




<footer>
<table>
  <tr>
    <th style="width: 300px;">ELABORADO POR:</th>
     <th style="width: 400px;">APROBADO POR:</th>
  </tr>

</table>

</footer>
  </body>

</html>
