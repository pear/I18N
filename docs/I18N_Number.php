<?php
    //
    //
    //

    ini_set('include_path',ini_get('include_path').':../..');

    require_once 'I18N/Number.php';
    
    $locales = array('de_DE','en_US','fr_FR','it_IT');

    foreach( $locales as $aLocale )
    {
        $number = new I18N_Number( $aLocale );

        myPrint("<h1>\$number = new I18N_Number( '$aLocale' );</h1>");

        //
        //
        //
        myPrint( $number->format( pi() ) );
        myPrint( $number->format( 1000000 ) );


        $number->setFormat(I18N_NUMBER_INTEGER);
        myPrint( $number->format( pi() ) );
        myPrint( $number->format( 100000.99 ) );


        // set some sencesless format, which has
        // 4 - digits behind the decimal seperator
        // ; - as the decimal seperator
        // : - as the thousands seperator
        $myFormat = $number->setFormat(array( 4 , ';' , ':' ));
        myPrint( $number->format( pi() ) );
        myPrint( $number->format( 1000000.99 ) );


        // using all currently available formats, including myFormat, which we defined above
        myPrint( $number->format( pi() , I18N_NUMBER_INTEGER ) );
        myPrint( $number->format( pi() , I18N_NUMBER_FLOAT ) );
        myPrint( $number->format( pi() , $myFormat ) );

    }




    function myPrint( $string )
    {
        print "$string<br>";
    }
?>
