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
            <h3 class="box-title">Tablero | Reportes de Consumos </h3>
            <div class="box-tools">


            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">




            <table>
            <tr>
            <form action="<?php echo base_url('report/imprimir'); ?>" method="post">
            <td>Fecha Inicial: </td>
            <td><input type="text" name="finicial" id="finicial" class="form-control input-sm"  size="20" /></td>
            <td> &nbsp; &nbsp; &nbsp;Fecha Final: </td>
            <td><input type="text" name="ffinal" id="ffinal" class="form-control input-sm"  size="20" /></td>

            <td>

            <select name="documento" id="documento" class="form-control input-sm"  style="visibility:hidden">
                <option value="Venta">Consumo</option>
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
            <table class="table table-bordered table-bordered" id="reportes">
              <thead>
                <th WIDTH="100">Fecha</th>
                <th>Cliente</th>
                <th>Articulo</th>
                <th WIDTH="30">Cantidad</th>
                <th>Valor</th>
                <th>Total</th>

              <thead>

               <tbody>
                    <tr>
                        <td colspan=4><center>No Hay Información</center></td>
                    </tr>

               </tbody>
               <tfoot>
               <tr>
                <td colspan=5 align="right"> </td>
               <!-- <td><label id="lblimpuesto" name="lblimpuesto">$ 0</label></td>-->
               <!-- <td><label id="lblsubtotal" name="lblsubtotal">$ 0</label></td>-->
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
