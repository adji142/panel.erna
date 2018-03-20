<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
class login extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          //session_start();
          $this->load->helper('cookie');
          $this->load->model('m_login');
          $this->load->model('m_id');
          $this->load->library('user_agent');
     }

     public function index()
     {
          $data['title']="Sign in - Towo account";
          $this->load->view('account\login',$data);
     }
     //<login>
     function proses(){
          $this->form_validation->set_rules('username','username','required|valid_email');
          $this->form_validation->set_rules('password','password','required|trim');

          if($this->form_validation->run() == FALSE){
               $this->session->set_flashdata('result_login','Field Can not be empty');
               redirect('login');
          }
          else{
               $tgl_login = date("Y-m-d H:i:s");
               $jam_login=date("H:i:s");
               $usr = $this->input->post('username');
               $pwd = $this->input->post('password');
               $u=$usr;
               $p=md5($pwd);
               $status ='';
               $cek= $this->m_login->get_user($u,$p);
               $id = "";
               if ($this->agent->is_browser()){
               $agent = $this->agent->browser().' '.$this->agent->version();
               }elseif ($this->agent->is_mobile()){
               $agent = $this->agent->mobile();
               }else{
               $agent = 'Data user gagal di dapatkan';
               }
               if($cek->num_rows() > 0){
                    $cek2nd=$this->m_login->secon_step($status,$u);
                    foreach ($cek->result() as $qad) {
                         $sess_data['id_reg']=$qad->id_reg;
                         $sess_data['user']=$qad->email;
                         $sess_data['level']=$qad->level;
                         $status = $qad->status;
                         $id = $qad->id_reg;
                         //$sess_data['tgl_login']=$tgl_login;
                         //$sess_data['jam_login']=$jam_login;
                         $this->session->set_userdata($sess_data);
                    }
                    if($cek2nd->num_rows()==0){
                         $this->session->set_flashdata('result_login','Your Username not activated');
                         redirect('login');
                    }
                    else{
                         $sess_data['level']=$qad->level;
                         $insert = array(
                              'id_reg'=>$id,
                              'datetime'=>$tgl_login,
                              'browser'=>$agent,
                              'OS'=>$this->agent->platform(),
                              'IP'=>$this->input->ip_address()
                         );
                         $status_user = array(
                              'condition'=>'online'
                         );

                         $where = array(
                              'id_reg'=>$id
                         );
                         $this->m_login->log($insert,'log_login');
                         $this->m_login->condition($status_user,$where,'user');
                         $this->session->set_userdata($sess_data);
                         redirect('back/dashboard');
                    }
               }
               else{
                    $this->session->set_flashdata('result_login','user/pass salah');
                    redirect('login');
               }
          }
     }
     //</login>
     function logout(){
          $id = $this->session->userdata('id_reg');
          $status_user = array(
               'condition'=>'offline'
          );
                         
          $where = array(
               'id_reg'=>$id
          );
          $this->m_login->condition($status_user,$where,'user');
          $sess_data = array(
          'id_reg' => NULL,
          'oauth_provider' => NULL,
          'oauth_uid' => NULL,
          'name' => NULL,
          'profile_url' => NULL,
          'picture_url' => NULL,
          'loggedin' => FALSE
        );
        $this->session->unset_userdata($sess_data);
        
        delete_cookie('ci_session');
          $this->session->sess_destroy();
          redirect('id');
          
     }
     function register(){
          $data['title']="Sign up - Towo account";
          $this->load->view('account/register',$data);
     }
     function reset(){
          $data['title']="Reset your password - Towo account";
          $this->load->view('account/reset',$data);
     }
     //<register>
     function reg_pro(){
          $id_reg = rand(0,999999999);
          $val_code= rand(0,999999);

          if ($this->agent->is_browser()){
               $agent = $this->agent->browser().' '.$this->agent->version();
          }elseif ($this->agent->is_mobile()){
               $agent = $this->agent->mobile();
          }else{
               $agent = 'Data user gagal di dapatkan';
          }
          $this->form_validation->set_rules('user','user','required|trim');
          $this->form_validation->set_rules('email','email','required|valid_email');
          $this->form_validation->set_rules('pass','pass','required|trim');
          $this->form_validation->set_rules('re-pass','re-pass','required|trim');
          $this->form_validation->set_rules('aggree','aggree','required|trim');
          if($this->form_validation->run() == FALSE){
               $this->session->set_flashdata('result_login','Field Can not be empty or check the check box');
               redirect('login/register');
          }
          else{
               $user = $this->input->post('user');
               $email = $this->input->post('email');
               $pass = $this->input->post('pass');
               $re_Pass =$this->input->post('re-pass');
               $md_pass = md5($pass);
               $md_repass=md5($re_Pass);

               if($md_pass == $md_repass){
                    $cek_already = $this->m_login->cek_reg_mail($email);
                    if($cek_already -> num_rows() > 0 ){
                         $this->session->set_flashdata('result_login','Username is already used');
                         redirect('login/register');
                    }
                    else{
                         $data= array(
                              'id_reg'=>$id_reg,
                              'user'=>$user,
                              'email'=>$email,
                              'pass'=>$md_repass,
                              'datetime_reg'=>date('Y-m-d H:i:s'),
                              'browser'=>$agent,
                              'OS'=>$this->agent->platform(),
                              'IP'=>$this->input->ip_address()

                         );
                         $this->m_login->register($data,'registration');
                         $val=array(
                              'ver_code'=>$val_code,
                              'email'=>$email,
                              'id_reg'=>$id_reg,
                              'status'=>'Deactive'
                         );
                         $this->m_login->register_val_code($val,'ver_code');
                         $sess_data['email']=$email;
                         $this->session->set_userdata($sess_data);
                         //email
                         $url = $_SERVER['HTTP_REFERER'];

                    $config = Array(
                      'protocol' => 'smtp',
                      'smtp_host' => 'ssl://smtp.googlemail.com',
                      'smtp_port' => 465,
                      'smtp_user' => 'adjia7x@gmail.com', //isi dengan gmailmu!
                      'smtp_pass' => '13121995', //isi dengan password gmailmu!
                      'mailtype' => 'html',
                      'charset' => 'iso-8859-1',
                      'wordwrap' => TRUE
                    );
                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");
                    $this->email->from('adjia7x@gmail.com');
                    $this->email->to($email); //email tujuan. Isikan dengan emailmu!
                    $this->email->subject('Towo.com - Verification code');
                    $this->email->message('
                         <h3><center><b>Towo.com</b></center></h3><br>
                         <p>
                         Thank you for registering <a href="towo.com">towo.com</a><br>
                         please use this verification code to verify your account :
                         <br>
                         <b>Your Verification code</b><br>
                         <h3>'.$val_code.'</h3>
                         </p>
                         <p>
                         Keep your store growth...<br>
                         Best Regards<br><br>

                         <a href="towo.com">towo.com</a>
                         </p>
                    ');
                    if($this->email->send()){
                         redirect('login/confirm');
                    }
                    else{
                         show_error($this->email->print_debugger());
                    }
                         
                    }

               }
               else{
                    $this->session->set_flashdata('result_login','Password Not Match');
                    redirect('login/register');
               }
               
          }
     }
     //</register>
     //<verification>
          function confirm(){
               $data['title']="Account Confirmation - Towo account";
               $this->load->view('account/verification',$data);
          }
          function conf_prog(){
               $email = $this->input->post('email');
               $id_profil= rand(0,99999900);
               $ver_code = $this->input->post('ver_code');
               $this->form_validation->set_rules('email','email','required|valid_email');
               $this->form_validation->set_rules('ver_code','ver_code','required|trim');
               if($this->form_validation->run() == FALSE){
               $this->session->set_flashdata('result_login','Field Can not be empty');
                    redirect('login/confirm');
               }
               else{
                    $cek_ver_mail = $this->m_login->cekmail_vercode($email);
                    $cek_ver_code = $this->m_login->cek_ver_code($ver_code);
                    $cek_all = $this->m_login->cek_all($email)->result();
                    if($cek_ver_mail->num_rows() < 1){
                         $this->session->set_flashdata('result_login','Email Can not be Verifyed!!, try to register first!');
                         redirect('login/confirm');
                    }
                    else{
                         if($cek_ver_code->num_rows() < 1){
                              $this->session->set_flashdata('result_login','Sorry, Your Verification Code is wrong, try again!');
                              redirect('login/confirm');
                         }
                         else{
                              $code="";
                              $mail="";
                              $pwd="";
                              foreach ($cek_all as $d) {
                                   $code = $d->id_reg;
                                   $mail = $d->email;
                                   $pwd = $d->pass;
                                   $data_input = array(
                                        'id_reg'=>$code,
                                        'email'=>$mail,
                                        'pass'=>$pwd,
                                        'level'=>'1',
                                        'status'=>'Activated'
                                   );
                              $this->m_login->add_user($data_input,'user');
                              $data_update=array(
                                   'status'=>'Activated'
                              );
                              $where = array(
                                   'id_reg'=>$code
                              );
                              $this->m_login->update_atv($where,$data_update,'ver_code');
                              $this->session->set_flashdata('result_login','Your Account has been activated, please login!!');
                              $add_profile = array(
                                   'id_reg'=>$code,
                                   'id_profile'=>'PR'.$id_profil,
                                   'email'=>$email,
                                   'photo'=>'img_profile/blank.png'
                              );
                              $this->m_login->add_profile($add_profile,'app_profile');
                              $path = './img_post/'.$code;
                              mkdir($path,0755,TRUE);
                              copy('./img_post/blank.jpg', $path."blank.jpg");
                              redirect('login');

                              
                              }
                         }
                    }
               }
          }
     //</verification>
          //reset pass
          function reset_pro(){
          $email = $this->input->post('email');
          $this->form_validation->set_rules('email','email','required|valid_email');
          $cek_email = $this->m_login->cek_all($email)->result();
          if($this->form_validation->run() == FALSE){
               $this->session->set_flashdata('result_login','Field Can not be empty');
               redirect('login/reset');
          }
          else{
               $param="";
               foreach ($cek_email as $c) {
                    $mail = base64_encode($c->email);
                    $param = rtrim($mail,'=');
                    
               }
               if($param==""){
                    $this->session->set_flashdata('result_login','Sorry, your email is not registered, try to sign up!!');
                    redirect('login/reset');
               }
               else{
                    // redirect('login/cek/'.$param.'');
                    $url = $_SERVER['HTTP_REFERER'];

                    $config = Array(
                      'protocol' => 'smtp',
                      'smtp_host' => 'ssl://smtp.googlemail.com',
                      'smtp_port' => 465,
                      'smtp_user' => 'adjia7x@gmail.com', //isi dengan gmailmu!
                      'smtp_pass' => '13121995', //isi dengan password gmailmu!
                      'mailtype' => 'html',
                      'charset' => 'iso-8859-1',
                      'wordwrap' => TRUE
                    );
                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");
                    $this->email->from('adjia7x@gmail.com');
                    $this->email->to($email); //email tujuan. Isikan dengan emailmu!
                    $this->email->subject('reset password');
                    $this->email->message('Follow this link to reset your password <br>'.base_url('login/redir/'.$param.''));
                    if($this->email->send()){
                         $this->session->set_flashdata('result_login','Check your mail to get reset link');
                         redirect('login/reset');
                    }
                    else{
                         show_error($this->email->print_debugger());
                    }
               }
          }
          }

          function redir($param){
               $sess_data['param_email']=$param;
               $this->session->set_userdata($sess_data);
               $data['title']="Reset password - admin towo";
               $this->load->view('account/reset_pass',$data);
          }
          function go_reset(){
               $get_mail = $this->input->post('res_acv');
               $old = $this->input->post('old');
               $new = $this->input->post('new');
               $re_new= $this->input->post('re_new');
               $base = $get_mail.str_repeat('=', strlen($get_mail)%4);
               $hash = base64_decode($base);
               $old_md = md5($old);
               $new_md = md5($new);
               $re_md = md5($re_new);
               $this->form_validation->set_rules('res_acv','res_acv','required|trim');
               $this->form_validation->set_rules('old','old','required|trim');
               $this->form_validation->set_rules('new','new','required|trim');
               $this->form_validation->set_rules('re_new','re_new','required|trim');
               if($this->form_validation->run() == FALSE){
                    $this->session->set_flashdata('result_login','Field Can not be empty');
                    redirect('login/redir/'.$get_mail);
               }
               else{
                    //cek 1st step email + old pass
                    $cek_email_old = $this->m_login->cek_email_old($hash,$old_md);
                    $rs_cek_email_old = $cek_email_old->num_rows();
                    if($rs_cek_email_old==0){
                         $this->session->set_flashdata('result_login','Old password is not match');
                         redirect('login/redir/'.$get_mail);
                    }
                    else{
                         //second step cek new + re-new 
                         if($new_md==$re_md){
                              //update password registration
                              $data_update_reg=array(
                                   'pass'=>$new_md
                              );
                              $where_reg = array(
                                   'email'=>$hash
                              );
                              $this->m_login->update_pass_reg($where_reg,$data_update_reg,'registration');
                              $data_update_user = array(
                                   'pass'=>$new_md
                              );
                              $where_user=array(
                                   'email'=>$hash
                              );
                              $this->m_login->update_pass_user($where_user,$data_update_user,'user');
                              $this->session->set_flashdata('result_login','Password reset successfuly, please login to start new session');
                              redirect('login');
                         }
                         else{
                              $this->session->set_flashdata('result_login','New password is not match, please try again!!!');
                              redirect('login/redir/'.$get_mail);
                         }
                    }
               }
          }
          
     public function keluar()
    {
        // logout
        $sess_data = array(
            'id_fb' => NULL,
          'name' => NULL,
          'email' => NULL,
          'image' => NULL,
          'loggedin' => FALSE
        );
        $this->session->unset_userdata($sess_data);
        
        delete_cookie('ci_session');
        
        redirect('id');
    }
    //insert into other table after login with facebook
    // function oauth_insert(){
    //       $id_fb = $this->session->userdata('id_fb');
    //       $user = $this->session->userdata('name');
    //       $email = $this->session->userdata('email');
    //       $image =$this->session->userdata('image');
    //       $tgl_login = date("Y-m-d H:i:s");
    //       $val_code= rand(0,999999);
    //       $id_profil= rand(0,99999900);
          
    //       $getidfacebook_onreg = $this->m_login->get_id_face_reg($id_fb);
    //       $getidfacebook_onprofile = $this->m_login->get_id_face_profile($id_fb);
    //       $getidfacebook_onuser = $this->m_login->get_id_face_user($id_fb);
    //       $getidfacebook_onver = $this->m_login->get_id_face_ver($id_fb);
    //       if ($this->agent->is_browser()){
    //            $agent = $this->agent->browser().' '.$this->agent->version();
    //       }elseif ($this->agent->is_mobile()){
    //            $agent = $this->agent->mobile();
    //       }else{
    //            $agent = 'Data user gagal di dapatkan';
    //       }
    //       //step one registration
    //       if($getidfacebook_onreg->num_rows()==0){
    //            $data= array(
    //            'id_reg'=>$id_fb,
    //            'user'=>$user,
    //            'email'=>'',
    //            'pass'=>'',
    //            'datetime_reg'=>date('Y-m-d H:i:s'),
    //            'browser'=>$agent,
    //            'OS'=>$this->agent->platform(),
    //            'IP'=>$this->input->ip_address()

    //       );
    //       $this->m_login->register($data,'registration');
    //       redirect('login/oauth_insert');
    //       }
    //       elseif($getidfacebook_onprofile->num_rows()==0){
    //            $add_profile = array(
    //                 'id_reg'=>$id_fb,
    //                 'id_profile'=>'PR'.$id_profil,
    //                 'email'=>'',
    //                 'photo'=>$image
    //            );
    //            $this->m_login->add_profile($add_profile,'app_profile');
    //            redirect('login/oauth_insert');
    //       }
    //       elseif($getidfacebook_onuser->num_rows()==0){
    //            $data_input= array(
    //                 'id_reg'=>$id_fb,
    //                 'level'=>'1',
    //                 'status'=>'Activated',
    //                 'condition'=>'online'
    //            );
    //            $this->m_login->add_user($data_input,'user');
    //            redirect('login/oauth_insert');
    //       }
    //       elseif($getidfacebook_onver->num_rows()==0){
    //            $val=array(
    //                 'ver_code'=>$val_code,
    //                 'email'=>'',
    //                 'id_reg'=>$id_fb,
    //                 'status'=>'Activated'
    //            );
    //            $this->m_login->register_val_code($val,'ver_code');
    //            redirect('login/oauth_insert');
    //       }
    //       else{
    //            $sess_data['id_reg']=$id_fb;
    //            $this->session->set_userdata($sess_data);
    //            redirect('back/dashboard');
    //       }
    // }
    //       //end reset pass
    //       //start auth with google
    //       //$clientId = '1002671393480-uc93qbqfb33gp12vgvvefvc9e8670pn4.apps.googleusercontent.com';$this->session->userdata('id');

    //       //$clientSecret = 'IcC665eVhqBfnrks2KQmbqMU';
          
}