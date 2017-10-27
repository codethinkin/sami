<div class="content-wrapper">
<!-- Content Header (Page header) -->
<!-- Main content -->
  <section class="content">
    <div>

      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Lista de Ordenes</a></li>
        <li role="presentation"><a href="#reportes" aria-controls="reportes" role="tab" data-toggle="tab">Reportes</a></li>
      <!--  <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>-->
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">

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

         <a href="<?php echo base_url('ordencompra/add_order'); ?> " class="btn btn-primary btn-xs" ><i class="glyphicon glyphicon-plus"></i> Nueva Compra</a>

                          <button class="btn btn-default btn-xs" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="tblConsumos" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="check-all"></th>
                            <th>Factura</th>
                            <th>Proveedor</th>
                            <th>Producto</th>
                            <th>Fecha Compra</th>
                            <th>Total</th>
                             <th style="width:150px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>

                </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->
            </div>

        </div>
        <div role="tabpanel" class="tab-pane" id="reportes">
HOla

        </div>
      <!--  <div role="tabpanel" class="tab-pane" id="messages">..d.</div>
        <div role="tabpanel" class="tab-pane" id="settings">.wer..</div>-->
      </div>

    </div>



    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
