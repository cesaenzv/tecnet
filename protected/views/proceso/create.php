<?php
/* @var $this ProcesoController */
/* @var $model Proceso */

$this->breadcrumbs=array(
	'Procesos'=>array('index'),
	'Create',
);

?>

<h1>Create Proceso</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>