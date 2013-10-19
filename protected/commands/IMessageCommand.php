<?php

Yii::import('system.cli.commands.MessageCommand');

class IMessageCommand extends MessageCommand
{

    protected function extractMessages2($fileName, $translator)
    {
        echo "Extracting messages from $fileName...\n";
        $subjects = file($fileName);
        for ($i = 0; $i < count($subjects); $i++) {
            $subject = $subjects[$i];
            $n = preg_match_all('/\b' . $translator . '\s*\(\s*(\'.*?(?<!\\\\)\'|".*?(?<!\\\\)")\s*(,\s*array\([^)]*\),\s*(\'.*?(?<!\\\\)\'|".*?(?<!\\\\)"))?\s*[,\)]/s', $subject, $matches, PREG_SET_ORDER);
            $messages = array();

            for ($i = 0; $i < $n; ++$i) {
                $message = $matches[$i][1];
                if ($message == '1' || $message == '\'1\'') {
                    var_dump($i, $subject);
                    throw new Exception;
                }
                if (isset($matches[$i][3])) {
                    $messages[trim($matches[$i][3], '\'\"')][] = eval("return $message;");
                } else {
                    $messages['all'][] = eval("return $message;");  // use eval to eliminate quote escape
                }
            }
        }
        return $messages;
    }

    protected function extractMessages($fileName, $translator)
    {
        echo "Extracting messages from $fileName...\n";
        $subject = file_get_contents($fileName);
        $n = preg_match_all('/\b' . $translator . '\s*\(\s*(\'.*?(?<!\\\\)\'|".*?(?<!\\\\)")\s*(,\s*array\([^\)]*\),\s*(\'.*?(?<!\\\\)\'|".*?(?<!\\\\)"))?\s*[,\)]/s', $subject, $matches, PREG_SET_ORDER);
        $messages = array();
        for ($i = 0; $i < $n; ++$i) {
            $message = $matches[$i][1];
            if ($message == '1' || $message == '\'1\'') {
                var_dump($message);
                throw new Exception;
            }
            if (isset($matches[$i][3]) && strlen($matches[$i][3]) < 15) {
                $messages[trim($matches[$i][3], '\'\"')][] = eval("return $message;");
            } else {
                $messages['slicnost'][] = eval("return $message;");  // use eval to eliminate quote escape
            }
        }
        return $messages;
    }

    protected function originalExtractMessages($fileName, $translator)
    {
        echo "Extracting messages from $fileName...\n";
        $subject = file_get_contents($fileName);
        $n = preg_match_all('/\b' . $translator . '\s*\(\s*(\'.*?(?<!\\\\)\'|".*?(?<!\\\\)")\s*,\s*(\'.*?(?<!\\\\)\'|".*?(?<!\\\\)")\s*[,\)]/s', $subject, $matches, PREG_SET_ORDER);
        $messages = array();
        for ($i = 0; $i < $n; ++$i) {
            if (($pos = strpos($matches[$i][1], '.')) !== false) {
                $category = substr($matches[$i][1], $pos + 1, -1);
            } else {
                $category=substr($matches[$i][1], 1, -1);
            }
            $message = $matches[$i][2];
            $messages[$category][] = eval("return $message;");  // use eval to eliminate quote escape
        }
        return $messages;
    }

    protected function generateMessageFile($messages, $fileName, $overwrite)
    {
        echo "Saving messages to $fileName...";
        if (is_file($fileName)) {
            $translated=require($fileName);
            sort($messages);
            ksort($translated);
            if (array_keys($translated)==$messages) {
                echo "nothing new...skipped.\n";
                return;
            }
            $merged=array();
            $untranslated=array();
            foreach ($messages as $message) {
                if (!empty($translated[$message])) {
                    $merged[$message]=$translated[$message];
                } else {
                    $untranslated[]=$message;
                }
            }
            ksort($merged);
            sort($untranslated);
            $todo=array();
            foreach ($untranslated as $message) {
                $todo[$message]='';
            }
            ksort($translated);
            foreach ($translated as $message => $translation) {
                if (!isset($merged[$message]) && !isset($todo[$message])) {
                    $todo[$message]='@@'.$translation.'@@';
                }
            }
            $merged=array_merge($todo, $merged);
            if ($overwrite === false) {
                $fileName.='.merged';
            }
            echo "translation merged.\n";
        } else {
            $merged=array();
            foreach ($messages as $message) {
                $merged[$message]='';
            }
            ksort($merged);
            echo "saved.\n";
        }
        $array=str_replace("\r", '', var_export($merged, true));
        $content=<<<EOD
<?php
return $array;

EOD;
        file_put_contents($fileName, $content);
    }
}
