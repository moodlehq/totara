<?php

require_once(dirname(__FILE__) . '/libextinc/OAuth.php');

/**
 * OAuth Consumer - derived from OAuth libraries of simpleSAMLphp
 *
 * @author Andreas Åkre Solberg, <andreas.solberg@uninett.no>, UNINETT AS.
 * @package simpleSAMLphp
 * @version $Id$
 */

class local_oauth_HTTPResponse {

	public $body;
	private $headers;
	public $status;
	public $message;

	public function __construct($body, $headers, $status, $message) {
		$this->body = $body;
		$this->headers = $headers;
		$this->status = $status;
		$this->message = $message;

        // sort out HTTP errors
        if (empty($this->status)) {
            $this->status = $this->headers['http_code'];
        }
        if ($this->status > 299 && empty($this->message)) {
            $this->message = $this->body;
        }
    }
}


class local_oauth_Consumer {

    private $consumer;
    private $signer;

    public function __construct($key, $secret) {
        $this->consumer = new OAuthConsumer($key, $secret, NULL);
        $this->signer = new OAuthSignatureMethod_HMAC_SHA1();
    }

    // Used only to load the libextinc library early.
    public static function dummy() {}

    public function getRequestToken($url, $parameters=NULL) {
        $req_req = OAuthRequest::from_consumer_and_token($this->consumer, NULL, "GET", $url, $parameters);
        $req_req->sign_request($this->signer, $this->consumer, NULL);

        $response_req = $this->send_request('GET', $req_req->to_url(), FALSE, FALSE);
        if ($response_req === FALSE) {
            throw new local_oauth_exception('Error contacting request_token endpoint on the OAuth Provider');
        }

        parse_str($response_req->body, $responseParsed);

        if(array_key_exists('error', $responseParsed))
            throw new local_oauth_exception('Error getting request token: ' . $responseParsed['error']);

        $requestToken = $responseParsed['oauth_token'];
        $requestTokenSecret = $responseParsed['oauth_token_secret'];

        return new OAuthToken($requestToken, $requestTokenSecret);
    }

    public function getAuthorizeRequest($url, $requestToken, $redirect = TRUE, $callback = NULL) {
        $authorizeURL = $url . '?oauth_token=' . $requestToken->key;
        if ($callback) {
            $authorizeURL .= '&oauth_callback=' . urlencode($callback);
        }
        if ($redirect) {
            SimpleSAML_Utilities::redirect($authorizeURL);
            exit;
        }
        return $authorizeURL;
    }

    public function getAccessToken($url, $requestToken) {

        $acc_req = OAuthRequest::from_consumer_and_token($this->consumer, $requestToken, "GET", $url, NULL);
        $acc_req->sign_request($this->signer, $this->consumer, $requestToken);

        $response_acc = $this->send_request('GET', $acc_req->to_url(), FALSE, FALSE);
        if ($response_acc === FALSE) {
            throw new local_oauth_exception('Error contacting request_token endpoint on the OAuth Provider');
        }

        parse_str($response_acc->body, $accessResponseParsed);

        if(array_key_exists('error', $accessResponseParsed)) {
            throw new local_oauth_exception('Error getting request token: ' . $accessResponseParsed['error']);
        }

        if (!isset($accessResponseParsed['oauth_token']) || !isset($accessResponseParsed['oauth_token_secret'])) {
            throw new local_oauth_exception('Error getting request token no token or secret: ' . var_export($accessResponseParsed, true));
        }
        $accessToken = $accessResponseParsed['oauth_token'];
        $accessTokenSecret = $accessResponseParsed['oauth_token_secret'];

        return new OAuthToken($accessToken, $accessTokenSecret);
    }


    public function send_request($http_method, $url, $auth_header=null, $postData=null, $timeout=100) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERAGENT, 'MySpifyAgent-1.0');
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

        switch($http_method) {
          case 'GET':
              if ($auth_header) {
                  curl_setopt($curl, CURLOPT_HTTPHEADER, array($auth_header));
              }
              break;
          case 'POST':
              curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded',
                                                           $auth_header));
              curl_setopt($curl, CURLOPT_POST, 1);
              curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
              break;
          case 'PUT':
              curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded',
                                                           $auth_header));
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $http_method);
              curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
              break;
          case 'DELETE':
              curl_setopt($curl, CURLOPT_HTTPHEADER, array($auth_header));
              curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $http_method);
              break;
        }
        // execute
        $body = curl_exec($curl);
        $headers = curl_getinfo($curl);

        // fetch errors
        $errorNumber = curl_errno($curl);
        $errorMessage = curl_error($curl);

        curl_close($curl);

        $response = new local_oauth_HTTPResponse($body, $headers, $errorNumber, $errorMessage);
        return $response;
    }


    public function postRequest($url, $accessToken, $parameters) {
        $data_req = OAuthRequest::from_consumer_and_token($this->consumer, $accessToken, "POST", $url, $parameters);
        $data_req->sign_request($this->signer, $this->consumer, $accessToken);
        $postdata = $data_req->to_postdata();

        $response = $this->send_request('POST', $url, FALSE, $postdata);
        return $response;
    }


    public function getRequest($url, $accessToken, $parameters) {

        $data_req = OAuthRequest::from_consumer_and_token($this->consumer, $accessToken, "GET", $url, $parameters);
        $data_req->sign_request($this->signer, $this->consumer, $accessToken);

        $response = $this->send_request('GET', $data_req->to_url(), FALSE, FALSE);
        return $response;
    }

}

