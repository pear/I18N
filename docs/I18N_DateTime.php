<?php
    //
    //
    //

//ini_set('include_path',realpath(dirname(__FILE__).'/../../../').':'.realpath(dirname(__FILE__).'/../../../../includes').':'.ini_get('include_path'));
//ini_set('error_reporting',E_ALL);
    ini_set('include_path',ini_get('include_path').':../..');
         
    print "You can set the locale by giving a GET-param i.e. '?lang=fr_FR'<br><br>";

    require_once 'I18N/DateTime.php';

    if (@$_REQUEST['lang']) {
        $lang = $_REQUEST['lang'];
    } else {
        $lang = 'en_US';
    }
                                     
    echo 'require_once \'I18N/DateTime.php\';<br>';
    echo '$dateTime = new I18N_DateTime( \''.$lang.'\' );<br><br>';
    $dateTime =& I18N_DateTime::singleton($lang);


    // 
    //  very simple examples, to get the date and/or time for now
    //                                                           
    myPrint('<h1>simple Examples</h1>');

    //
    // get the time now in format DEFAULT
    //
    myPrint( '$dateTime->format() . . . '. $dateTime->format() );
    myPrint( '$dateTime->formatShort() . . . '. $dateTime->formatShort() );
    myPrint( '$dateTime->formatMedium() . . . '. $dateTime->formatMedium() );
    myPrint( '$dateTime->formatLong() . . . '. $dateTime->formatLong() );
    myPrint( '$dateTime->formatFull() . . . '. $dateTime->formatFull() );


    echo '<br><br>';
    myPrint( '$dateTime->formatTime() . . . '. $dateTime->formatTime() );
    myPrint( '$dateTime->formatTimeShort() . . . '. $dateTime->formatTimeShort() );
    myPrint( '$dateTime->formatTimeMedium() . . . '. $dateTime->formatTimeMedium() );
    myPrint( '$dateTime->formatTimeLong() . . . '. $dateTime->formatTimeLong() );
    myPrint( '$dateTime->formatTimeFull() . . . '. $dateTime->formatTimeFull() );


    echo '<br><br>';
    myPrint( '$dateTime->formatDate() . . . '. $dateTime->formatDate() );
    myPrint( '$dateTime->formatDateShort() . . . '. $dateTime->formatDateShort() );
    myPrint( '$dateTime->formatDateMedium() . . . '. $dateTime->formatDateMedium() );
    myPrint( '$dateTime->formatDateLong() . . . '. $dateTime->formatDateLong() );
    myPrint( '$dateTime->formatDateFull() . . . '. $dateTime->formatDateFull() );



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
