$(document).ready(function(){
	var reporteTecnico = (function(){
		var userNameTec, tipoTec, plantillaTec,consultBtn,fchI,fchF;
		/*_________________Funciones_________________*/
		var init = function(config){
			fchI = config.fchI;
			fchF = config.fchF;
			consultBtn = config.consultBtn;
			historialData = $("#tecnicoContent");
			plantillaTec = $("#tecnicosTemplate");
			jQueryPlugins();
			bindEvents();
		},
		jQueryPlugins = function(){
			fchI.datepicker({ dateFormat: "yy-mm-dd" });
			fchF.datepicker({ dateFormat: "yy-mm-dd" });
		},
		bindEvents = function(){
			$("#configContent").find("input[name=tecType]:radio").each(function(i,item){
				$(item).click(function(){
					getTecs($(item));	
				});
			});
			consultBtn.on('click',function(){
				consultarReporte();
			});
		},
		consultarReporte = function(){
			var typeConsult = $('input[name=reportType]:checked').val();
			var tec = $('#tecSelected').val();
			var typeTec = $('input[name=tecType]:checked').val();
			console.log(fchI.val());
			console.log(fchF.val());
			if(typeConsult!== undefined && tec !== undefined ){
				$.ajax({
				type:'POST',
				url:url,
				dataType: "json",
				data: {
					fchI: fchI.val(),
					fchF: fchF.val(),
					tecId:tec,
					typeConsult:typeConsult,
					typeTec:typeTec,
				},
				success:function(data){
					console.log(data);
				},
				error:function(){
				}
			});
			}
			
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
		consultBtn : $("#consultBtn"),
		fchI: $("#fchI"),
		fchF: $("#fchF")
	});
});
