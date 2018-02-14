<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class expired extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('back/m_dash');
			$this->load->model('back/m_profile');
			$this->load->model('back/m_post');
			$this->load->model('back/m_expired');
			$this->load->helper(array('url','file'));
		}
		function search(){
			if(is_null($this->input->get('id'))){
				$this->load->view('expired');
			}
			else{
				$this->load->model('m_expired');
				$data['post'] = $this->m_expired->search($this->input->get('id'));
				$this->load->view('expired',$data);
				echo $this->m_expired->search($this->input->get('id'));
			}
		}
		//test auto complate
		public function autocomplete()
        {
                // load model
                $this->load->model('m_expired');
                $search_data = $this->input->post('search');
                $id_reg = $this->session->userdata('id_reg');
                $result = $this->m_expired->get_autocomplete($search_data,$id_reg);
                if (!empty($result))
                {
                    foreach ($result as $row):
                        $param = $row->id_post;
                        echo '
                        <div id = "finalResult">
        <div class="col-md-3">
        <div class="box" style="height: 70%;">
        <div class="box-header with-border">
        <a href="'.base_url("back/edit/show/".$param."").'"><h3 class="box-title"><font color = "#0087F7">'.$row->promo_title.'</font></h3></a>
        <div class="box-tools pull-right">
        </div>
        </div>
        <div class="box-body">
        <p>
        <img width="100%" src="'.base_url().'/'.$row->pic1.'"  alt="User Image" height="50%" class="img-circle">
        </p>
        <p>
        <?php echo $desc;?>
        </p>
        <p>
        Periode :'.$row->start_period.' until '.$row->end_period.'
        </p>
        </div>
        <div class="box-footer">
          <p><i class="fa fa-eye"> Viewer</i></p>
          <p><i class="fa fa-heart-o"> Like</i></p>
        </div>
        </div>
        </div>
        </div>
        ';
                    endforeach;
                }
                else
                {
                    echo "<li> <em> Not found ... </em> </li>";
                }

        }
        function asc(){
            $this->load->model('m_expired');
                $search_data = $this->input->post('new');
                $result = $this->m_expired->get_asc($search_data);
                if (!empty($result))
                {
                    foreach ($result as $row):
                        $param = $row->id_post;
                        echo '
                        <div id = "finalResult">
                        <div class="col-md-3">
                        <div class="box" style="height: 70%;">
                        <div class="box-header with-border">
                        <a href="'.base_url("back/edit/show/".$param."").'"><h3 class="box-title"><font color = "#0087F7">'.$row->promo_title.'</font></h3></a>
                        <div class="box-tools pull-right">
                        </div>
                        </div>
                        <div class="box-body">
                        <p>
                        <img width="100%" src="'.base_url().'/'.$row->pic1.'"  alt="User Image" height="50%" class="img-circle">
                        </p>
                        <p>
                        <?php echo $desc;?>
                        </p>
                        <p>
                        Periode :'.$row->start_period.' until '.$row->end_period.'
                        </p>
                        </div>
                        <div class="box-footer">
                          <p><i class="fa fa-eye"> Viewer</i></p>
                          <p><i class="fa fa-heart-o"> Like</i></p>
                        </div>
                        </div>
                        </div>
                        </div>
                        ';
                        endforeach;
                }
                else
                {
                    echo "<li> <em> Not found ... </em> </li>";
                }
        }
        function desc(){
            $this->load->model('m_expired');
                $search_data = $this->input->post('old');
                $result = $this->m_expired->get_desc($search_data);
                if (!empty($result))
                {
                    foreach ($result as $row):
                        $param = $row->id_post;
                        echo '
                        <div id = "finalResult">
                        <div class="col-md-3">
                        <div class="box" style="height: 70%;">
                        <div class="box-header with-border">
                        <a href="'.base_url("back/edit/show/".$param."").'"><h3 class="box-title"><font color = "#0087F7">'.$row->promo_title.'</font></h3></a>
                        <div class="box-tools pull-right">
                        </div>
                        </div>
                        <div class="box-body">
                        <p>
                        <img width="100%" src="'.base_url().'/'.$row->pic1.'"  alt="User Image" height="50%" class="img-circle">
                        </p>
                        <p>
                        <?php echo $desc;?>
                        </p>
                        <p>
                        Periode :'.$row->start_period.' until '.$row->end_period.'
                        </p>
                        </div>
                        <div class="box-footer">
                          <p><i class="fa fa-eye"> Viewer</i></p>
                          <p><i class="fa fa-heart-o"> Like</i></p>
                        </div>
                        </div>
                        </div>
                        </div>
                        ';
                        endforeach;
                }
                else
                {
                    echo "<li> <em> Not found ... </em> </li>";
                }
        }
	}
?>