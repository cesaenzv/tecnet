<?php
/* @var $this OrdenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ordens',
);

$this->menu=array(
	array('label'=>'Create Orden', 'url'=>array('create')),
	array('label'=>'Manage Orden', 'url'=>array('admin')),
);
?>

<h1>Ordens</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
