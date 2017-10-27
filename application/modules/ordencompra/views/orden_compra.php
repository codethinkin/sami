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
          <h3 class="box-title"><span class="glyphicon glyphicon-list"></span> Ordenes de Compra </h3>
        </div>
        <div class="box-body" style="background: rgb(249, 250, 252);">

<script type="text/javascript">
var baseurl = "<?php echo base_url(); ?>";
</script>

<script type="text/javascript">
function AsignaSession(){
document.getElementById("idsession").value="<?php echo md5(rand(1000,50000)); ?>";
}
</script>

<div id="mensaje"></div>
  <div id="msgbx_err" class="alert-box error" style="color:red" display="none"></div>
<br/>
<table border=0 width="100%">
<tr><td> </td>
  <td>
      <div class="row">
        <div class="col-xs-3">
             <strong>Factura No.</strong> <input type="text"  style="color:#FF0000; font-size:18px;" name="Factura" id="Factura" class="form-control input-sm" size="30" />
    </div>
    <div class="col-xs-4">

  <strong>Fecha:</strong><input type="date" name="FechaFactura" id="FechaFactura" class="form-control input-sm" size="30" />
    </div>
         <div class="col-xs-4">
     <strong>Proveedor:</strong> <input type="text" name="BuscaProveedor" id="BuscaProveedor" class="form-control input-sm" autocomplete="off" size="30" />

    </div>
    </div>
  </td></tr>
<tr>
  <td></td>
  <td>
        <div class="row">
        <div class="col-xs-4">
              <strong>Producto:</strong> <input type="text" name="BuscaProducto" id="BuscaProducto" class="form-control input-sm" autocomplete="off" size="30" />
         </div>

         <div class="col-xs-2">

                  <strong>Cantidad:</strong><input  type="text" name="cantidad" id="cantidad" autocomplete="off"  class="form-control input-sm" size="3" value="1" />
          </div>
          <div class="col-xs-2">

                   <strong>Cantidad En Stock:</strong><input type="text" name="existencia" id="existencia" class="form-control input-sm"  size="3" readonly="readonly"/>
          </div>

           <div class="col-xs-2">
                    <strong>Ultimo Precio:</strong><input type="text" name="precioventa" class="form-control input-sm"  id="precioventa" size="3" disabled />
           </div>

            <div class="col-xs-2">
            <strong>Precio Compra:</strong><input type="text" name="precio"  id="precio" class="form-control input-sm" size="3"  />

            </div>

  </td>



  <td>
    <input type="hidden" name="descripcion"  id="descripcion" />
    <input type="hidden" name="costo"  id="costo" />
    <input type="hidden" name="nit"  id="nit" />
    <input type="hidden" name="nom_pro"  id="nom_pro" />
    <input type="hidden" name="codigo"  id="codigo" />
<input type="hidden" name="refererencia"  id="refererencia" />

    <input type="hidden" name="idsession"  id="idsession" value="<?php echo md5(rand(1000,50000)); ?>" /></td>
  <td></td>
  <td>

  </td>
  <td></td>
  <td>

  </td>
  <td></td>
  <td></td>
 <td>
  &nbsp;<button type="submit" id="AgregaProducto" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Agregar Producto</button>

</td>
</tr>
</table>
<br/><hr/><br/>
<form   name="formulario" id="formulario" role="form">
<table class="table table-bordered table-striped"    id="carrito">
<thead>

<th>Código</th>
<th>Descripcion</th>
<th>Proveedor</th>
<th>Precio Compra</th>
<th>Cantidad</th>
<th>Total</th>
<th></th>
<thead>

<tbody>
    <tr>
        <td colspan=7><center>No Hay Productos Agregados</center></td>
    </tr>

</tbody>
<tfoot>
<tr>
<td colspan=5 align="right">Sub-Total:</td>
<td colspan=2><label id="lblsubtotal" name="lblsubtotal">$0</label>
<input type="hidden" name="txtsubtotal" id="txtsubtotal" value="0"/>

<input type="hidden" name="valor"  id="valor" /></td>
</tr>
<tr>
<td colspan=5 align="right">IVA:</td>
<td colspan=2><label id="lbliva" name="lbliva">$0</label>
<input type="hidden" name="txtIva" id="txtIva" value="0"/></td>
</tr>
<tr>
<td colspan=5 align="right"  style="color:#FF0000; font-size:18px;">Total:</td>
<td colspan=2><label id="lbltotal" name="lbltotal">$0</label>
<input type="hidden" name="txtTotal" id="txtTotal" value="0"/></td>
</tr>
</tfoot>
</table>
<center>
<button type="reset" class="btn btn-default" onclick="javascript:location.reload();"><span class="glyphicon glyphicon-edit"></span> Nueva Orden de Compra</button> &nbsp;
<button type="submit" id="SaveOrder" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Guardar Orden Compra</button></center>
</form>


        </div>
            <!-- /.box-body -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
