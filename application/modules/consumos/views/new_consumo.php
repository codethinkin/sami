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
            <h3 class="box-title">Tablero | Consumos </h3>
            <div class="box-tools">

            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <input type="hidden" name="cat" id="cat" value="<?php echo @$ventas[0]->id; ?>">
            <input type="hidden" name="cli" id="cli" value="<?php echo @$ventas[0]->id_Cliente; ?>">
            <input type="hidden" name="cen" id="cen" value="<?php echo @$ventas[0]->id_centros; ?>">
            <div id="mensaje"></div>

            <script type="text/javascript">
//var id  = 0;
var id_Cliente      = 0;
var id_centros      = 0;
  //var idprov        = 0;
  var ids           = document.getElementById("id").value;
  ids               = parseInt(ids.length);

  if(ids==0){
    id_Cliente = 0;
    id_centros    = 0;
    //idprov       = 0;
  }else{
    id_Cliente        = document.getElementById("cli").value;
    id_centros        = document.getElementById("cen").value;
    //idprov           = document.getElementById("prov").value;
  }
function AsignaSession(){
  document.getElementById("idsessionventa").value="<?php echo md5(rand(1000,50000)); ?>";
}
function RefrescarPagina(){
  if(confirm("Si cambias de Cliente se Perderan los Cambios")) {
    location.reload();
  }else{

    return false;
  }

}
</script>

<table border=0 width="100%">
	<tr>
		<td colspan="10">
			<table>
      <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;Fecha:&nbsp;&nbsp;&nbsp;</td>
        <td>

            <input type="date" name="FechaFactura" id="FechaFactura" class="form-control input-sm"  size="18" />
        </td>
        <tr>
    <td colspan="10"><br/></td>
  </tr>
      </tr>
      <tr>

        <td>&nbsp;&nbsp;&nbsp;&nbsp;Cliente:&nbsp;&nbsp;&nbsp;</td>
           <td>
               <select name="clientes" id="clientes" class="form-control"></select>

          </td>

          <td>&nbsp;&nbsp;&nbsp;&nbsp;C.C:&nbsp;&nbsp;&nbsp;</td>
           <td>
            <select name="centros" id="centros" class="form-control"></select>
          </td>
            <td>&nbsp;<button type="reset" class="btn btn-default" onclick="RefrescarPagina();"><span class="glyphicon glyphicon-refresh"></span> Cambiar Cliente</button></td>
      </tr>
      <br>

				<tr>
				<!--	<td>&nbsp;&nbsp;&nbsp;&nbsp;Cliente:&nbsp;&nbsp;&nbsp;</td>
					<td><input type="text" name="BuscaCliente" id="BuscaCliente" class="form-control input-sm" placeholder="---Buscar Cliente---"autocomplete="off" size="30" /></td>-->

					<td>&nbsp;<label id="lblNombrecliente" name="lblNombrecliente"> </label>
            <label id="lblidcliente" name="lblidcliente"> </label>
          </td>

				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="10"><br/></td>
	</tr>
    <tr>
      <td>Producto: </td>
      <td><input type="text" name="BuscaProducto" id="BuscaProducto"  class="form-control input-sm" autocomplete="off" size="30" /></td>
      <td>Cantidad:</td>
      <td><input  type="text" name="cantidad" id="cantidad" onkeypress="return validarNumeros(event)" autocomplete="off"  class="form-control input-sm" size="3" value="1" /></td>
      <td>
        <input type="hidden" name="descripcion"  id="descripcion" />
        <input type="hidden" name="costo"  id="costo" />
        <input type="hidden" name="idProveedor"  id="idProveedor" />
        <input type="hidden" name="factura"  id="factura" />
        <input type="hidden" name="codigo"  id="codigo" />
        <input type="hidden" name="Proveedor"  id="Proveedor" />
        <input type="hidden" name="Cliente"  id="Cliente" />
        <input type="hidden" name="idsessionventa"  id="idsessionventa" value="<?php echo md5(rand(1000,50000)); ?>" /></td>
      <td>Existencia:</td>
      <td>
        <input type="text" name="existencia" id="existencia" class="form-control input-sm"  size="3" readonly="readonly"/>
      </td>
      <td></td>
      <td><input type="hidden" name="precioventa" class="form-control input-sm"  id="precioventa" size="15" readonly="readonly"/></td>
     <td>
      &nbsp;<button type="submit"  id="AgregaProducto" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Agregar Producto</button>

    </td>
    </tr>
    </table>
<br/><hr/><br/>
<form   name="formulario" id="formulario" role="form">
<table class="table table-bordered table-striped"    id="carrito">
  <thead>
    <th>Código</th>
    <th>Descripcion</th>
    <th>Precio</th>
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
    <td colspan=2><label id="lblsubtotal" name="lblsubtotal">$ 0</label><input type="hidden" name="txtsubtotal" id="txtsubtotal" value="0"/C></td>
  </tr>
  <tr>
    <td colspan=5 align="right">IVA:</td>
    <td colspan=2><label id="lbliva" name="lbliva">$ 0</label><input type="hidden" name="txtIva" id="txtIva" value="0"/></td>
  </tr>
  <tr>
    <td colspan=5 align="right">Total:</td>
    <td colspan=2><label id="lbltotal" name="lbltotal">$ 0</label><input type="hidden" name="txtTotal" id="txtTotal" value="0"/></td>
  </tr>
</tfoot>
  </table>
  <!--<p class="bg-success">Direcciónes de Embarque</p>
  <input type="radio" value="0"/> Dir. de Embarque <input type="radio" value="1"> Dir de Recolección.
<br/>
  Dir. de Entrega:
  <select name="dirEnvio">
    <option value="0">--Elige Dirección</option>
  </select>-->
 <center>
  <!--<button type="reset" class="btn btn-default" ><span class="glyphicon glyphicon-edit"></span> Nuevo Consumo</button> &nbsp;-->
  <a class="btn btn-default" href="<?= base_url("ventas"); ?>"><span class="glyphicon glyphicon-edit"> Nuevo Consumo</a>
  <button type="submit" id="SaveOrder" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Registro Consumo</button></center>
</form>
<!-- Popup de confirmacion -->

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

<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div id="msgbx_err" class="alert-box error" display="none" style="color:red;"></div>
                        <div class="form-group">
                          <label class="control-label col-md-3">NIT</label>
                            <div class="col-md-9">
                                <input name="nit" id="nit" placeholder="" class="form-control input-sm input-sm" type="text" required>
                                <span class="help-block"></span><span id="nit_result"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Razón Social</label>
                            <div class="col-md-9">
                                <input name="name" placeholder="" class="form-control input-sm" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Contacto</label>
                            <div class="col-md-9">
                                <input name="contact" placeholder="" class="form-control input-sm" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Dirección</label>
                            <div class="col-md-9">
                                <input name="address" placeholder="" class="form-control input-sm" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Télefono</label>
                            <div class="col-md-9">
                                <input name="phone1" placeholder="" class="form-control input-sm" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                      <div class="form-group">
                            <label class="control-label col-md-3">Movil</label>
                            <div class="col-md-9">
                              <input name="phone2" placeholder="" class="form-control input-sm" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Correo</label>
                            <div class="col-md-9">
                                <input name="email" placeholder="" class="form-control input-sm" type="numeric">
                                <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Estado</label>
                            <div class="col-md-9">
                                <select name="state" class="form-control input-sm">
                                    <option value="">--Selecionar Estado--</option>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                                  </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-xs">Grabar</button>
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
