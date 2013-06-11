<?php
/* @var $this EspecificacionController */
/* @var $model Especificacion */

$this->breadcrumbs=array(
	'Especificacions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Especificacion', 'url'=>array('index')),
	array('label'=>'Manage Especificacion', 'url'=>array('admin')),
);
?>

<h1>Create Especificacion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>