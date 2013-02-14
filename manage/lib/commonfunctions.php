<?php
/*Function to find out time in appropriate way*/

function plural($num) {
    if ($num != 1)
        return "s";
}

function calcreltime($date) {
    $diff = time() - ($date);
    if ($diff<60)
        return $diff . " second" . plural($diff) . " ago";
    $diff = round($diff/60);
    if ($diff<60)
        return $diff . " minute" . plural($diff) . " ago";
    $diff = round($diff/60);
    if ($diff<24)
        return $diff . " hour" . plural($diff) . " ago";
    $diff = round($diff/24);
    if ($diff<7)
        return $diff . " day" . plural($diff) . " ago";
    $diff = round($diff/7);
    if ($diff<4)
        return $diff . " week" . plural($diff) . " ago";
    return  "on " . date("F j, Y", ($date));
}

function getRelativeTime($ts){
    return "<span class='timeautoupdate' timestamp='".$ts."' title='".date("l, M d, Y", $ts)." at ".date("h:i A", $ts)."'>".calcreltime($ts)."</span>";
}
function validatemail($email){
          $isValid = true;
        $atIndex = strrpos($email, "@");
        if (is_bool($atIndex) && !$atIndex)
        {
        $isValid = false;
        }
        else
        {
        $domain = substr($email, $atIndex+1);
        $local = substr($email, 0, $atIndex);
        $localLen = strlen($local);
        $domainLen = strlen($domain);
        if ($localLen < 1 || $localLen > 64)
        {
        $isValid = false;
        }
        else if ($domainLen < 1 || $domainLen > 255)
        {
        $isValid = false;
        }
        else if ($local[0] == '.' || $local[$localLen-1] == '.')
        {
        $isValid = false;
        }
        else if (preg_match('/\\.\\./', $local))
        {
        $isValid = false;
        }
        else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
        {
        $isValid = false;
        }
        else if (preg_match('/\\.\\./', $domain))
        {
        $isValid = false;
        }
        else if
        (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
        str_replace("\\\\","",$local)))
        {
        if (!preg_match('/^"(\\\\"|[^"])+"$/',
        str_replace("\\\\","",$local)))
        {
        $isValid = false;
        }
        }
        if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
        {
        $isValid = false;
        }
        }
        return $isValid;
        }

?>
