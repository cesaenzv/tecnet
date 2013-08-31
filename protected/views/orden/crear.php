<?php
/* @var $this OrdenController */
/* @var $model Orden */

$this->breadcrumbs=array(
	'Ordens'=>array('index'),
	'Create',
);

?>

<div class="ordenes" id="createOrden">
<a style="display: block" class="link-fancy" href="" id="createCliente"></a>
<a style="display: block" class="link-fancy" href="" id="createOrdenFancy"></a>
<?php 
echo $this->renderPartial('_form', array('model'=>$model)); 
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a.link-fancy',
    'config'=>array(),
    )
);
?>
</div>