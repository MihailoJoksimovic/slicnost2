<?php

class NumberValidator extends CNumberValidator
{
    const MAX_INT_VALUE = 2147483647;
    const MAX_BIG_INT_VALUE = 9223372036854775808;
    const MAX_DOUBLE_VALUE = 9223372036854775808;

    protected function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;
        if ($this->allowEmpty && $this->isEmpty($value))
            return;
        if ($this->integerOnly)
        {
            if (!preg_match($this->integerPattern, "$value"))
            {
                $message = $this->message !== null ? $this->message : t('{attribute} must be expressed in numbers.');
                $this->addError($object, $attribute, $message);
            }
            else if($value > self::MAX_INT_VALUE)
            {
                $message = $this->message !== null ? $this->message : t('{attribute} is too big.');
                $this->addError($object, $attribute, $message);
            }
        }
        else
        {
            if (!preg_match($this->numberPattern, "$value"))
            {
                $message = $this->message !== null ? $this->message : t('{attribute} must be expressed in numbers.');
                $this->addError($object, $attribute, $message);
            }
            else if($value > self::MAX_DOUBLE_VALUE)
            {
                $message = $this->message !== null ? $this->message : t('{attribute} is too big.');
                $this->addError($object, $attribute, $message);
            }
        }

        //added
        if (($this->min !== null && $value < $this->min) || ($this->max !== null && $value > $this->max))
        {
            $message = t('{attribute} must be expressed in numbers between {min} and {max}.');
            $this->addError($object, $attribute, $message, array('{min}' => $this->min, '{max}' => $this->max));
        }
        else
        {
            if ($this->min !== null && $value < $this->min)
            {
                $message = $this->tooSmall !== null ? $this->tooSmall : t('{attribute} must be larger than {min}.');
                $this->addError($object, $attribute, $message, array('{min}' => $this->min));
            }
            if ($this->max !== null && $value > $this->max)
            {
                $message = $this->tooBig !== null ? $this->tooBig : t('{attribute} must be smaller than {max}.');
                $this->addError($object, $attribute, $message, array('{max}' => $this->max));
            }
        }
    }

    public function clientValidateAttribute($object, $attribute)
    {
        $label = $object->getAttributeLabel($attribute);

        if (($message = $this->message) === null)
            $message = $this->integerOnly ? t('{attribute} must be a whole number.') : t('{attribute} must be a number.');
        $message = strtr($message, array(
                    '{attribute}' => $label,
                ));

        if (($tooBig = $this->tooBig) === null)
            $tooBig = t('{attribute} must be smaller than {max}.');
        $tooBig = strtr($tooBig, array(
                    '{attribute}' => $label,
                    '{max}' => $this->max,
                ));

        if (($tooSmall = $this->tooSmall) === null)
            $tooSmall = t('{attribute} must be larger than {min}.');
        $tooSmall = strtr($tooSmall, array(
                    '{attribute}' => $label,
                    '{min}' => $this->min,
                ));

        $pattern = $this->integerOnly ? $this->integerPattern : $this->numberPattern;
        $js = "
                if(!value.match($pattern)) {
                messages.push(" . CJSON::encode($message) . ");
                }
                ";
        if ($this->min !== null)
        {
            $js.="
                    if(value<{$this->min}) {
                    messages.push(" . CJSON::encode($tooSmall) . ");
                    }
                    ";
        }
        if ($this->max !== null)
        {
            $js.="
                if(value>{$this->max}) {
                messages.push(" . CJSON::encode($tooBig) . ");
                }
                ";
        }

        if ($this->allowEmpty)
        {
            $js = "
                if($.trim(value)!='') {
                $js
                }
                ";
        }

        return $js;
    }

}