<?php
use Xmf\Request;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\SyntaxHighlighter;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
require_once __DIR__ . '/header.php';
$url = parse_url(\Xmf\Request::getString('HTTP_REFERER', '', 'SERVER'));
header("X-Frame-Options: ALLOW-FROM {$url['scheme']}://{$url['host']}/*");
$GLOBALS['xoopsOption']['template_main'] = 'tad_embed_page.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

/*-----------function區--------------*/
function show_tad_embed($ebsn)
{
    global $xoopsTpl;

    if (empty($ebsn)) {
        return;
    }

    $embed = get_tad_embed($ebsn);
    $xoopsTpl->assign('embed', $embed);

}

/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$ebsn = Request::getInt('ebsn');

switch ($op) {
    default:
    show_tad_embed($ebsn);
        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu));
require_once XOOPS_ROOT_PATH . '/footer.php';
