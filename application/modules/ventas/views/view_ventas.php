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
          <h3 class="box-title"><span class="glyphicon glyphicon-list"></span> Registro Venta / Consumo</h3>
        </div>
        <div class="box-body" style="background: rgb(249, 250, 252);">
          <input type="hidden" name="cat" id="cat" value="<?php echo @$ventas[0]->id; ?>">
          <input type="hidden" name="cli" id="cli" value="<?php echo @$ventas[0]->id_Cliente; ?>">
          <input type="hidden" name="cen" id="cen" value="<?php echo @$ventas[0]->id_centros; ?>">

          <script type="text/javascript">
            var baseurl = "<?php echo base_url(); ?>";
          </script>

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

          <div id="mensaje"></div>
      <br/>


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
                <td><input type="text" name="BuscaProducto" id="BuscaProducto"  class="form-control autocomplete" autocomplete="off" size="30" /></td>
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
            </div>
            <!-- /.box-body -->
        </section>
        <!-- /.content -->
      </div>
