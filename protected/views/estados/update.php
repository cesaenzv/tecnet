<?php
/* @var $this EstadosController */
/* @var $model Estados */

$this->breadcrumbs=array(
	'Estadoses'=>array('index'),
	$model->k_idEstado=>array('view','id'=>$model->k_idEstado),
	'Update',
);

$this->menu=array(
	array('label'=>'List Estados', 'url'=>array('index')),
	array('label'=>'Create Estados', 'url'=>array('create')),
	array('label'=>'View Estados', 'url'=>array('view', 'id'=>$model->k_idEstado)),
	array('label'=>'Manage Estados', 'url'=>array('admin')),
);
?>

<h1>Update Estados <?php echo $model->k_idEstado; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>