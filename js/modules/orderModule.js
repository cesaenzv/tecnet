$(document).ready(function() {

	var orderModule = (function(){
		var btnSearchClient, docClient, typeDocument, equiposGrid, plantillaClient,clientData;
		var init = function(config){
			clientData = config.clientData;
			plantillaClient = $("#clientTemplate");
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
			$.ajax({
				url:searchClientUrl,
				dataType: "json",
				data: {doc:docClient.val(), typeDoc:typeDocument.val()},
				success:function(data){
					console.log(data);
					if( data.cliente !== undefined && data.cliente !== null ){
						showClienteData(data.cliente)
						createEquipoGrid(data.equipos);
					}else{
						alert("Crear cliente");
						alert("Mostrar Grilla Vacia");
					}
				},
				error:function(){
					console.log("error");
				}
			});
		},
		showClienteData = function(client){
			console.log(client);
			var template = Handlebars.compile(plantillaClient.html());
			var contenido = template(client);
			clientData.html(contenido);
		},
		createEquipoGrid = function(equipos){
			equiposGrid.jqGrid({
				data:equipos !== null ? equipos:"{}",
				datatype: "json",
				colNames: ["ID", "Nombre","Especificación","Estado","Servicio","Estado"],
                colModel: [
                	{ name: "id", width: 200,editable:true,hidden:false, edittype: "select", editrules:{edithidden:true, required:true}},
                    { name: "nombre", width: 200,editable:true,hidden:false, edittype: "select", editrules:{edithidden:true, required:true}},
                    { name: "especificacion", width: 200,editable:true,hidden:false, edittype: "select", editrules:{edithidden:true, required:true}},
                    { name: "estado", width: 100, align: "right",editable:true,hidden:false,editrules:{edithidden:true, required:true}},
                    { name: "servicio", width: 100, align: "right",editable:true,hidden:false,editrules:{edithidden:true, required:true}},
                    { name: "tecnico", width: 100, align: "right",editable:true,hidden:false,editrules:{edithidden:true, required:true}}
                ],
				rowNum: 20,
    			rowList: [10, 20, 30],
    			sortname: "k_idEquipo",
    			sortorder: "desc",
                viewrecords: true,
                gridview: true,
                afterSubmit:function(data,postd){
                    console.log(data);
                    console.log(postd);
                    return {0:true};
                },
                autoencode: true,
                caption: "Equipos"               
			}).navGrid('#pagerEquipo', {
                edit : true,
                add : true,
                del : true,
                search :false,
                closeAfterEdit: true,
                closeAfterAdd:true,
                afterComplete : function(response, postdata)
                {
                    alert("asdf");
                } 
            });
		};
		return {
			init:init
		}
	})();

	orderModule.init({
		btnSearchClient:$("#searchClient"),
		docClient:$("#Orden_k_idUsuario"),
		typeDocument:$("#typeDocument"),
		equiposGrid:$("#equiposGrid"),
		clientData:$("#clientData")
	});	
});
