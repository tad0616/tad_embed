<?php

namespace XoopsModules\Tad_embed;

use XoopsModules\Tad_embed;
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

class PageBlockHandler extends \XoopsPersistableObjectHandler
{
    /**
     * constructor
     * @param mixed $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'tad_embed', PageBlock::class, 'ebsn', 'title');
    }

    /**
     * Insert a new page block ready to be configured
     *
     * @param int $blockid
     *
     * @return Tad_Embed\PageBlock|false
     */
    public function newPageBlock($blockid)
    {
        $block = $this->create();
        $block->setVar('blockid', $blockid);

        if ($this->insert($block)) {
            return $block;
        }

        return false;
    }

    /**
     * Get all available blocks
     *
     * @return array
     */
    public function getAllBlocks()
    {
        $ret = [];
        $result = $this->db->query('SELECT bid, b.name AS name, b.title AS title, m.name AS modname  FROM ' . $this->db->prefix('newblocks') . ' b, ' . $this->db->prefix('modules') . ' m WHERE (b.mid=m.mid) ORDER BY modname, name');

        while (list($id, $name, $title, $modname) = $this->db->fetchRow($result)) {
            $ret[$id] = $modname . ' --> ' . $title . ' (' . $name . ')';
        }

        return $ret;
    }

    /**
     * Get all custom blocks
     *
     * @return array
     */
    public function getAllCustomBlocks()
    {
        $ret = [];
        $result = $this->db->query('
            SELECT bid, name, title FROM ' . $this->db->prefix('newblocks') . '  WHERE  mid = 0 ORDER BY name');

        while (list($id, $name, $title) = $this->db->fetchRow($result)) {
            $ret[$id] = $name . ' --> ' . $title;
        }

        return $ret;
    }
}
