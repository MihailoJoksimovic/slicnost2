<?php
$form = $this->beginWidget('ActiveForm', array(
    'id' => 'favorite-form',
));

echo $form->errorSummary(array($user, $personalInfo));

?>

<h3><?= t('Registration'); ?></h3>

<?= $form->labelEx($user, 'email'); ?>
<?= $form->textField($user, 'email'); ?>
<br />
<?= $form->labelEx($personalInfo, 'first_name'); ?>
<?= $form->textField($personalInfo, 'first_name'); ?>
<br />
<?= $form->labelEx($personalInfo, 'last_name'); ?>
<?= $form->textField($personalInfo, 'last_name'); ?>
<br />
<?= $form->labelEx($personalInfo, 'gender'); ?>
<?= $form->dropDownList($personalInfo, 'gender', array(
    PersonalInfo::GENDER_MALE => PersonalInfo::getGenderStringStatic(PersonalInfo::GENDER_MALE),
    PersonalInfo::GENDER_FEMALE => PersonalInfo::getGenderStringStatic(PersonalInfo::GENDER_FEMALE),
)); ?>
<br />
<?= $form->labelEx($user, 'password'); ?>
<?= $form->passwordField($user, 'password'); ?>
<br />

<div class="buttons">
    <?= Html::submitButton(); ?>
</div>
<?php $this->endWidget(); ?>
