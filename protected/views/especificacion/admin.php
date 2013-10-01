<?php
/* @var $this EspecificacionController */
/* @var $model Especificacion */

$this->breadcrumbs=array(
	'Especificacions'=>array('admin'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#especificacion-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manejar Modelos<a  class="crear btn" href="<?php echo Yii::app()->createAbsoluteUrl("especificacion/Create");?>"></a></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'especificacion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'k_especificacion',
		'n_nombreEspecificacion',
		'k_idTipoEquipo',
		'k_idMarca',
		array(
			'class'=>'CButtonColumn',
            'template' => '{update}'
		),
	),
)); ?>
