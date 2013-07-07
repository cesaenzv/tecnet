$(document).ready(function() {
	var mantenimientoModule = (function(){
		var contentPaq, idPaquete, idProceso,idEquipo;
		var init = function(config){
			contentPaq = config.contentPaq;
			bindEvents();
		},
		bindEvents = function(){
			contentPaq.find(".btnTratarR").each(function(){
				console.log(this);
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
			$.ajax({
				url:getServiciosPaqUrl,
                dataType: "json",
                data: {
                    idPaquete:idPaquete,
                    idProceso:idProceso,
                    idEquipo:idEquipo
                },
                success:function(data){
                   
                },
                error:function(){
                    console.log("error");
                }
			});
		};
		return {
			init:init
		}
	})();

	mantenimientoModule.init({
		contentPaq:$("#paquetesM")
	});
});