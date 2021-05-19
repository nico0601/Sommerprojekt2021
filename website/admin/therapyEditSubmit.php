<?php
function var_dump_pre($mixed = null)
{
    echo '<pre>';
    echo htmlspecialchars(var_dump_ret($mixed));
    echo '</pre>';
    return null;
}

function var_dump_ret($mixed = null)
{
    ob_start();
    var_dump($mixed);
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

var_dump_pre($_POST);