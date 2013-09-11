$(document).ready(function() {
	var ordenViewModule = (function(){
		var jqGridTable,jqGridPager,idOrden;
		var init = function(config){
			jqGridTable = config.jqGridTable;
			jqGridPager = config.jqGridPager;
			idOrden = config.idOrden;
			activeGrid();
		},
		activeGrid = function(){
			$(jqGridTable).jqGrid("clearGridData");
            $(jqGridTable).jqGrid("GridUnload");
            $(jqGridTable).jqGrid({
                loadtext:"Cargando datos...",
                url: getGridProcesos+"?id="+idOrden.text(),
                emptyrecords: "Sin registros",
                loadonce:false,
                datatype: "json",
                mtype: "POST",
                width:900,
                shrinkToFit:true,
    			resizable:true,
                colNames: ["ID","id_Equipo" ,"Serial", "Especificacion","Estado","Descripcion Orden", "Estado Proceso", "Leido", "Fecha Asig.", "Fecha Fin.","Servicio", "Responsable"],
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
                    name: "id_Equipo", 
                    width: 0,
                    editable:true,
                    hidden:true,
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "serial", 
                    width: 300,
                    editable:true,
                    hidden:false,
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "Especificacion", 
                    width: 350,
                    editable:true,
                    hidden:false,                     
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "i_inhouse", 
                    width: 100,
                    editable:true,
                    hidden:false,                     
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "n_descripcion", 
                    width: 400,                     
                    hidden:false,
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "nombreEstado", 
                    width: 350,
                    editable:true,
                    hidden:false,                     
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "leido", 
                    width: 100,
                    editable:true,
                    hidden:false,                     
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "fchAsignacion", 
                    width: 300,
                    editable:true,
                    hidden:false,                     
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "fchFinalizacion", 
                    width: 300,
                    editable:true,
                    hidden:false,                     
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "servicio", 
                    width: 300,
                    editable:true,
                    hidden:false,                     
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                },
                {
                    name: "responsable", 
                    width: 350,
                    editable:true,
                    hidden:false,                     
                    editrules:{
                        edithidden:true, 
                        required:true
                    }
                }

                ],
                pager: jqGridPager,
                rowNum: 20,
                rowList: [20, 40, 60],
                sortname: "k_idProceso",
                sortorder: "desc",               
                viewrecords: true,
                gridview: true,
                autoencode: true,
                caption: "Mantenimientos Cliente",
                multiselect: false,
            }).navGrid(jqGridPager, {
                edit : false,
                add : false,
                del : false,
                search :false,
                closeAfterEdit: true,
                closeAfterAdd:true
                });
            
            $(jqGridTable).jqGrid('filterToolbar',{stringResult: true, searchOnEnter : false});
		};
		return{
			init:init
		}
	})();

	ordenViewModule.init({
		jqGridTable:"#jqGridTable",
		jqGridPager:("#jqGridPager"),
		idOrden:$("#k_idOrden")
	});
})