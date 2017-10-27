<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
  <section class="content">
  <?php if($this->session->flashdata("messagePr")){?>
    <div class="alert alert-info">
      <?php echo $this->session->flashdata("messagePr")?>
    </div>
  <?php } ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Tablero | Consumos Realizados </h3>
            <div class="box-tools">
<a class="btn btn-primary btn-xs" href="<?php echo base_url('ventas'); ?> "><i class="glyphicon glyphicon-plus"></i> Nueva Venta</a>

                  <button class="btn btn-default btn-xs" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>
            </div>
          </div>
<br>

          <!-- /.box-header -->
          <div class="box-body">
            <table id="tblSales" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>

                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Centro/Costo</th>
                    <th>Subtotal</th>
                    <th>IVA</th>
                    <th>Total</th>
                  <!--  <th style="width:150px;">Acciones</th>-->
                </tr>
            </thead>
            <tbody>
              <?php
                  foreach ($sales as $sale)
              {
                  ?>
                  <tr>

  		    <td><?php echo $sale->FECHA_FACTURA ?></td>
           <td><?php echo $sale->nameCus ?></td>
          <td><?php echo $sale->centocosto ?></td>
  		    <td><?php echo $sale->BRUTO ?></td>
          <td><?php echo $sale->TOTAL_IMPUESTO ?></td>
  		    <td><?php echo $sale->TOTAL ?></td>
  		<!--    <td style="text-align:center" width="200px">-->
  			<?php
  			/*echo anchor(site_url('contactos/read/'.$sale->id),'<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="bottom" title="Leer"><i class="fa  fa-eye left"></i></button>');
  			echo ' | ';
  			echo anchor(site_url('contactos/update/'.$sale->id),'<button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="right" title="Actualizar"><i class="fa fa-pencil left"></i></button>');
  */
  			?>
  		    </td>
  	        </tr>
                  <?php
              }
              ?>
              </tbody>

        </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- Modal Crud Start-->
<!-- Bootstrap modal -->

<script type="text/javascript">

var currentLocation = window.location;

$(document).ready(function() {


 // DataTable
 $('#tblSales').DataTable( {
				 "language":
				 {
 "sProcessing":     "Procesando...",
 "sLengthMenu":     "Mostrar _MENU_ registros",
 "sZeroRecords":    "No se encontraron resultados",
 "sEmptyTable":     "Ningún dato disponible en esta tabla",
 "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
 "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
 "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
 "sInfoPostFix":    "",
 "sSearch":         "Buscar:",
 "sUrl":            "",
 "sInfoThousands":  ",",
 "sLoadingRecords": "Cargando...",
 "oPaginate": {
		 "sFirst":    "Primero",
		 "sLast":     "Último",
		 "sNext":     "Siguiente",
		 "sPrevious": "Anterior"
 },
 "oAria": {
		 "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		 "sSortDescending": ": Activar para ordenar la columna de manera descendente"
 }
}


});

};


function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}









</script>
