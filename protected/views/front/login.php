<h1>Login</h1>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'login-form'
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->labelEx($loginForm, 'username'); ?>
        <?php echo $form->textField($loginForm, 'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($loginForm, 'password'); ?>
        <?php echo $form->passwordField($loginForm, 'password'); ?>
    </div>

    <div class="row rememberMe">
        <?php echo $form->checkBox($loginForm, 'rememberMe'); ?>
        <?php echo $form->label($loginForm, 'rememberMe'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->
