<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Поля с <span class="required">*</span> являются обязательными.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model,'category_id',Category::model()->getTree()); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article'); ?>
		<?php echo $form->textField($model,'article',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'article'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'count'); ?>
		<?php echo $form->textField($model,'count'); ?>
		<?php echo $form->error($model,'count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'images'); ?>
                <?php
                $this->widget('CMultiFileUpload', array(
                    'model'=>$model,
                    'attribute'=>'images',
                    'accept'=>'jpg|gif|png',
                    'duplicate' => 'Этот файл уже выбран!',
                    'denied' => 'Недопустимый тип файла',
                    'remove' => CHtml::image('/images/delete.png', 'Удалить'),
                    'htmlOptions' => array(
                        'multiple' => 'multiple',
                    ),
                    /*
                    'options'=>array(
                       'onFileSelect'=>'function(e, v, m){ alert("onFileSelect - "+v) }',
                       'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
                       'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
                       'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
                       'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
                       'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
                    ),
                    */
                ));
                ?>
                <?php
                if ($model->other_images) {
                  $this->renderPartial('_imageGrid', array('model' => $model));
                }
                ?>
		<?php echo $form->error($model,'images'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
                <?php $this->widget('application.extensions.ckeditor.CKEditor', array(
                    'model'=>$model,
                    'attribute'=>'description',
                    'language'=>'ru',
                    'editorTemplate'=>'full',
                    )); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_title'); ?>
		<?php echo $form->textField($model,'meta_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'meta_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_keywords'); ?>
		<?php echo $form->textField($model,'meta_keywords',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'meta_keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_desc'); ?>
		<?php echo $form->textField($model,'meta_desc',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'meta_desc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'old_price'); ?>
		<?php echo $form->textField($model,'old_price'); ?>
		<?php echo $form->error($model,'old_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recommended'); ?>
                <?php echo $form->dropDownList($model,'recommended',array('0'=>'Нет', '1'=>'Да')); ?>
		<?php echo $form->error($model,'recommended'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'novelty'); ?>
                <?php echo $form->dropDownList($model,'novelty',array('0'=>'Нет', '1'=>'Да')); ?>
		<?php echo $form->error($model,'novelty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
                <?php echo $form->dropDownList($model,'status',array('0'=>'Нет', '1'=>'Да')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->