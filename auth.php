<?php session_start();
require_once 'config.php';
class Auth
{
//    define("CLIENT_ID", "3MVG9CEn_O3jvv0y__ijS_m.DQSlk7cY6imT88XWH4SxysPdrUhXmt_2F5LHkOwmWCuoeB6eJwVSJmV9B.Bwb");
//    define("CLIENT_SECRET", "1787285624110897671");
//    define("REDIRECT_URI", "sf.local/auth_rebound.php");
//    define("LOGIN_URI", "https://login.salesforce.com");

    /**
     * @var string
     */
    private $client_id;

    /**
     * @var string
     */
    private $client_secret;

    /**
     * @var string
     */
    private $redirect_url;

    /**
     * @var string
     */
    private $login_url;

    private $grant_type;

    private $code;

    private $access_token;

    private $instance_url;

    public function __construct($client_id, $client_secret, $redirect_url, $login_url)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->redirect_url = $redirect_url;
        $this->login_url = $login_url;
        $this->grant_type = "authorization_code";
    }

    public function authorize()
    {
        header("Location: ". $this->login_url . "/services/oauth2/authorize?response_type=code&client_id=" . $this->client_id . "&redirect_uri=" . urlencode($this->redirect_url));
    }

    public function renderError($message)
    {
        header('Location: auth_error.php?message='.urlencode($message));
    }

    public function tradeAuthForToken()
    {
        $handle = curl_init();
        $params =
            "code=" . $this->code
            . "&grant_type=authorization_code"
            . "&client_id=" . $this->client_id
            . "&client_secret=" . $this->client_secret
            . "&redirect_uri=" . urlencode($this->redirect_url);

        curl_setopt($handle, CURLOPT_URL, $this->login_url.'/services/oauth2/token');
        curl_setopt($handle, CURLOPT_HEADER, false);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $params);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER , TRUE);

        $response = curl_exec($handle);
        if(curl_getinfo($handle, CURLINFO_HTTP_CODE) != '200'){
            $this->renderError('There was an error retrieving your auth code for your access token:  ' . curl_error($handle));
        }
        curl_close($handle);
        $response = json_decode($response, true);
        $this->access_token= $response['access_token'];
        $this->instance_url = $response['instance_url'];
        $_SESSION['access_token'] = $this->access_token;
        $_SESSION['instance_url'] = $this->instance_url;
        header('Location: '.SITE_URL.'crud_dash.php');
    }

    // getters and setters

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param string $client_id
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->client_secret;
    }

    /**
     * @param string $client_secret
     */
    public function setClientSecret($client_secret)
    {
        $this->client_secret = $client_secret;
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        return $this->redirect_url;
    }

    /**
     * @param string $redirect_url
     */
    public function setRedirectUrl($redirect_url)
    {
        $this->redirect_url = $redirect_url;
    }

    /**
     * @return string
     */
    public function getLoginUrl()
    {
        return $this->login_url;
    }

    /**
     * @param string $login_url
     */
    public function setLoginUrl($login_url)
    {
        $this->login_url = $login_url;
    }

    /**
     * @return mixed
     */
    public function getGrantType()
    {
        return $this->grant_type;
    }

    /**
     * @param mixed $grant_type
     */
    public function setGrantType($grant_type)
    {
        $this->grant_type = $grant_type;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @param mixed $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * @return mixed
     */
    public function getInstanceUrl()
    {
        return $this->instance_url;
    }

    /**
     * @param mixed $instance_url
     */
    public function setInstanceUrl($instance_url)
    {
        $this->instance_url = $instance_url;
    }

}

?>