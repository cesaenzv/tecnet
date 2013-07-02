<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->k_identificacion=>array('view','id'=>$model->k_identificacion),
	'Update',
);

?>

<h1>Update Cliente <?php echo $model->k_identificacion; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>