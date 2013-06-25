<?php
/* @var $this OrdenController */
/* @var $model Orden */

$this->breadcrumbs=array(
	'Ordens'=>array('index'),
	$model->k_idOrden=>array('view','id'=>$model->k_idOrden),
	'Update',
);

?>

<h1>Update Orden <?php echo $model->k_idOrden; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>