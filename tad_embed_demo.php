<?php
use Xmf\Request;
use XoopsModules\Tadtools\Utility;

/*-----------引入檔案區--------------*/
require_once __DIR__ . '/header.php';
$url = parse_url(\Xmf\Request::getString('HTTP_REFERER', '', 'SERVER'));
header("X-Frame-Options: ALLOW-FROM {$url['scheme']}://{$url['host']}/*");
$xoopsConfig['theme_set'] = 'blank_theme';
$GLOBALS['xoopsOption']['template_main'] = 'tad_embed_demo.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

/*-----------秀出結果區--------------*/
$op = Request::getString('op');
$ebsn = Request::getInt('ebsn');
// 關閉除錯訊息
header('HTTP/1.1 200 OK');
$xoopsLogger->activated = false;

$block = blockShow($ebsn);

$width_smarty = empty($embed['width']) ? '' : "width: {$embed['width']};";
$height_smarty = '';
$border_smarty = empty($embed['border']) ? '' : "border: {$embed['border']}px solid gray;";

$xoopsTpl->assign('width', $width_smarty);
$xoopsTpl->assign('height', $height_smarty);
$xoopsTpl->assign('border', $border_smarty);
$xoopsTpl->assign('content', $block);
require_once XOOPS_ROOT_PATH . '/footer.php';

/*-----------function區--------------*/

function blockShow($ebsn)
{
    global $xoopsDB;
    $bb = get_tad_embed($ebsn);
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('newblocks') . '` WHERE `bid` =?';
    $result = Utility::query($sql, 'i', [$bb['blockid']]) or Utility::web_error($sql, __FILE__, __LINE__);

    require_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';
    require_once XOOPS_ROOT_PATH . '/class/template.php';
    $row = $xoopsDB->fetchArray($result);
    $row['options'] = $bb['options'];
    $row['title'] = $bb['title'];

    $XoopsBlock = new \XoopsBlock($row);
    $template = new \XoopsTpl();

    $template->caching = 0;
    $tplName = ($tplName = $XoopsBlock->getVar('template')) ? "db:$tplName" : 'db:system_block_dummy.tpl';

    $cacheid = 'blk_' . $ebsn . '_' . md5($_SERVER['REQUEST_URI']);

    $block = '<base target="_blank">';
    if (!$template->is_cached($tplName, $cacheid)) {
        //$xoopsLogger->addBlock( $XoopsBlock->getVar('title') );
        if (!($bresult = $XoopsBlock->buildBlock())) {
            return false;
        }
        $template->assign('block', $bresult);
        $block .= $template->fetch($tplName, $cacheid);
    } else {
        //$xoopsLogger->addBlock($XoopsBlock->getVar('name'), true, 0);
        $block .= $template->fetch($tplName, $cacheid);
    }

    $now = date('Y-m-d H:i:s', xoops_getUserTimestamp(time()));
    $sql = 'UPDATE `' . $xoopsDB->prefix('tad_embed') . '` SET `update_date` = ?, `http_referer`= ?, `counter` = `counter` + 1 WHERE `ebsn` = ?';
    Utility::query($sql, 'ssi', [$now, Request::getString('HTTP_REFERER', '', 'SERVER'), $ebsn]);

    //$block=$template->display($tplName);
    return $block;
}
