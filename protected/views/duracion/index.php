<?php
/* @var $this DuracionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Duracions',
);

$this->menu=array(
	array('label'=>'Create Duracion', 'url'=>array('create')),
	array('label'=>'Manage Duracion', 'url'=>array('admin')),
);
?>

<h1>Duracions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
