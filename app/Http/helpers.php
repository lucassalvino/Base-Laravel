<?php

    function urlExists($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($code == 200) {
            $status = true;
        } else {
            $status = false;
        }
        curl_close($ch);
        return $status;
    }

    function get_textarea_value( $textarea ) {
        $textarea = str_replace(array("\\r\\n", "\\R\\N"),"\n", $textarea);
        $textarea = str_replace("\\","", $textarea);
        return nl2br($textarea);
    }

    function existe($str = null) {
        if(isset($str) and $str != '') {
            return true;
        }
        return false;
    }

    function formataData($data, $formato = 'd-m-Y') {
        $date = date_create($data);
        return date_format($date, $formato);
    }  
?>