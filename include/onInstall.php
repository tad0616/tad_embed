<?php
function xoops_module_install_tad_embed(&$module)
{
    if (chk_chk1()) {
        go_update1();
    }

    return true;
}

//檢查某欄位是否存在
function chk_chk1()
{
    global $xoopsDB;
    $sql           = "select count(*) from " . $xoopsDB->prefix("tadtools_setup") . " where tt_theme='for_tad_embed_theme'";
    $result        = $xoopsDB->query($sql);
    list($counter) = $xoopsDB->fetchRow($result);
    if (empty($counter)) {
        return true;
    }

    return false;
}

//執行更新
function go_update1()
{
    global $xoopsDB;
    $sql = "INSERT INTO " . $xoopsDB->prefix("tadtools_setup") . " (`tt_theme`, `tt_use_bootstrap`, `tt_bootstrap_color`, `tt_theme_kind`) VALUES ('for_tad_embed_theme', '0',  'bootstrap3', 'html'),";
    $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL, 3, mysql_error());

    return true;
}

//建立目錄
function mk_dir($dir = "")
{
    //若無目錄名稱秀出警告訊息
    if (empty($dir)) {
        return;
    }

    //若目錄不存在的話建立目錄
    if (!is_dir($dir)) {
        umask(000);
        //若建立失敗秀出警告訊息
        mkdir($dir, 0777);
    }
}
