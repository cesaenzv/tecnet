<?php
/* @var $this DuracionController */
/* @var $model Duracion */

$this->breadcrumbs=array(
	'Duracions'=>array('index'),
	$model->k_idDuracion=>array('view','id'=>$model->k_idDuracion),
	'Update',
);

$this->menu=array(
	array('label'=>'List Duracion', 'url'=>array('index')),
	array('label'=>'Create Duracion', 'url'=>array('create')),
	array('label'=>'View Duracion', 'url'=>array('view', 'id'=>$model->k_idDuracion)),
	array('label'=>'Manage Duracion', 'url'=>array('admin')),
);
?>

<h1>Update Duracion <?php echo $model->k_idDuracion; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>