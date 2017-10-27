<div class="modal fade" id="nameModal_Templates"  role="dialog"><!-- Modal Crud Start-->
	<div class="col-md-offset-4 col-md-4">
		<div class="box box-primary popup" >
			<div class="box-header with-border formsize">
				<h3 class="box-title">Templates</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body" style="padding: 0px 0px 0px 0px;"></div>
		</div>
	</div>
</div><!--End Modal Crud -->
<!-- start: PAGE CONTENT -->
<?php if($this->session->flashdata("message")){?>
  <div class="alert alert-info">
    <?php echo $this->session->flashdata("message")?>
  </div>
<?php } ?>
<div class="row">
  <div class="box-header my-header">
    <h3 class="box-title">Combustibles</h3>
  </div>
<br>
 <button class="btn btn-primary btn-xs" onclick="add_Fuel()"><i class="glyphicon glyphicon-plus"></i> Nuevo Combustible</button>
  <div class="box-body">
    <table id="example_Templates" class="cell-border example_Templates table table-striped table1 table-bordered table-hover dataTable">
      <thead>
        <tr>
          <th>Combustible</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.row -->
<!-- Modal -->
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
                            <label class="control-label col-md-3">Nombre</label>
                            <div class="col-md-9">
                                <input name="name" id="name" placeholder="" class="form-control input-sm" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3" id="lblState">Estado</label>
                            <div class="col-md-9">
                                <select name="state" id="state" class="form-control input-sm">
                                    <option value="">--Selecionar Estado--</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Incativo">Inactivo</option>
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


<script>
var table;

$(document).ready(function() {
validate();

	var url = "<?php echo base_url();?>";
    $("#example_Templates").DataTable({

						"oAria": {
									"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
									"sSortDescending": ": Activar para ordenar la columna de manera descendente"
									}
								},
        "processing": true,
        "serverSide": true,
		"language": {"search": "_INPUT_", "searchPlaceholder": "Search"},
		"iDisplayLength": 10,
		"aLengthMenu": [[10, 25, 50, 100,500,-1], [10, 25, 50,100,500,"All"]],
        "ajax": url+"templates/ajax_data"
    });



function setId(id) {
	var url =  "<?php echo site_url();?>";
	$("#cnfrm_delete").find("a.yes-btn").attr("href",url+"/templates/delete_data/"+id);
}


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

function add_Fuel(){
    save_method = 'add';
$("#state").hide();
$("#lblState").hide();

    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Registro Nuevo de Motor'); // Set Title to Bootstrap modal title
}

function edit_fuel(id)
{
    save_method = 'update';
    $("#state").show();
    $("#lblState").show();
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string



    $.ajax({
         //url: "<?php echo site_url('fuel/ajax_edit')?>"/+id,
       url : currentLocation + "/fuel/ajax_edit/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="name"]').val(data.namefuel);
            $('[name="state"]').val(data.state);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Usuario'); // Set title to Bootstrap modal title
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
        url = currentLocation + "/fuel/ajax_add/";
    } else {
        url = currentLocation + "/fuel/ajax_update/";
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


function delete_fuel(id)
{
    if(confirm('Esta seguro de borrar esta información?'))
    {
        // ajax delete data to database
        $.ajax({
            url : currentLocation + "/fuel/ajax_delete/"+id,
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



function validate(){

  $('#msgbx_err').hide();
     $('#nit').blur(function(){
        var email_val = $("#nit").val();
        if(email_val){
            $('#msgbx_err').show();
            $.post(currentLocation + "/fuel/nit_check_fuel", {
                nit: email_val
            }, function(response){
                $('#loading').hide();
                $('#msgbx_err').html('').html(response.message).show().delay(6000).fadeOut();
            });
            return false;
        }
    });

}

function detail_fuel(id)
{
  $('#form')[0].reset(); // reset form on modals
  $('.form-group').removeClass('has-error'); // clear error class
  $('.help-block').empty(); // clear error string
  $('#modal_detail').modal('show'); // show bootstrap modal

  //Ajax Load data from ajax

  $.ajax({
      url : currentLocation + "/fuel/ajax_edit/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        $('[name="id"]').val(data.id);
        $('[name="name"]').val(data.namefuel);
        $('[name="state"]').val(data.state);
         $('.modal-title').text('Movimientos del fuelos'); // Set Title to Bootstrap modal title

      },

      error: function (jqXHR, textStatus, errorThrown)
      {
          alert('Error get data from ajax');
      }
  });
}
</script>
