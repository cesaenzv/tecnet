$(document).ready(function() {

	var orderModule = (function(){
		var btnSearchClient, docClient, typeDocument, gridEquipos;
		var init = function(config){
			btnSearchClient = config.btnSearchClient;
			docClient = config.docClient;
			typeDocument = config.typeDocument;
			equiposGrid = config.equiposGrid;			
			bindEvents();
		},
		bindEvents = function(){
			btnSearchClient.click(function(){			
				findClient();
			});
		},
		findClient = function(){
			console.log("findClient");
			console.log(searchClientUrl.toString());
			$.ajax({
				url:searchClientUrl,
				data: {doc:docClient.val(), typeDoc:typeDocument.val()},
				success:function(data){
					data.cliente !== null ? showClienteData(data.client) : alert("El cliente no existe");
					createEquipoGrid(data.equipos);
				},
				error:function(){
					console.log("error");
				}
			});
		},
		showClienteData = function(client){
			alert("showClienteData");
		},
		createEquipoGrid = function(equipos){
			gridEquipos.jqGrid();
		};
		return {
			init:init
		}
	})();

	orderModule.init({
		btnSearchClient:$("#searchClient"),
		docClient:$("#Orden_k_idUsuario"),
		typeDocument:$("#typeDocument"),
		gridEquipos:$("#equiposGrid")
	});	
});
