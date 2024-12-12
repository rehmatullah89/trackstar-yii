<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Users</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array
    (
		array(
        'name'  => 'id',
        'value' => 'CHtml::link($data->id, Yii::app()->createUrl("user/view",array("id"=>$data->primaryKey)))',
		'type'  => 'raw',
		),
		'email',
		'username',
		'last_login_time',
		'create_time',
		'create_user_id',
		'update_time',
		'update_user_id',
	),
)); ?>
