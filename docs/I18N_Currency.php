<?php
    //
    //
    //

    ini_set('include_path',ini_get('include_path').':../..');

    require_once 'I18N/Currency.php';

    $locales = array('de_DE','en_US','fr_FR','it_IT');
            
    foreach( $locales as $aLocale )
    {
        $currency = new I18N_Currency( $aLocale );

        myPrint("<h1>\$currency = new I18N_Currency( '$aLocale' );</h1>");

        myPrint( $currency->format( pi() ) );
        myPrint( $currency->format( 1000 ) );

        myPrint( $currency->format( pi() , I18N_CURRENCY_INTERNATIONAL ) );
        myPrint( $currency->format( 1000.99 , I18N_CURRENCY_INTERNATIONAL ) );
    }







    function myPrint( $string )
    {
        print "$string<br><br>";
    }
?>
