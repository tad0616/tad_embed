<?php
$modversion = [];
global $xoopsConfig;

//---模組基本資訊---//
$modversion['name'] = _MI_TADEMBED_NAME;
// $modversion['version'] = 2.7;
$modversion['version'] = $_SESSION['xoops_version'] >= 20511 ? '3.0.0-Stable' : '3.0';
$modversion['description'] = _MI_TADEMBED_DESC;
$modversion['author'] = _MI_TADEMBED_AUTHOR;
$modversion['credits'] = _MI_TADEMBED_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['image'] = 'images/logo.png';
$modversion['dirname'] = basename(__DIR__);

//---模組狀態資訊---//
$modversion['release_date'] = '2022-10-24';
$modversion['module_website_url'] = 'https://tad0616.net/';
$modversion['module_website_name'] = _MI_TADEMBED_AUTHOR_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'https://tad0616.net/';
$modversion['author_website_name'] = _MI_TADEMBED_AUTHOR_WEB;
$modversion['min_php'] = 5.5;
$modversion['min_xoops'] = '2.5';
$modversion['min_tadtools'] = '1.20';

//---paypal資訊---//
$modversion['paypal'] = [
    'business' => 'tad0616@gmail.com',
    'item_name' => 'Donation : ' . _MI_TAD_WEB,
    'amount' => 0,
    'currency_code' => 'USD',
];

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1;

//---資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'] = ['tad_embed'];

//---管理介面設定---//
$modversion['hasAdmin'] = 0;

//---使用者主選單設定---//
$modversion['hasMain'] = 1;

//---樣板設定---//
$modversion['templates'] = [
    ['file' => 'tad_embed_index.tpl', 'description' => 'tad_embed_index.tpl'],
    ['file' => 'tad_embed_demo.tpl', 'description' => 'tad_embed_demo.tpl'],
];
