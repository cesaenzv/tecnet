<?php
/* @var $this ClienteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Clientes',
);

?>

<h1>Clientes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
