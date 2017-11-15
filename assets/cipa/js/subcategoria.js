var currentLocation = window.location;



var table;

$(document).ready(function() {

alert()
validate();
alert("Hola");
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
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Inameial no order.
              "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Inameial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": currentLocation + "subcategory/ajax_list",
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

       url : currentLocation + "subcategory/ajax_edit/"+id,
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
,
        url = currentLocation + "subcategory/ajax_add/";
    } else {
        url = currentLocation + "subcategory/ajax_update";
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


function delete_category(id)
{
    if(confirm('Esta seguro de borrar esta información?'))
    {
        // ajax delete data to database
        $.ajax({
            url : currentLocation + "subcategory/ajax_delete/"+id,
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
                url: currentLocation + "subcategory/ajax_bulk_delete_category",
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
     $('#name').blur(function(){
        var email_val = $("#name").val();
        if(email_val){
            $('#msgbx_err').show();
            $.post(currentLocation + "subcategory/name_check_category", {
                name: email_val
            }, function(response){
                $('#loading').hide();
                $('#msgbx_err').html('').html(response.message).show().delay(6000).fadeOut();
            });
            return false;
        }
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
      url : currentLocation + "subcategory/ajax_edit/" + id,
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
