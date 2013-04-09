<?php
extension_check();
function extension_check() {
    $fail = '';
    $pass = '';
    
    if(version_compare(phpversion(), '5.2.0', '<')) {
        $fail .= '<li>You need<strong> PHP 5.2.0</strong> (or greater)</li>';
    }
    else {
        $pass .='<li>You have<strong> PHP 5.2.0</strong> (or greater)</li>';
    }

    if(!ini_get('safe_mode')) {
        $pass .='<li>Safe Mode is <strong>off</strong></li>';
        $ver = mysql_get_server_info();
        $version = explode('-', $ver);
        //preg_match('/[0-9]\.[0-9]+\.[0-9]+/', shell_exec('mysql -V'), $version);
        //$fail .= '<li>'.shell_exec('mysql --help').print_r($version, true).'</li>';
        if(version_compare($version[0], '4.1.20', '<')) {
            $fail .= '<li>You need<strong> MySQL 4.1.20</strong> (or greater)</li>';
        }
        else {
            $pass .='<li>You have<strong> MySQL 4.1.20</strong> (or greater)</li>';
        }
    }
    else { $fail .= '<li>Safe Mode is <strong>on</strong></li>';  }

    
    if($fail) {
        echo '<p><strong>Your server does not meet the following requirements in order to install Coravity CMS.</strong>';
        echo '<br>The following requirements failed, please contact your hosting provider in order to receive assistance with meeting the system requirements for Coravity CMS:';
        echo '<ul>'.$fail.'</ul></p>';
        echo 'The following requirements were successfully met:';
        echo '<ul>'.$pass.'</ul>';
        $btn='<input type="submit" value="Continue" class="button disable" disabled/>';
        echo getform($btn);
    } else {
        echo '<p><strong>Congratulations!</strong> Your server meets the requirements for Coravity CMS.</p>';
        echo '<ul>'.$pass.'</ul>';
        $btn='<input type="submit" value="Continue" class="button">';
        echo getform($btn);

    }
}

function getform($btn){
    return '
            <form action="?id=DBCONFIG">
            <input type="hidden" name="nav_id" value="2"'.uniqid().'>
            <input type="hidden" name="cms_installation" value="'.uniqid().'">
            <input type="hidden" name="install_id" value="'.uniqid().'">
            '.$btn.'
            </form> ';
}

?>
