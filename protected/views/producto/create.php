<?php
/* @var $this ProductoController */
/* @var $model Producto */

$this->breadcrumbs=array(
	'Productos'=>array('index'),
	'Create',
);

?>

<h1>Create Producto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'services'=>$services,'services_product'=>$services_product)); ?>