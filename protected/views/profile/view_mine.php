<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/jeditable.min.js"></script>

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
        <?php echo $personalInfo->getAttributeLabel('height_id'); ?>: 
        <p id="height_id"><?php echo $personalInfo->height_id != '' ? e($personalInfo->height_id) : t('Change'); ?></p>

        <?php echo $personalInfo->getAttributeLabel('weight_id'); ?>: 
        <p id="weight_id"><?php echo $personalInfo->weight_id != '' ? e($personalInfo->weight_id) : t('Change'); ?></p>

        <?php echo t('Age'); ?>: 
        <p id="">TODO</p>

        <?php echo $personalInfo->getAttributeLabel('hair_color_id'); ?>: 
        <p id="hair_color_id"><?php echo $personalInfo->hair_color_id != '' ? e($personalInfo->hair_color_id) : t('Change'); ?></p>

        <?php echo $personalInfo->getAttributeLabel('eye_color_id'); ?>: 
        <p id="eye_color_id"><?php echo $personalInfo->eye_color_id != '' ? e($personalInfo->eye_color_id) : t('Change'); ?></p>

        <?php echo $personalInfo->getAttributeLabel('body_type_id'); ?>: 
        <p id="body_type_id"><?php echo $personalInfo->body_type_id != '' ? e($personalInfo->body_type_id) : t('Change'); ?></p>
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


<script>
    $('#height_id').editable('<?php echo url("profile/ajaxEditField"); ?>', { 
        loadurl: '<?php echo url("listLoader/loadList", array("listName" => "list_height")); ?>',
        type   : 'select',
        submit : 'OK'
     });
    $('#weight_id').editable('<?php echo url("profile/ajaxEditField"); ?>', { 
        loadurl: '<?php echo url("listLoader/loadList", array("listName" => "list_weight")); ?>',
        type   : 'select',
        submit : 'OK'
     });
    $('#hair_color_id').editable('<?php echo url("profile/ajaxEditField"); ?>', { 
        loadurl: '<?php echo url("listLoader/loadList", array("listName" => "list_hair_color")); ?>',
        type   : 'select',
        submit : 'OK'
     });
    $('#eye_color_id').editable('<?php echo url("profile/ajaxEditField"); ?>', { 
        loadurl: '<?php echo url("listLoader/loadList", array("listName" => "list_eye_color")); ?>',
        type   : 'select',
        submit : 'OK'
     });
</script>