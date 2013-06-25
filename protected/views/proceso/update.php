<?php
/* @var $this ProcesoController */
/* @var $model Proceso */

$this->breadcrumbs=array(
	'Procesos'=>array('index'),
	$model->k_idProceso=>array('view','id'=>$model->k_idProceso),
	'Update',
);

?>

<h1>Update Proceso <?php echo $model->k_idProceso; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>