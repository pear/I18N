<?php

    /**
    *
    *   test of I18N_Message_Common
    *
    */
    print 'TEST I18N_Messages_Common<br><br>';
    require_once( 'I18N/Messages/Common.php' );

    $strings[] = 'This is a test for all of you out there';
    $strings[] = 'Das ist ein Test für Euch alle da draussen.';
    $strings[] = 'Esto es una prueba para todos vosotros ahi.';
    $strings[] = 'Questo è un test per tutti voi là fuori.';

    foreach( $strings as $aString )
        print "<b>$aString</b> --- seems to be of the language: ".I18N_Messages_Common::determineLanguage($aString).'<br>';


    /**
    *
    *   test of Message_Translate
    *
    *   DB file: http://wolfram.kriesing.de/libs/php/examples/SimpleTemplate/translate.sql
    *
    */
    print '<br><br>TEST I18N_Messages_Translate<br><br>';
    require_once( 'I18N/Messages/Translate.php' );

    $translate = new I18N_Messages_Translate( 'mysql://root@localhost/test' );

    $translated[] = $translate->simpleTranslate( 'source code' , 'de' );
    $translated[] = $translate->translate( 'translate (i.e. into ($someVar-or any other string))' , 'de' );
    $translated[] = $translate->translateMarkUpString( $input , 'de' );

    foreach( $translated as $aTrans )
        print "$aTrans<br>";

    print_r( $translate->getAll( 'de' ) );


?>