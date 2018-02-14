<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
require_once('Facebook/FacebookSession.php');
require_once('Facebook/FacebookRequest.php');
require_once('Facebook/FacebookResponse.php');
require_once('Facebook/FacebookSDKException.php');
require_once('Facebook/FacebookRequestException.php');
require_once('Facebook/FacebookRedirectLoginHelper.php');
require_once('Facebook/FacebookAuthorizationException.php');
require_once('Facebook/GraphObject.php');
require_once('Facebook/GraphUser.php');
require_once('Facebook/GraphSessionInfo.php');
require_once('Facebook/Entities/AccessToken.php');
require_once('Facebook/HttpClients/FacebookCurl.php');
require_once('Facebook/HttpClients/FacebookHttpable.php');
require_once('Facebook/HttpClients/FacebookCurlHttpClient.php');
include_once APPPATH . "libraries/google-api-php-client/src/Google/Client.php";
include_once APPPATH . "libraries/google-api-php-client/src/Google/Service/Oauth2.php";
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest; 
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
use Facebook\FacebookHttpable;
use Facebook\FacebookCurlHttpClient;
use Facebook\FacebookCurl;
class account extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('back/m_dash');
        $this->load->model('back/m_profile');
        $this->load->model('back/m_account');
	}
    function pre_load(){
        $data['title']="Your account - Towo.com";
        $this->load->view('back/account',$data);
    }
	public function index(){
		// 1. masukan app id, secret and redirect url
        ////////////////////////////////////////////////////////////////////
        // pada langkah ke 1, kamu akan diminta untuk memasukan App ID, App
        // Secret dan Redirect URL. App ID dan App Secret bisa kamu dapatkan
        // di halaman DASHBOARD di https://developer.facebook.com. Redirect
        // URL adalah url halaman tempat login facebook kamu.
        ////////////////////////////////////////////////////////////////////
        // validation
        $id_reg = $this->session->userdata('id_reg');
        $app_id = '1802826076676207';
        $app_secret = '341026ed31f2698490742535df44c1ae';
        $redirect_url=base_url().'/back/account';
        
        // 2. inisialisasi, buat helper object and dapatkan session
        FacebookSession::setDefaultApplication($app_id, $app_secret);
        $helper = new FacebookRedirectLoginHelper($redirect_url);
        $sess = $helper->getSessionFromRedirect();
        
        // 3. cek validasi akun pengguna
        if($this->session->userdata('fb_token'))
        {
            $sess = new FacebookSession($this->session->userdata('fb_token'));
            
            try
            {
               $sess->Validate($app_id, $app_secret);
            }
            catch(FacebookAuthorizationException $e)
            {
               print_r($e);
            }
        }
        
        $this->data['loggedin'] = FALSE;
        // login url
        $this->data['login_url'] = $helper->getLoginUrl(array('email'));
        $get_urllogin = $helper->getLoginUrl(array('email'));
        // 4. jika fb session ada maka buat session pengguna
        if(isset($sess))
        {
          $this->session->set_userdata('fb_token', $sess->getToken());
          $request = new FacebookRequest($sess, 'GET', '/me');
          $response = $request->execute();
          $graph = $response->getGraphObject(GraphUser::classname());
            $sess_data = array(
                'id_reg' => $id_reg,
                'oauth_provider' => 'facebook',
                'name' => $graph->getName(),
                'oauth_uid' => $graph->getId(),
               'profile_url' => 'https://www.facebook.com/'.$graph->getProperty('id'),
               'picture_url' => 'https://graph.facebook.com/'.$graph->getId().'/picture?width=50',
               'loggedin' => TRUE
            );
            $this->session->set_userdata($sess_data);
            $provider = 'facebook';
            $cek = $this->m_account->check_already($id_reg,$provider);
            if($cek->num_rows()>0){
                // redirect($_SERVER['HTTP_REFERER']);
                $data['title']="Your account - Towo.com";
        $this->load->view('back/account',$data);
            }
            else{
                $this->m_account->insert_soc($sess_data,'social_user');
                redirect('back/dashboard/account');
            }
        }
        $sess_data['login']=$get_urllogin;
        $this->session->set_userdata($sess_data);
  //       $data['title']="Your account - Towo.com";
		// $this->load->view('back/account',$data);

        // this is for google Oauth
        $client_id = '1002671393480-jkdsqc76prvfadigmqb544vfgdkri73r.apps.googleusercontent.com';
        $client_secret = 'am1QvOMotmw-c9Yf4KSlME-_';
        $redirect_uri = 'http://localhost/promo/back/account/';
        $simple_api_key = 'AIzaSyDt5qklLm65hOrqpP5GqhLA3ytSFOMi_a0';
        $client = new Google_Client();
        $client->setApplicationName("towo");
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->setDeveloperKey($simple_api_key);
        $client->addScope("https://www.googleapis.com/auth/userinfo.email");
        $objOAuthService = new Google_Service_Oauth2($client);
        if (isset($_GET['code'])) {
            $client->authenticate($_GET['code']);
            $SESSION['access_token'] = $client->getAccessToken();
            $this->session->set_userdata($SESSION);
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }
        $token = $this->session->userdata('access_token');
        if(isset($token) && $token){
            $client->setAccessToken($_SESSION['access_token']);
        }
        if($client->getAccessToken()){
            $userData = $objOAuthService->userinfo->get();
            $sess_auth['userData']=$userData;
            $this->session->set_userdata($sess_auth);
            $token = $client->getAccessToken();
        } else{
            $authUrl = $client->createAuthUrl();
            $sess_auth['authUrl']=$authUrl;
            $this->session->set_userdata($sess_auth);
        }
        $data['title']="Your account - Towo.com";
        $this->load->view('back/account',$data);
        // redirect(base_url('back/account/test'));

        // This is for Instagram
	}
    function test(){
        $id_reg = $this->session->userdata('id_reg');
        if(isset($_GET['code'])){
            $check_already_ig = $this->m_account->check_already_ig($id_reg);
            echo $check_already_ig->num_rows();
            if($check_already_ig->num_rows()==0){
            $instagram_parameter = array(
                'client_id'=>'dfc8fc0e5a984ebe82be5612d5ac8cfe',
                'client_secret'=>'a5f0d2e4b14b4011b2a0ff9ba4a9826e',
                'grant_type'=>'authorization_code',
                'redirect_uri'=>'http://localhost/promo/back/account/test/',
                'code'=>$_GET['code']
            );
            $curl = curl_init('https://api.instagram.com/oauth/access_token');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $instagram_parameter);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            $result = curl_exec($curl);
            curl_close($curl);
            // print_r($result);
            $fin_result = json_decode($result);
            $sess_data = array(
                'id_reg'=>$id_reg,
                'oauth_provider'=>'Instagram',
                'oauth_uid' =>$fin_result->user->id,
                'name'=>$fin_result->user->username,
                'picture_url'=>$fin_result->user->profile_picture,
                'profile_url'=>'https://www.instagram.com/'.$fin_result->user->username,
                'loggedin'=>TRUE
            );
            $session = array('id_ig'=>$fin_result);
            $this->session->set_userdata($session);
            $this->m_account->insert_soc($sess_data,'social_user');
            $data['title']="Your account - Towo.com";
            $this->load->view('back/account',$data);
            // redirect(base_url('back/account'));
        }
        else{
            $data['title']="Your account - Towo.com";
            $this->load->view('back/account',$data);
            // redirect(base_url('back/account'));
        }
        }
        else{
            $data['title']="Your account - Towo.com";
            $this->load->view('back/account',$data);
            // redirect(base_url('back/account'));
        }
    }
}
?>