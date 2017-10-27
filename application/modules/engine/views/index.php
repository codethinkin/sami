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
          <h3 class="box-title">Configuración General Para </h3>
        </div>
        <div class="box-body" style="background: rgb(249, 250, 252);">
          <div class="row">
            <div class="col-lg-12">
              <div class="tabbable tabs-left">
                <ul id="myTab4" class="nav nav-tabs col-md-3">
                  <li class="active">
                    <a href="#tab_General" data-toggle="tab">
                      <i class="fa fa-cogs"></i>&nbsp;&nbsp;
                      <span>Motores</span>
                    </a>
                  </li>
                  <li>
                    <a href="#emailSetting" data-toggle="tab">
                      <i class="fa fa-envelope-o" aria-hidden="true"></i> &nbsp;&nbsp;
                      <span>Combustibles</span>
                    </a>
                  </li>
                  <li id="permis">
                    <a href="#permissionSetting" data-toggle="tab">
                      <i class="fa fa-indent" aria-hidden="true"></i>
                      <span>Capacidad de Carga</span>
                    </a>
                  </li>
                  <li id="templates">
                    <a href="#templates-div" data-toggle="tab">
                      <i class="fa fa-puzzle-piece" aria-hidden="true"></i>
                      <span>Mastil</span>
                    </a>
                  </li>
                </ul>
                <div class="tab-content col-md-9">
                  <div class="tab-pane fade in" id="templates-div"></div>
                    <div class="tab-pane fade active in" id="tab_General">
                      <div class="row">
                        <div class="box-header my-header">
                          <h3 class="box-title">Configuracion de Motores</h3>
                        </div>
                      </div>
                      <div class="box-body">

<div class="box-tools">
<button class="btn btn-primary btn-xs" onclick="add_engine()"><i class="glyphicon glyphicon-plus"></i> Nuevo Registro</button>
<button class="btn btn-default btn-xs" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>
</div>
                        <table id="tblEngine" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="check-all"></th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th style="width:150px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                    </table>
                      </div>


                        </div>
                        <div class="tab-pane fade" id="emailSetting">
                          <div class="row">
                            <div class="box-header my-header">
                              <h3 class="box-title">Configuración Combustibles</h3>
                            </div>
                          </div>

                          <div class="box-body">

                    <div class="box-tools">
                    <button class="btn btn-primary btn-xs" onclick="add_fuel()"><i class="glyphicon glyphicon-plus"></i> Nuevo Registro</button>
                    <button class="btn btn-default btn-xs" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>
                    </div>
                            <table id="tblFuele" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="check-all"></th>
                                    <th>Nombre</th>
                                    <th style="width:150px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>
                          </div>

                        </div>
                        <div class="tab-pane " id="permissionSetting">
                          <div class="row">
                            <div class="box-header my-header">
                              <h3 class="box-title">Permissions</h3>
                            </div>
                          </div>
                          <div class="panel-group" id="accordion">
                            <h5 class="over-title">
                              <div class="row form-horizontal">
                                <div class="col-md-3">
                                  <a class="btn btn-o btn-success" id="addmoreRoles" href="#"><i class="fa fa-plus"></i> Agregar Tipo de Usuario</a>
                                </div>
                                <div class="col-md-9">
                                  <div class="form-horizontal"  id="addmoreRolesShow">
                                    <form>
                                      <div class="form-group">
                                        <label for="roles" class="control-label col-md-2 thfont">Tipo de Usuario</label>
                                        <div class="col-md-5">
                                          <input type="text" name="roles"  id="roles"  class="form-control" placeholder="Ingrese Usuario" />
                                          <p id="showRolesMSG" style="color:red;"></p>
                                        </div>
                                        <button type="button" id="rolesAdd" class="btn  btn-success">Grabar</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </h5>
                          </div>
                          <form class="form-horizontal" action="<?php echo base_url().'setting/permission' ?>" method="post">
                          <?php
                          $permission = getAllDataByTable('permission');
                          $setPermission =array();
                          $own_create = '';$own_read = '';$own_update = '';$own_delete = '';
                          $all_create = '';$all_read = '';$all_update = '';$all_delete = '';
                          $i=0;
                          $permission = isset($permission)&&is_array($permission)&&!empty($permission)?$permission:array();
                          if(isset($permission[1])) {
                            foreach($permission as $perkey=>$value){
                              $id = isset($value->id)?$value->id:'';
                              $user_type = isset($value->user_type)?$value->user_type:'';
                              $data = isset($value->data)?json_decode($value->data):'';
                              if($user_type=='admin'){}else{
                          ?>
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $id;?>"><i class="fa fa-bars"></i> <?php echo  'Permissions for: '. ucfirst($user_type);?></a></h4>
                                  </div>
                                  <div id="collapse_<?php echo $id;?>" class="panel-collapse collapse <?php if($i==0){echo"in";}?>">
                                    <div class="panel-body">
                                      <table class="table table-bordered dt-responsive rolesPermissionTable">
                                        <thead>
                                          <tr class="showRolesPermission">
                                            <th scope="col">Modules</th>
                                            <th scope="col">Create</th>
                                            <th scope="col">Read</th>
                                            <th scope="col">Update</th>
                                            <th scope="col">Delete</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                          if(isset($data) && !empty($data)){
                                            foreach($data as $perkey=>$valueR){
                                              $perkey = isset($perkey)?$perkey:'';
                                              $valueR = isset($valueR)?$valueR:'';
                                              if(isset($valueR)) {
                                                $setPermissionCheck = $valueR;
                                                $own_create = isset($setPermissionCheck->own_create)?$setPermissionCheck->own_create:'';
                                                $own_read = isset($setPermissionCheck->own_read)?$setPermissionCheck->own_read:'';
                                                $own_update = isset($setPermissionCheck->own_update)?$setPermissionCheck->own_update:'';
                                                $own_delete = isset($setPermissionCheck->own_delete)?$setPermissionCheck->own_delete:'';
                                                $all_create = isset($setPermissionCheck->all_create)?$setPermissionCheck->all_create:'';
                                                $all_read = isset($setPermissionCheck->all_read)?$setPermissionCheck->all_read:'';
                                                $all_update = isset($setPermissionCheck->all_update)?$setPermissionCheck->all_update:'';
                                                $all_delete = isset($setPermissionCheck->all_delete)?$setPermissionCheck->all_delete:'';
                                              } else {
                                                $setPermissionCheck =array();$own_create = '';$own_read = '';$own_update = '';$own_delete = '';
                                                $all_create = '';$all_read = '';$all_update = '';$all_delete = '';
                                              }
                                            ?>
                                              <tr>
                                                <th scope="col" colspan="5" class="showRolesPermission text-center"><?php echo ucfirst(str_replace('_', ' ', $perkey));?>
                                                  <?php
                                                        //$perkey = str_replace(' ', '_SPACE_', $perkey);
                                                        $user_type = str_replace(' ', '_SPACE_', $user_type);
                                                  ?>
                                                  <input type="hidden" name="data[<?php echo $user_type;?>][<?php echo $perkey;?>]" value="<?php echo $perkey;?>" />
                                                </th>
                                              </tr>
                                              <tr>
                                                <th scope="row" class="thfont">Entradas Propias</th>
                                                <td><input type="checkbox" name="data[<?php echo $user_type;?>][<?php echo $perkey;?>][own_create]" value="1" <?php if($own_create==1){echo"checked";}?>/></td>
                                                <td><input type="checkbox" name="data[<?php echo $user_type;?>][<?php echo $perkey;?>][own_read]"  value="1" <?php if($own_read==1){echo"checked";}?>/></td>
                                                <td><input type="checkbox" name="data[<?php echo $user_type;?>][<?php echo $perkey;?>][own_update]"  value="1" <?php if($own_update==1){echo"checked";}?>/></td>
                                                <td><input type="checkbox" name="data[<?php echo $user_type;?>][<?php echo $perkey;?>][own_delete]" value="1" <?php if($own_delete==1){echo"checked";}?>/></td>
                                              </tr>
                                              <tr>
                                                <th scope="row" class="thfont">Todas las Entradas</th>
                                                <td>-</td>
                                                <td><input type="checkbox" name="data[<?php echo $user_type;?>][<?php echo $perkey;?>][all_read]"  value="1" <?php if($all_read==1){echo"checked";}?>/></td>
                                                <td><input type="checkbox" name="data[<?php echo $user_type;?>][<?php echo $perkey;?>][all_update]"  value="1" <?php if($all_update==1){echo"checked";}?> /></td>
                                                <td><input type="checkbox" name="data[<?php echo $user_type;?>][<?php echo $perkey;?>][all_delete]" value="1" <?php if($all_delete==1){echo"checked";}?>/></td>
                                              </tr>
                                      <?php }
                                          } else {
                                            $blanckModule1 = getRowByTableColomId('permission','admin','user_type','data');
                                            if(isset($blanckModule1) && $blanckModule1 != '') {
                                              foreach(json_decode($blanckModule1) as $key1=>$value1) {
                                      ?>
                                                <tr>
                                                  <th scope="col" colspan="5" class="showRolesPermission text-center"><?php echo ucfirst(str_replace('_', ' ', $key1));?>
                                                    <?php
                                                      //$key1 = str_replace(' ', '_SPACE_', $key1);
                                                      $user_type = str_replace(' ', '_SPACE_', $user_type);
                                                    ?>
                                                    <input type="hidden" name="data[<?php echo $user_type;?>][<?php echo $key1;?>]" value="<?php echo $key1;?>" />
                                                  </th>
                                                </tr>
                                                <tr>
                                                  <th scope="row" class="thfont">Entradas Propias</th>
                                                  <td><input type="checkbox" name="data[<?php echo $user_type;?>][<?php echo $key1;?>][own_create]" value="1"/></td>
                                                  <td><input type="checkbox" name="data[<?php echo $user_type;?>][<?php echo $key1;?>][own_read]"  value="1"/></td>
                                                  <td><input type="checkbox" name="data[<?php echo $user_type;?>][<?php echo $key1;?>][own_update]"  value="1"/></td>
                                                  <td><input type="checkbox" name="data[<?php echo $user_type;?>][<?php echo $key1;?>][own_delete]" value="1"/></td>
                                                </tr>
                                                <tr>
                                                  <th scope="row" class="thfont">Todas las Entradas</th>
                                                  <td>-</td>
                                                  <td><input type="checkbox" name="data[<?php echo $user_type;?>][<?php echo $key1;?>][all_read]"  value="1"/></td>
                                                  <td><input type="checkbox" name="data[<?php echo $user_type;?>][<?php echo $key1;?>][all_update]"  value="1"/></td>
                                                  <td><input type="checkbox" name="data[<?php echo $user_type;?>][<?php echo $key1;?>][all_delete]" value="1"/></td>
                                                </tr>
                                          <?php
                                              }
                                            }
                                          }
                                          ?>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                        <?php
                                $i++;
                              }
                            }
                        ?>
                            <hr>
                            <input type="submit" name="save" value="Grabar Permisos" class="btn btn-wide btn-success margin-top-20" />
                    <?php } ?>
                          </form>
                        </div>
                        <!-- /.panel -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <div class="modal fade" id="modal_form" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="modal-title">Person Form</h3>
                  </div>
                  <div class="modal-body form">
                      <form action="#" id="form_engine" class="form-horizontal">
                      <input type="hidden" value="" name="id"/>
                          <div class="form-body">
                              <div id="msgbx_err" class="alert-box error" display="none" style="color:red;"></div>

                              <div class="form-group">
                                  <label class="control-label col-md-3">Nombre</label>
                                  <div class="col-md-9">
                                      <input name="name" id="name" placeholder="" class="form-control input-sm" type="text" required>
                                      <span class="help-block"></span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-md-3">Tipo Motor</label>
                                  <div class="col-md-9">
                                      <input name="type" id="type" placeholder="" class="form-control input-sm" type="text" required>
                                      <span class="help-block"></span>
                                  </div>
                              </div>

                                      </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" id="btnSave" onclick="save_engine()" class="btn btn-primary btn-xs">Grabar</button>
                      <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->


<!--Modal Combustibles-->
      <div class="modal fade" id="modal_form_fuel" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_fuel" class="form-horizontal">
                <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div id="msgbx_err" class="alert-box error" display="none" style="color:red;"></div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Nombre</label>
                            <div class="col-md-9">
                                <input name="name" id="name" placeholder="" class="form-control input-sm" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>


                                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save_fuel()" class="btn btn-primary btn-xs">Grabar</button>
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!--Fin Modal Combustibles-->

      <script>
    var currentLocation = window.location;
      var table;
      var table2;

      $(document).ready(function() {
      validate();

          //datatables
          table = $('#tblEngine').DataTable({
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
                        "searchPlaceholder":		"Dato para buscar",
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
                      },

                  "lengthMenu":		[[8, 10, 20, 25, 50, -1], [8, 10, 20, 25, 50, "Todos"]],
                        "iDisplayLength":	8,
                          "processing": true, //Feature control the processing indicator.
                          "serverSide": true, //Feature control DataTables' server-side processing mode.
                          "order": [], //Initial no order.
                    "processing": true, //Feature control the processing indicator.
              "serverSide": true, //Feature control DataTables' server-side processing mode.
              "order": [], //Initial no order.

              // Load data for the table's content from an Ajax source
              "ajax": {
                  "url": "<?php echo site_url('Engine/ajax_list')?>",
                  "type": "POST"
              },

              //Set column definition initialisation properties.
              "columnDefs": [
              {
                  "targets": [ 0 ], //first column / numbering column
                  "orderable": false, //set not orderable
              },
              ],

          });

          table2 = $('#tblFuele').DataTable({
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
                        "searchPlaceholder":		"Dato para buscar",
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
                      },

                  "lengthMenu":		[[8, 10, 20, 25, 50, -1], [8, 10, 20, 25, 50, "Todos"]],
                        "iDisplayLength":	8,
                          "processing": true, //Feature control the processing indicator.
                          "serverSide": true, //Feature control DataTables' server-side processing mode.
                          "order": [], //Initial no order.
                    "processing": true, //Feature control the processing indicator.
              "serverSide": true, //Feature control DataTables' server-side processing mode.
              "order": [], //Initial no order.

              // Load data for the table's content from an Ajax source
              "ajax": {
                  "url": "<?php echo site_url('engine/ajax_list_fuel')?>",
                  "type": "POST"
              },

              //Set column definition initialisation properties.
              "columnDefs": [
              {
                  "targets": [ 0 ], //first column / numbering column
                  "orderable": false, //set not orderable
              },
              ],

          });

              //set input/textarea/select event when change value, remove class error and remove text help block

              $("input").change(function(){
                  $(this).parent().parent().removeClass('has-error');
                  $(this).next().empty();
              });
              $("textarea").change(function(){
                  $(this).parent().parent().removeClass('has-error');
                  $(this).next().empty();
              });
              $("select").change(function(){
                  $(this).parent().parent().removeClass('has-error');
                  $(this).next().empty();
              });

              //check all

              $("#check-all").click(function () {
                  $(".data-check").prop('checked', $(this).prop('checked'));
              });

      });

      function add_fuel(){
          save_method = 'add';


          $('#form_fuel')[0].reset(); // reset form on modals
          $('.form-group').removeClass('has-error'); // clear error class
          $('.help-block').empty(); // clear error string
          $('#modal_form').modal('show'); // show bootstrap modal
          $('.modal-title').text('Registro Nuevo de Motor'); // Set Title to Bootstrap modal title
      }

      function edit_fuel(id)
      {
          save_method = 'update';

          $('#form_fuel')[0].reset(); // reset form on modals
          $('.form-group').removeClass('has-error'); // clear error class
          $('.help-block').empty(); // clear error string



          $.ajax({
               //url: "<?php echo site_url('Engine/ajax_edit')?>"/+id,
             url : currentLocation + "/engine/ajax_edit/"+id,
              type: "GET",
              dataType: "JSON",
              success: function(data)
              {
                  $('[name="id"]').val(data.id);
                  $('[name="name"]').val(data.nameFuel);
                  $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                  $('.modal-title').text('Editar Motor'); // Set title to Bootstrap modal title
              },

              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error get data from ajax');
              }
          });

      }


      function reload_table()
      {
          table.ajax.reload(null,false); //reload datatable ajax
      }

      function save_engine()
      {
      //  validate();


          $('#btnSave').text('saving...'); //change button text
          $('#btnSave').attr('disabled',true); //set button disable
          var url;
          if(save_method == 'add') {
              url = currentLocation + "/engine/ajax_add_fuel/";
          } else {
              url = currentLocation + "/engine/ajax_update_fuel/";
          }

          var formData = new FormData($('#form_fuel')[0]);
          $.ajax({
              url : url,
              type: "POST",
              data: formData,
              contentType: false,
              processData: false,
              dataType: "JSON",
              success: function(data)
              {
                  if(data.status) //if success close modal and reload ajax table
                  {
                      $('#modal_form').modal('hide');
                      reload_table();
                  }
                  else
                  {
                      for (var i = 0; i < data.inputerror.length; i++)
                      {
                          $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                          $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                      }
                  }
                  $('#btnSave').text('Grabar'); //change button text
                  $('#btnSave').attr('disabled',false); //set button enable
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error al Guardar ó  Actualizar la Información');
                  $('#btnSave').text('Grabar'); //change button text
                  $('#btnSave').attr('disabled',false); //set button enable
              }

          });

      }


      function delete_fuel(id)
      {
          if(confirm('Esta seguro de borrar esta información?'))
          {
              // ajax delete data to database
              $.ajax({
                  url : currentLocation + "/engine/ajax_delete_fuel/"+id,
                  type: "POST",
                  dataType: "JSON",
                  success: function(data)
                  {
                              $('#modal_form_fuel').modal('hide');
                      reload_table();
                  },
                error: function (jqXHR, textStatus, errorThrown)
                  {
                      alert('Error al tratar de borrar la información');
                  }
              });
          }
      }



      function validate(){

        $('#msgbx_err').hide();
           $('#name').blur(function(){
              var email_val = $("#nit").val();
              if(email_val){
                  $('#msgbx_err').show();
                  $.post(currentLocation + "/engine/nit_check_Engine", {
                      nit: email_val
                  }, function(response){
                      $('#loading').hide();
                      $('#msgbx_err').html('').html(response.message).show().delay(6000).fadeOut();
                  });
                  return false;
              }
          });

      }

      function detail_Engine(id)
      {
        $('#form_engine')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_detail').modal('show'); // show bootstrap modal

        //Ajax Load data from ajax

        $.ajax({
            url : currentLocation + "/engine/ajax_edit/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
              $('[name="id"]').val(data.id);
              $('[name="name"]').val(data.nameEngine);
              $('[name="type"]').val(data.type);
               $('.modal-title').text('Movimientos del Motores'); // Set Title to Bootstrap modal title

            },

            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
      }
      </script>
