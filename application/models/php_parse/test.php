<?php
require 'autoload.php';
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseClient;
date_default_timezone_set('Africa/Lagos');//or change to whatever timezone you want

//ParseClient::initialize( $app_id, $rest_key, $master_key );
ParseClient::initialize( "myAppId", "", "" );
// Users of Parse Server will need to point ParseClient at their remote URL and Mount Point:
ParseClient::setServerURL('http://localhost:1337','parse');

$contents = "Hello World.";
$file = ParseFile::createFromData($_FILES["userfile"], basename($_FILES["userfile"]["name"]));

$file->save();
// The file has been saved to Parse and now has a URL.
$url = $file->getURL();
$jobApplication = new ParseObject("JobApplication");
$jobApplication->set("applicantName", "Joe Smith");
$jobApplication->set("applicantResumeFile", $file);
$jobApplication->save();

$gameScore = new ParseObject("Muthu");

$gameScore->set("score", 376252);
$gameScore->set("playerName", "MUTHU PANDIAN");
$gameScore->set("cheatMode", false);


try {
  $gameScore->save();
  echo 'New object created with objectId: ' . $gameScore->getObjectId();
  $query = new ParseQuery("Muthu");
  $gameScoreRes = $query->get($gameScore->getObjectId());
  echo '<hr>';
  print_r( $gameScoreRes);
} catch (ParseException $ex) {
  // Execute any logic that should take place if the save fails.
  // error is a ParseException object with an error code and message.
  echo 'Failed to create new object, with error message: ' . $ex->getMessage();
}
