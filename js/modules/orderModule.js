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
                data: {
                    doc:docClient.val(), 
                    typeDoc:typeDocument.val()
                },
                success:function(data){
                    console.log(data);
                    if( data.cliente !== null && data.cliente !== null ){
                        showClienteData(data.cliente)
                        createEquipoGrid(docClient.val());
                    }else{
                        $("#createCliente").attr("href","http://localhost/tecnet/cliente/createFancy/"+docClient.val())
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
        },
        createMantenimiento = function(){
            var rowid = $(equiposGrid).jqGrid('getGridParam', 'selrow');
            if (rowid == null) {
                alert("Debe seleccionar un equipo para realizar el mantenimiento");
                return false;
            }
            var ret = $(equiposGrid).getRowData(rowid);
        }
        createEquipoGrid = function(idCliente){
            equiposGrid.jqGrid({
                url: "http://localhost/tecnet/cliente/GetEquipoGrid/"+idCliente,
                datatype: "json",
                mtype: "POST",
                colNames: ["ID", "Serial","Especificación","Estado"],
                colModel: [
                    {
                        name: "k_idEquipo", 
                        width: 200,                    
                        editrules:{
                            edithidden:true, 
                            required:true
                        }
                    },

                    {
                        name: "n_nombreEquipo", 
                        width: 200,
                        editable:true,
                        hidden:false,
                        editrules:{
                            edithidden:true, 
                            required:true
                        }
                    },

                    {
                        name: "k_idEspecificacion", 
                        width: 200,
                        editable:true,
                        hidden:false, 
                        edittype: "select", 
                        editoptions:{dataUrl: "http://localhost/tecnet/cliente/GetEspecificaciones/"},
                        editrules:{
                            edithidden:true, 
                            required:true
                        }
                    },

                    {
                        name: "i_inhouse", 
                        width: 100, 
                        align: "right",
                        editable:true,
                        edittype: "select", 
                        editoptions:{dataUrl: "http://localhost/tecnet/cliente/GetEstados/"},
                        hidden:false,
                        editrules:{
                            edithidden:true, 
                            required:true
                        }
                    }
                ],
                pager: "#pagerEquipoGrid",
                rowNum: 20,
                rowList: [10, 20, 30],
                sortname: "k_idEquipo",
                sortorder: "desc",
                editurl:"http://localhost/tecnet/equipo/saveGrid/"+idCliente,
                viewrecords: true,
                gridview: true,
                autoencode: true,
                caption: "Equipos"               
            });
            equiposGrid.jqGrid('navGrid', '#pagerEquipoGrid', {
                edit : true,
                add : true,
                del : false,
                search :false,
                closeAfterEdit: true,
                closeAfterAdd:true,
                afterSubmit : function(response, postdata)
                {
                } 
            },
                {//edit data
                    serializeEditData:function(postdata){
                        var rowid = jQuery("#tablaCategoriaGrid").jqGrid('getGridParam', 'selrow');
                        var ret = jQuery("#tablaCategoriaGrid").getRowData(rowid);
                        postdata.k_idEspecificacion=ret.idsubtipo;
                        return postdata;
                    }
                },
                {//add data
                    serializeAddData:function(postdata){
                        var rowid = jQuery("#tablaCategoriaGrid").jqGrid('getGridParam', 'selrow');
                        var ret = jQuery("#tablaCategoriaGrid").getRowData(rowid);
                        postdata.idsubtipo=ret.idsubtipo;
                        return postdata;
                    }
                },
                {//delete data
                    serializeDelData: function (postdata) {
                        var rowid = jQuery("#tablaCategoriaGrid").jqGrid('getGridParam', 'selrow');
                        var ret = jQuery("#tablaCategoriaGrid").getRowData(rowid);
                        postdata.idsubtipo=ret.idsubtipo;
                        return postdata;
                    }
                }).navButtonAdd("#pagerEquipoGrid", { caption: "mantenimiento", buttonicon: "ui-icon-newwin",
                onClickButton: function (data) { 
                    createMantenimiento();
                },
                position: "last", title: "Forzar Realizacion", cursor: "pointer"
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