$(document).ready(function() {
	var garantiaModule = (function(){

		var btnSearchClient, docClient, typeDocument, garantiaGrid, clientData;

		var init = function(config){
			clientData = config.clientData;
            plantillaClient = $("#clientTemplate");
            btnSearchClient = config.btnSearchClient;
            docClient = config.docClient;
            typeDocument = config.typeDocument;
            garantiaGrid = config.garantiaGrid;
            crearEquipo = config.crearEquipo;          
            bindEvents();
		},
        bindEvents = function(){
            btnSearchClient.click(function(){           
                findClient();
            });            
            
            $("#Orden_k_idUsuario").keypress(function(event){
                if(event.which==13){
                    btnSearchClient.click();
                }
            });
        },
        findClient = function(){
            $.ajax({
                url:searchClientUrl,
                dataType: "json",
                data: {
                    doc:docClient.val(), 
                    typeDoc:typeDocument.val()
                },
                success:function(data){
                    if( data.cliente !== null && data.cliente !== null ){
                        showClienteData(data.cliente)
                        createGarantiaGrid(docClient.val());
                    }else{
                    	console.log("Mostrar fancy");
                    	$("#createCliente").attr("href","");
                        $("#createCliente").attr("href","../cliente/createFancy/"+docClient.val())
                        $("#createCliente").click();
                    }
                },
                error:function(){
                    console.log("error");
                }
            });
        },
        showClienteData = function(client){            
            var template = Handlebars.compile(plantillaClient.html());
            var contenido = template(client);
            clientData.html(contenido);
        },createGarantiaGrid = function(idClient){


            garantiaGrid.jqGrid('GridUnload');
            garantiaGrid.jqGrid('clearGridData');
            garantiaGrid.jqGrid({
                url: createEquipoGridUrl+"?idCliente="+idClient+"&garantia='true'",
                datatype: "json",
                mtype: "POST",
                width:900,
                colNames: ["ID", "Equipo", "Especificacion", "Tecnico", "Descripcion", "Leido","Fecha Asignacion","Fecha Entrega","Estado"],
                colModel: [
                {
                    name: "k_idProceso", 
                    width: 0,
                    hidden:true,                    
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "nombreE", 
                    width: 250,
                    editable:true,
                    hidden:false,
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "especificacion", 
                    width: 200,
                    editable:true,
                    hidden:false,
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "tecnico_username", 
                    width: 200,
                    editable:true,
                    hidden:false,                     
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "n_descripcion", 
                    width: 200,
                    editable:true,
                    hidden:false,                     
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "o_flagLeido", 
                    width: 200,                     
                    hidden:false,
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "fch_Asignacion", 
                    width: 200,
                    editable:true,
                    hidden:false,                     
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "fch_Entrega", 
                    width: 200,
                    editable:true,
                    hidden:false,                     
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "fk_idEstado", 
                    width: 200,
                    editable:true,
                    hidden:false,                     
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                }
                ],
                pager: "#pagerGarantiaGrid",
                rowNum: 20,
                rowList: [10, 20, 30],
                sortname: "k_idProceso",
                sortorder: "desc",               
                viewrecords: true,
                gridview: true,
                autoencode: true,
                caption: "Mantenimientos Cliente",
                multiselect: false,
            });
            garantiaGrid.jqGrid('navGrid', '#pagerGarantiaGrid', {
                edit : false,
                add : false,
                del : false,
                search :false,
                closeAfterEdit: true,
                closeAfterAdd:true,
                afterSubmit : function(response, postdata)
                {
                } 
            },
            {},
            {},
            {
            }).navButtonAdd("#pagerGarantiaGrid", {
                caption: "", 
                buttonicon: "ui-icon-circle-plus",
                onClickButton: function (data) { 
                    agregarMantenimiento();
                },
                position: "first", 
                title: "Nuevo Mant.", 
                cursor: "pointer"
            });
            
            garantiaGrid.jqGrid('filterToolbar',{stringResult: true, searchOnEnter : false});
        },
        agregarMantenimiento = function(){
                $("#callViewCrearMantenimiento").attr('href',"");
                $("#callViewCrearMantenimiento").attr('href',urlView+'/?idC='+docClient.val());
                $("#callViewCrearMantenimiento").click();
        };


		return {
			init:init
		};
	})();

	garantiaModule.init({
		btnSearchClient:$("#searchClient"),
        docClient:$("#Orden_k_idUsuario"),
        typeDocument:$("#typeDocument"),
        garantiaGrid:$("#garantiaGrid"),
        clientData:$("#clientData")
	});
});