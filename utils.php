<?php
function alert($str){
    echo '<script type="text/javascript">',
    "alert('$str')",
    '</script>';
}

function consoleLog($str){
    echo '<script type="text/javascript">',
    "console.log('$str')",
    '</script>';
}
?>