<?php
/* @var $this ProcesoController */
/* @var $model Proceso */

$this->breadcrumbs=array(
	'Procesos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Proceso', 'url'=>array('index')),
	array('label'=>'Manage Proceso', 'url'=>array('admin')),
);
?>

<h1>Create Proceso</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>