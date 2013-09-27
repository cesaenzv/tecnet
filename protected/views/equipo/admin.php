<?php
/* @var $this EquipoController */
/* @var $model Equipo */


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#equipo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Manejar Equipos<a  class="crear btn" href="<?php echo Yii::app()->createAbsoluteUrl("equipo/Create");?>"></a></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'equipo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'k_idEquipo',
		'n_nombreEquipo',
		'k_idCliente',
		'k_idEspecificacion',
		array(
			'class'=>'CButtonColumn',
            'template' => '{view} {update}',
		),
	),
)); ?>
