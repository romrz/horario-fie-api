<?php

/*
    Horario FIE API entry point.

    It receives the subject id by a GET parameter
    named 'subject'.

    It outputs the HTML page containing the
    subject's information.
*/

include 'src/CurlPersistentConnection.php';
include 'src/SubjectRetriever.php';

// Allow requests from other domains
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

echo SubjectRetriever::get($_GET['subject']); 
