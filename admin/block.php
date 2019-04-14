<?php
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';

if (isset($_REQUEST['op'])) {
    $op = $_REQUEST['op'];
} else {
    redirect_header('index.php', 1, _NOPERM);
    exit;
}

$pageblockHandler = xoops_getModuleHandler('pageblock');

switch ($op) {
    case 'save':

        if (!isset($_POST['ebsn'])) {
            $block = $pageblockHandler->create();
        } elseif (!$block = $pageblockHandler->get($_POST['ebsn'])) {
            $block = $pageblockHandler->create();
        }
        $block->setVar('ebsn', $_POST['ebsn']);
        $block->setVar('blockid', $_POST['blockid']);
        $block->setVar('title', $_POST['title']);
        $block->setVar('width', $_POST['width']);
        $block->setVar('height', $_POST['height']);
        $block->setVar('border', $_POST['border']);
        $block->setVar('note', $_POST['note']);
        $uid = $xoopsUser->uid();
        $block->setVar('uid', 1);
        $time = date('Y-m-d H:i:s', xoops_getUserTimestamp(time()));
        $block->setVar('update_date', $time);

        if (isset($_POST['options']) && (count($_POST['options']) > 0)) {
            $options = $_POST['options'];
            $count = count($options);
            for ($i = 0; $i < $count; $i++) {
                if (is_array($options[$i])) {
                    $options[$i] = implode(',', $options[$i]);
                }
            }
            $block->setVar('options', implode('|', $options));
        } else {
            $block->setVar('options', '');
        }

        if ($pageblockHandler->insert($block)) {
            redirect_header('index.php?ebsn=' . $block->getVar('ebsn'), 1, _MA_TADEMBED_SUCCESS);
            exit;
        }
        break;
    case 'new':
    case 'edit':

        if ('new' === $op) {
            $block = $pageblockHandler->create();
            $block->setVar('blockid', $_POST['blockid']);
            $block->setVar('width', '100%');
            $block->setVar('height', '350px');
            $block->setVar('update_date', time());
            $block->setBlock($_POST['blockid']);
        } else {
            $block = $pageblockHandler->get($_REQUEST['ebsn']);
            $block->setBlock();
        }

        $form = $block->getForm();
        $main = $form->render();

        break;
    case 'delete':
        $obj = $pageblockHandler->get($_REQUEST['ebsn']);
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if ($pageblockHandler->delete($obj)) {
                redirect_header('index.php?ebsn=' . $obj->getVar('ebsn'), 3, sprintf(_MA_TADEMBED_DELETEDSUCCESS, $obj->getVar('title')));
            } else {
                xoops_cp_header();
                $main = implode('<br>', $obj->getErrors());
                xoops_cp_footer();
            }
        } else {
            xoops_cp_header();
            xoops_confirm(['ok' => 1, 'ebsn' => $_REQUEST['ebsn'], 'op' => 'delete'], 'block.php', sprintf(_MA_TADEMBED_RUSUREDEL, $obj->getVar('title')));
            xoops_cp_footer();
        }
        break;
}

require_once __DIR__ . '/footer.php';
