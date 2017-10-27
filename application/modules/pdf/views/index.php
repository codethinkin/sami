<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
  <section class="content">

	<h1>MPDF</h1>
	<h3>Esto es una prueba de mpdf</h3>

	<form action="<?php echo base_url();?>pdf/save" method="POST" id="form">
		<input type="text" name="txtPDF"><br>
		<input type="button" onclick"save()" name="btnDownload" id="btnSave">
	</form>
</section>
<script type="text/javascript">
$(document).ready(function() {
  function add_employee(){
      save_method = 'add';


      $('#form')[0].reset(); // reset form on modals

  }



})

function save()
{

  alert("Hola");

}
</script>
</html>
