<?php
 
class Login extends CI_Controller
{
    
    public function index()
    {
        $this->load->view('header/header');
        $this->load->view('header/css');
        $this->load->view('home/index');
        $this->load->view('header/htmlclose');
    }
    
    public function checkUser()
    {
         
        $this->form_validation->set_rules('name','Username','required');
        $this->form_validation->set_rules('password','Password','required');
        if ($this->form_validation->run() == false) {
            // $this->index();
            //echo "error someting";
             setFlashData('alert-danger','All fields are required !','Login');
        }else{
            $data['name'] = $this->input->post('name', true);
            $data['password'] = $this->input->post('password', true);
            $user = $this->LoginModel->checkUser($data);
           // var_dump($data['email']);
            if (count($user) == 1) {
                switch ($user[0]['Status']) {
                    case 0:
                        //echo '';
                        setFlashData('alert-danger','Please activate your account before login','login');
                        break;
                    case 1:
                        if ($user[0]['password'] == $data['password']) {
                            //session here
                           $myActualUser =  array(
                                'id'=>$user[0]['id'],
                                'name'=>$user[0]['name'],
                                 'fullname'=>$user[0]['fullname'],
                                  'profile'=>$user[0]['profile'],
                                
                            );
                           $this->session->set_userdata($myActualUser);
                            if ($this->session->userdata('id')) {
                                redirect('Login/User');
                            }else{
                                setFlashData('alert-danger','session is not created','Login');
                            }
                        }
                        else{
                            setFlashData('alert-danger','Your password is invalid','Login');
                        }
                        break;
                    case 2:
                        setFlashData('alert-danger','the admin blocked you.','Login');
                        break;
                }
            }else{
                 setFlashData('alert-warning','Please Enter Valid username and password','Login');
               // echo 'The email is not exist.';
            }
        }
    }
    
  public function User(){
        $this->load->view('header/header');
		$this->load->view('header/css');
		$this->load->view('header/navbartop');
		$this->load->view('header/navbarleft');
		$this->load->view('home/dashboard');
		$this->load->view('header/footer');
		$this->load->view('header/htmlclose');
    }
    
    
    public function NewClient(){
          $data['currency']= $this->LoginModel->getCurency();
          //$data['getClients'] = $this->LoginModel->checkClients(1184551);
       // var_dump($data['getClients'] );
        $this->load->view('header/header');
		$this->load->view('header/css');
		$this->load->view('header/navbartop');
		$this->load->view('header/navbarleft');
		$this->load->view('home/Newclient',$data);
		$this->load->view('header/footer');
		$this->load->view('header/htmlclose');
    }
    public function getcontact(){
        if(!$this->input->is_ajax_request()){
	 		$this->session->set_flashdata('alert-warning','plase call the ajax request');
	 		redirect('Login/NewClient');
	 		
	 	}else{
	 	    $contactid = $this->input->post('contactid',true);
	 	    $url = "https://api.hubapi.com/contacts/v1/contact/vid/".$contactid."/profile?hapikey=050a7606-f202-4c31-9cec-8aeaea345a63";
            $ch = curl_init();  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch);
            $manage = json_decode($result);
            $data["firstname"] =  $manage->properties->firstname->value;
            $data["email"] = $manage->properties->email->value;
            $data["phone"] = $manage->properties->phone->value;
       	   echo json_encode($data);
	 	}
        
    }
    public function allClient(){
         if(userLoggedIn()){
             
        $config['base_url']= site_url('Login/allClient');
		$total_rows =  $this->LoginModel->allclients();
		$config['total_rows']= $total_rows;
		$config['per_page']= 4;
		$config['uri_segment']= 3;
		$this->load->library('pagination');
		$this->pagination->initialize($config);
		$page  = ($this->uri->segment(3) ) ? $this->uri->segment(3):0;
		$data['allclients']= $this->LoginModel->fetchallclients($config['per_page'],$page);
		$data['link']=$this->pagination->create_links();
		$data['payments'] =$this->LoginModel->allpayments();
        $this->load->view('header/header');
		$this->load->view('header/css');
		$this->load->view('header/navbartop');
		$this->load->view('header/navbarleft');
		$this->load->view('home/Allclient',$data);
		$this->load->view('header/footer');
		$this->load->view('header/htmlclose');
         }else{
			//echo "user";
			setFlashData('alert-warning','Please Login first to access!','Login');
		}
    }
    
    public function addClient(){
        if(userLoggedIn()){
            	$data['contactid'] = $this->input->post('contactid',true);
            	$data['clientname'] = $this->input->post('clientname',true);
            	$data['clientemail'] = $this->input->post('clientemail',true);
            	$data['clientphone'] = $this->input->post('clientphone',true);
            	$data['dofjoining'] = $this->input->post('dofjoining',true);
            	$data['city'] = $this->input->post('city',true);
            	$data['batchname'] = $this->input->post('batchname',true);
            	$data['address'] = $this->input->post('address',true);
            	$data['coach'] = $this->input->post('coach',true);
            	$data['co_coach'] = $this->input->post('co_coach',true);
            	$data['pgm_name'] = $this->input->post('pgm_name',true);
            	$data['pgm_price'] = $this->input->post('pgm_price',true);
            	$data['pgm_pr_crncy'] = $this->input->post('pgm_pr_crncy',true);
            	$data['paid_at_vanue'] = $this->input->post('paid_at_vanue',true);
            	$data['vanue_pr_crncy'] = $this->input->post('vanue_pr_crncy',true);
                $data['modofpayment'] = $this->input->post('modofpayment',true);
            	
             if(!empty($data['contactid']) && !empty($data['clientname']) && !empty($data['clientemail']) &&
             !empty($data['clientphone']) && !empty($data['dofjoining']) && !empty($data['city']) &&
             !empty($data['batchname']) && !empty($data['coach']) && !empty($data['co_coach']) &&
             !empty($data['pgm_name']) && !empty($data['pgm_price']) && !empty($data['pgm_pr_crncy']) &&
             !empty($data['paid_at_vanue']) && !empty($data['vanue_pr_crncy']) && !empty($data['modofpayment']) && !empty($data['address']) 
             ){
                 $path =  realpath(APPPATH.'../assets/images/newclient');
					$config['upload_path']=$path;
					$config['max_size']=100;
					$config['allowed_types']='gif|png|jpeg|jpg';
					 
					$this->load->library('upload',$config);
					if(!$this->upload->do_upload('signupformimg')){
						$error = $this->upload->display_errors();
						//var_dump($error);
						setFlashData('alert-danger',$error,'Admin/NewClient');
					}else{
						$fileName = $this->upload->data();
						//var_dump($fileName);
						$data['profile'] = $fileName['file_name'];
						$data['cDate']= date('Y-m-d h:i:sa');
						$data['userid']= getuserId();
					}
					$res1 = $this->LoginModel->checkClient($data);
                 if($res1->num_rows() > 0){
						setFlashData('alert-danger','client Already Exists','Login/NewClient');
					}else{
					    $res = $this->LoginModel->addnewclient($data);
					if($res){
					setFlashData('alert-success','You have successfully added your client','Login/NewClient');
					}else{
					setFlashData('alert-danger','You can not add now','Login/NewClient');
					}
					}
             }else{
                 setFlashData('alert-warning','all The Fields is Required','Login/NewClient');
             }
            	
        }else{
			//echo "user";
			setFlashData('alert-warning','Please Login first to access!','Login');
		}
    }
    
    public function editclient($id){
           if(userLoggedIn())
           {
                   if(!empty($id) && isset($id))
                   {
                       
                       $data['clients']=  $this->LoginModel->checkClientById($id);
                       if(count($data['clients']) == 1)
        				{
        				     $data['currency']= $this->LoginModel->getCurency();
                                $this->load->view('header/header');
                        		$this->load->view('header/css');
                        		$this->load->view('header/navbartop');
                        		$this->load->view('header/navbarleft');
                        		$this->load->view('home/editclient',$data);
                        		$this->load->view('header/footer');
                        		$this->load->view('header/htmlclose');
        				}
        				else
        				{
        					//echo "not found";
        					setFlashData('alert-warning','category Not found ','Login/allClient');
        				}
                        
                   }
                   else
                   {
                       	setFlashData('alert-warning','somthing went wrong','Login/allClient');
                   }
       
           }
           else
           {
			//echo "user";
			setFlashData('alert-warning','Please Login first to access!','Login');
		  }
    }
    public function paidamount(){
             echo "paid second installment";
                     $this->load->view('header/header');
            		$this->load->view('header/css');
            		$this->load->view('header/navbartop');
            		$this->load->view('header/navbarleft');
            		$this->load->view('home/paidamount');
            		$this->load->view('header/footer');
            		$this->load->view('header/htmlclose');
    }
    public function UpdateClient(){
        echo "hello";
    }
    public function profile($id){
          if(userLoggedIn()){
              	if(!empty($id) && isset($id)){
              	    $data['profile']=  $this->LoginModel->checkProfileById($id);	
              	    if(count($data['profile']) == 1)
				{
				    $this->load->view('header/header');
            		$this->load->view('header/css');
            		$this->load->view('header/navbartop');
            		$this->load->view('header/navbarleft');
            		$this->load->view('home/profile',$data);
            		$this->load->view('header/footer');
            		$this->load->view('header/htmlclose');
				    
				}else{
				    setFlashData('alert-warning','Profile Not found Contact Admin ','Login');
				}
              	}else{
              	    
				setFlashData('alert-warning','somthing went wrong','Login');
              	}
        
          }else{
              	setFlashData('alert-warning','Please Login first to access!','Login');
          }
    }
    
    public function updatProfile(){
        if(userLoggedIn()){
            $data['fullname'] = $this->input->post('fullname',true);
			//$data['profile'] = $this->input->post('profile',true);
			$data['contact'] = $this->input->post('contact',true);
			$id = $this->input->post('id',true);
			$oldimage = $this->input->post('oldimage',true);
			if(!empty($data['fullname']) && !empty($data['contact']) )
				{
				    if(isset($_FILES['profileDp']) && is_uploaded_file($_FILES['profileDp']['tmp_name']))
				{
				    $path =  realpath(APPPATH.'../assets/images/profile');
					$config['upload_path']=$path;
					$config['max_size']=100;
					$config['allowed_types']='gif|png|jpeg|jpg';
					$this->load->library('upload',$config);
					if(!$this->upload->do_upload('profileDp')){
						$error = $this->upload->display_errors();
						//var_dump($error);
						setFlashData('alert-danger',$error,'Login/profile/'.$id);
					}else{
						$fileName = $this->upload->data();
						//var_dump($fileName);
						$data['profile'] = $fileName['file_name'];
						 
					}
				
				}//image check
					$res2 = $this->LoginModel->checkprofile($data);
					if($res2->num_rows() > 0)
						{
						setFlashData('alert-danger','already Updated your profile','Login/profile/'.$id);
						}
						else
						{
						$res2 = $this->LoginModel->updateProfile($data,$id);
						if($res2){
						if(!empty($data['profile']) && isset($data['profile'])){
						if(file_exists($path.'/'.$oldimage)){
							unlink($path.'/'.$oldimage);
						}
					}	
						setFlashData('alert-success','You have successfully updated your profile','Login/profile/'.$id);
						}else{
					     setFlashData('alert-danger','You can not updated now','Login/profile/'.$id);
						}
						}
				}else{
				    setFlashData('alert-warning','All fields are Required','Login/profile/'.$id);
				}
        }
        else
        {
              	setFlashData('alert-warning','Please Login first to access!','Login');
        }
    }
    public function logout(){
		if($this->session->userdata('id')){
			$this->session->set_userdata('id','');
			//$this->session->set_flashdata('error','Seccessfully logout !');
			setFlashData('alert-warning','Seccessfully logout !','Login');
			//redirect('Admin/Login');
		}else{
			setFlashData('alert-warning','Please login Now !','Login');
			//$this->session->set_flashdata('error','Please login Now !');
			//redirect('Admin/Login');
		}
	}
    
}
