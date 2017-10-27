<!-- page content -->
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper settingPage">
    <!-- Main content -->
    <section class="content">
      <?php if($this->session->flashdata("message")){?>
        <div class="alert alert-info alert-dismissible"  role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php echo $this->session->flashdata("message")?>
        </div>
      <?php } ?>
      <!-- Default box -->
      <div class="box box-success" >
        <div class="box-header with-border">
          <h3 class="box-title"><span class="glyphicon glyphicon-list"></span> Reporte Compras </h3>
        </div>
        <div class="box-body" style="background: rgb(249, 250, 252);">
<div id="mensaje"></div>
          <hr/><br/>
<table>
<tr>
<td>Fecha Inicial: </td>
<td><input type="text" name="finicial" id="finicial" class="form-control input-sm"  size="20" /></td>
<td> &nbsp; &nbsp; &nbsp;Fecha Final: </td>
<td><input type="text" name="ffinal" id="ffinal" class="form-control input-sm"  size="20" /></td>
<td>&nbsp; &nbsp; &nbsp; </td>
<td>
<select name="documento" id="documento" class="form-control input-sm" >
  <option value="Entrada">Compras</option>
</select>

</td>
<td>
    &nbsp;<button type="submit"   id="GeneraReporte" class="btn btn-primary"><i class="fa fa-align-left"></i> Generar Reporte</button>
  &nbsp;<a href="<?php echo base_url("Ordencompra/Excel") ?>" class="btn btn-primary"><i class="fa fa-align-left"></i> Excel</a>
  </td>
</tr>
</table>
<hr/>
<br/>
<table class="table table-bordered table-striped"    id="reportes">
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
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
  </div>
  <script type="text/javascript">
    var baseurl = "<?php echo base_url(); ?>";
  </script>

  <script type="text/javascript">
           $(function() {
                $( "#finicial" ).datepicker();
                $( "#ffinal" ).datepicker();
             });
        </script>
