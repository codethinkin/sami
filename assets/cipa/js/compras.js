var currentLocation = window.location;
$(function(){
  $("#BuscaProducto").autocomplete({
            source: currentLocation + "/buscarproductos",
             select: function(event, ui) {
				$('#descripcion').val(ui.item.descripcion);
				$('#codigo').val(ui.item.codigo);
				$('#precio').val(ui.item.precio_compra);
				$("#existencia").val(ui.item.cantidad);
				$("#precioventa").val(ui.item.precio_venta);
				$("#costo").val(ui.item.id);
        $("#refe").val(ui.item.referencia);
           }
    });

  $("#BuscaProveedor").autocomplete({
            source: currentLocation + "/buscarproveedor",
             select: function(event, ui) {
				$('#nit').val(ui.item.nit);
				$('#nom_pro').val(ui.item.name);

		}
    });
});


$(document).ready(function(){

validate();
	$("#Factura").focus();
	$("#BuscaProducto");
	$("#BuscaProveedor");
	// creamos carrito de orden de compra
	$("#AgregaProducto").click(function()
	{		var code = $('input#codigo').val();
			var code = $('input#referesncia').val();
			var prove = $('input#nom_pro').val();
			var idses= $('input#idsession').val();
			if(code==""){
				$("#BuscaProducto").focus();
				$('#BuscaProducto').val('');
			      alert("Selecciona el Producto a Comprar");
				return false;

			}else if(prove ==""){
				$('#BuscaProveedor').val('');
			      alert("Selecciona el Proveedor");
				return false;

			}

				else{
				var Producto = new Object();

				Producto.Codigo      = $('input#codigo').val();
				Producto.Descripcion = $('input#descripcion').val();
				Producto.Cantidad    = $('input#cantidad').val();
				Producto.Pcompra     = $('input#precio').val();
				Producto.IdSession   = $('input#idsession').val();
				Producto.Proveedor   = $('input#nom_pro').val();
				Producto.Costo		 = $('input#costo').val();
				Producto.Pnuevo		 = $('input#precioventa').val();
				//Producto.FechaFactura = $('input#FechaFactura').val();

				var DatosJson = JSON.stringify(Producto);
				$.post(currentLocation + '/addcarrito',
				{
					MiCarrito: DatosJson
				},
				function(data, textStatus) {

					$("#carrito tbody").html("");
					var Subtotal = 0;
					var iva      = 0;
					var total    = 0;
					//Recibimos parametro y imprimimos
					$.each(data, function(i, item) {
						var cantsincero =  item.cantidad;
						cantsincero     = parseInt(cantsincero);

						//var valortodo = item.precio;
					    //	valortodo     = parseInt((parseInt(item.precio)+parseInt(item.precio_venta))/2);

						if(cantsincero!=0){

							//var valor = parseInt((parseInt(item.precio)+parseInt(Producto.Pnuevo))/2);
							//var tol = parseInt(valortodo);

							//var cant = item.cantidad;

							var Operacion= parseFloat(item.precio) * parseFloat(item.cantidad);
							Subtotal = parseInt(Operacion + Subtotal);
							iva      = parseInt(parseInt(Subtotal) * parseFloat(0.19));
							total    = parseFloat(iva) + parseFloat(Subtotal);




							var nuevaFila =
							"<tr>"
							+"<td>"+item.txtCodigo+"</td>"
							+"<td>"+item.descripcion+"</td>"
							+"<td>"+item.nombre_proveedor+"</td>"
							+"<td>$ "+item.precio+"</td>"
							+"<td>"+item.cantidad+"</td>"
							+"<td>$ "+Operacion+"</td>"
							+"<td><div align='center'>"
							+'<img onclick="EliminarItem('
							+"'"+item.txtCodigo+"',"
							+"'"+item.descripcion+"',"
							+"'-1',"
							+"'"+item.precio+"',"
							+"'"+item.precio_venta+"',"
							+"'"+idses+"',"
							+"'"+item.nombre_proveedor+"',"
							+"'"+item.costo+"'"
							+ ')"'
							+" src='img/delete.png' width='20'/></div></td>"
							+"</tr>";
							$(nuevaFila).appendTo("#carrito tbody");
							$("#lblsubtotal").text("$ " + Subtotal);
							$("#lbliva").text("$ " + iva);
							$("#lbltotal").text("$ " + total);
							$("#txtsubtotal").val(Subtotal);
							$("#txtIva").val(iva);
							$("#txtTotal").val(total);
							$("#valor").val(valor);
						}

					});
						LimpiarTexto();
					},
					"json"
				);
				return false;
			}
	});


	//Guardamos Orden compra
	$("#SaveOrder").click(function()
	{		var code = $('input#txtTotal').val();
			if(code=="0"){
				$('#BuscaProducto').val('');
				$("#BuscaProducto").focus();
				alert( "No Hay Partidas que Cobrar");
				return false;

			}else{

				var Producto = new Object();

				Producto.IdSession   		= $('input#idsession').val();
				Producto.Subtotal    		= $('input#txtsubtotal').val();
				Producto.IVA   		 		= $('input#txtIva').val();
				Producto.Total 		 		= $('input#txtTotal').val();
				Producto.Precio 		 	= $('input#valor').val();
				Producto.Factura     		= $('input#Factura').val();
				Producto.FechaF     		= $('input#FechaFactura').val();
				Producto.Proveedor          = $('input#nom_pro').val();




				var DatosJson 		 = JSON.stringify(Producto);
				$("#mensaje").append("<div class='modal1'><div class='center1'> <center> <img src='"+ baseurl +"/img/gif-load.gif'> Registrando Orden...</center></div></div>");
				$.post(currentLocation + '/saveOrder',
				{
					MiCarrito: DatosJson
				},
				function(data, textStatus) {
						$("#carrito tbody").html("");
						if(data.TipoMsg=="Error"){
							$("#mensaje").html("<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>"+data.Msg+"</div>");
						}else{
							$("#mensaje").html("<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>"+data.Msg+"</div>");
						}
						var nuevaFila =
						"<tr>"
						+"<td colspan=7><center>No Hay Productos Agregados</center></td>"
						+"</tr>";
						$(nuevaFila).appendTo("#carrito tbody");
					},
					"json"
				);
				$("#lblsubtotal").text("$ 0");
				$("#lbliva").text("$ 0");
				$("#lbltotal").text("$ 0");
				$("#lblvalor").text("$ 0");
				LimpiaOrder();
				AsignaSession();
				return false;

			}
	});
});

function actualizarvalor(){
	document.getElementById("valor").value = valor;

}
function LimpiarTexto(){

		document.getElementById("BuscaProducto").value="";
		//document.getElementById("BuscaProveedor").value="";
		document.getElementById("codigo").value="";
		document.getElementById("cantidad").value="1";
		document.getElementById("precio").value="";
		$("#BuscaProducto").focus();

}
function LimpiaOrder(){
	document.getElementById("txtTotal").value="0";
	document.getElementById("Factura").value="";
	document.getElementById("BuscaProveedor").value="";
	document.getElementById("FechaFactura").value="";
	document.getElementById("precioventa").value="";
	document.getElementById("nom_pro").value="";
}


function validate(){

  $('#msgbx_err').hide();
  $('#factura').blur(function() {
  var url= currentLocation + "/ordencompra/chk_usr";
            var name = $("#factura").val();
                     $.post(url, {code: name}, function(d) {
                         if (d == 1)
                         {
                            //  alertify.alert();
                         alertify.alert('La Factura Ya Existe', 'Esta Factura ya se encuentra registrada', function(){ alertify.success('Ok'); });
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

function EliminarItem(codigo,descripcion,cantidad,pcompra,idsession,proveedor,costo){
		var Producto = new Object();
		Producto.Codigo      = codigo;
		Producto.Descripcion = descripcion;
		Producto.Cantidad    = cantidad;
		Producto.Pcompra     = pcompra;
		Producto.IdSession   = idsession;
		Producto.Proveedor   = proveedor;
		Producto.Costo		 = costo;
		var DatosJson = JSON.stringify(Producto);
		$.post(currentLocation + '/addcarrito',
		{
			MiCarrito: DatosJson
		},


		function(data, textStatus) {

			$("#carrito tbody").html("");
			var Subtotal = 0;
			var iva      = 0;
			var total    = 0;
			var contador = 0;
			//Recibimos parametro y imprimimos
			$.each(data, function(i, item) {
				var cantsincero =  item.cantidad;
				cantsincero     = parseInt(cantsincero);
				if(cantsincero!=0){
					contador   = contador + 1;

					var Operacion= parseInt(valor) * parseInt(item.cantidad);
					var valor = (parseInt(item.precio)+parseInt(Producto.Pnuevo))/2;

					Subtotal = (Subtotal + Operacion);
					iva      = parseFloat(Subtotal) * parseFloat(0.19);
					total    = parseFloat(iva) + parseFloat(Subtotal);
					var nuevaFila =
					"<tr>"
					+"<td>"+item.txtCodigo+"</td>"
					+"<td>"+item.descripcion+"</td>"
					+"<td>"+item.nombre_proveedor+"</td>"
					+"<td>$ "+item.precio+"</td>"
					+"<td>"+item.cantidad+"</td>"
					+"<td>$ "+Operacion+"</td>"
					+"<td><div align='center'>"
					+'<img onclick="EliminarItem('
					+"'"+item.txtCodigo+"',"
					+"'"+item.descripcion+"',"
					+"'-1',"
					+"'"+item.precio+"',"
					+"'"+item.precio_venta+"',"
					+"'"+idsession+"',"
					+"'"+item.nombre_proveedor+"',"
					+"'"+item.costo+"'"
					+ ')"'
					+" src='img/delete.png' width='20'/></div></td>"
					+"</tr>";
					$(nuevaFila).appendTo("#carrito tbody");
					$("#lblsubtotal").text("$ " + Subtotal);
					$("#lbliva").text("$ " + iva);
					$("#lbltotal").text("$ " + total);
					$("#txtsubtotal").val(Subtotal);
					$("#txtIva").val(iva);
					$("#txtTotal").val(total);
					$("#valor").val(valor);
				}

			});
				if(contador==0){
					$("#carrito tbody").html("");
					var nuevaFila =
					"<tr>"
					+"<td colspan=7><center>No Hay Productos Agregados</center></td>"
					+"</tr>";
					$(nuevaFila).appendTo("#carrito tbody");
					$("#lblsubtotal").text("$ 0");
					$("#lbliva").text("$ 0");
					$("#lbltotal").text("$ 0");
					$("#lblvalor").text("$ 0");
					LimpiaOrder();
				}
				LimpiarTexto();
			},
			"json"
		);
		return false;
	}
