<?php
/* @var $this OrdenController */
/* @var $model Orden */

$this->breadcrumbs=array(
	'Ordens'=>array('index'),
	'Create',
);

?>

<h1>Create Orden</h1>
<a style="display: block" href="" id="createCliente"></a>
<?php 
echo $this->renderPartial('_form', array('model'=>$model)); 
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a#createCliente',
    'config'=>array(),
    )
);
?>
