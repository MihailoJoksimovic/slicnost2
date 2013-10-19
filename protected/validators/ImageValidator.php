<?php

class ImageValidator extends CFileValidator
{

    public $mimeType;
    public $tooLarge = '';
    public $idiotic = '';
    public $noFile = '';
    public $required = FALSE;

    protected function validateAttribute($object, $attribute)
    {
        $file = $object->$attribute;

        switch ($file['error']['file'])
        {
            case UPLOAD_ERR_OK:
                if (isset($this->mimeType))
                {
                    $mime = is_scalar($this->mimeType) ? array($this->mimeType) : $this->mimeType;

                    if (!in_array($file['type']['file'], $mime))
                    {
                        $this->addError($object, $attribute, t('Photo type is not supported. Allowed types are: jpg, png.'));
                    }
                }
                break;
            case UPLOAD_ERR_INI_SIZE:
                $this->addError($object, $attribute, $this->tooLarge == '' ? t('The maximum file size is 2MB.') : $this->tooLarge);
                break;
            case UPLOAD_ERR_NO_FILE:
                $this->addError($object, $attribute, $this->noFile == '' ? t('No file selected.') : $this->noFile);
                break;
            default:
                $this->addError($object, $attribute, $this->idiotic == '' ? t('Something went wrong. Please try again.') : $this->idiotic);
                break;
        }
    }

}

?>
