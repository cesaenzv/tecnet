<?php
/* @var $this TipoequipoController */
/* @var $model Tipoequipo */

$this->breadcrumbs=array(
	'Tipoequipos'=>array('index'),
	$model->k_idTipo=>array('view','id'=>$model->k_idTipo),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tipoequipo', 'url'=>array('index')),
	array('label'=>'Create Tipoequipo', 'url'=>array('create')),
	array('label'=>'View Tipoequipo', 'url'=>array('view', 'id'=>$model->k_idTipo)),
	array('label'=>'Manage Tipoequipo', 'url'=>array('admin')),
);
?>

<h1>Update Tipoequipo <?php echo $model->k_idTipo; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>