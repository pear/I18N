<?php
    //
    //
    //

    ini_set('include_path',ini_get('include_path').':../..');

    require_once 'I18N/DateTime.php';

    $dateTime = new I18N_DateTime( 'es_ES' );


    ////////////////////////////////////////////
    //
    //   DATE and TIME
    //
    //

    myPrint('<h1>DATE and TIME</h1>');

    //
    // get the time now in format DEFAULT
    //
    myPrint( $dateTime->format() );

    //
    // get the time now in format FULL
    //                                               
    myPrint( $dateTime->format( mktime(0,0,0,1,12,12) , I18N_DATETIME_FULL ) );
    // or like this
    $dateTime->setFormat( I18N_DATETIME_FULL );
    myPrint( $dateTime->format() );

    // all possible formats
    myPrint( $dateTime->format( time() , I18N_DATETIME_SHORT ) );
    myPrint( $dateTime->format( time() , I18N_DATETIME_MEDIUM ) );
    myPrint( $dateTime->format( time() , I18N_DATETIME_DEFAULT ) );
    myPrint( $dateTime->format( time() , I18N_DATETIME_LONG ) );
    myPrint( $dateTime->format( time() , I18N_DATETIME_FULL ) );




    ////////////////////////////////////////////
    //
    //   DATE only
    //
    //

    myPrint('<h1>DATE only</h1>');

    //
    // get the time now in format DEFAULT
    //
    myPrint( $dateTime->formatDate() );

    //
    // get the time now in format FULL
    //
    myPrint( $dateTime->formatDate( time() , I18N_DATETIME_FULL ) );
    // or like this
    $dateTime->setFormat( I18N_DATETIME_FULL );
    myPrint( $dateTime->formatDate() );

    // all possible formats
    myPrint( $dateTime->formatDate( time() , I18N_DATETIME_SHORT ) );
    myPrint( $dateTime->formatDate( time() , I18N_DATETIME_MEDIUM ) );
    myPrint( $dateTime->formatDate( time() , I18N_DATETIME_DEFAULT ) );
    myPrint( $dateTime->formatDate( time() , I18N_DATETIME_LONG ) );
    myPrint( $dateTime->formatDate( time() , I18N_DATETIME_FULL ) );



    ////////////////////////////////////////////
    //
    //   TIME only
    //
    //

    myPrint('<h1>TIME only</h1>');

    //
    // get the time now in format DEFAULT
    //
    myPrint( $dateTime->formatTime() );

    //
    // get the time now in format FULL
    //
    myPrint( $dateTime->formatTime( time() , I18N_DATETIME_FULL ) );
    // or like this
    $dateTime->setFormat( I18N_DATETIME_FULL );
    myPrint( $dateTime->formatTime() );

    // all possible formats
    myPrint( $dateTime->formatTime( time() , I18N_DATETIME_SHORT ) );
    myPrint( $dateTime->formatTime( time() , I18N_DATETIME_MEDIUM ) );
    myPrint( $dateTime->formatTime( time() , I18N_DATETIME_DEFAULT ) );
    myPrint( $dateTime->formatTime( time() , I18N_DATETIME_LONG ) );
    myPrint( $dateTime->formatTime( time() , I18N_DATETIME_FULL ) );


    
    /*****************************
    *
    *   CUSTOM formats
    *
    */

    myPrint('<h1>CUSTOM format</h1>');

    //
    // get the time now in a custom format
    //
    $myFormat = $dateTime->setFormat('l, d.m.Y - H:i:s \y\e\a\h');
    myPrint( $dateTime->format() );

    // switch back to default format
    $dateTime->setFormat();
    myPrint( $dateTime->format() );

    // switch back to myFormat
    $dateTime->setFormat( $myFormat );
    myPrint( $dateTime->formatDate() );



    myPrint('<h1>CUSTOM time-format</h1>');
    //
    //  set custom time format only
    //
    $myTimeFormat = $dateTime->setTimeFormat('H \U\h\r i \M\i\n\u\t\e\n \u\n\d s \S\e\k\u\n\d\e\n');
    myPrint( $dateTime->formatTime() );

    // switch back to default format
    $dateTime->setFormat();
    myPrint( $dateTime->format() );

    // switch back to myFormat
    $dateTime->setFormat( $myTimeFormat );
    myPrint( $dateTime->formatTime() );





    function myPrint( $string )
    {
        print "$string<br><br>";
    }
?>
