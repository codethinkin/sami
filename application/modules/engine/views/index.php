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

<div class="row">
<div class="col-md-4">

  <div class="container">

<!--Configuracion de Motores-->
  <div class="card hovercard">
     <img src="http://placehold.it/300x200/000000/&text=Header" alt=""/>
     <div class="avatar">
        <img src="http://placehold.it/80X80/333333/&text=Head" alt="" />
     </div>
     <div class="info">
        <div class="title">
           Tipo Motor
        </div>
        <div class="desc">Ingrese Los Diferentes Tipos de Motores</div>

     </div>
     <div class="bottom">
       <button type="button" class="btn btn-primary" onclick="save_engine()">Abrir
       </button>
     </div>
  </div>
  </div>
</div>
<!--Fin Configuracion de motores-->

<!--Configuracion de combustible-->
<div class="col-md-4">

  <div class="container">

<!--Configuracion de Motores-->
  <div class="card hovercard">
     <img src="http://placehold.it/300x200/000000/&text=Header" alt=""/>
     <div class="avatar">
        <img src="http://placehold.it/80X80/333333/&text=Head" alt="" />
     </div>
     <div class="info">
        <div class="title">
           Tipo de Combustibles
        </div>
        <div class="desc">Ingrese Los Diferentes Tipos de Combustibles</div>

     </div>
     <div class="bottom">
       <button type="button" class="btn btn-primary" onclick="save_fuel()">Abrir
       </button>
     </div>
  </div>
  </div>
</div>
<!--Fion Configuracion de Combustibles-->
<!-- Configuracion de Capacidad  de Carga-->
<div class="col-md-4">

  <div class="container">
<!--Configuracion de Motores-->
  <div class="card hovercard">
     <img src="http://placehold.it/300x200/000000/&text=Header" alt=""/>
     <div class="avatar">
        <img src="http://placehold.it/80X80/333333/&text=Head" alt="" />
     </div>
     <div class="info">
        <div class="title">
           Capacidad de Carga
        </div>
        <div class="desc">Ingrese Los Diferentes Capacidades de Carga</div>

     </div>
     <div class="bottom">
       <button type="button" class="btn btn-primary" onclick="save_load()">Abrir
       </button>
     </div>
  </div>
  </div>
</div>
<!-- Configuracion de Capacidad  de Carga-->
</div>
<div class="row">
<div class="col-md-4">

  <div class="container">
<!--Configuracion de Motores-->
  <div class="card hovercard">
     <img src="http://placehold.it/300x200/000000/&text=Header" alt=""/>
     <div class="avatar">
        <img src="http://placehold.it/80X80/333333/&text=Head" alt="" />
     </div>
     <div class="info">
        <div class="title">
           Tipo Equipo
        </div>
        <div class="desc">Ingrese Los Diferentes Tipos de Equipo</div>

     </div>
     <div class="bottom">
       <button type="button" class="btn btn-primary" onclick="save_equipment()">Abrir
       </button>
     </div>
  </div>
  </div>
</div>
<!--Fin Configuracion de motores-->
<!--Configuracion de combustible-->
<div class="col-md-4">
  <div class="container">
<!--Configuracion de Motores-->
  <div class="card hovercard">
     <img src="http://placehold.it/300x200/000000/&text=Header" alt=""/>
     <div class="avatar">
        <img src="http://placehold.it/80X80/333333/&text=Head" alt="" />
     </div>
     <div class="info">
        <div class="title">
           Mastil
        </div>
        <div class="desc">Ingrese Mastil</div>

     </div>
     <div class="bottom">
       <button type="button" class="btn btn-primary" onclick="save_mastil()">Abrir
       </button>
     </div>
  </div>
  </div>
</div>
<!--Fion Configuracion de Mastil-->
<div class="col-md-4">

  <div class="container">
<!--Configuracion de Motores-->
  <div class="card hovercard">
     <img src="http://placehold.it/300x200/000000/&text=Header" alt=""/>
     <div class="avatar">
        <img src="http://placehold.it/80X80/333333/&text=Head" alt="" />
     </div>
     <div class="info">
        <div class="title">
           Etapas
        </div>
        <div class="desc">Ingrese Las Diferentes Etapas</div>

     </div>
     <div class="bottom">
       <button type="button" class="btn btn-primary" onclick="save_etapa()">Abrir
       </button>
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
      <div class="modal fade" id="modal_form_engine" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h3 class="modal-title">Person Form</h3>
                  </div>
                  <div class="modal-body form">

                    <table id="tblengine" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
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
<hr>
<label for="" class="label-info">Formulario de Registro</label>
<hr>
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
                      <button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-xs">Grabar</button>
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

                        <table id="tblfuel" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
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
      <hr>
      <label for="" class="label-info">Formulario de Registro</label>
      <hr>

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
                <button type="button" id="btnSave" onclick="add_fuel()" class="btn btn-primary btn-xs">Grabar</button>
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--Modal Carga-->
      <div class="modal fade" id="modal_form_load" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_load" class="form-horizontal">
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
                <button type="button" id="btnSave" onclick="add_load()" class="btn btn-primary btn-xs">Grabar</button>
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Fin Modal Carga-->


<!--Modal Equipo-->
      <div class="modal fade" id="modal_form_equipment" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_equipment" class="form-horizontal">
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
                <button type="button" id="btnSave" onclick="add_equipment()" class="btn btn-primary btn-xs">Grabar</button>
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!--Modal mastil-->
      <div class="modal fade" id="modal_form_mastil" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_mastil" class="form-horizontal">
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
                <button type="button" id="btnSave" onclick="add_mastil()" class="btn btn-primary btn-xs">Grabar</button>
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!--Modal etapa-->
      <div class="modal fade" id="modal_form_etapa" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_etapa" class="form-horizontal">
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
                <button type="button" id="btnSave" onclick="add_etapa()" class="btn btn-primary btn-xs">Grabar</button>
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
var currentLocation = window.location;
var table;

$(document).ready(function() {
//validate();

    //datatables
    table = $('#tblengine').DataTable({
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
                    "order": [], //Inameial no order.
              "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Inameial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('engine/ajax_list')?>",
            "type": "POST"
        },

        //Set column definameion inameialisation properties.
        "columnDefs": [
        {
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],

    });

        //set input/textarea/select event when change value, remove class error and remove text help block

/*
    table = $('#tblfuel').DataTable({
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
                        "order": [], //Inameial no order.
                  "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Inameial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('engine/ajax_list_fuel')?>",
                "type": "POST"
            },

            //Set column definameion inameialisation properties.
            "columnDefs": [
            {
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
            ],

        });*/

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

function save_engine(){
    save_method = 'add';
    $('#form_engine')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_engine').modal('show'); // show bootstrap modal
    $('.modal-title').text('Registro nuevo Tipo de Equipo'); // Set Title to Bootstrap modal title
}
function edit_engine(id){
    save_method = 'update';

    $('#form_engine')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string



    $.ajax({
         //url: "<?php echo site_url('engine/ajax_edit')?>"/+id,
       url : currentLocation + "/engine/ajax_edit/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="nameEngine"]').val(data.name);
            $('[name="type"]').val(data.type);
            $('#modal_form_engine').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Tipo Motor'); // Set title to Bootstrap modal title
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}
function reload_table(){
    table.ajax.reload(null,false); //reload datatable ajax
}
function save(){
  validate();
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
    if(save_method == 'add') {
        url = currentLocation + "/engine/ajax_add/";
    } else {
        url = currentLocation + "/engine/ajax_update/";
    }

    var formData = new FormData($('#form_engine')[0]);
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
            alertify.alert('Error!', 'Error al Guardar ó  Actualizar la Información, Posiblemente el Campo a Registrar ya Exista... Contacte al administrador....', function(){ alertify.success('Ok'); });

            $('#btnSave').text('Grabar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }

    });

}
function delete_engine(id){
    if(confirm('Esta seguro de borrar esta información?'))
    {
        // ajax delete data to database
        $.ajax({
            url : currentLocation + "/engine/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                        $('#modal_form').modal('hide');
                reload_table();
            },
          error: function (jqXHR, textStatus, errorThrown)
            {
                  alertify.alert('Error!', 'No es posible borar la información... Contacte al administrador....', function(){ alertify.success('Ok'); });
            }
        });
    }
}
function bulk_delete(){
    var list_id = [];
    $(".data-check:checked").each(function() {
            list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
        if(confirm('Are you sure delete this '+list_id.length+' data?'))
        {
            $.ajax({
                type: "POST",
                data: {id:list_id},
                url: currentLocation + "/engine/ajax_bulk_delete_engine",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                      reload_table();
                    }
                    else
                    {
                          alertify.alert('Error!', 'Error... Contacte al administrador....', function(){ alertify.success('Ok'); });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                      alertify.alert('Error!', 'Error al Eliminar la información... Contacte al administrador....', function(){ alertify.success('Ok'); });
                }
            });
        }
    }
    else
    {
        alert('no data selected');
    }
}
function validate(){
$('#msgbx_err').hide();
$('#name').blur(function() {
var url= currentLocation + "/engine/chk_usr";
          var name = $("#name").val();
                   $.post(url, {code: name}, function(d) {
                       if (d == 1)
                       {
                          //  alertify.alert();
                       alertify.alert('Error!', 'La Categoria ya se encuentra registrada', function(){ alertify.success('Ok'); });
                          // $('#msgbx_err').show();
                          // $('#code').focus();
                       }
                       else
                       {
                           $('#msgbx_err').hide();
                       }
                   });
               });
}
function detail_engine(id){
  $('#form')[0].reset(); // reset form on modals
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
          $('[name="nameEngine"]').val(data.name);
          $('[name="type"]').val(data.type);
         $('.modal-title').text('Movimientos del engineos'); // Set Title to Bootstrap modal title

      },

      error: function (jqXHR, textStatus, errorThrown)
      {
          alert('Error get data from ajax');
      }
  });
}
<!--Fin Configuracion Combustible-->

<!--Configuracion Combustible-->

function save_fuel(){
    save_method = 'add';
    $('#form_fuel')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_fuel').modal('show'); // show bootstrap modal
    $('.modal-title').text('Registro nuevo Tipo de Combustible'); // Set Title to Bootstrap modal title
}
function edit_fuel(id){
    save_method = 'update';

    $('#form_fuel')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string



    $.ajax({
         //url: "<?php echo site_url('engine/ajax_edit_fuel')?>"/+id,
       url : currentLocation + "/engine/ajax_edit_fuel/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="nameFuel"]').val(data.name);
            $('#modal_form_fuel').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Tipo de Combustible'); // Set title to Bootstrap modal title
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}
function reload_table(){
    table.ajax.reload(null,false); //reload datatable ajax
}
function add_fuel(){

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
                $('#modal_form_fuel').modal('hide');
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
            alertify.alert('Error!', 'Error al Guardar ó  Actualizar la Información, Posiblemente el Campo a Registrar ya Exista... Contacte al administrador....', function(){ alertify.success('Ok'); });

            $('#btnSave').text('Grabar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }

    });

}
function delete_fuel(id){
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
                  alertify.alert('Error!', 'No es posible borar la información... Contacte al administrador....', function(){ alertify.success('Ok'); });
            }
        });
    }
}
function bulk_delete_fuel(){
    var list_id = [];
    $(".data-check:checked").each(function() {
            list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
        if(confirm('Are you sure delete this '+list_id.length+' data?'))
        {
            $.ajax({
                type: "POST",
                data: {id:list_id},
                url: currentLocation + "/engine/ajax_bulk_delete_fuel",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                      reload_table();
                    }
                    else
                    {
                          alertify.alert('Error!', 'Error... Contacte al administrador....', function(){ alertify.success('Ok'); });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                      alertify.alert('Error!', 'Error al Eliminar la información... Contacte al administrador....', function(){ alertify.success('Ok'); });
                }
            });
        }
    }
    else
    {
        alert('no data selected');
    }
}
<!--Fin Configuracion Combustible-->

<!--Configuracion Carga-->
function save_load(){
    save_method = 'add';
    $('#form_load')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_load').modal('show'); // show bootstrap modal
    $('.modal-title').text('Registro Nueva Capaciadad De Carga'); // Set Title to Bootstrap modal title
}
function edit_load(id){
    save_method = 'update';

    $('#form_load')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string



    $.ajax({
         //url: "<?php echo site_url('engine/ajax_edit_load')?>"/+id,
       url : currentLocation + "/engine/ajax_edit_load/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="nameload"]').val(data.name);
            $('#modal_form_load').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Tipo de Combustible'); // Set title to Bootstrap modal title
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}
function reload_table(){
    table.ajax.reload(null,false); //reload datatable ajax
}
function add_load(){
  validate();
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
    if(save_method == 'add') {
        url = currentLocation + "/engine/ajax_add_load/";
    } else {
        url = currentLocation + "/engine/ajax_update_load/";
    }

    var formData = new FormData($('#form_load')[0]);
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
                $('#modal_form_load').modal('hide');
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
            alertify.alert('Error!', 'Error al Guardar ó  Actualizar la Información, Posiblemente el Campo a Registrar ya Exista... Contacte al administrador....', function(){ alertify.success('Ok'); });

            $('#btnSave').text('Grabar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }

    });

}
function delete_load(id){
    if(confirm('Esta seguro de borrar esta información?'))
    {
        // ajax delete data to database
        $.ajax({
            url : currentLocation + "/engine/ajax_delete_load/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                        $('#modal_form_load').modal('hide');
                reload_table();
            },
          error: function (jqXHR, textStatus, errorThrown)
            {
                  alertify.alert('Error!', 'No es posible borar la información... Contacte al administrador....', function(){ alertify.success('Ok'); });
            }
        });
    }
}
function bulk_delete_load(){
    var list_id = [];
    $(".data-check:checked").each(function() {
            list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
        if(confirm('Are you sure delete this '+list_id.length+' data?'))
        {
            $.ajax({
                type: "POST",
                data: {id:list_id},
                url: currentLocation + "/engine/ajax_bulk_delete_load",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                      reload_table();
                    }
                    else
                    {
                          alertify.alert('Error!', 'Error... Contacte al administrador....', function(){ alertify.success('Ok'); });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                      alertify.alert('Error!', 'Error al Eliminar la información... Contacte al administrador....', function(){ alertify.success('Ok'); });
                }
            });
        }
    }
    else
    {
        alert('no data selected');
    }
}
<!--Fin Configuracion Carga-->

<!--Configuracion Tipo Equipo-->

function save_equipment(){
    save_method = 'add';
    $('#form_equipment')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_equipment').modal('show'); // show bootstrap modal
    $('.modal-title').text('Registro nuevo Tipo De Equipo'); // Set Title to Bootstrap modal title
}
function edit_equipment(id){
    save_method = 'update';

    $('#form_equipment')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string



    $.ajax({
         //url: "<?php echo site_url('engine/ajax_edit_equipment')?>"/+id,
       url : currentLocation + "/engine/ajax_edit_equipment/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="nameType"]').val(data.name);
            $('#modal_form_equipment').modal('show'); // show bootstrap modal when complete equipmented
            $('.modal-title').text('Editar Tipo de Equipo'); // Set title to Bootstrap modal title
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}
function equipment_table(){
    table.ajax.equipment(null,false); //reequipment datatable ajax
}
function add_equipment(){
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
    if(save_method == 'add') {
        url = currentLocation + "/engine/ajax_add_equipment/";
    } else {
        url = currentLocation + "/engine/ajax_update_equipment/";
    }

    var formData = new FormData($('#form_equipment')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reequipment ajax table
            {
                $('#modal_form_equipment').modal('hide');
                reequipment_table();
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
            alertify.alert('Error!', 'Error al Guardar ó  Actualizar la Información, Posiblemente el Campo a Registrar ya Exista... Contacte al administrador....', function(){ alertify.success('Ok'); });

            $('#btnSave').text('Grabar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }

    });

}
function delete_equipmet(id){
    if(confirm('Esta seguro de borrar esta información?'))
    {
        // ajax delete data to database
        $.ajax({
            url : currentLocation + "/engine/ajax_delete_equipment/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                        $('#modal_form_equipment').modal('hide');
                reequipment_table();
            },
          error: function (jqXHR, textStatus, errorThrown)
            {
                  alertify.alert('Error!', 'No es posible borar la información... Contacte al administrador....', function(){ alertify.success('Ok'); });
            }
        });
    }
}
function bulk_delete_equipment(){
    var list_id = [];
    $(".data-check:checked").each(function() {
            list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
        if(confirm('Are you sure delete this '+list_id.length+' data?'))
        {
            $.ajax({
                type: "POST",
                data: {id:list_id},
                url: currentLocation + "/engine/ajax_bulk_delete_equipment",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                      reequipment_table();
                    }
                    else
                    {
                          alertify.alert('Error!', 'Error... Contacte al administrador....', function(){ alertify.success('Ok'); });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                      alertify.alert('Error!', 'Error al Eliminar la información... Contacte al administrador....', function(){ alertify.success('Ok'); });
                }
            });
        }
    }
    else
    {
        alert('no data selected');
    }
}

<!--Fin Configuracion tipo equipo-->

<!--configuracion Mastil-->
function save_mastil(){
    save_method = 'add';
    $('#form_mastil')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_mastil').modal('show'); // show bootstrap modal
    $('.modal-title').text('Registro Nuevo Mastil'); // Set Title to Bootstrap modal title
}
function edit_mastil(id){
    save_method = 'update';

    $('#form_mastil')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string



    $.ajax({
         //url: "<?php echo site_url('engine/ajax_edit_mastil')?>"/+id,
       url : currentLocation + "/engine/ajax_edit_mastil/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="nameMastil"]').val(data.name);
            $('#modal_form_mastil').modal('show'); // show bootstrap modal when complete mastiled
            $('.modal-title').text('Editar Mastil'); // Set title to Bootstrap modal title
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}
function mastil_table(){
    table.ajax.mastil(null,false); //remastil datatable ajax
}
function add_mastil(){
  validate();
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
    if(save_method == 'add') {
        url = currentLocation + "/engine/ajax_add_mastil/";
    } else {
        url = currentLocation + "/engine/ajax_update_mastil/";
    }

    var formData = new FormData($('#form_mastil')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and remastil ajax table
            {
                $('#modal_form_mastil').modal('hide');
                remastil_table();
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
            alertify.alert('Error!', 'Error al Guardar ó  Actualizar la Información, Posiblemente el Campo a Registrar ya Exista... Contacte al administrador....', function(){ alertify.success('Ok'); });

            $('#btnSave').text('Grabar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }

    });

}
function delete_mastile(id){
    if(confirm('Esta seguro de borrar esta información?'))
    {
        // ajax delete data to database
        $.ajax({
            url : currentLocation + "/engine/ajax_delete_mastil/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                        $('#modal_form_mastil').modal('hide');
                remastil_table();
            },
          error: function (jqXHR, textStatus, errorThrown)
            {
                  alertify.alert('Error!', 'No es posible borar la información... Contacte al administrador....', function(){ alertify.success('Ok'); });
            }
        });
    }
}
function bulk_delete_mastil(){
    var list_id = [];
    $(".data-check:checked").each(function() {
            list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
        if(confirm('Are you sure delete this '+list_id.length+' data?'))
        {
            $.ajax({
                type: "POST",
                data: {id:list_id},
                url: currentLocation + "/engine/ajax_bulk_delete_mastil",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                      remastil_table();
                    }
                    else
                    {
                          alertify.alert('Error!', 'Error... Contacte al administrador....', function(){ alertify.success('Ok'); });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                      alertify.alert('Error!', 'Error al Eliminar la información... Contacte al administrador....', function(){ alertify.success('Ok'); });
                }
            });
        }
    }
    else
    {
        alert('no data selected');
    }
}
<!--Fin Configuracion Mastil-->

<!--Configuracion Etapa-->
function save_etapa(){
    save_method = 'add';
    $('#form_etapa')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_etapa').modal('show'); // show bootstrap modal
    $('.modal-title').text('Registro Nueva Etapa'); // Set Title to Bootstrap modal title
}
function edit_etapa(id){
    save_method = 'update';

    $('#form_etapa')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string



    $.ajax({
         //url: "<?php echo site_url('engine/ajax_edit_etapa')?>"/+id,
       url : currentLocation + "/engine/ajax_edit_etapa/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="nameEtapa"]').val(data.name);
            $('#modal_form_etapa').modal('show'); // show bootstrap modal when complete etapaed
            $('.modal-title').text('Editar Nueva Etapa'); // Set title to Bootstrap modal title
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}
function etapa_table(){
    table.ajax.etapa(null,false); //reetapa datatable ajax
}
function add_etapa(){

    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
    if(save_method == 'add') {
        url = currentLocation + "/engine/ajax_add_etapa/";
    } else {
        url = currentLocation + "/engine/ajax_update_etapa/";
    }

    var formData = new FormData($('#form_etapa')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reetapa ajax table
            {
                $('#modal_form_etapa').modal('hide');
                reetapa_table();
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
            alertify.alert('Error!', 'Error al Guardar ó  Actualizar la Información, Posiblemente el Campo a Registrar ya Exista... Contacte al administrador....', function(){ alertify.success('Ok'); });

            $('#btnSave').text('Grabar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }

    });

}
function delete_etapa(id){
    if(confirm('Esta seguro de borrar esta información?'))
    {
        // ajax delete data to database
        $.ajax({
            url : currentLocation + "/engine/ajax_delete_etapa/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                        $('#modal_form_etapa').modal('hide');
                reetapa_table();
            },
          error: function (jqXHR, textStatus, errorThrown)
            {
                  alertify.alert('Error!', 'No es posible borar la información... Contacte al administrador....', function(){ alertify.success('Ok'); });
            }
        });
    }
}
function bulk_delete_etapa(){
    var list_id = [];
    $(".data-check:checked").each(function() {
            list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
        if(confirm('Are you sure delete this '+list_id.length+' data?'))
        {
            $.ajax({
                type: "POST",
                data: {id:list_id},
                url: currentLocation + "/engine/ajax_bulk_delete_etapa",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                      reetapa_table();
                    }
                    else
                    {
                          alertify.alert('Error!', 'Error... Contacte al administrador....', function(){ alertify.success('Ok'); });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                      alertify.alert('Error!', 'Error al Eliminar la información... Contacte al administrador....', function(){ alertify.success('Ok'); });
                }
            });
        }
    }
    else
    {
        alert('no data selected');
    }
}
<!--Fin Configuracion Etapa-->
</script>
