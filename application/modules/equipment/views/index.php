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
            <h3 class="box-title">Tablero | Equipos Registrados </h3>
            <div class="box-tools">
                  <button class="btn btn-primary btn-xs" onclick="add_equipment()"><i class="glyphicon glyphicon-plus"></i> Nuevo Equipo</button>
                  <button class="btn btn-default btn-xs" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>
            </div>
          </div>
<br>

          <!-- /.box-header -->
          <div class="box-body">
            <table id="tblEquipment" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><input type="checkbox" id="check-all"></th>
                    <th>Cliente</th>
                    <th>Equipo</th>
                    <th>Código</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Serie</th>
                    <th>Capacidad</th>


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
                        <div id="msgbx_err" class="alert-box error" style="color:red" display="none">
                          <h3>Opps, Este código ya se encuentra registrado.</h3>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Cliente</label>
                            <div class="col-md-9">
                              <select name="customers" class="form-control input-sm" data-validate="required" id="id"
                                        onchange="return get_towns_sections(this.value)" required>
                                          <option value="">Seleccione</option>
                                               <?php
                                                 $classes = $this->db->get('customers')->result_array();
                                                 foreach($classes as $row):
                                                   ?>
                                                   <option value="<?php echo $row['id'];?>">
                                                     <?php echo $row['nameCus'];?>
                                                   </option>
                                                   <?php
                                                   endforeach;
                                                   ?>
                          </select>
                                <span class="help-block"></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3">Equipo</label>
                            <div class="col-md-9">
                              <select name="equipmentType" class="form-control input-sm" data-validate="required" id="id"
                                        onchange="return get_towns_sections(this.value)" required>
                                          <option value="">Seleccione</option>
                                               <?php
                                                 $classes = $this->db->get('equipmentType')->result_array();
                                                 foreach($classes as $row):
                                                   ?>
                                                   <option value="<?php echo $row['nameType'];?>">
                                                     <?php echo $row['nameType'];?>
                                                   </option>
                                                   <?php
                                                   endforeach;
                                                   ?>
                          </select>
                                <span class="help-block"></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3">Código</label>
                            <div class="col-md-9">
                                <input name="code" placeholder="" class="form-control input-sm" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Motor</label>
                            <div class="col-md-9">
                              <select name="engine" class="form-control input-sm" data-validate="required" id="id"
                                        onchange="return get_towns_sections(this.value)" required>
                                          <option value="">Seleccione</option>
                                               <?php
                                                 $classes = $this->db->get('engine')->result_array();
                                                 foreach($classes as $row):
                                                   ?>
                                                   <option value="<?php echo $row['id'];?>">
                                                     <?php echo $row['nameEngine'];?>
                                                   </option>
                                                   <?php
                                                   endforeach;
                                                   ?>
                          </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Combustible</label>
                            <div class="col-md-9">
                              <select name="fuel" class="form-control input-sm" data-validate="required" id="id"
                                        onchange="return get_towns_sections(this.value)" required>
                                          <option value="">Seleccione</option>
                                               <?php
                                                 $classes = $this->db->get('fuel')->result_array();
                                                 foreach($classes as $row):
                                                   ?>
                                                   <option value="<?php echo $row['id'];?>">
                                                     <?php echo $row['nameFuel'];?>
                                                   </option>
                                                   <?php
                                                   endforeach;
                                                   ?>
                          </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                      <div class="form-group">
                            <label class="control-label col-md-3">Marca</label>
                            <div class="col-md-9">
                                <input name="mark" placeholder="" class="form-control input-sm" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                              <label class="control-label col-md-3">Modelo</label>
                              <div class="col-md-9">
                                  <input name="model" placeholder="" class="form-control input-sm" type="text">
                                  <span class="help-block"></span>
                              </div>
                          </div>

                          <div class="form-group">
                                <label class="control-label col-md-3">Serie</label>
                                <div class="col-md-9">
                                    <input name="serie" placeholder="" class="form-control input-sm" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Capacidad Carga</label>
                            <div class="col-md-9">
                              <select name="load" class="form-control input-sm" data-validate="required" id="id"
                                        onchange="return get_towns_sections(this.value)" required>
                                          <option value="">Seleccione</option>
                                               <?php
                                                 $classes = $this->db->get('load')->result_array();
                                                 foreach($classes as $row):
                                                   ?>
                                                   <option value="<?php echo $row['id'];?>">
                                                     <?php echo $row['nameLoad'];?>
                                                   </option>
                                                   <?php
                                                   endforeach;
                                                   ?>
                          </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Mastil</label>
                            <div class="col-md-9">
                              <select name="mastil" class="form-control input-sm" data-validate="required" id="id"
                                        onchange="return get_towns_sections(this.value)" required>
                                          <option value="">Seleccione</option>
                                               <?php
                                                 $classes = $this->db->get('mastil')->result_array();
                                                 foreach($classes as $row):
                                                   ?>
                                                   <option value="<?php echo $row['id'];?>">
                                                     <?php echo $row['nameMastil'];?>
                                                   </option>
                                                   <?php
                                                   endforeach;
                                                   ?>
                          </select>
                                <span class="help-block"></span>
                            </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Etapa</label>
                            <div class="col-md-9">
                              <select name="etapa" class="form-control input-sm" data-validate="required" id="id"
                                        onchange="return get_towns_sections(this.value)" required>
                                          <option value="">Seleccione</option>
                                               <?php
                                                 $classes = $this->db->get('etapa')->result_array();
                                                 foreach($classes as $row):
                                                   ?>
                                                   <option value="<?php echo $row['id'];?>">
                                                     <?php echo $row['nameEtapa'];?>
                                                   </option>
                                                   <?php
                                                   endforeach;
                                                   ?>
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


<script type="text/javascript">

var currentLocation = window.location;
var table;

$(document).ready(function() {

validate();

    //datatables
    table = $('#tblEquipment').DataTable({


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
"responsive": true,
        "order": [], //Initial no order.



        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('equipment/ajax_list')?>",
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

function add_equipment(){

    save_method = 'add';
//$("#precio").prop('disabled', false);

    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Registro Nuevo Equipo'); // Set Title to Bootstrap modal title
}



function edit_equipment(id)
{
    save_method = 'update';
  //  $("#precio").prop('disabled', true);
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string



    $.ajax({

       url : currentLocation + "/equipment/ajax_edit/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="customers"]').val(data.customers);
            $('[name="mastil"]').val(data.mastil);
            $('[name="load"]').val(data.load);
            $('[name="fuel"]').val(data.fuel);
            $('[name="etapa"]').val(data.etapa);
            $('[name="engine"]').val(data.engine);
            $('[name="status"]').val(data.status);
            $('[name="code"]').val(data.code);
            $('[name="mark"]').val(data.mark);
            $('[name="model"]').val(data.model);
            $('[name="serie"]').val(data.serie);
            $('[name="description"]').val(data.description);
          //  $('[name="observation"]').val(data.observation);
//$('[name="tecnmechanic"]').val(data.tecnmechanic);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar equipmento'); // Set title to Bootstrap modal title
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}
/*
function info_equipment(id)
{
    save_method = 'update';
    $("#precio").prop('disabled', true);
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string



    $.ajax({

       url : currentLocation + "/equipment/ajax_edit/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="code"]').val(data.codigo);
            $('[name="description"]').val(data.descripcion);
            $('[name="marca"]').val(data.marca);
            $('[name="referencia"]').val(data.referencia);
            $('[name="ubicacion"]').val(data.ubicacion);
            $('[name="cantidad"]').val(data.cantidad);
            $('[name="category"]').val(data.id_categoria);
            $('[name="unidadMedida"]').val(data.unidadMedida);
            $('[name="subcategory"]').val(data.id_subcategoria);
            $('[name="stock"]').val(data.stock);
            $('#modal_info').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Movimientos Del equipmento'); // Set title to Bootstrap modal title
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}

*/
function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}

function save()
{
  //Svalidate();
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
    if(save_method == 'add') {
      url = currentLocation + "/equipment/ajax_add/";
    } else {
        url = currentLocation + "/equipment/ajax_update/";
    }

    var formData = new FormData($('#form')[0]);
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


function delete_equipment(id)
{
    if(confirm('Esta seguro de borrar esta información?'))
    {
        // ajax delete data to database
        $.ajax({
            url : currentLocation + "/equipment/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                        $('#modal_form').modal('hide');
                reload_table();
            },
          error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error al tratar de borrar la información');
            }
        });
    }
}

function bulk_delete()
{
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
                url: currentLocation + "/equipment/ajax_bulk_delete_equipment",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                      reload_table();
                    }
                    else
                    {
                        alert('Failed.');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
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
$('#code').blur(function() {
var url= currentLocation + "/equipment/chk_usr";
          var name = $("#code").val();
                   $.post(url, {code: name}, function(d) {
                       if (d == 1)
                       {
                          //  alertify.alert();
                       alertify.alert('Codigo Ya Existente', 'Este código ya se encuentra registrado', function(){ alertify.success('Ok'); });
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

function detail_equipment(id)
{
  $('#form')[0].reset(); // reset form on modals
  $('.form-group').removeClass('has-error'); // clear error class
  $('.help-block').empty(); // clear error string
  $('#modal_detail').modal('show'); // show bootstrap modal

  //Ajax Load data from ajax

  $.ajax({
      url : currentLocation + "/equipment/ajax_edit/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        $('[name="id"]').val(data.id);
        $('[name="customers"]').val(data.customers);
        $('[name="mastil"]').val(data.mastil);
        $('[name="load"]').val(data.load);
        $('[name="fuel"]').val(data.fuel);
        $('[name="etapa"]').val(data.etapa);
        $('[name="engine"]').val(data.engine);
        $('[name="status"]').val(data.status);
        $('[name="code"]').val(data.code);
        $('[name="mark"]').val(data.mark);
        $('[name="model"]').val(data.model);
        $('[name="serie"]').val(data.serie);
        $('[name="description"]').val(data.description);
      //  $('[name="observation"]').val(data.observation);
      //  $('[name="tecnmechanic"]').val(data.tecnmechanic);
         $('.modal-title').text('Movimientos del equipmentos'); // Set Title to Bootstrap modal title

      },

      error: function (jqXHR, textStatus, errorThrown)
      {
          alert('Error get data from ajax');
      }
  });
}


function get_towns_sections(id) {
      $.ajax({
            url: currentLocation + "/equipment/get_subcate_section/" + id ,
            success: function(response)
            {
                jQuery('#towns_selector_holder').html(response);
            }
        });

  }






</script>
