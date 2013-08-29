<?php
/* @var $this OrdenController */
/* @var $model Orden */

$this->breadcrumbs=array(
	'Ordens'=>array('index'),
	'Create',
);

?>

<div id="adminOrdenes">
  <input id="createOrdenButton" name="radio" type="radio" value="createOrden"/><label for="createOrdenButton">Crear Orden</label>
  <input id="viewOrdenButton" name="radio" type="radio" value="viewOrden"/><label for="viewOrdenButton">Ver Ordenes</label>
</div>

<div class="ordenes" id="createOrden" style="display: none">
<a style="display: block" href="" id="createCliente"></a>
<?php 
echo $this->renderPartial('_form', array('model'=>$model)); 
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a#createCliente',
    'config'=>array(),
    )
);
?>
</div>
<div class="ordenes" id ="viewOrden" style="display: none">
<a style="display: block" href="" id="createCliente"></a>
<?php 
echo $this->renderPartial('_form', array('model'=>$model)); 
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a#createCliente',
    'config'=>array(),
    )
);
?>
</div>