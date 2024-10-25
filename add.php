<?php
use Xmf\Request;
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\Utility;

/*-----------引入檔案區--------------*/
require_once __DIR__ . '/header.php';
$xoopsOption['template_main'] = 'tad_embed_index.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

if (!$_SESSION['tad_embed_adm']) {
    redirect_header($_SERVER['PHP_SELF'], 3, _MD_TADEMBED_NO_PERMISSION);
}
/*-----------執行動作判斷區----------*/
$op = Request::getString('op');
$ebsn = Request::getInt('ebsn');

switch ($op) {

    //新增資料
    case 'insert_tad_embed':
        $ebsn = insert_tad_embed();
        header("location: index.php?ebsn=$ebsn");
        exit;

    //更新資料
    case 'update_tad_embed':
        update_tad_embed($ebsn);
        header("location: index.php?ebsn=$ebsn");
        exit;

    //更新資料
    case 'update_tad_embed_config':
        update_tad_embed_config($ebsn);
        header("location: index.php?ebsn=$ebsn");
        exit;

    //新增區塊
    case 'select_block':
        select_block();
        break;

    //設定區塊
    case 'tad_embed_form':
        tad_embed_form($ebsn);
        break;

    //刪除資料
    case 'delete_tad_embed':
        delete_tad_embed($ebsn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //預設動作
    default:
        list_all_tad_embed();
        $op = 'list_all_tad_embed';
        break;

}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('now_op', $op);
$xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu, false, $interface_icon));
$xoTheme->addStylesheet('modules/tadtools/css/my-input.css');
require_once XOOPS_ROOT_PATH . '/footer.php';

/*-----------function區--------------*/
//tad_embed編輯表單
function tad_embed_form($ebsn = '')
{
    global $xoopsDB, $xoopsUser, $xoopsTpl;
    require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
    require_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';
    //include_once(XOOPS_ROOT_PATH."/class/xoopseditor/xoopseditor.php");

    //抓取預設值
    if (!empty($ebsn)) {
        $DBV = get_tad_embed($ebsn);
    } else {
        $DBV = [];
    }

    //預設值設定

    //設定「ebsn」欄位預設值
    $ebsn = (!isset($DBV['ebsn'])) ? $ebsn : $DBV['ebsn'];
    $xoopsTpl->assign('ebsn', $ebsn);

    //設定「blockid」欄位預設值
    $blockid = (!isset($DBV['blockid'])) ? (int) $_REQUEST['blockid'] : $DBV['blockid'];
    $xoopsTpl->assign('blockid', $blockid);

    //設定「width」欄位預設值
    $width = (!isset($DBV['width'])) ? '100%' : $DBV['width'];
    $xoopsTpl->assign('width', $width);

    //設定「height」欄位預設值
    $height = (!isset($DBV['height'])) ? '800px' : $DBV['height'];
    $xoopsTpl->assign('height', $height);

    //設定「border」欄位預設值
    $border = (!isset($DBV['border'])) ? '' : $DBV['border'];
    $xoopsTpl->assign('border', $border);

    //設定「note」欄位預設值
    $note = (!isset($DBV['note'])) ? '' : $DBV['note'];
    $xoopsTpl->assign('note', $note);

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('newblocks') . '` WHERE `bid` = ?';
    $result = Utility::query($sql, 'i', [$blockid]) or Utility::web_error($sql, __FILE__, __LINE__);

    $row = $xoopsDB->fetchArray($result);

    //設定「title」欄位預設值
    $title = (!isset($DBV['title'])) ? $row['title'] : $DBV['title'];
    $xoopsTpl->assign('title', $title);

    //設定「options」欄位預設值
    $options = (!isset($DBV['options'])) ? $row['options'] : $DBV['options'];
    $xoopsTpl->assign('options', $options);

    //設定「scrolling」欄位預設值
    $scrolling = (!isset($DBV['scrolling'])) ? 'auto' : $DBV['scrolling'];
    $xoopsTpl->assign('scrolling', $scrolling);

    //設定「uid」欄位預設值
    $user_uid = ($xoopsUser) ? $xoopsUser->uid() : '';
    $uid = (!isset($DBV['uid'])) ? $user_uid : $DBV['uid'];
    $xoopsTpl->assign('user_uid', $uid);

    //設定「update_date」欄位預設值
    $update_date = (!isset($DBV['update_date'])) ? date('Y-m-d H:i:s') : $DBV['update_date'];
    $xoopsTpl->assign('update_date', $update_date);

    //設定「counter」欄位預設值
    $counter = (!isset($DBV['counter'])) ? null : $DBV['counter'];
    $xoopsTpl->assign('counter', $counter);

    $op = (empty($ebsn)) ? 'insert_tad_embed' : 'update_tad_embed';
    //$op="replace_tad_embed";
    $xoopsTpl->assign('op', $op);

    $FormValidator = new FormValidator('#myForm', true);
    $FormValidator->render();

    $row['options'] = $options;
    $row['title'] = $title;

    $Block = new \XoopsBlock($row);

    $options_form = $Block->getOptions();
    if ($options_form) {
        $XoopsFormLabel = new \XoopsFormLabel(_MD_TADEMBED_BLOCK_OPTIONS, $options_form);
        $options = $XoopsFormLabel->render();
    }

    $xoopsTpl->assign('options', $options);
}

//取得所有區塊
function get_block_id_opt($blockid = '')
{
    global $xoopsDB;

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('newblocks') . '` WHERE `visible`=1';
    $result = Utility::query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $option = '';

    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        //以下會產生這些變數： $ebsn , $blockid , $width , $height , $border , $note , $title , $uid , $update_date , $counter
        foreach ($all as $k => $v) {
            $$k = $v;
        }
        $selected = $blockid == $bid ? 'selected' : '';
        $option .= "<option value='$bid' $selected>$name</option>";
    }

    return $option;
}

//新增tad_embed計數器
function add_tad_embed_counter($ebsn = '')
{
    global $xoopsDB;
    $sql = 'UPDATE `' . $xoopsDB->prefix('tad_embed') . '` SET `counter` = `counter` + 1 WHERE `ebsn` = ?';
    Utility::query($sql, 'i', [$ebsn]) or Utility::web_error($sql, __FILE__, __LINE__);

}

//新增資料到tad_embed中
function insert_tad_embed()
{
    global $xoopsDB, $xoopsUser;

    //取得使用者編號
    $uid = ($xoopsUser) ? $xoopsUser->uid() : '';

    $border = (int) $_POST['border'];
    $blockid = (int) $_POST['blockid'];

    $scrolling = $_POST['scrolling'];
    $width = $_POST['width'];
    $title = $_POST['title'];
    $note = $_POST['note'];
    $height = $_POST['height'];

    $options = (isset($_POST['options']) && is_array($_POST['options'])) ? implode('|', $_POST['options']) : '';

    $now = date('Y-m-d H:i:s', xoops_getUserTimestamp(time()));
    $sql = 'INSERT INTO `' . $xoopsDB->prefix('tad_embed') . '`
    (`blockid`, `width`, `height`, `border`, `note`, `title`, `options`, `scrolling`, `uid`, `update_date`, `http_referer`, `counter`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)';
    Utility::query($sql, 'isssssssiss', [$blockid, $width, $height, $border, $note, $title, $options, $scrolling, $uid, $now, '']) or Utility::web_error($sql, __FILE__, __LINE__);

    //取得最後新增資料的流水編號
    $ebsn = $xoopsDB->getInsertId();

    return $ebsn;
}

//更新tad_embed某一筆資料
function update_tad_embed($ebsn = '')
{
    global $xoopsDB, $xoopsUser;

    //取得使用者編號
    $uid = ($xoopsUser) ? $xoopsUser->uid() : '';

    $border = (int) $_POST['border'];
    $blockid = (int) $_POST['blockid'];

    $scrolling = $_POST['scrolling'];
    $width = $_POST['width'];
    $height = $_POST['height'];

    $title = $_POST['title'];
    $note = $_POST['note'];
    $options = implode('|', $_POST['options']);

    $sql = 'UPDATE `' . $xoopsDB->prefix('tad_embed') . '` SET
    `blockid` = ?,
    `width` = ?,
    `height` = ?,
    `border` = ?,
    `note` = ?,
    `title` = ?,
    `options` = ?,
    `scrolling` = ?,
    `uid` = ?
    WHERE `ebsn` = ?';
    Utility::query($sql, 'isssssssii', [$blockid, $width, $height, $border, $note, $title, $options, $scrolling, $uid, $ebsn]) or Utility::web_error($sql, __FILE__, __LINE__);

    return $ebsn;
}

//更新tad_embed某一筆資料
function update_tad_embed_config($ebsn = '')
{
    global $xoopsDB;

    $border = (int) $_POST['border'];
    $blockid = (int) $_POST['blockid'];

    $scrolling = $_POST['scrolling'];
    $width = $_POST['width'];
    $height = $_POST['height'];

    $sql = 'UPDATE `' . $xoopsDB->prefix('tad_embed') . '` SET
    `blockid` = ?,
    `width` = ?,
    `height` = ?,
    `border` = ?,
    `scrolling` = ?
    WHERE `ebsn` = ?';
    Utility::query($sql, 'issssi', [$blockid, $width, $height, $border, $scrolling, $ebsn]) or Utility::web_error($sql, __FILE__, __LINE__);

    return $ebsn;
}

//列出所有tad_embed資料
function list_all_tad_embed()
{
    global $xoopsDB, $xoopsTpl;

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_embed') . '` ORDER BY update_date DESC';

    //Utility::getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = Utility::getPageBar($sql, 20, 10);
    $bar = $PageBar['bar'];
    $sql = $PageBar['sql'];
    $total = $PageBar['total'];

    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $all_content = [];
    $i = 0;
    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        //以下會產生這些變數： $ebsn , $blockid , $width , $height , $border , $note , $title , $uid , $update_date , $counter
        foreach ($all as $k => $v) {
            $$k = $v;
        }
        $all_content[$i] = $all;

        $border = (1 == $border) ? _YES : _NO;
        $uid_name = \XoopsUser::getUnameFromId($uid, 1);
        if (empty($uid_name)) {
            $uid_name = \XoopsUser::getUnameFromId($uid, 0);
        }
        $all_content[$i]['uid_name'] = $uid_name;
        $all_content[$i]['border'] = $border;
        $i++;
    }

    $xoopsTpl->assign('all_content', $all_content);
    $xoopsTpl->assign('total', $total);
    $xoopsTpl->assign('bar', $bar);

    $SweetAlert = new SweetAlert();
    $SweetAlert->render('delete_tad_embed_func', 'add.php?op=delete_tad_embed&ebsn=', 'ebsn');
}

//刪除tad_embed某筆資料資料
function delete_tad_embed($ebsn = '')
{
    global $xoopsDB;
    $sql = 'DELETE FROM `' . $xoopsDB->prefix('tad_embed') . '` WHERE `ebsn` = ?';
    Utility::query($sql, 'i', [$ebsn]) or Utility::web_error($sql, __FILE__, __LINE__);

}

function select_block()
{
    global $xoopsTpl;
    $pageblockHandler = \XoopsModules\Tad_embed\Helper::getInstance()->getHandler('PageBlock');
    $allblocks = $pageblockHandler->getAllBlocks();
    $allcustomblocks = $pageblockHandler->getAllCustomBlocks();
    $arr = $allblocks + $allcustomblocks;
    $xoopsTpl->assign('arr', $arr);
}
