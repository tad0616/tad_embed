<?php
//判斷是否對該模組有管理權限
if (!isset($_SESSION['tad_embed_adm'])) {
    $_SESSION['tad_embed_adm'] = ($xoopsUser) ? $xoopsUser->isAdmin() : false;
}

$interface_menu[_MD_TAD_EMBED_LIST] = 'index.php';
$interface_icon[_MD_TAD_EMBED_LIST] = "fa-cubes";

if ($_SESSION['tad_embed_adm'] or $_SERVER['PHP_SELF'] == '/admin.php') {
    $interface_menu[_MD_TAD_EMBED_FORM] = 'add.php';
    $interface_icon[_MD_TAD_EMBED_FORM] = "fa-plus-circle";
}
