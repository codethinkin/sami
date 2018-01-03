<footer class="main-footer">Software Administrador de Mantenimiento e Inventarios | SAMI</footer>
    <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


</body>
</html>
<!-- modal -->
<div id="cnfrm_delete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content col-md-6">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Confirmación</h4>
            </div>
            <div class="modal-body">
                <p>Realmente desea eliminar </p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-small  yes-btn btn-danger" href="">yes</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">no</button>
            </div>
        </div>
    </div>
</div>

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/js/jquery.dataTables.min.js');?>"></script>

<script src="<?php echo base_url('assets/js/dataTables.bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js');?>"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="<?php echo base_url('assets/alertifyjs/alertify.min.js');?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>


<script type="text/javascript" src="<?php echo base_url('assets/js/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/daterangepicker.js'); ?>"></script>

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.form-validator.min.js');?>"></script>

<!-- SlimScroll -->
<script src="<?php echo base_url('assets/js/jquery.slimscroll.min.js');?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/js/fastclick.js');?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/js/app.min.js');?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/js/icheck.min.js');?>"></script>
<script src="<?php echo base_url('assets/ckeditor/ckeditor.js');?>"></script>
<script src="<?php echo base_url('assets/ckeditor/adapters/jquery.js');?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/js/demo.js');?>"></script>
<script src="<?php echo base_url('assets/js/custom.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery-ui.js');?>"></script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>

<script type="text/javascript">
		// Enable pusher logging - don't include this in production
		Pusher.log = function(message) {
			if (window.console && window.console.log) {
				window.console.log(message);
			}
		};

		var pusher = new Pusher('ab0ec8cbb4f1cdead28e');
		var channel = pusher.subscribe('test_channel');

		channel.bind('my_event', function(data) {
			document.getElementById('event').innerHTML = data.message;
			alert(data.message);
		});
	</script>

<script>
	function validate_fileType(fileName,Nameid,arrayValu)
	{
		var string = arrayValu;
		var tempArray = new Array();
		var tempArray = string.split(',');
		var allowed_extensions =tempArray;
		var file_extension = fileName.split(".").pop();
		for(var i = 0; i <= allowed_extensions.length; i++)
		{
			if(allowed_extensions[i]==file_extension)
			{
				$("#error_"+Nameid).html("");
				return true; // valid file extension
			}
		}
		$("#"+Nameid).val("");
		$("#error_"+Nameid).css("color","red").html("File format not support to upload");
		return false;
	}
</script>

<?php

	https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js
$uri = $this->uri->segment(1);
switch ($uri) {
		case 'ventas':?>
 <script src="<?php echo base_url('assets/js/ventas.js'); ?>" ></script>
<?php

break;

case 'ordencompra':?>
<script src="<?php echo base_url('assets/js/compras.js'); ?>" ></script>
<script src="<?php echo base_url('assets/js/reporteComp.js'); ?>" ></script>
<?php
break;

case 'category':?>
<script src="<?php echo base_url('assets/js/category.js'); ?>" ></script>
<?php
break;

case 'report':?>
<script src="<?php echo base_url('assets/js/consumos.js'); ?>" ></script>
<?php
break;

case 'customers':?>
<script src="<?php echo base_url('assets/js/clientes.js'); ?>" ></script>
<?php
break;

case 'rcompras':?>
<script src="<?php echo base_url('assets/js/rcompras.js'); ?>" ></script>
<?php
break;


case 'dashboard':?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js" charset="utf-8"></script>
<script src="<?php echo base_url('assets/js/dashboard.js') ?> " ></script>
<?php
  			break;


	default:
		# code...
		break;
} ?>
