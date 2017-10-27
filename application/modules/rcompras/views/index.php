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
            <h3 class="box-title">Tablero | Reportes de Compras </h3>
            <div class="box-tools">


            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
<div id="mensaje"></div>



            <table>
            <tr>
            <form action="<?php echo base_url('report/imprimir'); ?>" method="post">
            <td>Fecha Inicial: </td>
            <td><input type="text" name="finicial" id="finicial" class="form-control input-sm"  size="20" /></td>
            <td> &nbsp; &nbsp; &nbsp;Fecha Final: </td>
            <td><input type="text" name="ffinal" id="ffinal" class="form-control input-sm"  size="20" /></td>

            <td>

            <select name="documento" id="documento" class="form-control input-sm"  style="visibility:hidden">
                <option value="Entrada">Compras</option>
             </select>





            </td>
            <td>
                  &nbsp;<button type="button"   id="GeneraReporte" class="btn btn-primary btn-xs"><i class="fa fa-align-left"></i> Generar Reporte</button>
                 
                </td>
                 </form>
                <td>

                </td>
            </tr>
            </table>
            <hr/>
            <br/>
            <table class="table table-bordered"    id="reportes">
  <thead>
    <th>Fecha</th>
    <th>Factura</th>
    <th>Proveedor</th>
    <th>Producto</th>
    <th>Subtotal</th>
    <th>Iva</th>
    <th>Total</th>
  <thead>

   <tbody>
        <tr>
            <td colspan=7><center>No Hay Información</center></td>
        </tr>

   </tbody>
   <tfoot>
   <tr>
    <td colspan=4 align="right"> </td>
	<td><label id="lblsubtotal" name="lblsubtotal">$ 0</label></td>
    <td><label id="lblimpuesto" name="lblimpuesto">$ 0</label></td>
    <td><label id="lbltotal" name="lbltotal">$ 0</label></td>
  </tr>

</tfoot>
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
      $(function() {
           $( "#finicial" ).datepicker();
           $( "#ffinal" ).datepicker();
        });


   </script>
