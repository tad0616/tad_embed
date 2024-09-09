<?php
use XoopsModules\Tadtools\Utility;
xoops_loadLanguage('main', 'tadtools');

/********************* 自訂函數 ********************
 * @param string $ebsn
 * @return array|false|void
 */

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
