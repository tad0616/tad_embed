<?php

use XoopsModules\Tadtools\Utility;

if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}

function xoops_module_install_tad_embed(&$module)
{
    // if (Utility::chk_chk1()) {
    //     Utility::go_update1();
    // }

    return true;
}
