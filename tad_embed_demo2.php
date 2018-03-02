<?php
header('Access-Control-Allow-Origin: *');
/*-----------引入檔案區--------------*/
include_once "header.php";
$xoopsOption['template_main'] = "tad_embed_demo2.tpl";
$xoopsConfig['theme_set']     = "for_tad_embed_theme";
include_once XOOPS_ROOT_PATH . "/header.php";
/*-----------function區--------------*/
$ebsn = empty($_REQUEST['ebsn']) ? "" : (int)$_REQUEST['ebsn'];

$embed = get_tad_embed($ebsn);

$block = blockShow($ebsn);

$width_smarty  = empty($embed['width']) ? "" : "width: {$embed['width']};";
$height_smarty = "";
$border_smarty = empty($embed['border']) ? "" : "border: {$embed['border']}px solid gray;";

function blockShow($ebsn)
{
    global $xoopsDB;
    $bb     = get_tad_embed($ebsn);
    $sql    = "select * from `" . $xoopsDB->prefix("newblocks") . "` where `bid` = '{$bb['blockid']}'";
    $result = $xoopsDB->query($sql) or web_error($sql);

    include_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';
    include_once XOOPS_ROOT_PATH . '/class/template.php';
    $row            = $xoopsDB->fetchArray($result);
    $row['options'] = $bb['options'];
    $row['title']   = $bb['title'];

    $XoopsBlock = new XoopsBlock($row);
    $template   = new XoopsTpl();

    $template->caching = 0;
    $tplName           = ($tplName = $XoopsBlock->getVar('template')) ? "db:$tplName" : "db:system_block_dummy.html";

    $cacheid = 'blk_' . $ebsn . "_" . md5($_SERVER['REQUEST_URI']);

    $block = "<base target=\"_blank\" />";
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

    $now = date("Y-m-d H:i:s", xoops_getUserTimestamp(time()));
    $sql = "update `" . $xoopsDB->prefix("tad_embed") . "` set `update_date` = '{$now}' , `http_referer`= '{$_SERVER["HTTP_REFERER"]}', `counter` = `counter` +1	 where `ebsn` = '{$ebsn}'";
    $xoopsDB->queryF($sql);

    //$block=$template->display($tplName);
    return $block;
}
/*-----------秀出結果區--------------*/
$xoopsTpl->assign("width", $width_smarty);
$xoopsTpl->assign("height", $height_smarty);
$xoopsTpl->assign("border", $border_smarty);
$xoopsTpl->assign("content", $block);
include_once XOOPS_ROOT_PATH . '/footer.php';
