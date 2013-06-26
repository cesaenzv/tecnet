var equipoModule = (function(){
	var marca = null, tipoEquipo=null, url;
	var init = function(){
		url = '<?php echo Yii::app()->createAbsoluteUrl("especificacion/getEspecificationList"); ?>';
	},setMarca =function(val){
		marca = val;
		getReferences();
	},setTipoEquipo = function(val){
		tipoEquipo = val;
		getReferences();
	},setUrl = function(val){
		url = val;
	},getReferences = function(){
		if (marca !== null && tipoEquipo !==null){
			$.ajax({
				url:url,
				data: {marca:marca, tipoEquipo:tipoEquipo},
				cache:false,
				success:function(data){
					console.log(data);
				},
				error:function(){
					console.log("error");
				}
			});
		}
	};
	return {
		setTipoEquipo:setTipoEquipo,
		setMarca:setMarca,
		setUrl:setUrl
	}
})();

