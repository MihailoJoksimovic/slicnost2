<?php
$form = $this->beginWidget('ActiveForm', array(
    'id' => 'edit-profile-form',
));

echo $form->errorSummary(array($user, $user->personalInfo));

?>


<h3><?= t('Edit profile'); ?></h3>

<!-- TEMP -->
<style type="text/css">
    #wrap div {
        border: 1px solid black;
    }
    #wrap div h3 {
        background-color: lightblue;
    }
</style>

<div id="wrap">
    <div>
        <h3>General</h3>

    </div>

    <div>
        <h3>Pictures</h3>
    </div>

    <div>
        <h3>More about me</h3>
    </div>

    <div>
        <h3>Hobbies</h3>
    </div>
</div>

<div class="buttons">
    <?= Html::submitButton(); ?>
</div>
<?php $this->endWidget(); ?>