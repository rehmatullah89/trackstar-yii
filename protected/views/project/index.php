<?php
/* @var $this ProjectController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Projects',
);

$this->menu=array(
	array('label'=>'Create Project', 'url'=>array('create')),
	array('label'=>'Manage Project', 'url'=>array('admin')),
);
?>

<h1>Projects</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array
    (
	array(
        'name'  => 'id',
        'value' => 'CHtml::link($data->id, Yii::app()->createUrl("project/view",array("id"=>$data->primaryKey)))',
		'type'  => 'raw',
		),
		'name',
		'description',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
<?php 
//widget for the recent comments
$this->beginWidget('zii.widgets.CPortlet', array('title'=>'Recent Comments',));
$this->widget('RecentCommentsWidget');
$this->endWidget(); 
?>