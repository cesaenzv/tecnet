<?php
/* @var $this OrdenController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ordens',
);

?>

<h1>Ordens</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
