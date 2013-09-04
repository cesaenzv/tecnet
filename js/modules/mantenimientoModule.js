$(document).ready(function() {
    var mantenimientoModule = (function(){
        var contentPaq, idPaquete, idProceso,idEquipo,idServicio,plantillaProducts,divTratamiento;
        var init = function(config){
            contentPaq = config.contentPaq;
            plantillaProducts = $("#procesServicesTemplate");
            divTratamiento = config.divTratamiento;
            bindEvents();
        },
        bindEvents = function(){
            contentPaq.find(".btnTratarR").each(function(){
                $(this).click("on",function(){
                    var paqM = $(this).closest(".paqM");
                    getDataPaqM(paqM);
                });
            });
        },		
        getDataPaqM = function(paquete){
            idPaquete = paquete.find("input#idPaquete");
            idProceso = paquete.find("input#idProceso");
            idEquipo = paquete.find("input#idProceso");	
            idServicio = paquete.find("input#idServicio");	
            $.ajax({
                url:getServiciosPaqUrl,
                dataType: "json",
                data: {
                    idPaquete:idPaquete.val(),
                    idProceso:idProceso.val(),
                    idEquipo:idEquipo.val(),
                    idServicio:idServicio.val()
                },
                success:function(data){
                    showDivTratamiento(data.productos);
                },
                error:function(){
                    console.log("error");
                }
            });
        },
        showDivTratamiento = function(productos){
            var template = Handlebars.compile(plantillaProducts.html());
            var contenido = template({
                productos:productos
            });
            divTratamiento.html(contenido);
            $('#multiSProd').multiSelect();          
        };
        return {
            init:init
        }
    })();

    mantenimientoModule.init({
        contentPaq:$("#paquetesM"),
        divTratamiento:$("#divTratamiento")
    });
});