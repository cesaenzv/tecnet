<?php
/* @var $this MarcaController */
/* @var $model Marca */

$this->breadcrumbs=array(
	'Marcas'=>array('index'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#marca-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manejar Marcas<a  class="crear btn" href="<?php echo Yii::app()->createAbsoluteUrl("marca/Create");?>"></a></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'marca-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'k_idMarca',
		'n_nombreMarca',
		array(
			'class'=>'CButtonColumn',
            'template' => '{view}',
		),
	),
)); ?>
