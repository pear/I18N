<?php
//
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2002 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.02 of the PHP license,      |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Wolfram Kriesing <wolfram@kriesing.de>                      |
// +----------------------------------------------------------------------+
//
//  $Id$
//

/**
*   this class provides language functionality, such as
*   determining the language of a given string, etc.
*   iso639-1 compliant, 2 letter code is used
*   iso639-1 http://www.loc.gov/standards/iso639-2/langcodes.html
*
*   @package  Language
*   @access   public
*   @author   Wolfram Kriesing <wolfram@kriesing.de>
*   @version  2001/12/29
*/
class I18N_Messages_Common
{

    /**
    *   @var    array   $list   this is simply a list of (all) languages, I extend it whenever a new language is added
    */
    var $list = array('en','de','es','fr','it');

    /**
    *   @var    array   $
    */
    var $langString = array('en'=>'english',
                            'de'=>'german',
                            'es'=>'spanish',
                            'fr'=>'french',
                            'it'=>'italian' );

    /**
    *
    *
    *   @access     public
    *   @author
    *   @version
    */
    function __construct( )
    {
# FIXXME pass a resource to the constructor which can be used to determine the
# language of a string, it should be possible to use XML, DB, or whatever
# this can then be used as a replacement for the array as used now
    }

    /**
    *   for pre-ZE2 compatibility
    *
    *   @access     public
    *   @author
    *   @version
    */
    function I18N_Messages_Common( )
    {
        return $this->__construct();
    }

    /**
    *   trys to get the language of a given string
    *
    *   @access     public
    *   @author     Wolfram Kriesing <wolfram@kriesing.de>
    *   @version    01/12/29
    *   @param      string  $string     the string which is used to try and determine its language
    *   @return     string  iso-string for the language
    *
    */
    function determineLanguage( $string )
    {
        // we make it very simple for now,
        // this should be done using a db one day, either one that "learns" or one which is already a huge dictionary
// FIXXME may be each word should be a regular expression, to catch different
// forms (i.e.: like, likes), this is more relevant for languages other than english
// but regexps may consume much more time when parsing all the languages ...
        $languages = array( 'en' => array(  'the','it','this',
                                            'he','she','him','her','his',
                                            'who','why','that','what',
                                            'with','has','been',
                                            'is','of','from','for'),
                            'de' => array(  'der','die','das','des','dem',
                                            'er','sie','es','ich','du','wir','ihr',
                                            'warum','wieso','wie','wo','weshalb','was',
                                            'habe','haben','machen','tun','ist'),
                            'es' => array(  'lo','la','las','los','esto','es',
                                            'el','yo','tu','ella','su','mi','ti',
                                            'por','que','cuanto','cuando','donde',
                                            'para','desde','hasta','luego','por','y','o','con',
                                            'hacer','hace','tener','esta','estar'),
                            'fr' => array(  'le','la','les',
                                            'je','tu','il','elle','nous','vous','ils','elles','ma','mon','ta','ton','notre','votre',
                                            'por','quoi','quand','qui','ou','combien',
                                            'pour','par','apres','ce','mais','et','ou','oui','non','en','avec',
                                            'suis','est','avoir'),

                            // italian provided by: Simone Cortesi <simone@cortesi.com>
                            'it' => array(  'il','lo','la','i','gli','le',
                                            'questo','quello',
                                            'io','tu','lui','lei','ella','egli','noi','voi','loro','essi',
                                            'mio','tuo','suo','nostro','vostro',
                                            'chi','perché','perche','quanto','quando','dove',
                                            'di','a','da','in','con','su','per','tra','fra',
                                            'essere','fare','avere')
                          );

        // replace all non word-characters by a space, i hope that is ok for all languages
        $string = preg_replace( '/[\W\s]/' , ' ' ,$string);

        $splitString = explode(' ',$string);        // get each single word in a field
        foreach( $splitString as $key=>$aString )   // remove spaces around the word and make it lower case
            $splitString[$key] = strtolower(trim($aString));

        // simply intersect each language array with the array that we created by splitting the string
        // and the result that's size is the biggest is our language
        foreach( $languages as $lang=>$aLanguage )
            $results[$lang] = sizeof(array_intersect($splitString,$aLanguage));

        arsort($results);
        reset ($results);
        list($lang,) = each($results);

        return $lang;

    }

} // end of class
?>