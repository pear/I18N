<?php

    ini_set('include_path',ini_get('include_path').':../..');

    /**
    *
    *   test of Message_Translate
    *
    *   DB file: http://wolfram.kriesing.de/libs/php/examples/SimpleTemplate/translate.sql
    *
    */


    require_once( 'HTML/IT.php' );
    $tpl = new IntegratedTemplate( '.' );
    $tpl->loadTemplatefile( 'I18N_Message_Translate.tpl' );
    $langLinks =    '<a href="'.$_SERVER['PHP_SELF'].'?lang=de">german</a>, '.
                    '<a href="'.$_SERVER['PHP_SELF'].'?lang=en">english</a>';
    $tpl->setVariable( 'langLinks' , $langLinks );
    $tpl->setVariable( 'sourceCode' , $sourceCode );
    $tplString = $tpl->get();

    //
    // the actual translate stuff
    //
    require_once( 'I18N/Messages/Translate.php' );
    $db = DB::connect('mysql://root@localhost/test');
    $translate = new I18N_Messages_Translate( $db );
    print $translate->translateMarkUpString( $tplString , $_REQUEST['lang']?$_REQUEST['lang']:'en' );

?>
