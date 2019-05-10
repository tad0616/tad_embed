<?php
$modversion = [];

//---模組基本資訊---//
$modversion['name'] = _MI_TADEMBED_NAME;
$modversion['version'] = 2.33;
$modversion['description'] = _MI_TADEMBED_DESC;
$modversion['author'] = _MI_TADEMBED_AUTHOR;
$modversion['credits'] = _MI_TADEMBED_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['image'] = 'images/logo.png';
$modversion['dirname'] = basename(__DIR__);

//---模組狀態資訊---//
$modversion['release_date'] = '2019-05-10';
$modversion['module_website_url'] = 'https://tad0616.net/';
$modversion['module_website_name'] = _MI_TADEMBED_AUTHOR_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'https://tad0616.net/';
$modversion['author_website_name'] = _MI_TADEMBED_AUTHOR_WEB;
$modversion['min_php'] = 5.4;
$modversion['min_xoops'] = '2.5';
$modversion['min_tadtools'] = '1.20';

//---paypal資訊---//
$modversion['paypal'] = [];
$modversion['paypal']['business'] = 'tad0616@gmail.com';
$modversion['paypal']['item_name'] = 'Donation : ' . _MI_TAD_WEB;
$modversion['paypal']['amount'] = 0;
$modversion['paypal']['currency_code'] = 'USD';

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1;

//---資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][1] = 'tad_embed';

//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

//---使用者主選單設定---//
$modversion['hasMain'] = 1;

//---樣板設定---//

$modversion['templates'][1]['file'] = 'tad_embed_index_tpl.html';
$modversion['templates'][1]['description'] = _MI_TADEMBED_TEMPLATE_DESC1;
$modversion['templates'][2]['file'] = 'tad_embed_demo_tpl.html';
$modversion['templates'][2]['description'] = _MI_TADEMBED_TEMPLATE_DESC2;

//---樣板設定---//
$modversion['templates'] = [];
$i = 1;
$modversion['templates'][$i]['file'] = 'tad_embed_adm_main.tpl';
$modversion['templates'][$i]['description'] = 'tad_embed_adm_main.tpl';
$i++;
$modversion['templates'][$i]['file'] = 'tad_embed_index.tpl';
$modversion['templates'][$i]['description'] = 'tad_embed_index.tpl';
$i++;
$modversion['templates'][$i]['file'] = 'tad_embed_demo.tpl';
$modversion['templates'][$i]['description'] = 'tad_embed_demo.tpl';
$i++;
$modversion['templates'][$i]['file'] = 'tad_embed_page.tpl';
$modversion['templates'][$i]['description'] = 'tad_embed_page.tpl';

//---區塊設定---//
// $modversion['blocks'][1]['file']        = "tad_embed_demo.php";
// $modversion['blocks'][1]['name']        = _MI_TADEMBED_BNAME1;
// $modversion['blocks'][1]['description'] = _MI_TADEMBED_BDESC1;
// $modversion['blocks'][1]['show_func']   = "tad_embed_demo";
// $modversion['blocks'][1]['template']    = "tad_embed_demo.html";
