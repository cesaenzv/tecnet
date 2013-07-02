<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	'Create',
);

?>

<h1>Create Cliente</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>