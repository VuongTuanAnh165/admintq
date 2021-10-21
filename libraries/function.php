<?php
    //debug
    function _debug($data)
    {
        echo '<pre style="background: #000; color: #fff; width:100%; overflow: auto">';
        echo '<div>Your IP: ' .$_SERVER["REMOTE_ADDR"] .'</div>';

        $debug_backtrace = debug_backtrace();
        $debug = array_shift($debug_backtrace);

        echo '<div>File: ' .$debug["file"] . '</div>';
        echo '<div>Line: ' .$debug["line"] . '</div>';

        if(is_array($data) || is_object($data))
        {
            print_r($data);
        }
        else
        {
            var_dump($data);
        }
        echo '</pre>';
    }

    //get input
    function getInput($string)
    {
        return isset($_GET[$string]) ? $_GET[$string] : '';
    }


    //post input
    function postInput($string)
    {
        return isset($_POST[$string]) ? $_POST[$string] : '';
    }

    function base_url()
    {
        return $url = "http://adminas.com/";
    }
    /*function base_url()
    {
        return $url = "http://laptopvta.xyz/";
    }*/

    function modules($url)
    {
        return base_url() . "admin/modules/" .$url;
    }

    if(!function_exists('redirectAdmin'))
    {
        function redirectAdmin($url = "")
        {
            header("location: ".base_url()."pages/{$url}");
            exit();
        }
    }

    if(!function_exists('redirectFontend'))
    {
        function redirectFontend($url = "")
        {
            header("location: ".base_url()."{$url}");
            exit();
        }
    }
    function formatDate($date)
    {
        return date('F j, Y, g:i a', strtotime($date));
    }
    //Hàm đổi từ số INT sang tiền VND
    function currency_format($number) 
    {
        if (!empty($number)) 
        {
            return number_format($number, 0, ',', '.');
        }
    }
?>