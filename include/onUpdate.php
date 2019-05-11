<?php

use XoopsModules\Tad_embed\Update;

if (!class_exists('XoopsModules\Tad_embed\Update')) {
    include dirname(__DIR__) . '/preloads/autoloader.php';
}
function xoops_module_update_tad_embed(&$module, $old_version)
{
    global $xoopsDB;

    // if (Update::chk_chk1()) {
    //     Update::go_update1();
    // }

    return true;
}
