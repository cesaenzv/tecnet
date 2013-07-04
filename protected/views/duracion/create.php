<?php
/* @var $this DuracionController */
/* @var $model Duracion */

$this->breadcrumbs=array(
	'Duracions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Duracion', 'url'=>array('index')),
	array('label'=>'Manage Duracion', 'url'=>array('admin')),
);
?>

<h1>Create Duracion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>