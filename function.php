<?php
use XoopsModules\Tadtools\Utility;
xoops_loadLanguage('main', 'tadtools');

/********************* 自訂函數 *********************/

//以流水號取得某筆tad_embed資料
function get_tad_embed($ebsn = '')
{
    global $xoopsDB;
    if (empty($ebsn)) {
        return;
    }

    $sql = 'select * from `' . $xoopsDB->prefix('tad_embed') . "` where `ebsn` = '{$ebsn}'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $data = $xoopsDB->fetchArray($result);

    return $data;
}

/********************* 預設函數 *********************/
//圓角文字框
function div_3d($title = '', $main = '', $kind = 'raised', $style = '', $other = '')
{
    $main = "<table style='width:auto;{$style}'><tr><td>
	<div class='{$kind}'>
	<h1>$title</h1>
	$other
	<b class='b1'></b><b class='b2'></b><b class='b3'></b><b class='b4'></b>
	<div class='boxcontent'>
 	$main
	</div>
	<b class='b4b'></b><b class='b3b'></b><b class='b2b'></b><b class='b1b'></b>
	</div>
	</td></tr></table>";

    return $main;
}
