<?php
/* @var $this EspecificacionController */
/* @var $model Especificacion */

$this->breadcrumbs=array(
	'Especificacions'=>array('index'),
	$model->k_especificacion=>array('view','id'=>$model->k_especificacion),
	'Update',
);

$this->menu=array(
	array('label'=>'List Especificacion', 'url'=>array('index')),
	array('label'=>'Create Especificacion', 'url'=>array('create')),
	array('label'=>'View Especificacion', 'url'=>array('view', 'id'=>$model->k_especificacion)),
	array('label'=>'Manage Especificacion', 'url'=>array('admin')),
);
?>

<h1>Update Especificacion <?php echo $model->k_especificacion; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>