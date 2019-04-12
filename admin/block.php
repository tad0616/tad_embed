<?php
include_once "header.php";
include_once "../function.php";

if (isset($_REQUEST['op'])) {
    $op = $_REQUEST['op'];
} else {
    redirect_header('index.php', 1, _NOPERM);
    exit;
}

$pageblock_handler = xoops_getModuleHandler('pageblock');

switch ($op) {
    case "save":

        if (!isset($_POST['ebsn'])) {
            $block = $pageblock_handler->create();
        } else if (!$block = $pageblock_handler->get($_POST['ebsn'])) {
            $block = $pageblock_handler->create();
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
        $time = date("Y-m-d H:i:s", xoops_getUserTimestamp(time()));
        $block->setVar('update_date', $time);

        if (isset($_POST['options']) && (count($_POST['options']) > 0)) {
            $options = $_POST['options'];
            $count   = count($options);
            for ($i = 0; $i < $count; $i++) {
                if (is_array($options[$i])) {
                    $options[$i] = implode(',', $options[$i]);
                }
            }
            $block->setVar('options', implode('|', $options));
        } else {
            $block->setVar('options', '');
        }

        if ($pageblock_handler->insert($block)) {
            redirect_header('index.php?ebsn=' . $block->getVar('ebsn'), 1, _MA_TADEMBED_SUCCESS);
            exit;
        }
        break;

    case "new":
    case "edit":

        if ($op == "new") {
            $block = $pageblock_handler->create();
            $block->setVar('blockid', $_POST['blockid']);
            $block->setVar('width', "100%");
            $block->setVar('height', "350px");
            $block->setVar('update_date', time());
            $block->setBlock($_POST['blockid']);
        } else {
            $block = $pageblock_handler->get($_REQUEST['ebsn']);
            $block->setBlock();
        }

        $form = $block->getForm();
        $main = $form->render();

        break;

    case "delete":
        $obj = $pageblock_handler->get($_REQUEST['ebsn']);
        if (isset($_REQUEST['ok']) && $_REQUEST['ok'] == 1) {
            if ($pageblock_handler->delete($obj)) {
                redirect_header('index.php?ebsn=' . $obj->getVar('ebsn'), 3, sprintf(_MA_TADEMBED_DELETEDSUCCESS, $obj->getVar('title')));
            } else {
                xoops_cp_header();
                $main = implode('<br />', $obj->getErrors());
                xoops_cp_footer();
            }
        } else {
            xoops_cp_header();
            xoops_confirm(['ok' => 1, 'ebsn' => $_REQUEST['ebsn'], 'op' => 'delete'], 'block.php', sprintf(_MA_TADEMBED_RUSUREDEL, $obj->getVar('title')));
            xoops_cp_footer();
        }
        break;
}

include_once 'footer.php';
