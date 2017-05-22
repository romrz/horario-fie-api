<?php

/*
    Horario FIE API entry point.

    It receives the subject id by a GET parameter
    named 'subject'.

    It outputs the HTML page containing the
    subject's information.
*/

include 'src/CurlPersistentConnection.php';
include 'src/SubjectParser.php';
include 'src/SubjectRetriever.php';

// Allow requests from other domains
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Content-Type: application/json');

$subject = $_GET['subject'];

if($subject == 'all')
{
	echo SubjectRetriever::all();
}
else
{
	echo SubjectRetriever::get($subject); 
}
