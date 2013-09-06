<?php
/* @var $this TipoequipoController */
/* @var $model Tipoequipo */

$this->breadcrumbs=array(
	'Tipoequipos'=>array('index'),
	$model->k_idTipo=>array('view','id'=>$model->k_idTipo),
	'Update',
);
?>

<h1>Update Tipoequipo <?php echo $model->k_idTipo; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>