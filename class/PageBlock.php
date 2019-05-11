<?php

namespace XoopsModules\Tad_embed;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * @copyright       The XUUPS Project http://www.xuups.com
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         Mytabs
 * @since           1.0
 * @author          trabis <lusopoemas@gmail.com>
 */
defined('XOOPS_ROOT_PATH') || die('XOOPS root path not defined');

class PageBlock extends \XoopsObject
{
    public $block;

    /**
     * constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->initVar('ebsn', XOBJ_DTYPE_INT);
        $this->initVar('blockid', XOBJ_DTYPE_INT);
        $this->initVar('width', XOBJ_DTYPE_TXTBOX, '100%');
        $this->initVar('height', XOBJ_DTYPE_TXTBOX, '300px');
        $this->initVar('border', XOBJ_DTYPE_INT, 0);
        $this->initVar('note', XOBJ_DTYPE_TXTAREA, '');
        $this->initVar('title', XOBJ_DTYPE_TXTBOX, '');
        $this->initVar('options', XOBJ_DTYPE_TXTBOX, '');
        $this->initVar('uid', XOBJ_DTYPE_INT);
        $this->initVar('update_date', XOBJ_DTYPE_TXTBOX);
    }

    /**
     * Set block of type $blockid as this pageblock's block
     *
     * @param int $blockid
     */
    public function setBlock($blockid = 0)
    {
        require_once XOOPS_ROOT_PATH . '/class/xoopsblock.php';
        if (0 == $blockid) {
            $this->block = new \XoopsBlock($this->getVar('blockid'));
            $this->block->assignVar('options', $this->getVar('options', 'n'));
            $this->block->assignVar('title', $this->getVar('title', 'n'));
        } else {
            $this->block = new \XoopsBlock($blockid);
            $this->block->assignVar('options', $this->block->getVar('options', 'n'));
            $this->block->assignVar('title', $this->block->getVar('title', 'n'));
        }
    }

    /**
     * Get the form for adding or editing blocks
     *
     * @return PageBlockForm
     */
    public function getForm()
    {
        require_once XOOPS_ROOT_PATH . '/modules/tad_embed/class/block.php';
        $form = new BlockForm('Block', 'blockform', 'block.php');
        $form->createElements($this);

        return $form;
    }

    /**
     * Get pageblock and block objects on array form
     *
     * @param string $format
     * @return array
     */
    public function toArray($format = 's')
    {
        $ret = [];
        $vars = $this->getVars();
        foreach (array_keys($vars) as $key) {
            $value = $this->getVar($key, $format);
            $ret[$key] = $value;
        }

        $vars = $this->block->getVars();
        foreach (array_keys($vars) as $key) {
            $value = $this->block->getVar($key, $format);
            $ret['block'][$key] = $value;
        }

        return $ret;
    }

    /**
     * Get content for this page block
     *
     * @param int  $unique
     * @param mixed $template
     * @return array
     */
    public function render($template, $unique = 0)
    {
        $block = [
            'ebsn' => $this->getVar('ebsn'),
            'blockid' => $this->getVar('blockid'),
            'module' => $this->block->getVar('dirname'),
            'title' => $this->getVar('title'),
        ];

        $xoopsLogger = \XoopsLogger::getInstance();

        $template->caching = 0;

        $tplName = ($tplName = $this->block->getVar('template')) ? "db:$tplName" : 'db:system_block_dummy.tpl';

        $cacheid = 'blk_' . $this->getVar('ebsn');

        if ($this->getVar('cachebyurl')) {
            $cacheid .= '_' . md5($_SERVER['REQUEST_URI']);
        }

        if (!$bcachetime || !$template->is_cached($tplName, $cacheid)) {
            $xoopsLogger->addBlock($this->block->getVar('title'));
            if (!($bresult = $this->block->buildBlock())) {
                return false;
            }
            $template->assign('block', $bresult);
            $block['content'] = $template->fetch($tplName, $cacheid);
        } else {
            $xoopsLogger->addBlock($this->block->getVar('name'), true, $bcachetime);
            $block['content'] = $template->fetch($tplName, $cacheid);
        }

        return $block;
    }
}
