<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP version 4.0                                                      |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997, 1998, 1999, 2000, 2001, 2002 The PHP Group       |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Naoki Shima <murahachibu@php.net>                           |
// |                                                                      |
// +----------------------------------------------------------------------+//
// $Id$

require_once 'PEAR.php';
/**
* Message Translation
* 
*/

class I18N_Messages_Common extends PEAR 
{
    // {{ variable declaration

    /**
    * Holds messageID to corresponding text mapping
    *
    * @type  : array
    * @access: private
    */
    var $_text = array();

    // }}

    /**
     * Look for and return the text corresponds to the messageID passed. 
     * Returns messageID when the corresponding text is not found
     */
    function get($messageID = "")
    {
        return ($messageID !== "" && is_array($this->_text) && in_array($messageID, array_keys($this->_text))) ? $this->_text[$messageID] :$messageID;
    }

    /**
     * Alias for getText(). Function name might not be appropriate because it conflicts PEAR coding standard 
     * that this is meant to be public function
     *
     * @param : string        messageID
     * @return: string        corresponding Text
     * @access: public
     */
    function _($messageID = "")
    {
        return $this->get($messageID);
    }

    function set($messageID = "",$str = "")
    {
        if($messageID === "") {
            return false;
        }
        if($str === "" && is_array($messageID)) {
            // user is passing an array
            $this->_text = $messageID;
        } else {
            $this->_text[$messageID] = $str;
        }
        return true;
    }
}
?>