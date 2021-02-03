<?php

function redirect_to($location)
{
    if (!headers_sent()) {
        header('Location: ' . $location);
        die();
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="' . $location . '";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
        echo '</noscript>';
    }
}
