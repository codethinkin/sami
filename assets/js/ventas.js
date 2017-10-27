var currentLocation = window.location;
$(function(){
	//Buscamos Cliente
  $("#BuscaCliente").autocomplete({
            source: currentLocation + "/BuscarCliente",
             select: function(event, ui) {
				$('#lblNombrecliente').text(ui.item.nameCus );
				$('#lblidcliente').text(ui.item.RFC);
				$('#Cliente').val(ui.item.nameCus);
				$('#BuscaProducto').prop("disabled", false);
				$('#AgregaProducto').prop("disabled", false);
				document.getElementById("BuscaProducto").focus();
				$('#BuscaCliente').prop("disabled", true);
           }
    });
  //Buscamos Producto
  $("#BuscaProducto").autocomplete({
            source: currentLocation + "/buscarproductos",
             select: function(event, ui) {
				$('#descripcion').val(ui.item.descripcion);
				$('#codigo').val(ui.item.codigo);
				$('#precioventa').val(ui.item.precio_venta);
				$("#existencia").val(ui.item.cantidad);
				//$("#Proveedor").val(ui.item.nombre_proveedor);
				$("#idProveedor").val(ui.item.id);
				$("#costo").val(ui.item.precio_compra);
           }
    });
});
$(document).ready(function(){
	$('#centros').prop('disabled', true);

	$('#centros').append("<option value='0'>Seleccionar C.C...</option>");
	//Cargamos Categorias
	var clientes = $("#clientes");
	clientes.append("<option value='0'>Cargando Clientes...</option>");
	$.getJSON(baseurl + "ventas/clientes",function(objetosretorna){
		clientes.empty();
		clientes.append("<option value='0'>---Seleccionar Cliente---</option>");
		$.each(objetosretorna, function(i,ObjetoReturn){
			var seleccion = "";
			if(id_Cliente==ObjetoReturn.id){
				seleccion = "selected='selected'";
			}
			var nuevaFila = "<option value='"+ObjetoReturn.id+"' "+seleccion+">" + ObjetoReturn.nameCus+"</option>";
			clientes.append(nuevaFila);
		});
	});
	//Si es diferente a cero hacemos select
	if(id_centros!=0){
			$('#centros').empty();
			$("#centros").append("<option value='0'>Cargando C...</option>");
			$.getJSON(baseurl + "ventas/centros",{filtro: id_Cliente},function(objetosretorna){
				$("#centros").empty();
				$("#centros").append("<option value='0'>Seleccionar Sub-Clientes...</option>");
				$.each(objetosretorna, function(i,centros){
					var seleccion2 = "";
					if(id_centros==centros.id){
						seleccion2 = "selected='selected'";
					}
					$("#centros").append("<option value='"+centros.id+"' "+seleccion2+">" + centros.centocosto+"</option>");
				});
			});
			$('#centros').prop('disabled', false);
			$('#codigo').prop('disabled', true);
	};


 	var centros = $("#centros");
	centros.append("<option value='0'>Cargando Centros de Costos...</option>");
	$.getJSON(baseurl + "ventas/centros",function(objetosretorna){
		centros.empty();
		centros.append("<option value='0'>---Seleccionar C.C---</option>");
		$.each(objetosretorna, function(i,ObjetoReturn){
			var seleccion = "";
			if(id==ObjetoReturn.id){
				seleccion = "selected='selected'";
			}
			var nuevaFila = "<option value='"+ObjetoReturn.id+"' "+seleccion+">" + ObjetoReturn.centocosto+"</option>";
			centros.append(nuevaFila);
		});
	});

		$("#clientes").change(function(){
			var clientes = $("#clientes").val();
			$('#centros').empty();
			if(clientes==0){
				//$('#centros').append("<option value='0'>Elige Sub-Categoria...</option>");
				$('#centros').prop('disabled', true);
			}else{
				$("#centros").append("<option value='0'>Cargando Centros de Costos...</option>");
				$.getJSON(baseurl + "ventas/centros",{filtro: $("#clientes").val()},function(objetosretorna){
					$("#centros").empty();
					//$("#centros").append("<option value='0'>Elige Sub-Categoria...</option>");
					$.each(objetosretorna, function(i,centros){
						$("#centros").append("<option value='"+centros.id+"'>" + centros.centocosto+"</option>");
					});
				});
				$('#centros').prop('disabled', false);
			}

		});

	$("#BuscaCliente").focus();
	$("#AgregaProducto").click(function()
	{		var code = $('input#codigo').val();
			var idses= $('input#idsessionventa').val();
			var canti= $('input#existencia').val();
			var cant2= $('input#cantidad').val();
			canti = parseInt(canti);
			cant2 = parseInt(cant2);
			if(code==""){
				$('#BuscaProducto').val('');
				LimpiarTexto();
				alert("Teclea el Producto a Vender");
				return false;

			}else if(canti==0){
				$('#BuscaProducto').val('');
				LimpiarTexto();
				alert("No hay Existencias del Producto: " + code);
				return false;
			}else if(cant2>canti){
				$('#BuscaProducto').val('');
				LimpiarTexto();
				alert("Nadamas Tenemos Disponible: " + canti + ", Productos y Usted Solicito: " + cant2 + ", Productos de la Clave: " + code);
				return false;
			}else{
				var Producto = new Object();
				Producto.Codigo      = $('input#codigo').val();
				Producto.Descripcion = $('input#descripcion').val();
				Producto.Cantidad    = $('input#cantidad').val();
				Producto.Pcompra     = $('input#precioventa').val();
				Producto.IdSession   = $('input#idsessionventa').val();
				//Producto.Proveedor   = $('input#Proveedor').val();
				Producto.Costo	     = $('input#costo').val();
				//Producto.IdProveedor = $('input#idProveedor').val();
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
						if(cantsincero!=0){
							var Operacion= parseFloat(item.precio) * parseFloat(item.cantidad);
							Subtotal = parseFloat(Subtotal) + parseFloat(Operacion);
							iva      = parseFloat(Subtotal) * parseFloat(0.19);
							total    = parseFloat(iva) + parseFloat(Subtotal);
							var nuevaFila =
							"<tr>"
							+"<td>"+item.txtCodigo+"</td>"
							+"<td>"+item.descripcion+"</td>"
							////+"<td>"+item.proveedor+"</td>"
							+"<td>$ "+item.precio+"</td>"
							+"<td>"+item.cantidad+"</td>"
							+"<td>$ "+Operacion+"</td>"
							+"<td><div align='center'>"
							+'<img onclick="EliminarItem('
							+"'"+item.txtCodigo+"',"
							+"'"+item.descripcion+"',"
							+"'-1',"
							+"'"+item.precio+"',"
							+"'"+idses+"',"
							//+"'"+item.proveedor+"',"
							+"'"+item.costo+"',"
							//+"'"+item.IdProveedor+"'"
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
						}

					});
						LimpiarTexto();
					},
					"json"
				);
				return false;
			}
	});
	//Guardamos Venta
	$("#SaveOrder").click(function()
	{		var code = $('input#txtTotal').val();
			if(code=="0"){
				$('#BuscaProducto').val('');
				$("#BuscaProducto").focus();
				alert("No Hay Producto a Consumir|");
				return false;

			}else{
				var Producto = new Object();
				Producto.Factura          = $('input#factura').val();
				Producto.FechaFactura     = $('input#FechaFactura').val();
				Producto.CENTROSCOSTOS 	  = $('select#centros').val();
				Producto.IdSession    = $('input#idsessionventa').val();
				Producto.Subtotal     = $('input#txtsubtotal').val();
				Producto.IVA   		  = $('input#txtIva').val();
				Producto.Total 		  = $('input#txtTotal').val();
				Producto.Cliente 	  = $('select#clientes').val();
				var DatosJson 		  = JSON.stringify(Producto);
				$("#mensaje").append("<div class='modal1'><div class='center1'> <center> <img src='"+ baseurl +"/img/gif-load.gif'> Registrando Consumo...</center></div></div>");
				$.post(currentLocation + '/saveOrder',
				{
					MiCarrito: DatosJson
				},
				function(data, textStatus) {
						$("#carrito tbody").html("");
						if(data.TipoMsg=="Error"){
							$("#mensaje").html("<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>"+data.Msg+"</div>");
						}

						else{
							$("#mensaje").html("<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>"+data.Msg+"</div>");
							//Abrimos Impresion  NumOrden
							//var Url = baseurl+'ventas/ImprimeVenta/'+data.NumOrden;
							//window.open(Url,'Pruebas','fullscreen=yes, scrollbars=auto');
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
				$('#BuscaCliente').prop("disabled", false);
				$('#BuscaCliente').val('')
				$('#lblNombrecliente').text('');
				$('#lblidcliente').text('');
				$("#BuscaCliente").focus();
				$('#BuscaProducto').prop("disabled",true);
				$('#AgregaProducto').prop("disabled", true);
				LimpiaOrder();
				AsignaSession();
				return false;


			}
			return false;
	});

});
function LimpiarTexto(){
		document.getElementById("BuscaProducto").value="";
		document.getElementById("codigo").value="";
		document.getElementById("cantidad").value="1";
		document.getElementById("precioventa").value="";

		$("#BuscaProducto").focus();
}
function LimpiaOrder(){
	document.getElementById("txtTotal").value="0";
	document.getElementById("factura").value="";
	document.getElementById("fechaFactura").value="";
	document.getElementById("centros").value="";


}
function EliminarItem(codigo,descripcion,cantidad,pcompra,idsession,costo){
		var Producto 		 = new Object();
		Producto.Codigo      = codigo;
		Producto.Descripcion = descripcion;
		Producto.Cantidad    = cantidad;
		Producto.Pcompra     = pcompra;
		Producto.IdSession   = idsession;
		//Producto.Proveedor   = proveedor;
		Producto.Costo	     = costo;
		//Producto.IdProveedor = idproveedor;

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
					var Operacion= parseFloat(item.precio) * parseFloat(item.cantidad);
					Subtotal = parseFloat(Subtotal) + parseFloat(Operacion);
					iva      = parseFloat(Subtotal) * parseFloat(0.19);
					total    = parseFloat(iva) + parseFloat(Subtotal);
					var nuevaFila =
					"<tr>"
					+"<td>"+item.txtCodigo+"</td>"
					+"<td>"+item.descripcion+"</td>"
					//+"<td>"+item.proveedor+"</td>"
					+"<td>$ "+item.precio+"</td>"
					+"<td>"+item.cantidad+"</td>"
					+"<td>$ "+Operacion+"</td>"
					+"<td><div align='center'>"
					+'<img onclick="EliminarItem('
					+"'"+item.txtCodigo+"',"
					+"'"+item.descripcion+"',"
					+"'-1',"
					+"'"+item.precio+"',"
					+"'"+idsession+"',"
					//+"'"+item.proveedor+"',"
					+"'"+item.costo+"',"
					//+"'"+item.IdProveedor+"'"
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
					LimpiaOrder();
				}
				LimpiarTexto();
			},
			"json"
		);
		return false;
	}
