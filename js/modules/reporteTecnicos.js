$(document).ready(function(){
	var reporteTecnico = (function(){
		var userNameTec, tipoTec, plantillaTec,consultBtn;
		/*_________________Funciones_________________*/
		var init = function(config){
			consultBtn = config.consultBtn;
			historialData = $("#tecnicoContent");
			plantillaTec = $("#tecnicosTemplate");
			bindEvents();
		},
		bindEvents = function(){
			$("#config").find("input[type=radio]").each(function(i,item){
				$(item).click(function(){
					getTecs($(item));	
				});
			});
			consultBtn.on('click',function(){
				consultarHistorial();
			});
		},
		getTecs = function (item) {
			$.ajax({
				type:'POST',
				url:urlGetTecs,
				dataType: "json",
				data: {
					typeTec:item.val()
				},
				success:function(data){
					showListTecs(data);
				},
				error:function(){
				}
			});
		},
		showListTecs = function(tecs){			
			var s = $('<select id=tecSelected/>');
			for (var x=0;x<tecs.length;x++){
			    $('<option />', {value: tecs[x].id, text: tecs[x].username}).appendTo(s);
			}
			$("#listTecnicos").html(s);
		};		

		return {
			init:init
		}	
	})();

	reporteTecnico.init({
		consultBtn : $("#consultBtn")
	});
});
