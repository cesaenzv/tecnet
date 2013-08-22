<?php
/* @var $this OrdenController */
/* @var $model Orden */

$this->breadcrumbs=array(
	'Ordens'=>array('index'),
	'Create',
);

?>

<h1>Create Orden</h1>
<a style="display: block" href="<?php echo $this->createUrl("cliente/createFancy"); ?>" id="createCliente">;lkajcdi</a>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>