<?php
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\SyntaxHighlighter;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
require_once __DIR__ . '/header.php';
$xoopsOption['template_main'] = 'tad_embed_index.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

/*-----------function區--------------*/
function list_tad_embed($ebsn)
{
    global $isAdmin, $xoopsDB, $xoopsTpl;

    $sql = 'SELECT `ebsn`, `title` FROM `' . $xoopsDB->prefix('tad_embed') . '` ';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        $menu[] = $all;
    }
    $xoopsTpl->assign('menu', $menu);

    $xoopsTpl->assign('ebsn', $ebsn);

    if (empty($ebsn)) {
        return;
    }

    $embed = get_tad_embed($ebsn);

    $width_smarty = empty($embed['width']) ? '' : "width: {$embed['width']};";
    $height_smarty = empty($embed['height']) ? '' : "height: {$embed['height']};";
    $border_smarty = empty($embed['border']) ? 'border:none;' : "border: {$embed['border']}px solid gray;";

    //高亮度語法

    $SyntaxHighlighter = new SyntaxHighlighter();
    $SyntaxHighlighter->render();

    $xoopsTpl->assign('width_smarty', $width_smarty);
    $xoopsTpl->assign('height_smarty', $height_smarty);
    $xoopsTpl->assign('border_smarty', $border_smarty);
    $xoopsTpl->assign('embed', $embed);

    if ($isAdmin) {
        $SweetAlert = new SweetAlert();
        $SweetAlert->render('delete_tad_embed_func', 'admin/main.php?op=delete_tad_embed&ebsn=', 'ebsn');
    }
}

/*-----------執行動作判斷區----------*/
$op = empty($_REQUEST['op']) ? '' : $_REQUEST['op'];
$ebsn = empty($_REQUEST['ebsn']) ? '' : (int)$_REQUEST['ebsn'];

switch ($op) {
    default:
        list_tad_embed($ebsn);
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu));
$xoopsTpl->assign('isAdmin', $isAdmin);

require_once XOOPS_ROOT_PATH . '/footer.php';
