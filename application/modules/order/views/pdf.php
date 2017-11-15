<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
<link rel="stylesheet" href="<?php echo base_url('assets/css/pdf.css'); ?>">

</head>
<body>
<div class="body">

  <div id="logo">
    <img src="<?php echo base_url('assets/images/logoold.jpg'); ?>">
  </div>

<div id="orden">
    <h1>ORDEN DE TRABAJO No.  </h1>
<p>MANTENIMIENTO <?php echo $tipomante; ?></p>
</div>


</div>

  <header class="clearfix">


    <div id="project">
      <div><span>CLIENTE</span> </div>
      <div><span>NIT:</span> </div>
      <div><span>EQUIPO:</span> </div>
      <div><span>MARCA:</span> </div>
      <div><span>MODELO:</span> </div>
      <div><span>SERIE</span> </div>
      <div><span>HOROMETRO:</span> </div>
      <div><span>AUTORIZADO POR:</span></div>

    </div>
  </header>
  <main>
<hr>
    <table>
      <thead>
        <tr>
          <th colspan="3">DESCRIPCIÓN DEL SERVICIO Y REPUESTOS NECESARIOS</th>
          <th>CANTIDAD</th>
          <th>PRECIO</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="service">Design</td>
          <td class="desc">Creating a recognizable design solution based on the company's existing visual identity</td>
          <td class="unit">$40.00</td>
          <td class="qty">26</td>
          <td class="total">$1,040.00</td>
        </tr>
        <tr>
          <td class="service">Development</td>
          <td class="desc">Developing a Content Management System-based Website</td>
          <td class="unit">$40.00</td>
          <td class="qty">80</td>
          <td class="total">$3,200.00</td>
        </tr>
        <tr>
          <td class="service">SEO</td>
          <td class="desc">Optimize the site for search engines (SEO)</td>
          <td class="unit">$40.00</td>
          <td class="qty">20</td>
          <td class="total">$800.00</td>
        </tr>
        <tr>
          <td class="service">Training</td>
          <td class="desc">Initial training sessions for staff responsible for uploading web content</td>
          <td class="unit">$40.00</td>
          <td class="qty">4</td>
          <td class="total">$160.00</td>
        </tr>
        <tr>
          <td colspan="4">SUBTOTAL</td>
          <td class="total">$5,200.00</td>
        </tr>
        <tr>
          <td colspan="4">TAX 25%</td>
          <td class="total">$1,300.00</td>
        </tr>
        <tr>
          <td colspan="4" class="grand total">GRAND TOTAL</td>
          <td class="grand total">$6,500.00</td>
        </tr>
      </tbody>
    </table>




  </main>
  <table id="firmas">
    <thead>
      <tr>
        <th class="service">ELABORADO POR:</th>
        <th class="desc">RECIBIDO POR:</th>
        </tr>
    </thead>
    <tbody>


    </tbody>
  </table>
  <footer>
    CARGAR S.A | Calle 31 # 41 51, Itagui Antioquia | 444 7773
  </footer>
</body>
</html>
