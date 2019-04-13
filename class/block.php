<?php
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
 * @version         $Id: block.php 0 2009-11-14 18:47:04Z trabis $
 */
defined('XOOPS_ROOT_PATH') or die('XOOPS root path not defined');

include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

class TadEmbedBlockForm extends XoopsThemeForm
{
    public function createElements($target)
    {
        if ($target->isNew()) {
            $this->addElement(new XoopsFormText(_MA_TADEMBED_BLOCK_TITLE, 'title', 35, 255, $target->block->getVar('title', 'e')));
        } else {
            $this->addElement(new XoopsFormText(_MA_TADEMBED_BLOCK_TITLE, 'title', 35, 255, $target->getVar('title', 'e')));
        }

        $options = $target->block->getOptions();
        if ($options) {
            $this->addElement(new XoopsFormLabel(_MA_TADEMBED_BLOCK_OPTIONS, $options));
        }

        $this->addElement(new XoopsFormText(_MA_TADEMBED_WIDTH, 'width', 5, 255, $target->block->getVar('width', 'e')));
        $this->addElement(new XoopsFormText(_MA_TADEMBED_HEIGHT, 'height', 5, 255, $target->block->getVar('height', 'e')));

        $this->addElement(new XoopsFormRadioYN(_MA_TADEMBED_BORDER, 'border', $target->block->getVar('border', 'e')));
        $this->addElement(new XoopsFormTextArea(_MA_TADEMBED_NOTE, 'note', $target->block->getVar('border', 'e'), 3, 50, ''));

        $this->addElement(new XoopsFormHidden('blockid', $target->getVar('blockid')));
        $this->addElement(new XoopsFormHidden('op', 'save'));
        if (!$target->isNew()) {
            $this->addElement(new XoopsFormHidden('ebsn', $target->getVar('ebsn')));
        }
        $tray = new XoopsFormElementTray('');
        $tray->addElement(new XoopsFormButton('', 'submit', _MA_TADEMBED_OK, 'submit'));

        $cancel = new XoopsFormButton('', 'cancel', _MA_TADEMBED_CANCEL, 'button');
        $cancel->setExtra("onclick=\"self.location='index.php?ebsn=" . $target->getVar('ebsn') . "';\"");
        $tray->addElement($cancel);

        $this->addElement($tray);
    }
}
