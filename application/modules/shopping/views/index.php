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
            <h3 class="box-title">Tablero | Compras Realizadas </h3>
            <div class="box-tools">
<a class="btn btn-primary btn-xs" href="<?php echo base_url('ordencompra'); ?> "><i class="glyphicon glyphicon-plus"></i> Nueva Compra</a>

                  <button class="btn btn-default btn-xs" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>
            </div>
          </div>
<br>

          <!-- /.box-header -->
          <div class="box-body">
            <table id="tblShopping" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><input type="checkbox" id="check-all"></th>
                    <th>Factura</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Subtotal</th>
                    <th>IVA</th>
                    <th>Total</th>
                  <!--  <th style="width:150px;">Acciones</th>-->
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
<div class="row">
<div class="col-md-6">
  <div id="msgbx_err" class="alert-box error" display="none" style="color:red;"></div>
  <div class="form-group">
    <label class="control-label col-md-3">Factura</label>
      <div class="col-md-9">
        <input name="factura" id="factura" placeholder="" class="form-control input-sm input-sm" type="text" required>
        <span class="help-block"></span><span id="name_result"></span>
      </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3">Proveedor</label>
      <div class="col-md-9">
        <input name="proveedor" id="proveedor" placeholder="" class="form-control input-sm input-sm" type="text" required>
        <span class="help-block"></span><span id="name_result"></span>
      </div>
  </div>

</div>

<div class="col-md-6">
  <div class="form-group">
    <label class="control-label col-md-3">Fecha</label>
      <div class="col-md-9">
        <input name="fecha" id="fecha" placeholder="" class="form-control input-sm input-sm" type="text" required>
        <span class="help-block"></span><span id="name_result"></span>
      </div>
  </div>
</div>
<hr>

</div>



                                    </div>
                  </form>

              <div class="modal-footer">
                  <button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-xs">Grabar</button>
                  <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancelar</button>
              </div>
</div>
          </div><!-- /.modal-content -->
      </div>
  </div><!-- /.modal-dialog -->

<script type="text/javascript">

var currentLocation = window.location;
var table;

$(document).ready(function() {

validate();



    //datatables
    table = $('#tblShopping').DataTable({


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
            "url": "<?php echo site_url('shopping/ajax_list')?>",
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


function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax
}







function validate(){

$('#msgbx_err').hide();
$('#code').blur(function() {
var url= currentLocation + "/product/chk_usr";
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

function edit_shopping(id)
{
    save_method = 'update';
    $("#state").show();
    $("#lblState").show();
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string



    $.ajax({

       url : currentLocation + "/shopping/ajax_edit/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.ID);
            $('[name="factura"]').val(data.FACTURA);
            $('[name="fecha"]').val(data.FECHA_FACTURA);
            $('[name="proveedor"]').val(data.PROVEEDOR);
            $('[name="producto"]').val(data.producto);
            $('[name="cantidad"]').val(data.cantidad);
            $('[name="precio_compra"]').val(data.precio_compra);
            $('[name="subtotal"]').val(data.bruto);
            $('[name="iva"]').val(data.baseimpuesto);
            $('[name="totalImpuesto"]').val(data.total_impuesto);
            $('[name="total"]').val(data.total);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Vista Factura'); // Set title to Bootstrap modal title
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}








</script>
