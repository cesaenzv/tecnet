<?php
/* @var $this EspecificacionController */
/* @var $model Especificacion */

$this->breadcrumbs=array(
	'Especificacions'=>array('index'),
	$model->k_especificacion=>array('view','id'=>$model->k_especificacion),
	'Update',
);

?>

<h1>Update Especificacion <?php echo $model->k_especificacion; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>