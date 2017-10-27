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
          <h3 class="box-title">Tablero General </h3>
        </div>
        <div class="box-body" style="background: rgb(249, 250, 252);">
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $totalVentas; ?></h3>

                  <p>Consumo</p>
                </div>
                <div class="icon">
                    <a href="<?php echo base_url("consumos"); ?> "<i class="ion ion-bag"></i></a>
                </div>
                <a href="<?php echo base_url("consumos"); ?> " class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $totalCompras; ?><sup style="font-size: 20px"></sup></h3>

                  <p>Compras</p>
                </div>
                <div class="icon">
                  <a href="<?php echo base_url("ordencompra"); ?> "   <i class="ion ion-briefcase"></i></a>
                </div>
                  <a href="<?php echo base_url("ordencompra"); ?> "  class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $totalUser; ?></h3>

                  <p>Productos / Insumos</p>
                </div>
                <div class="icon">
                <a href="<?php echo base_url("product"); ?> "  <i class="ion ion-person-add"></i></a>
                </div>
                <a href="<?php echo base_url("product"); ?> " class="small-box-footer">Más Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $totalUser; ?></h3>

                  <p>Usuarios</p>
                </div>
                <div class="icon">
                  <a href="<?php echo base_url("user/userTable"); ?> " <i class="ion-ios-people-outline"></i></a>
                </div>
              <a href="<?php echo base_url("user/userTable"); ?> " class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
            </div>
            <!-- /.box-body -->

        <!-- /.content -->
<div class="row">

<div class="col-md-6">
  <div class="box box-success" >
    <div class="box-header with-border">
      <h3 class="box-title">Grafico Compras </h3>
    </div>
    <div class="box-body" style="background: rgb(249, 250, 252);">
  <div class="row">
<!--
  <div class="col-md-offset-3 col-md-3">
  <p>Seleccionar Año</p>
  <div class="caja">
  <div class="form-group">
  <select class="form-control" onchange="mostrarResultados(.this.value);" name="anio" id="anio">
    <?php
          for($i=2017; $i<2020;$i++){
            if($i == 2017){
                    echo '<option value="'.$i.'" selected>'.$i.'</option>';
  }else{
  echo '<option value="'.$i.'">'.$i.'</option>';
  }
  }
  ?>
  </select>

  </div>
-->
  </div>
  </div>


  </div>
<!--  <input type="button" id="btnBuscar" value="Graficar">-->

  <div id="contenedor_grafico">
  <canvas id="myChart" width="400" height="150"></canvas>
  </div>
  </div>



  <div class="col-md-6">
    <div class="box box-success" >
      <div class="box-header with-border">
        <h3 class="box-title">Grafico Ventas </h3>
      </div>
      <div class="box-body" style="background: rgb(249, 250, 252);">
    <div class="row">

    </div>
    </div>


    </div>
    <div id="contenedor_grafico_ventas">
    <canvas id="ventas" width="400" height="150"></canvas>
    </div>
    </div>
  </div>


</div>

</div>





    </div>
</section>      <!-- /.content-wrapper -->
