<?php

use XoopsModules\Tad_embed\Utility;

function xoops_module_uninstall_tad_embed(&$module)
{
    global $xoopsDB;
    $date = date("Ymd");

    rename(XOOPS_ROOT_PATH . "/uploads/tad_embed", XOOPS_ROOT_PATH . "/uploads/tad_embed_bak_{$date}");

    return true;
}

