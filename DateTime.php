<?php
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
// | Authors: Wolfram Kriesing <wk@visionp.de>                            |
// |                                                                      |
// +----------------------------------------------------------------------+//
// $Id$

require_once 'I18N/Format.php';

define( I18N_DATETIME_SHORT ,       1 );
define( I18N_DATETIME_DEFAULT ,     2 );
define( I18N_DATETIME_MEDIUM ,      3 );
define( I18N_DATETIME_LONG ,        4 );
define( I18N_DATETIME_FULL ,        5 );

define( I18N_CUSTOM_FORMATS_OFFSET ,        100 );


class I18N_DateTime extends I18N_Format
{

    // for ZE2 :-)
/*
    const SHORT =   1;
    const DEFAULT = 2;
    const MEDIUM =  3;
    const LONG =    4;
    const FULL =    5;

    const CUSTOM_FORMATS_OFFSET = 100;
*/
       
    var $days = array( 'Sunday' , 'Monday' , 'Tuesday' , 'Wednesday' , 'Thursday' , 'Friday' , 'Saturday' );

    var $daysAbbreviated = array( 'So','Mo','Di','Mi','Do','Fr','Sa');

    var $monthsAbbreviated = array( 'Jan' , 'Feb' , 'Mar' , 'Apr' , 'May' , 'Jun' ,'Jul' , 'Aug' , 'Sep' , 'Oct' , 'Nov' , 'Dec' );

    var $months = array(
                            'January',
                            'February',
                            'March',
                            'April',
                            'May',
                            'June',
                            'Juli',
                            'August',
                            'September',
                            'October',
                            'November',
                            'December'
                         );

    /**
    *   this var contains the current locale this instace works with
    *
    *   @access     protected
    *   @var        string  this is a string like 'de_DE' or 'en_US', etc.
    */
    var $_locale;

    /**
    *   the locale object which contains all the formatting specs
    *
    *   @access     protected
    *   @var        object
    */
    var $_localeObj = null;

    
    var $_currentFormat = I18N_DATETIME_DEFAULT;
    var $_currentDateFormat = I18N_DATETIME_DEFAULT;
    var $_currentTimeFormat = I18N_DATETIME_DEFAULT;

    var $_customFormats = array();

    /**
    *   returns the timestamp formatted according to the locale and the format-mode
    *   use this method to format a date and time timestamp
    *
    *   @see        setFormat()
    *   @version    02/11/20
    *   @author     Wolfram Kriesing <wolfram@kriesing.de>
    *   @param      int     a timestamp
    *   @param      int     the formatting mode, using setFormat you can add custom formats
    *   @return     string  the formatted timestamp
    *   @access     public
    */
    function format( $timestamp=null , $format=null )
    {
        return $this->_format($timestamp , $format );
    }

    /**
    *   returns the timestamp formatted according to the locale and the format-mode
    *   use this method to get a formatted date only
    *
    *   @see        setDateFormat()
    *   @version    02/11/20
    *   @author     Wolfram Kriesing <wolfram@kriesing.de>
    *   @param      int     a timestamp
    *   @param      int     the formatting mode, use setDateFormat to add custom formats
    *   @return     string  the formatted timestamp
    *   @access     public
    */
    function formatDate( $timestamp=null , $format=null )
    {
        return $this->_formatDateTime($timestamp , $format , 'date' );
    }

    /**
    *   returns the timestamp formatted according to the locale and the format-mode
    *   use this method to get a formatted time only
    *
    *   @see        setTimeFormat()
    *   @version    02/11/20
    *   @author     Wolfram Kriesing <wolfram@kriesing.de>
    *   @param      int     a timestamp
    *   @param      int     the formatting mode, use setTimeFormat to add custom formats
    *   @return     string  the formatted timestamp
    *   @access     public
    */
    function formatTime( $timestamp=null , $format=null )
    {
        return $this->_formatDateTime($timestamp , $format , 'time' );
    }

    /**
    *   formats a timestamp consisting of date and time
    *   or a custom timestamp, which was set using setFormat
    *
    *   @see        setFormat()
    *   @version    02/11/20
    *   @author     Wolfram Kriesing <wolfram@kriesing.de>
    *   @param      int     a timestamp
    *   @param      int     the format
    *   @return     string  the formatted timestamp
    *   @access     private
    */
    function _format( $timestamp , $format )
    {
        if( $format == null ){
            $format = $this->getFormat();
        }
        if( $timestamp == null ){
            $timestamp = time();
        }

        if( $format >= I18N_CUSTOM_FORMATS_OFFSET )
        {
            if( isset($this->_customFormats[$format]) )
            {
                return $this->_translate(date( $this->_customFormats[$format] , $timestamp ));
            }
            else
            {
                $format = I18N_DATETIME_DEFAULT;
            }
        }

        return $this->_formatDateTime( $timestamp , $format , 'date' ).' '.$this->_formatDateTime( $timestamp , $format , 'time' );
    }

    /**
    *   this method formats the given timestamp into the given format
    *
    *   @see        setFormat()
    *   @see        setDateFormat()
    *   @see        setTimeFormat()
    *   @version    02/11/20
    *   @author     Wolfram Kriesing <wolfram@kriesing.de>
    *   @param      int     a timestamp
    *   @param      int     the formatting mode, use setTimeFormat to add custom formats
    *   @param      string  either 'date' or 'time' so this method knows what it is currently formatting
    *   @return     string  the formatted timestamp
    *   @access     private
    */
    function _formatDateTime( $timestamp , $format , $what )
    {
        $getFormatMethod = 'get'.ucfirst($what).'Format';
        if( $format == null ){
            $format = $this->$getFormatMethod();
        }
        if( $timestamp == null ){
            $timestamp = time();
        }
                 
        $curFormat = I18N_DATETIME_DEFAULT;// just in case the if's below dont find nothing
        $formatArray = $what.'Formats';
        if( isset($this->_localeObj->{$formatArray}[$format]) )
        {
            $curFormat = $this->_localeObj->{$formatArray}[$format];
        }
        elseif( isset($this->_customFormats[$format]) )
        {
            $curFormat = $this->_customFormats[$format];
        }

        return $this->_translate(date( $curFormat , $timestamp ));
    }

    /**
    *   this simply translates the formatted timestamp into the locale-language
    *
    *   @version    02/11/20
    *   @author     Wolfram Kriesing <wolfram@kriesing.de>
    *   @param      string  a human readable timestamp, such as 'Monday, August 7 2002'
    *   @return     string  the formatted timestamp
    *   @access     private
    */
    function _translate( $string )
    {
//FIXXME optimize this array, use only those that are in the format string, i.e. if no abbreviated formats are used
// dont put the abbreviated's in this array ....
        $translateArrays = array( 'days' , 'months' , 'daysAbbreviated' , 'monthsAbbreviated' );

// FIXXME optimize the localized arrays, so we only need to put the words in there which really need translation, such
// as November is the same in german and english, but still it is translated here
        foreach( $translateArrays as $aArray ){                                   
            if( isset($this->_localeObj->{$aArray}) )
                $string = str_replace( $this->{$aArray} , $this->_localeObj->{$aArray} , $string );
        }

        return $string;
    }

    /**
    *   define a custom format given by $format and return the $format-id
    *   the format-id can be used to call format( x , format-id ) to
    *   tell the method you want to use the format with that id
    *
    *   @see        format()
    *   @version    02/11/20
    *   @author     Wolfram Kriesing <wolfram@kriesing.de>
    *   @param      string  defines a custom format
    *   @return     int     the format-id, to be used with the format-method
    */
    function setFormat( $format=I18N_DATETIME_DEFAULT )
    {
        return parent::setFormat( $format );
    }

    /**
    *   define a custom format given by $format and return the $format-id
    *   the format-id can be used to call formatDate( x , format-id ) to
    *   tell the method you want to use the format with that id
    *
    *   @see        formatDate()
    *   @version    02/11/20
    *   @author     Wolfram Kriesing <wolfram@kriesing.de>
    *   @param      string  defines a custom format
    *   @return     int     the format-id, to be used with the format-method
    */
    function setDateFormat( $format=I18N_DATETIME_DEFAULT )
    {
        return $this->_setFormat( $format , 'date' );
    }

    /**
    *   define a custom format given by $format and return the $format-id
    *   the format-id can be used to call formatTime( x , format-id ) to
    *   tell the method you want to use the format with that id
    *
    *   @see        formatTime()
    *   @version    02/11/20
    *   @author     Wolfram Kriesing <wolfram@kriesing.de>
    *   @param      string  defines a custom format
    *   @return     int     the format-id, to be used with the format-method
    */
    function setTimeFormat( $format=I18N_DATETIME_DEFAULT )
    {
        return $this->_setFormat( $format , 'time' );
    }

    /**
    *
    */
    function getDateFormat()
    {
        return $this->_currentDateFormat;
    }
    function getTimeFormat()
    {
        return $this->_currentTimeFormat;
    }

}
?>
