<html>
<body>
<font color="red">
    please get the sql-file from
    <a href="http://wolfram.kriesing.de/libs/php/SimpleTemplate/examples/translate.sql">here</a>
    to make the translate-method work properly<br>
    this example requires &gt;=PHP 4.1
</font>
<br><br>

<?php

    ini_set('include_path',ini_get('include_path').':../..');

    /**
    *
    *   test of I18N_Message_Common
    *
    */
    print '<h1>TEST I18N_Messages_Common</h1>';
    require_once( 'I18N/Messages/Common.php' );

    $strings[] = 'This is a test for all of you out there!';
    $strings[] = 'Das ist ein Test für Euch alle da draussen!';
    $strings[] = 'Esto es una prueba para todos vosotros ahi!';
    $strings[] = 'je tu il elle nous vous - need french input here :-)';
    $strings[] = 'Questo è un test per tutti voi là fuori!';
    $strings[] = 'PHP ró?ni si? od skryptów wykonywanych po stronie klienta takich jak np.';

    foreach( $strings as $aString )
        print "<b>$aString</b> --- seems to be of the language: <b>".I18N_Messages_Common::determineLanguage($aString).'</b><br>';

    echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
    echo 'determine language of:<input name="langString" size="50" ';
    echo 'value="'.(isset($_REQUEST['langString'])?$_REQUEST['langString']:'What language is this?').'">';
    echo '<input type="submit"><br>';
    if( $_REQUEST['langString'] )
    {
        echo 'I18N_Messages_Common::determineLanguage says it is: <b>';
        echo I18N_Messages_Common::determineLanguage($_REQUEST['langString']).'</b>';
    }
    echo "</form>";


    /**
    *
    *   test of Message_Translate
    *
    *   DB file: http://wolfram.kriesing.de/libs/php/examples/SimpleTemplate/translate.sql
    *
    */
    print '<h1>TEST I18N_Messages_Translate</h1>';
    require_once( 'I18N/Messages/Translate.php' );

    $translate = new I18N_Messages_Translate( 'mysql://root@localhost/test' );

    $translated[] = $translate->simpleTranslate( 'source code' , 'de' );
    $translated[] = $translate->translate( 'translate (i.e. into ($someVar-or any other string))' , 'de' );
    $translated[] = $translate->translateMarkUpString( $input , 'de' );

    foreach( $translated as $aTrans )
        print "$aTrans<br>";

    print_r( $translate->getAll( 'de' ) );


?>
</body>
</html>

