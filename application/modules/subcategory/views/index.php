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
            <h3 class="box-title">Tablero | Sub-Categorias  </h3>
            <div class="box-tools">

 <button class="btn btn-primary btn-xs" onclick="add_category()"><i class="glyphicon glyphicon-plus"></i> Nueva Sub-Categoria</button>

                  <button class="btn btn-default btn-xs" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="tblsubcategory" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><input type="checkbox" id="check-all"></th>
                    <th>Categoria</th>
                    <th>Sub-Categoria</th>
                    <th>Estado</th>
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
                        <div id="msgbx_err" class="alert-box error" display="none" style="color:red;"></div>
                        <div class="form-group">
                          <label class="control-label col-md-3">Categoria</label>
                            <div class="col-md-9">
                              <select name="category" class="form-control input-sm" data-validate="required" id="id"
                                        onchange="return get_towns_sections(this.value)" required>
                                          <option value="">Seleccione</option>
                                               <?php
                                                 $classes = $this->db->get('category')->result_array();
                                                 foreach($classes as $row):
                                                   ?>
                                                   <option value="<?php echo $row['id'];?>">
                                                     <?php echo $row['name'];?>
                                                   </option>
                                                   <?php
                                                   endforeach;
                                                   ?>
                          </select>
                                <span class="help-block"></span><span id="name_result"></span>
                            </div>
                        </div>

                        <label class="control-label col-md-3">Sub-Categoria</label>
                          <div class="col-md-9">
                              <input name="name" id="name" placeholder="" class="form-control input-sm input-sm" type="text" required>
                              <span class="help-block"></span><span id="name_result"></span>
                          </div>
                      </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" id="lblState">Estado</label>
                            <div class="col-md-9">
                                <select name="state" id="state" class="form-control input-sm">
                                    <option value="">--Selecionar Estado--</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <span class="help-block"></span>
                              </div>
                          </div>
                                    </div>
                  </form>

              <div class="modal-footer">
                  <button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-xs">Grabar</button>
                  <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
              </div>
</div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->


<script>
var currentLocation = window.location;
var table;

$(document).ready(function() {
validate();

    //datatables
    table = $('#tblsubcategory').DataTable({
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
                    "processing": false, //Feature control the processing indicator.
                    "serverSide": false, //Feature control DataTables' server-side processing mode.
                    "order": [], //Inameial no order.
              "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Inameial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('subcategory/ajax_list')?>",
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

function add_category(){
    save_method = 'add';
    $("#state").hide();
    $("#lblState").hide();
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Registro Nueva Categoria'); // Set Title to Bootstrap modal title
}


function edit_category(id)
{
    save_method = 'update';
    $("#state").show();
    $("#lblState").show();
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string



    $.ajax({
         //url: "<?php echo site_url('category/ajax_edit')?>"/+id,

       url : currentLocation + "/subcategory/ajax_edit/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="name"]').val(data.name);
            $('[name="category"]').val(data.category);
            $('[name="state"]').val(data.state);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Categoria'); // Set title to Bootstrap modal title
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

function save()
{
  validate();
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;
    if(save_method == 'add') {
        url = currentLocation + "/subcategory/ajax_add/";
    } else {
        url = currentLocation + "/subcategory/ajax_update/";
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
            alertify.alert('Error!', 'Error al Guardar ó  Actualizar la Información, Posiblemente el Campo a Registrar ya Exista... Contacte al administrador....', function(){ alertify.success('Ok'); });
            $('#btnSave').text('Grabar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }

    });

}


function delete_category(id)
{
    if(confirm('Esta seguro de borrar esta información?'))
    {
        // ajax delete data to database
        $.ajax({
            url : currentLocation + "/subcategory/ajax_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                        $('#modal_form').modal('hide');
                reload_table();
            },
          error: function (jqXHR, textStatus, errorThrown)
            {
                alertify.alert('Error!', 'Error al tratar de borrar la información... Contacte al administrador....', function(){ alertify.success('Ok'); });
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
                url: currentLocation + "/subcategory/ajax_bulk_delete_category",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                      reload_table();
                    }
                    else
                    {
                        alertify.alert('Error!', 'Error al tratar de borrar items seleccionados... Contacte al administrador....', function(){ alertify.success('Ok'); });
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
$('#name').blur(function() {
var url= currentLocation + "/subcategory/chk_usr";
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

function detail_category(id)
{
  $('#form')[0].reset(); // reset form on modals
  $('.form-group').removeClass('has-error'); // clear error class
  $('.help-block').empty(); // clear error string
  $('#modal_detail').modal('show'); // show bootstrap modal

  //Ajax Load data from ajax

  $.ajax({
      url : currentLocation + "/subcategory/ajax_edit/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
          $('[name="id"]').val(data.id);
          $('[name="name"]').val(data.name);
         $('[name="category"]').val(data.category);
          $('[name="state"]').val(data.state);
         $('.modal-title').text('Actualización Sub-Categoria'); // Set Title to Bootstrap modal title

      },

      error: function (jqXHR, textStatus, errorThrown)
      {
          alert('Error get data from ajax');
      }
  });
}
</script>
