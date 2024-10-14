<?php
use Xmf\Request;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
require_once __DIR__ . '/header.php';
$url = parse_url(\Xmf\Request::getString('HTTP_REFERER', '', 'SERVER'));
header("X-Frame-Options: ALLOW-FROM {$url['scheme']}://{$url['host']}/*");
$GLOBALS['xoopsOption']['template_main'] = 'tad_embed_index.tpl';

require_once XOOPS_ROOT_PATH . '/header.php';

/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$ebsn = Request::getInt('ebsn');

switch ($op) {
    default:
        show_tad_embed($ebsn);
        $op = 'show_tad_embed';
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('now_op', $op);
$xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu, false, $interface_icon));
require_once XOOPS_ROOT_PATH . '/footer.php';

/*-----------function區--------------*/
function show_tad_embed($ebsn)
{
    global $xoopsTpl;

    if (empty($ebsn)) {
        return;
    }

    $embed = get_tad_embed($ebsn);
    $xoopsTpl->assign('embed', $embed);

    $width_smarty = empty($embed['width']) ? '' : "width: {$embed['width']};";
    $height_smarty = empty($embed['height']) ? '' : "height: {$embed['height']};";
    $border_smarty = empty($embed['border']) ? 'border:none;' : "border: {$embed['border']}px solid gray;";

    $xoopsTpl->assign('width_smarty', $width_smarty);
    $xoopsTpl->assign('height_smarty', $height_smarty);
    $xoopsTpl->assign('border_smarty', $border_smarty);

}
