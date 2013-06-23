<?php
/* @var $this ServicioController */
/* @var $model Servicio */

$this->breadcrumbs=array(
	'Servicios'=>array('index'),
	'Create',
);

?>

<h1>Create Servicio</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>