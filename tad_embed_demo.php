<?php
use Xmf\Request;
use XoopsModules\Tadtools\Utility;

/*-----------引入檔案區--------------*/
require_once __DIR__ . '/header.php';
$url = parse_url(\Xmf\Request::getString('HTTP_REFERER', '', 'SERVER'));
// die(var_dump($url));
header("X-Frame-Options: ALLOW-FROM {$url['scheme']}://{$url['host']}/*");
$GLOBALS['xoopsOption']['template_main'] = 'tad_embed_demo.tpl';
$xoopsConfig['theme_set'] = 'blank_theme';
require_once XOOPS_ROOT_PATH . '/header.php';
/*-----------function區--------------*/

$op = Request::getString('op');
$ebsn = Request::getInt('ebsn');

//$embed=get_tad_embed($ebsn);

$block = blockShow($ebsn);

$width_smarty = empty($embed['width']) ? '' : "width: {$embed['width']};";
$height_smarty = '';
$border_smarty = empty($embed['border']) ? '' : "border: {$embed['border']}px solid gray;";

function blockShow($ebsn)
{
    global $xoopsDB;
    $bb = get_tad_embed($ebsn);
    $sql = 'select * from `' . $xoopsDB->prefix('newblocks') . "` where `bid` = '{$bb['blockid']}'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

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
    $sql = 'update `' . $xoopsDB->prefix('tad_embed') . "` set `update_date` = '{$now}' , `http_referer`= '{\Xmf\Request::getString('HTTP_REFERER', '', 'SERVER')}', `counter` = `counter` +1	 where `ebsn` = '{$ebsn}'";
    $xoopsDB->queryF($sql);

    //$block=$template->display($tplName);
    return $block;
}
/*-----------秀出結果區--------------*/
$xoopsTpl->assign('width', $width_smarty);
$xoopsTpl->assign('height', $height_smarty);
$xoopsTpl->assign('border', $border_smarty);
$xoopsTpl->assign('content', $block);
require_once XOOPS_ROOT_PATH . '/footer.php';
