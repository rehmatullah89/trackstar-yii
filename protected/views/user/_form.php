<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<div class="row">
	<?php echo $form->labelEx($model,'password_repeat'); ?>
	<?php echo $form->passwordField($model,'password_repeat',array('size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->error($model,'password_repeat'); ?>
	</div>
	
	<!-- <div class="row">
	<?php //echo $form->labelEx($model,'last_login_time'); ?>
	<?php
	/* $this->widget(
    'ext.jui.EJuiDateTimePicker',
    array(
        'model'     => $model,
        'attribute' => 'last_login_time',
        //'language'=> 'ru',//default Yii::app()->language
        //'mode'    => 'datetime',//'datetime' or 'time' ('datetime' default)
        'options'   => array(
           'dateFormat' => 'yy-m-d',
            'timeFormat' => 'hh:mm:ss',
        ),
    )
); */
	?>
	<?php //echo $form->error($model,'last_login_time'); ?>
	</div> 
	

			<div class="row">
	<?php //echo $form->labelEx($model,'create_time'); ?>
	<?php
/* 	$this->widget(
    'ext.jui.EJuiDateTimePicker',
    array(
        'model'     => $model,
        'attribute' => 'create_time',
        //'language'=> 'ru',//default Yii::app()->language
        //'mode'    => 'datetime',//'datetime' or 'time' ('datetime' default)
        'options'   => array(
           'dateFormat' => 'yy-m-d',
            'timeFormat' => 'hh:mm:ss',
        ),
    )
); */
	?>
	<?php //echo $form->error($model,'create_time'); ?>
	</div>-->

	<!-- <div class="row">
		<?php //echo $form->labelEx($model,'create_user_id'); ?>
		<?php //echo $form->textField($model,'create_user_id'); ?>
		<?php //echo $form->error($model,'create_user_id'); ?>
	</div> 

		<div class="row">
	<?php //echo $form->labelEx($model,'update_time'); ?>
	<?php
	/* 	$this->widget(
		'ext.jui.EJuiDateTimePicker',
		array(
			'model'     => $model,
			'attribute' => 'update_time',
			//'language'=> 'ru',//default Yii::app()->language
			//'mode'    => 'datetime',//'datetime' or 'time' ('datetime' default)
			'options'   => array(
			   'dateFormat' => 'yy-m-d',
				'timeFormat' => 'hh:mm:ss',
				),
			)
		); */
	?>
	<?php //echo $form->error($model,'update_time'); ?>
	</div>-->

	<!-- <div class="row">
		<?php //echo $form->labelEx($model,'update_user_id'); ?>
		<?php //echo $form->textField($model,'update_user_id'); ?>
		<?php //echo $form->error($model,'update_user_id'); ?>
	</div> -->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->