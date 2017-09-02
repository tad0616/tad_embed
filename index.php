<?php
/*-----------引入檔案區--------------*/
include_once "header.php";
$xoopsOption['template_main'] = "tad_embed_index.tpl";
include_once XOOPS_ROOT_PATH . "/header.php";

/*-----------function區--------------*/
function list_tad_embed($ebsn)
{
    global $isAdmin, $xoopsDB, $xoopsTpl;

    $sql = "SELECT `ebsn`, `title` FROM `" . $xoopsDB->prefix("tad_embed") . "` ";
    $result = $xoopsDB->query($sql) or web_error($sql);

    while ($all = $xoopsDB->fetchArray($result)) {
        $menu[] = $all;
    }
    $xoopsTpl->assign('menu', $menu);

    $xoopsTpl->assign('ebsn', $ebsn);

    if (empty($ebsn)) {
        return;
    }

    $embed = get_tad_embed($ebsn);

    $width_smarty  = empty($embed['width']) ? "" : "width: {$embed['width']};";
    $height_smarty = empty($embed['height']) ? "" : "height: {$embed['height']};";
    $border_smarty = empty($embed['border']) ? "border:none;" : "border: {$embed['border']}px solid gray;";

    //高亮度語法
    $syntaxhighlighter_code = "";
    if (file_exists(TADTOOLS_PATH . "/syntaxhighlighter.php")) {
        include_once TADTOOLS_PATH . "/syntaxhighlighter.php";
        $syntaxhighlighter      = new syntaxhighlighter();
        $syntaxhighlighter_code = $syntaxhighlighter->render();
    }

    $xoopsTpl->assign('width_smarty', $width_smarty);
    $xoopsTpl->assign('height_smarty', $height_smarty);
    $xoopsTpl->assign('border_smarty', $border_smarty);
    $xoopsTpl->assign('syntaxhighlighter_code', $syntaxhighlighter_code);
    $xoopsTpl->assign('embed', $embed);

    if ($isAdmin) {
        if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php")) {
            redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
        }
        include_once XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php";
        $sweet_alert = new sweet_alert();
        $sweet_alert->render("delete_tad_embed_func", "admin/main.php?op=delete_tad_embed&ebsn=", 'ebsn');
    }
}

/*-----------執行動作判斷區----------*/
$op   = empty($_REQUEST['op']) ? "" : $_REQUEST['op'];
$ebsn = empty($_REQUEST['ebsn']) ? "" : intval($_REQUEST['ebsn']);

switch ($op) {

    default:
        list_tad_embed($ebsn);
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign("toolbar", toolbar_bootstrap($interface_menu));
$xoopsTpl->assign("isAdmin", $isAdmin);

include_once XOOPS_ROOT_PATH . '/footer.php';
