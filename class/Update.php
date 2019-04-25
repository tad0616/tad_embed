<?php
namespace XoopsModules\Tad_embed;

/*
Update Class Definition

You may not change or alter any portion of this comment or credits of
supporting developers from this source code or any supporting source code
which is considered copyrighted (c) material of the original comment or credit
authors.

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @license      http://www.fsf.org/copyleft/gpl.html GNU public license
 * @copyright    https://xoops.org 2001-2017 &copy; XOOPS Project
 * @author       Mamba <mambax7@gmail.com>
 */

/**
 * Class Update
 */
class Update
{
    //檢查某欄位是否存在
    public static function chk_chk1()
    {
        global $xoopsDB;
        $sql = 'SELECT count(*) FROM ' . $xoopsDB->prefix('tadtools_setup') . " WHERE tt_theme='for_tad_embed_theme'";
        $result = $xoopsDB->query($sql);
        list($counter) = $xoopsDB->fetchRow($result);
        if (empty($counter)) {
            return true;
        }

        return false;
    }

    //執行更新
    public static function go_update1()
    {
        global $xoopsDB;
        $sql = 'INSERT INTO ' . $xoopsDB->prefix('tadtools_setup') . " (`tt_theme`, `tt_use_bootstrap`, `tt_bootstrap_color`, `tt_theme_kind`) VALUES ('for_tad_embed_theme', '0',  'bootstrap3', 'html'),";
        $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL, 3, mysql_error());

        return true;
    }

}
