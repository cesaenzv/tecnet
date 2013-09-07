<?php 
Yii::app()->getClientScript()->registerCssFile('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/libs/jquery.ui.js', CClientScript::POS_HEAD);

?>
<script type="text/javascript"> 

	var guardarGarantia = '<?php echo Yii::app()->createAbsoluteUrl("equipo/CreateEMantenimiento"); ?>';

</script>

<div class="form">
    <div class="row">
        <label>Identificacion del Cliente</label>
        <label id="idClienteLbl"><?php echo $idC ?></label>
    </div>

    <div>
    	<label>Tecnico</label>
        <?php
        echo CHtml::dropDownList('userTec', 'userTec', $users, null);
        ?>        
    </div>

    <div>
    	<label>Equipos</label>
        <?php
        echo CHtml::dropDownList('equipoId', 'equipoId', $equipos, null);
        ?>        
    </div>

    <div class="row">
        <label>Descripcion</label>
        <textarea id="txtDescripcion" rows="10" cols="25"></textarea>
        
    </div>
    <button id="crearGarantia">Crear Garantia</button>    
</div>



<script>
	bindEventsFancy = function (){
        $("#crearGarantia").click(function(e){
            e.preventDefault();
            guardarNuevaGarantia();
        });
    };
    guardarNuevaGarantia = function(){
        console.log("Guardar Garantia");
         $.ajax({
         	type:"POST",
            url:guardarGarantia,
            dataType: "json",
            data: {
                idCliente : $("#idClienteLbl").text(),
                tecnicoId : $("#userTec").val(),
                equipoId : $("#equipoId").val(),
                descripcion : $("#txtDescripcion").val()
            },
            success:function(data){
                console.log(data);
                garantiaGrid.trigger( 'reloadGrid' );                    
            },
            error:function(){
                console.log("error");
            }
        });
    };	
    bindEventsFancy();
</script>