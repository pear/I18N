<?php

    ini_set('include_path',ini_get('include_path').':../..');

    
    /**
    *
    *   test of I18N_Negotiator
    *
    */
    print 'TEST I18N_Negotiator<br><br>';
    require_once( 'I18N/Negotiator.php' );


    $neg = new I18N_Negotiator;

    $execute = array();
    $execute[] = '$lang = $neg->getLanguageMatch()';
    $execute[] = '$country = $neg->getCountryMatch($lang)';
    $execute[] = '$neg->getVariantInfo($lang)';
    $execute[] = '$neg->getCharsetMatch()';
    $execute[] = '$neg->getCountryName($country)';
    $execute[] = '$neg->getLanguageName($lang)';

    echo '<table border="1">';
    foreach( $execute as $aExecute )
    {
        eval('$result='.$aExecute.';');
        print "<tr><td>$aExecute </td><td> $result</td></tr>";
    }
    echo '</table>';

?>
