<?php
// set your path to Zend if you need it
foreach (array('/home/piers/code/cgi/oauthlib/',
               ) as $path) {
    $path = realpath($path);
    set_include_path($path . PATH_SEPARATOR . get_include_path());
}

require_once('libextinc/OAuth.php');
require_once('Consumer.php');
require_once('Utilities.php');

// set your Google consumer key / secret
$CONSUMER_KEY = 'www.piersharding.com';
$CONSUMER_SECRET = 'AW6IOcKR8laG3HPulZDdqFoh';
$RETURN_TO = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];

session_start();
if (!isset($_SESSION['REQUEST_TOKEN'])) {
    $consumer = new local_oauth_Consumer($CONSUMER_KEY, $CONSUMER_SECRET);
    $requestToken = $consumer->getRequestToken('https://www.google.com/accounts/OAuthGetRequestToken', array('scope' => 'http://tables.googlelabs.com/api/query'));

    $_SESSION['CONSUMER'] = serialize($consumer);
    $_SESSION['REQUEST_TOKEN'] = serialize($requestToken);

    // Authorize the request token
    $consumer->getAuthorizeRequest('https://www.google.com/accounts/OAuthAuthorizeToken', $requestToken, TRUE, $RETURN_TO);
}

$consumer = unserialize($_SESSION['CONSUMER']);
$requestToken = unserialize($_SESSION['REQUEST_TOKEN']);
if (!isset($_SESSION['ACCESS_TOKEN'])) {
    // Replace the request token with an access token
    $accessToken = $consumer->getAccessToken('https://www.google.com/accounts/OAuthGetAccessToken', $requestToken);
    $_SESSION['ACCESS_TOKEN'] = serialize($accessToken);
}

$accessToken = unserialize($_SESSION['ACCESS_TOKEN']);
echo "<pre>\n";
echo "Got an access token from the OAuth service provider [" . $accessToken->key . "] with the secret [" . $accessToken->secret . "]\n";
$consumer->showTables('http://tables.googlelabs.com/api/query', $accessToken);
echo "</pre>\n";
//    unset($_SESSION['REQUEST_TOKEN']);

