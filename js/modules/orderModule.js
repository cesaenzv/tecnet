$(document).ready(function() {

    var orderModule = (function(){
        var btnSearchClient, docClient, typeDocument, equiposGrid, plantillaClient,clientData,crearEquipo;
        var init = function(config){
            $("#dialog-iframe").dialog({
                autoOpen: false
            });
            clientData = config.clientData;
            plantillaClient = $("#clientTemplate");
            btnSearchClient = config.btnSearchClient;
            docClient = config.docClient;
            typeDocument = config.typeDocument;
            equiposGrid = config.equiposGrid;
            crearEquipo = config.crearEquipo;          
            bindEvents();
        },
        bindEvents = function(){

            btnSearchClient.click(function(){           
                findClient();
            });

            crearEquipo.click(function(e){
                e.preventDefault();
                crearEquipoCliente();
            });
            
            $("#Orden_k_idUsuario").keypress(function(event){
                if(event.which==13){
                    btnSearchClient.click();
                }
            });

            $("#marcaInput").change(getEspecificacion);
            $("#tipoequipoInput").change(getEspecificacion);
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
                        createEquipoGrid(docClient.val());
                    }else{
                        $("#dialog-iframe").dialog( "option", "title", "Crear Cliente" );
                        $("#dialog-iframe").dialog( "option", "width", 450 );
                        $("#dialog-iframe").dialog( "option", "resizable", false );
                        $("#dialog-iframe").dialog("open");
                        $("#iframe").attr('src',"../cliente/createFancy/"+docClient.val());
                        $("#iframe").attr('width',"400");
                        $("#iframe").attr('height',"525");
                        $("#dialog-iframe").dialog( "option", "position", "center");
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
        agregarEquipo = function(){         
            $("#dialog-iframe").dialog( "option", "title", "Crear Equipo" );
            $("#dialog-iframe").dialog( "option", "width", 550 );
            $("#dialog-iframe").dialog( "option", "resizable", false );
            $("#dialog-iframe").dialog("open");
            $("#iframe").attr('src',url+'/?idC='+docClient.val());
            $("#iframe").attr('width',"500");
            $("#iframe").attr('height',"300");
            $("#dialog-iframe").dialog( "option", "position", "center");
        },
        createMantenimiento = function(){
            var rowid = $(equiposGrid).jqGrid('getGridParam', 'selarrrow');
            if (rowid == null) {
                alert("Debe seleccionar al menos un equipo para realizar el mantenimiento");
                return false;
            }
            var mensaje="Esta seguro que desea realizar mantenimiento a los equipos con serial:\n";
            for (var i =0 ; i<rowid.length;i++){
                var msj = $(equiposGrid).getRowData(rowid[i]).n_nombreEquipo;
                mensaje+= msj +"\n";
            }
            mensaje+="Recuerde que esta acción no se puede deshacer";
            if(confirm(mensaje)){
                $.ajax({
                    type: "POST",
                    url: "../orden/CreateOrden/",
                    data: "ids="+(rowid),
                    success: function(response){
                        if(response.mensaje.toLowerCase()=="fail"){
                            alert("No se ha podido crear la orden, porfavor intente nuevamente");
                            return false;
                        }else{
                            $("#dialog-iframe").dialog( "option", "title", "Crear Mantenimiento" );
                            $("#dialog-iframe").dialog( "option", "width", 700 );
                            $("#dialog-iframe").dialog( "option", "resizable", false );
                            $("#dialog-iframe").dialog("open");
                            $("#iframe").attr('src',"../orden/createPaquete/"+response.idOrden);
                            $("#iframe").attr('width',"650");
                            $("#iframe").attr('height',"800");
                            $("#dialog-iframe").dialog( "option", "position", "center");
                        }
                    },
                    dataType: 'json'
                });
            }
        },
        confirmaCliente= function(){
            $("#dialog-iframe").dialog("close");
            findClient();
        },
        createEquipoGrid = function(idCliente){
            $(equiposGrid).jqGrid("clearGridData");
            $(equiposGrid).jqGrid("GridUnload");
            $(equiposGrid).jqGrid({
                url: createEquipoGridUrl+"?idCliente="+idCliente,
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
                    editoptions:{
                        dataUrl: "../cliente/GetEspecificaciones/"
                    },
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
                    editoptions:{
                        dataUrl: "../cliente/GetEstados/"
                    },
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
                editurl:"../equipo/saveGrid/"+idCliente,
                viewrecords: true,
                gridview: true,
                autoencode: true,
                caption: "Equipos",
                multiselect: true
            });
            $(equiposGrid).jqGrid('navGrid', '#pagerEquipoGrid', {
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
            }).navButtonAdd("#pagerEquipoGrid", {
                caption: "mantenimiento", 
                buttonicon: "ui-icon-newwin",
                onClickButton: function (data) { 
                    createMantenimiento();
                },
                position: "last", 
                title: "Forzar Realizacion", 
                cursor: "pointer"
            }).navButtonAdd("#pagerEquipoGrid", {
                caption: "", 
                buttonicon: "ui-icon-circle-plus",
                onClickButton: function (data) { 
                    agregarEquipo();
                },
                position: "first", 
                title: "Forzar Realizacion", 
                cursor: "pointer"
            });
            
            $(equiposGrid).jqGrid('filterToolbar',{
                stringResult: true,
                searchOnEnter : false
            });
        },
        getEspecificacion = function(){
            if ($("#especificacionInput").autocomplete()){
                $("#especificacionInput").autocomplete('destroy');  
            };
            $.ajax({
                type:"POST",
                url:url,
                dataType:"json",
                data: {
                    marca:$("#marcaInput").val(), 
                    tipoEquipo:$("#tipoequipoInput").val()
                },
                success:function(data){
                    $("#nombreEspecificacion").autocomplete({
                        source: data.list,
                        minLength:2
                    });
                },
                error:function(error){
                    console.log(error);
                }
            });
        }; 
        crearEquipoCliente = function(){
            $.ajax({
                type:"POST",
                url:urlCrearEquipo,
                dataType: "json",
                data: {
                    clienteId:$("#idClienteLbl").text(),
                    especificacion:$("#nombreEspecificacion").val(),
                    nombreEquipo:$("#nombreEquipo").val(),
                    marca:$("#marcaInput").val(),
                    tipoEquipo:$("#tipoequipoInput").val()
                },
                success:function(data){
                    alert(data.msg);
                },
                error:function(){
                    console.log("error");
                }
            });
        };
        return {
            init:init,
            confirmaCliente:confirmaCliente
        }
    })();

    orderModule.init({
        btnSearchClient:$("#searchClient"),
        docClient:$("#Orden_k_idUsuario"),
        typeDocument:$("#typeDocument"),
        equiposGrid:"#equiposGrid",
        clientData:$("#clientData"),
        crearEquipo:$("#CrearEquipoBtn")
    });
});