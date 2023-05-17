<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\aboutModel;
use App\Models\add_serviceModel;
use App\Models\emailModel;
use App\Models\footersettingModel;
use App\Models\homeModel;
use App\Models\logoModel;
use App\Models\partners_typeModel;
use App\Models\privacyModel;
use App\Models\refundModel;
use App\Models\socialmediaModel;
use App\Models\systemsettingModel;
use App\Models\termsModel;
use App\Models\whoModel;
use App\Models\happycustomerModel;
use App\Models\multibranchesModel;
use App\Models\contactusModel;
use App\Models\vissionModel;
use App\Models\missionModel;
use App\Models\adminLoginModel;
use App\Models\businessModel;
use App\Models\sendQuoteModel;
use App\Models\sendMailModel;
use App\Models\ourstoryModel;
use App\Models\ourexpertiseModel;
use App\Models\services_contentModel;
use App\Models\proj_contentsModel;
use App\Models\proj_categoryModel;
use App\Models\add_proj_nameModel;
use App\Models\add_fintech_Model;
use App\Models\fintech_contentsModel;
use App\Models\partners_contentModel;
use App\Models\partnersModel;
use App\Models\add_solutionModel;
use App\Models\solution_contentModel;
use App\Models\fintech_featuresModel;
use App\Models\careerModel;
use App\Models\youthEmpowermentModel;
use App\Models\seoModel;

class Admin extends BaseController
{
 
    public function index()
    {
        echo view('login');
       
    }

    public function adminLogin()
    {
        $session = session();
        $validation =  \Config\Services::validation();
        $db = \Config\Database::connect();

        $input = $this->validate([
            'user_email' => 'required|valid_email',            
            'user_pwd' => 'required',
        ]);
        if (!$input) {
            echo view('login', ['validation' => $this->validator]);       
        }
        else {            
            $adminLoginModel = new adminLoginModel();
            $email = $this->request->getVar('user_email');
            $password = $this->request->getVar('user_pwd');
            $query = $db->query("SELECT * FROM `mytt_web_admin_login_table` WHERE `admin_username` = '".$email."' AND `status` != 2");
            $results = $query->getResult();

            if($results) {
                 foreach ($results as $row) {                    
                     echo $user = $row->admin_username;                 
                     echo $pass =$row->admin_pwd;
                        if($password == $pass) {                            
                                $_SESSION['ID'] = $row->id;  
                                return redirect()->to('dashboard');               
                        } else{
                            $session->setFlashdata('msg', 'Password is Incorrect.');
                            return redirect()->to('login');
                        }
                 }
            } else{
                $session->setFlashdata('msg', 'Email does not exist.');
                return redirect()->to('login');
            }
        }
       
    }        
    //Home Page
        //Insert
            public function home()
            {   
                $session = session();
                if($session->has('ID')) 
                {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                        'header' => 'required',
                        'image1' => 'uploaded[image1]',
                        'content' => 'required'
                    ]);
                    if (!$input) {
                        session()->setFlashdata('message', 'Please fill all data!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('home'));
                    }
                    else {
                        $file = $this->request->getFile('image1');
                        echo $home = "home_".$file->getName();
                        if($file->isValid()) {
                        $file->move('./assets/images/upload_image/', $home,true);
                        }  
                    
                        $homeModel = new homeModel();
                        // Add operation
                        $home_Id = $homeModel->insert_data(array(
                            "home_header" =>  $this->request->getVar('header'),
                            "home_image1" =>  $home,
                            "home_content" => $this->request->getVar('content'),
                        ));
                        if(!empty($home_Id) || $home_Id != '' || $home_Id != 0) {
                            session()->setFlashdata('message', 'Added Successfully!');
                            session()->setFlashdata('alert-class', 'alert-success');
                            return $this->response->redirect(site_url('home'));
                            } else {
                            session()->setFlashdata('message', 'Do not Add!');
                            session()->setFlashdata('alert-class', 'alert-danger');
                            return $this->response->redirect(site_url('home'));
                        }
                        
                    }
                }else {
                    return redirect()->to('login');
                }
            }
            //Update
            public function edithome()
            {   
                $session = session();
                if($session->has('ID')) 
                {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                        'header' => 'required',
                        'content' => 'required'
                    ]);
                    if (!$input) {
                        session()->setFlashdata('message', 'Please fill all data!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('home'));
                    }
                    else {
                            if($this->request->getFile('image1') == "") {
                            $home = $this->request->getVar('hdn_slide_img');
                            } 
                            else {
                            $file = $this->request->getFile('image1');
                            $home = "home_".$file->getName();
                            if($file->isValid()) {
                            $file->move('./assets/images/upload_image/', $home, true);
                             }
                            }
                        
                            $homeModel = new homeModel();
                        // Add operation
                        $home_Id = $homeModel->update_data($this->request->getvar('id'),array(
                            "home_header" =>  $this->request->getVar('header'),
                            "home_image1" =>  $home,
                            "home_content" => $this->request->getVar('content'),
                        ));
                        if(!empty($home_Id) || $home_Id != '' || $home_Id != 0) {
                            session()->setFlashdata('message', 'Updated Successfully!');
                            session()->setFlashdata('alert-class', 'alert-success');
                            return $this->response->redirect(site_url('home'));
                            } else {
                            session()->setFlashdata('message', 'Do not Update!');
                            session()->setFlashdata('alert-class', 'alert-danger');
                            return $this->response->redirect(site_url('home'));
                        }
                        
                    }
                }else {
                    return redirect()->to('login');
                }
            }
            //Delete
            public  function deleteHome()
            {
                $id = $this->request->getVar('id');
                $homeModel = new homeModel();
                $home_Id = $homeModel->delete_data($id);
                return $this->response->redirect(site_url('home'));
            }

            //Social Media Setting
                //Insert
                public function socialmedia()
                {   
                    $validation =  \Config\Services::validation();
                    
                    $input = $this->validate([
                        'social_name' => 'required',
                        'social_url' => 'required'
                    ]);
                    if (!$input) {
                        session()->setFlashdata('message', 'Please fill all data!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('socialmedia'));
                    }
                    else {
                        $file = $this->request->getFile('social_img');
                        $social = "social_".$file->getName();
                        if($file->isValid()) {
                            $file->move('./assets/images/upload_image/', $social, true);
                        } else {
                            throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')');
                        }
                        $socialmediaModel = new socialmediaModel();
                        // Add operation
                       echo $social_Id = $socialmediaModel->insert_data(array(
                            "social_img" =>  $social,
                            "social_name" => $this->request->getVar('social_name'),
                            "social_url" =>  $this->request->getVar('social_url')
                        ));
                        if(!empty($social_Id) || $social_Id != '' || $social_Id != 0) {
                            session()->setFlashdata('message', 'Added Successfully!');
                            session()->setFlashdata('alert-class', 'alert-success');
                            return $this->response->redirect(site_url('socialmedia'));
                            } else {
                            session()->setFlashdata('message', 'Do not Add!');
                            session()->setFlashdata('alert-class', 'alert-danger');
                           return $this->response->redirect(site_url('socialmedia'));
                        }
                    }
                }

                 //Update
                         public function editSocialmedia()
                        {   
                            $validation =  \Config\Services::validation();
                            
                            $input = $this->validate([
                                'social_name' => 'required',
                                'social_url' => 'required'
                            ]);
                            if (!$input) {
                                session()->setFlashdata('message', 'Please fill all data!');
                                session()->setFlashdata('alert-class', 'alert-danger');
                                return $this->response->redirect(site_url('socialmedia'));
                            }
                            else {
                                if($this->request->getFile('social_img') == "") {
                                    $social = $this->request->getVar('hdn_social_img');
                                } else {
                                $file = $this->request->getFile('social_img');
                                $social = "social".$this->request->getVar('social_name').$file->getName();
                                if($file->isValid()) {
                                $file->move('./assets/images/upload_image/', $social, true);
                            }
                                
                                }
                                $socialmediaModel = new socialmediaModel();
                                // Add operation
                            echo $social_Id = $socialmediaModel->update_data($this->request->getvar('id'),array(
                                    "social_img" =>  $social,
                                    "social_name" => $this->request->getVar('social_name'),
                                    "social_url" =>  $this->request->getVar('social_url')
                                ));
                                if(!empty($social_Id) || $social_Id != '' || $social_Id != 0) {
                                    session()->setFlashdata('message', 'Updated Successfully!');
                                    session()->setFlashdata('alert-class', 'alert-success');
                                    return $this->response->redirect(site_url('socialmedia'));
                                    } else {
                                    session()->setFlashdata('message', 'Do not Update!');
                                    session()->setFlashdata('alert-class', 'alert-danger');
                                return $this->response->redirect(site_url('socialmedia'));
                                }
                            }
                        }
                   
                        //Delete
                    public  function deletesocialmedia()
                    {
                        $id = $this->request->getVar('id');
                        $socialmediaModel = new socialmediaModel();
                        $social_Id = $socialmediaModel->delete_data($id);
                        return $this->response->redirect(site_url('socialmedia'));
                    }

                //Contact Us

                //Insert
                public function contactus()
                {   
                $session = session();
                if($session->has('ID')) 
                {
                        $validation =  \Config\Services::validation();
                        $input = $this->validate([
                        'title' => 'required',
                        'mobile' => 'required',
                        'email' => 'required',
                        'address' => 'required',
                        'contact_image' => 'uploaded[contact_image]',
                        'content' => 'required'
                        ]);
                        if (!$input) {
                        session()->setFlashdata('message', 'Please fill all data!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('contactus'));
                        }
                        else {
                        $file = $this->request->getFile('contact_image');
                        $contactus = "contactus_".$file->getName();
                        if($file->isValid()) {
                            $file->move('./assets/images/upload_image/', $contactus, true);
                        }  
                        
                        $contactusModel = new contactusModel();
                        // Add operation
                        $contact_Id = $contactusModel->insert_data(array(
                            "contact_title" => $this->request->getVar('title'),
                            "contact_mobile" => $this->request->getVar('mobile'),
                            "contact_email" => $this->request->getVar('email'),
                            "contact_address" => $this->request->getVar('address'),
                            "contact_image" => $contactus,
                            "contact_content" => $this->request->getVar('content'),
                        ));
                        if(!empty($contact_Id) || $contact_Id != '' || $contact_Id != 0) {
                            session()->setFlashdata('message', 'Added Successfully!');
                            session()->setFlashdata('alert-class', 'alert-success');
                            return $this->response->redirect(site_url('contactus'));
                            } else {
                            session()->setFlashdata('message', 'Do not Add!');
                            session()->setFlashdata('alert-class', 'alert-danger');
                            return $this->response->redirect(site_url('contactus'));
                        }
                    }
                }else {
                    return redirect()->to('login');
                }
            }
            
        public function contactus_update()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
                $input = $this->validate([
                'title' => 'required',
                'mobile' => 'required',
                'email' => 'required',
                'address' => 'required',
                'content' => 'required'
                 ]);
                if (!$input) {
                session()->setFlashdata('message', 'Please fill all data!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('contactus'));
                }
                else {
                echo $file = $this->request->getFile('contact_image');
                $contact_image = "contactus_".$file->getName();
                if($file->isValid()) {
                $file->move('./assets/images/upload_image/', $contact_image, true);
                }  
                echo  $id = $this->request->getVar('id');
                $contactusModel = new contactusModel();
                // Add operation
                echo $contact_Id = $contactusModel->update_data($id, array(
                "contact_title" => $this->request->getVar('title'),
                "contact_mobile" =>  $this->request->getVar('mobile'),
                "contact_email" =>   $this->request->getVar('email'),
                "contact_address" => $this->request->getVar('address'),
                "contact_image" =>   $contact_image,
                "contact_content" => $this->request->getVar('content'),
                 ));
                if(!empty($contact_Id) || $contact_Id != '' || $contact_Id != 0) {
                session()->setFlashdata('message', 'Updated Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $this->response->redirect(site_url('contactus'));
                echo 'Updated Successfully';
                } else {
                session()->setFlashdata('message', 'Do not Update!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('contactus'));
                }
                }
            }else {
                return redirect()->to('login');
            }
        }
        
        public function about()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
                $input = $this->validate([
                'header' => 'required',
                'subtitle' => 'required',
                'about_img' => 'uploaded[about_img]',
                'content' => 'required'
                ]);
                if (!$input) {
                session()->setFlashdata('message', 'Please fill all data!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('about'));
                }
                else{
                $file = $this->request->getFile('about_img');
                $about ="about_".$file->getName();
                if($file->isValid()) {
                $file->move('./assets/images/upload_image/', $about, true);
                }  

                $aboutModel = new aboutModel();
                // Add operation
                $about_Id = $aboutModel->insert_data(array(
                "about_header" => $this->request->getVar('header'),
                "about_subtitle" => $this->request->getVar('subtitle'),
                "image" => $about,
                "about_content" => $this->request->getVar('content'),
                ));
                if(!empty($about_Id) || $about_Id != '' || $about_Id != 0) {
                session()->setFlashdata('message', 'Added Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $this->response->redirect(site_url('about'));
                } else {
                session()->setFlashdata('message', 'Do not Add!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('about'));
                }
                }
            }else {
                return redirect()->to('login');
            }    
        }

        public function about_update()
        { 
            $session = session();
            if($session->has('ID')) 
            {  
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'header' => 'required',
                    'subtitle' => 'required',
                    'content' => 'required'
                    ]);
                
                    if (!$input)
                    {
                        session()->setFlashdata('message', 'Please fill all data!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('about'));   
                    } else{
                        $file = $this->request->getFile('about_img');
                        $about = "about_".$file->getName();
                        if($file->isValid()) {
                        $file->move('./assets/images/upload_image/', $about, true);
                        }
                        echo  $id = $this->request->getVar('id');
                        $aboutModel = new aboutModel();
                        // Add operation
                        $about_Id = $aboutModel->update_data($id, array(
                            "about_header" => $this->request->getVar('header'),
                            "about_subtitle" => $this->request->getVar('subtitle'),
                            "image" => $about,
                            "about_content" => $this->request->getVar('content')
                        ));
                        if(!empty($about_Id) || $about_Id != '' || $about_Id != 0)  {
                            session()->setFlashdata('message', 'Updated Successfully!');
                            session()->setFlashdata('alert-class', 'alert-success');
                            return $this->response->redirect(site_url('about'));
                        } else {
                            session()->setFlashdata('message', 'Do not Update!');
                            session()->setFlashdata('alert-class', 'alert-danger');
                            return $this->response->redirect(site_url('about'));
                        }
                
                    }
             }else {
                    return redirect()->to('login');
                 }
        }

        public  function about_delete($id)
        {            
            $aboutModel = new aboutModel();
            $aboutModel->where('id',$id)->delete();
            return redirect(site_url('about'));
        }

        public function email()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
                $input = $this->validate([
                'general' => 'required',
                'support' => 'required',
                'quote' => 'required'
                ]);
                if (!$input) {
                session()->setFlashdata('message', 'Please fill all data!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('email'));         
                 } else {

    
                $emailModel = new emailModel();
                // Add operation
                $email_Id = $emailModel->insert_data(array(
                "general_email" => $this->request->getVar('general'),
                "support_email" => $this->request->getVar('support'),
                "quote_email" => $this->request->getVar('quote')
                ));
                if(!empty($email_Id) || $email_Id != '' || $email_Id != 0) {
                session()->setFlashdata('message', 'Added Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $this->response->redirect(site_url('email'));
                } else {
                session()->setFlashdata('message', 'Do not Add!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('email'));
                }
                }
            }else {
                return redirect()->to('login');
                }
        }

    
        public function email_update()
        {  
            $session = session();
            if($session->has('ID')) 
            { 
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'general' => 'required',
                    'support' => 'required',
                    'quote' => 'required'
                    ]);
                    if (!$input)
                    {
                    session()->setFlashdata('message', 'Please fill all data!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('email'));   
                    } 
                    else {
                        echo  $id = $this->request->getVar('id');
                        $emailModel = new emailModel();
                        // Add operation
                        echo $email_Id = $emailModel->update_data($id, array(
                        "general_email" => $this->request->getVar('general'),
                        "support_email" => $this->request->getVar('support'),
                        "quote_email" => $this->request->getVar('quote')
                        ));
                        if(!empty($email_Id) || $email_Id != '' || $email_Id != 0)  {
                        session()->setFlashdata('message', 'Updated Successfully!');
                        session()->setFlashdata('alert-class', 'alert-success');
                        return $this->response->redirect(site_url('email'));
                        } else {
                        session()->setFlashdata('message', 'Do not Update!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('email'));
                    }
                
                }
            }else {
                return redirect()->to('login');
                }
        }


        public function footersetting()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'copy' => 'required',
                    'link' => 'required',
                    'developedBy' => 'required'
                    ]);
                    if (!$input) {
                    session()->setFlashdata('message', 'Please fill all data!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('footersetting'));         
                    } else {

                    $footersettingModel = new footersettingModel();
                    // Add operation
                    $footer_Id = $footersettingModel->insert_data(array(
                        "footer_copy" => $this->request->getVar('copy'),
                        "footer_link" => $this->request->getVar('link'),
                        "developed_by" => $this->request->getVar('developedBy')
                    ));

                    if(!empty($footer_Id) || $footer_Id != '' || $footer_Id != 0) {
                        session()->setFlashdata('message', 'Added Successfully!');
                        session()->setFlashdata('alert-class', 'alert-success');
                        return $this->response->redirect(site_url('footersetting'));
                        } else {
                        session()->setFlashdata('message', 'Do not Add!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('footersetting'));
                    }
                    }
                }else {
                    return redirect()->to('login');
                    }
        }

        
            

        public function footersetting_update()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
                $input = $this->validate([
                'copy' => 'required',
                'link' => 'required',
                'developedBy' => 'required'
                ]);
                if (!$input)
                {
                session()->setFlashdata('message', 'Please fill all data!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('footersetting'));   
                } else {
                echo  $id = $this->request->getVar('id');
                $footersettingModel = new footersettingModel();
                // Add operation
                echo $footer_Id = $footersettingModel->update_data($id, array(
                    "footer_copy" => $this->request->getVar('copy'),
                    "footer_link" => $this->request->getVar('link'),
                    "developed_by" => $this->request->getVar('developedBy')
                ));
                if(!empty($footer_Id) || $footer_Id != '' || $footer_Id != 0)  {
                session()->setFlashdata('message', 'Updated Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $this->response->redirect(site_url('footersetting'));
                } else {
                session()->setFlashdata('message', 'Do not Update!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('footersetting'));
                 }
            
                } 
            }
            else {
                return redirect()->to('login');
                }
        }

        public  function footersetting_delete($id)
        {
            $footersettingModel = new footersettingModel();
            $footersettingModel->where('id',$id)->delete();
            return redirect(site_url('footersetting'));   
        }
        // Logo Insert
        public function logo()
        {  
                $session = session();
                if($session->has('ID')) 
                {
                    $session = session();
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'favicon' => 'uploaded[favicon]',
                    'logo' => 'uploaded[logo]'
                    
                    ]);
                    if (!$input) {
                    session()->setFlashdata('message', 'Failed, please try again!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('logo'));
                     } else {
                    $file = $this->request->getFile('favicon');
                    $faviconImg ="favicon_".$file->getName();
                    if($file->isValid()) {
                        $file->move('./assets/images/', $faviconImg, true);
                    }  

                    $file = $this->request->getFile('logo');
                    $logoImg = "logo_".$file->getName();
                    if($file->isValid()) {
                    $file->move('./assets/images/', $logoImg, true);
                    }  

                    $logoModel = new logoModel();
                    // Add operation
                    $logo_Id = $logoModel->insert_data(array(
                        "logo_file" => $logoImg,
                        "favicon_file" => $faviconImg
                        
                    ));
                     if(!empty($logo_Id) || $logo_Id == '') {
                    session()->setFlashdata('message', 'Added Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('logo'));
                    } else {
                    session()->setFlashdata('message', 'Do not Add!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                   return $this->response->redirect(site_url('logo'));
                    }
                    } 
                }else {
                    return redirect()->to('login');
                    }
            }
            //Update Logo
        public function logo_update()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
                
                if(empty($this->request->getVar('favicon'))){
                $file = $this->request->getFile('favicon');
                $faviconImg ="favicon_".$file->getName();
                if($file->isValid()) {
                    $file->move('./assets/images/', $faviconImg, true);
                } 
                } else{
                $faviconImg = $this->request->getVar('hdnfavicon');
                 }
                if(empty($this->request->getVar('logo'))){
                $file = $this->request->getFile('logo');  
                $logoImg = "logo_".$file->getName();;
                if($file->isValid()) {
                $file->move('./assets/images/', $logoImg, true);
                }
                 }
               else{
                $logoImg = $this->request->getVar('hdnfavicon');
                }
                   
                $id = $this->request->getVar('id');
                $logoModel = new logoModel();
                // Add operation
                    $logo_Id = $logoModel->update_data($id, array(
                    "logo_file" => $logoImg,
                    "favicon_file" => $faviconImg
                    
                ));
                if(!empty($logo_Id) || $logo_Id == '')  {
                session()->setFlashdata('message', 'Updated Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $this->response->redirect(site_url('logo'));
                } else {
                session()->setFlashdata('message', 'Do not Update!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('logo'));
                }
            }else {
                return redirect()->to('login');
                }
        } 
        
        public  function logo_delete($id)
            {
                
                $logoModel = new logoModel();
                $logoModel->where('id',$id)->delete();
                return redirect(site_url('logo'));

            }

         //Partner
         public function partners()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
                $input = $this->validate([
                    'partner' => 'required',
                    'partner_img' => 'uploaded[partner_img]',
                    'partner_content' => 'required'
                ]);
                if (!$input) {
                    session()->setFlashdata('message', 'Please fill all data!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('partners'));
                } 
                 else
                {
                    $file = $this->request->getFile('partner_img');
                    $partners = "partners".$file->getName();
                    if($file->isValid()) {
                    $file->move('./assets/images/upload_image/partners/', $partners, true);
                    } 
                    $partnersModel = new partnersModel();
                            // Add operation
                    $partners_Id = $partnersModel->insert_data(array(
                        "partners_name" =>  $this->request->getVar('partner'),
                        "partners_logo" =>  $partners,
                        'partners_link' =>$this->request->getVar('partner_link'),
                        "partners_contents	" =>  $this->request->getVar('partner_content'),
                    ));
                    if(!empty($partners_Id) || $partners_Id != '' || $partners_Id != 0) {
                        session()->setFlashdata('message', 'Added Successfully!');
                        session()->setFlashdata('alert-class', 'alert-success');
                        return $this->response->redirect(site_url('partners'));
                        } else {
                        session()->setFlashdata('message', 'Do not Add!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('partners'));
                    } 
        
                }
            }
            else {
                return redirect()->to('login');
            }
        }

        //Update
        public function editpartners()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
                $input = $this->validate([
                    'partner' => 'required',
                    'partner_content' => 'required'
                ]);
                if (!$input) {
                    session()->setFlashdata('message', 'Please fill all data!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('partners'));
                } 
                 else{

                    if($this->request->getFile('partner_img') == "") {
                        $partners = $this->request->getVar('hdn_partner_img');
                    } else {
                       $file = $this->request->getFile('partner_img');
                       $partners = "partners".$file->getName();
                       if($file->isValid()) {
                       $file->move('./assets/images/upload_image/partners/', $partners, true);
                    }
                    
                    } 
                    $partnersModel = new partnersModel();
                            // Add operation
                    $partners_Id = $partnersModel->update_data($this->request->getvar('id'),array(
                    "partners_name" =>  $this->request->getVar('partner'),
                    "partners_logo" =>  $partners,
                    'partners_link' =>$this->request->getVar('partner_link'),
                    "partners_contents" => $this->request->getVar('partner_content'),
                    ));
                if(!empty($partners_Id) || $partners_Id != '' || $partners_Id != 0) {
                    session()->setFlashdata('message', 'Updated Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('partners'));
                    } else {
                    session()->setFlashdata('message', 'Do not Update!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('partners'));
                    } 
        
                }
            }
            else {
                return redirect()->to('login');
            }
        }
            //Delete
        public function deletePartners()
        {            
                $id = $this->request->getVar('id');
                $partnersModel = new partnersModel();
                $partners_Id = $partnersModel->delete_data($id);
                return $this->response->redirect(site_url('partners'));            
        }
        public function partners_delete($id)
        {            
            $partnersModel = new partnersModel();
            $partnersModel->where('id',$id)->delete();
            return redirect(site_url('partners'));
        }

        public function privacy()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
                $input = $this->validate([
                'header' => 'required',
                'subtitle' => 'required',
                'image' => 'uploaded[image]',
                'content' => 'required'
                ]);
                if (!$input) 
                {
                session()->setFlashdata('message', 'Please fill all data!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('privacy'));         
                 }
                else
                {
                $file = $this->request->getFile('image');
                $image = "privacy_".$file->getName();
                if($file->isValid()) 
                {
                $file->move('./assets/images/upload_image/', $image, true);
                }
                $privacyModel = new privacyModel();
                // Add operation
                $privacy_Id = $privacyModel->insert_data(array(
                "privacy_header" => $this->request->getVar('header'),
                "privacy_subtitle" => $this->request->getVar('subtitle'),
                "image" => $image,
                "privacy_content" => $this->request->getVar('content'),
                ));
                if(!empty($privacy_Id) || $privacy_Id != '' || $privacy_Id != 0) 
                {
                    session()->setFlashdata('message', 'Added Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('privacy'));
                }
            
                else 
                {
                session()->setFlashdata('message', 'Do not Add!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('privacy'));
                }
                }
            }else {
                return redirect()->to('login');
            }
        }

        public function privacy_update()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
                $input = $this->validate([
                'header' => 'required',
                'subtitle' => 'required',
                'content' => 'required'
                ]);
                if (!$input) 
                {
                session()->setFlashdata('message', 'Please fill all data!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('privacy'));         
                }
                else
               {
                    if($this->request->getFile('image') == "") {
                        $image = $this->request->getVar('hdn_slide_img');
                    } 
                    else {
                        $file = $this->request->getFile('image');
                        $image = "privacy_".$file->getName();
                        if($file->isValid()) {
                            $file->move('./assets/images/upload_image/', $image, true);
                        }
                    }
                   
                
                echo  $id = $this->request->getVar('id');
                $privacyModel = new privacyModel();
                // Add operation
                $privacy_Id = $privacyModel->update_data( $id, array(
                    "privacy_header" => $this->request->getVar('header'),
                    "privacy_subtitle" => $this->request->getVar('subtitle'),
                    "image" => $image,
                    "privacy_content" => $this->request->getVar('content'),
                    ));
                    if(!empty($privacy_Id) || $privacy_Id != '' || $privacy_Id != 0) 
                    {
                    session()->setFlashdata('message', 'Updated Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('privacy'));
                    }
            
                    else 
                    {
                    session()->setFlashdata('message', 'Do not Update!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('privacy'));
                }
                }
            } else {
                return redirect()->to('login');
            }
        }

        public function privacy_delete($id)
        {
            $privacyModel = new privacyModel();
            $privacyModel->where('id',$id)->delete();
            return redirect(site_url('privacy'));
        }
        public function refund()
        { 
            $session = session();
            if($session->has('ID')) 
            {  
                $validation =  \Config\Services::validation();
                $input = $this->validate([
                'header' => 'required',
                'subtitle' => 'required',
                'image' => 'uploaded[image]',
                'content' => 'required'
                ]);
                if (!$input) 
                {
                session()->setFlashdata('message', 'Please fill all data!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('refund'));         
                }
                else{
                $file = $this->request->getFile('image');
                $image = "refund_".$file->getName();
                if($file->isValid()) 
                {
                $file->move('./assets/images/upload_image/', $image, true);
                }  
                $refundModel = new refundModel();
                 // Add operation
                $refund_Id = $refundModel->insert_data(array(
                "refund_header" => $this->request->getVar('header'),
                "refund_subtitle" => $this->request->getVar('subtitle'),
                "image" => $image,
                "refund_content" => $this->request->getVar('content'),
                 ));
                if(!empty($refund_Id) || $refund_Id != '' || $refund_Id != 0) 
                {
                session()->setFlashdata('message', 'Added Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $this->response->redirect(site_url('refund'));
                 }
                 else 
                {
                    session()->setFlashdata('message', 'Do not Add!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('refund'));
                }
                }
            }else {
                return redirect()->to('login');
            }
        }
        public function refund_update()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
                $input = $this->validate([
                'header' => 'required',
                'subtitle' => 'required',
                'content' => 'required'
                ]);
                if (!$input) 
                {
                session()->setFlashdata('message', 'Please fill all data!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('refund'));         
                }
                else
                {
                    if($this->request->getFile('image') == "") {
                        $image = $this->request->getVar('hdn_slide_img');
                    } 
                    else {
                        $file = $this->request->getFile('image');
                        $image = "refund_".$file->getName();
                        if($file->isValid()) {
                            $file->move('./assets/images/upload_image/', $image, true);
                        }
                    }
                $id = $this->request->getVar('id'); 
                $refundModel = new refundModel();
                // Add operation
                $refund_Id = $refundModel->update_data( $id, array(
                "refund_header" => $this->request->getVar('header'),
                "refund_subtitle" => $this->request->getVar('subtitle'),
                "image" => $image,
                "refund_content" => $this->request->getVar('content'),
                ));
            
                if(!empty($refund_Id) || $refund_Id != '' || $refund_Id != 0) 
                {
                session()->setFlashdata('message', 'Updated Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $this->response->redirect(site_url('refund'));
                }
            
                else 
                {
                    session()->setFlashdata('message', 'Do not Update!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('refund'));
                }
                }
            }else {
                return redirect()->to('login');
            }
        }

        public function refund_delete($id)
        {
            $refundModel = new refundModel();
            $refundModel->where('id',$id)->delete();
            return redirect(site_url('refund'));
        }

        public function systemsetting()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
                $input = $this->validate([
                'sitename' => 'required',
                'shortsite' => 'required',
                'siteurl' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'email' => 'required',
                ]);
                 if (!$input) {
                session()->setFlashdata('message', 'Please fill all data!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('systemsetting'));         
                } 
                else {
                $systemsettingModel = new systemsettingModel();
                // Add operation
                $sys_Id = $systemsettingModel->insert_data(array(
                "site_name" => $this->request->getVar('sitename'),
                "short_site" => $this->request->getVar('shortsite'),
                "site_url" => $this->request->getVar('siteurl'),
                "site_address" => $this->request->getVar('address'),
                "phone" => $this->request->getVar('phone'),
                "email" => $this->request->getVar('email'),
                ));
                if(!empty($sys_Id) || $sys_Id != '' || $sys_Id != 0) {
                session()->setFlashdata('message', 'Added Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $this->response->redirect(site_url('systemsetting'));
                } else {
                session()->setFlashdata('message', 'Do not Add!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('systemsetting'));
                 }
                 }
            } else {
                return redirect()->to('login');
            }   
        }
       public function systemsetting_update()
            {  
                $session = session();
                if($session->has('ID')) 
                {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'sitename' => 'required',
                    'shortsite' => 'required',
                    'siteurl' => 'required',
                    'address' => 'required',
                    'phone' => 'required',
                    'email' => 'required'
                    ]);
                    
                    if (!$input)
                    {
                    session()->setFlashdata('message', 'Please fill all data!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('systemsetting'));   
                    } 
                    else {
                    echo  $id = $this->request->getVar('id');
                    $systemsettingModel = new systemsettingModel();
                    // Add operation
                    echo $sys_Id = $systemsettingModel->update_data($id, array(
                    "site_name" => $this->request->getVar('sitename'),
                    "short_site" => $this->request->getVar('shortsite'),
                    "site_url" => $this->request->getVar('siteurl'),
                    "site_address" => $this->request->getVar('address'),
                    "phone" => $this->request->getVar('phone'),
                    "email" => $this->request->getVar('email')
                    ));
                    
                    if(!empty($sys_Id) || $sys_Id != '' || $sys_Id != 0)  {
                    session()->setFlashdata('message', 'Updated Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('systemsetting'));
                    } else {
                    session()->setFlashdata('message', 'Do not Update!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('systemsetting'));
                    }
                    }
                }else {
                    return redirect()->to('login');
                } 
            }


            public function systemsetting_delete($id)
            {
            
            $systemsettingModel = new systemsettingModel();
            $systemsettingModel->where('id',$id)->delete();
                return redirect(site_url('systemsetting'));

            }
        public function terms()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
                $input = $this->validate([
                'header' => 'required',
                'subtitle' => 'required',
                'image' => 'uploaded[image]',
                'content' => 'required'
                ]);

                 if (!$input) {
                session()->setFlashdata('message', 'Please fill all data!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('terms'));         
                } else {
                $file = $this->request->getFile('image');
                $image = "terms_".$file->getName();
                if($file->isValid()) {
                    $file->move('./assets/images/upload_image/', $image, true);
                }  
                $termsModel = new termsModel();
                // Add operation
                $term_Id = $termsModel->insert_data(array(
                "term_header" => $this->request->getVar('header'),
                "term_subtitle" => $this->request->getVar('subtitle'),
                "image" => $image,
                "term_condition_content" => $this->request->getVar('content')
                ));
                if(!empty($term_Id) || $term_Id != '' || $term_Id != 0) {
                session()->setFlashdata('message', 'Added Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $this->response->redirect(site_url('terms'));
                } else {
                session()->setFlashdata('message', 'Do not Add!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('terms'));
                 }
                }
            }else {
                return redirect()->to('login');
            } 
        }

                public function terms_update()
                {  
                    $session = session();
                    if($session->has('ID')) 
                    { 
                            $validation =  \Config\Services::validation();
                            $input = $this->validate([
                            'header' => 'required',
                            'subtitle' => 'required',
                            'content' => 'required'
                            ]);
                            if (!$input)
                            {
                            session()->setFlashdata('message', 'Please fill all data!');
                            session()->setFlashdata('alert-class', 'alert-danger');
                            return $this->response->redirect(site_url('terms'));   
                            } else {
                                    if($this->request->getFile('image') == "") {
                                        $image = $this->request->getVar('hdn_slide_img');
                                    } 
                                    else {
                                        $file = $this->request->getFile('image');
                                        $image = "terms_".$file->getName();
                                        if($file->isValid()) {
                                            $file->move('./assets/images/upload_image/', $image, true);
                                        }
                                    }
                            
                            $id = $this->request->getVar('id');
                            $termsModel = new termsModel();
                            // Add operation
                            $term_Id = $termsModel->update_data($id, array(
                            "term_header" => $this->request->getVar('header'),
                            "term_subtitle" => $this->request->getVar('subtitle'),
                            "image" =>  $image,
                            "term_condition_content" => $this->request->getVar('content')
                            ));
                            if(!empty($term_Id) || $term_Id != '' || $term_Id != 0)  {
                            session()->setFlashdata('message', 'Updated Successfully!');
                            session()->setFlashdata('alert-class', 'alert-success');
                            return $this->response->redirect(site_url('terms'));
                            } else {
                            session()->setFlashdata('message', 'Do not Update!');
                            session()->setFlashdata('alert-class', 'alert-danger');
                            return $this->response->redirect(site_url('terms'));
                            }
                        }
                    }else {
                        return redirect()->to('login');
                    } 
                        
                }

        
            public function who()
            {   
                $session = session();
                if($session->has('ID')) 
                {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'title' => 'required',
                    'subtitle' => 'required',
                    'image' => 'uploaded[image]',
                    'content' => 'required'
                    ]);
                    if (!$input) {
                    session()->setFlashdata('message', 'Please fill all data!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('who'));
                    }
                    else {
                    $file = $this->request->getFile('image');
                    $image =  "who_".$file->getName();
                    if($file->isValid()) {
                    $file->move('./assets/images/upload_image/', $image, true);
                    }
                    $whoModel = new whoModel();
                    // Add operation
                    echo  $who_Id = $whoModel->insert_data(array(
                    "who_title" => $this->request->getVar('title'),
                    "who_subtitle" => $this->request->getVar('subtitle'),
                    "who_image" => $image,
                    "who_content" => $this->request->getVar('content'),
                    ));
                    if(!empty($who_Id) || $who_Id != '' || $who_Id != 0) 
                    {
                    session()->setFlashdata('message', 'Added Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('who'));
                    } else {
                    session()->setFlashdata('message', 'Do not Add!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('who'));
                    }
                    }
            }else {
                return redirect()->to('login');
            } 
         }
        public function who_update()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
                $input = $this->validate([
                'title' => 'required',
                'subtitle' => 'required',
                'image' => 'uploaded[image]',
                'content' => 'required'
                ]);
                if (!$input) {
                session()->setFlashdata('message', 'Please fill all data!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('who'));
                }
                else {
                $file = $this->request->getFile('image');
                $image =  "who_".$file->getName();
                if($file->isValid()) {
                $file->move('./assets/images/upload_image/', $image, true);
                }
                echo  $id = $this->request->getVar('id');
                $whoModel = new whoModel();
                // Add operation
                $who_Id = $whoModel->update_data($id, array(
                "who_title" =>    $this->request->getVar('title'),
                "who_subtitle" => $this->request->getVar('subtitle'),
                "who_image" =>    $image,
                "who_content" =>  $this->request->getVar('content'),
                ));
                if(!empty($who_Id) || $who_Id != '' || $who_Id != 0) 
                 {
                session()->setFlashdata('message', 'Updated Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $this->response->redirect(site_url('who'));
                } else 
                {
                session()->setFlashdata('message', 'Do not Updated!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('who'));
                }
                }
            }else {
                return redirect()->to('login');
            } 
            
        }

        public function who_delete($id)
        {
            
            $whoModel = new whoModel();
            $whoModel->where('id',$id)->delete();
            return redirect(site_url('who'));

        }
        
        public function happycustomer()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
                $input = $this->validate([
                'name' => 'required',
                'message' => 'required',
                'image' => 'uploaded[image]'
                ]);
                if (!$input) 
                {
                session()->setFlashdata('message', 'Please fill all data!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('happycustomer'));         
                }
                else{
                $file = $this->request->getFile('image');
                $image = "happycustomer_".$file->getName();;
                if($file->isValid()) 
                {
                $file->move('./assets/images/upload_image/', $image, true);
                } 
                 $happycustomerModel = new happycustomerModel();
                 // Add operation
                $cust_Id = $happycustomerModel->insert_data(array(
                "cust_name" => $this->request->getVar('name'),
                "cust_msg" => $this->request->getVar('message'),
                "cust_image" => $image,
                ));
                 if(!empty($cust_Id) || $cust_Id != '' || $cust_Id != 0) 
                 {
                session()->setFlashdata('message', 'Added Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $this->response->redirect(site_url('happycustomer'));
                 }
                 else 
                {
                session()->setFlashdata('message', 'Do not Add!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('happycustomer'));
                }
                }
            }else {
                return redirect()->to('login');
            } 
            
        }


        public function happycustomer_update()
        {  
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
                $input = $this->validate([
                'name' => 'required',
                'message' => 'required',
                'image' => 'uploaded[image]'
                 ]);
                if (!$input) 
                {
                session()->setFlashdata('message', 'Please fill all data!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('happycustomer'));         
                }
                else
                 {
                $file = $this->request->getFile('image');
                $image = "happycustomer_".$file->getName();
                if($file->isValid()) {
                $file->move('./assets/images/upload_image/', $image, true);
                 }
                echo  $id = $this->request->getVar('id');
                $happycustomerModel = new happycustomerModel();
                // Add operation
                $cust_Id = $happycustomerModel->update_data( $id, array(
                "cust_name" => $this->request->getVar('name'),
                "cust_msg" => $this->request->getVar('message'),
                "cust_image" => $image,
                ));
                if(!empty($cust_Id) || $cust_Id != '' || $cust_Id != 0) 
                {
                session()->setFlashdata('message', 'Updated Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $this->response->redirect(site_url('happycustomer'));
                }
                else 
                {
                session()->setFlashdata('message', 'Do not Update!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('happycustomer'));
                }
                }
            }else {
                return redirect()->to('login');
            } 
           
        }
                // multibranches
                public function multibranches()
                {  
                    $session = session();
                    if($session->has('ID')) 
                    { 
                        $validation =  \Config\Services::validation();
                        $input = $this->validate([
                        'title' => 'required',
                        'drop' => 'required',
                        'branch' => 'required',
                        'address' => 'required',
                        ]);
                        if (!$input) {
                        session()->setFlashdata('message', 'Please fill all data!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('multibranches'));         
                        } 
                        else {
                        $multibranchesModel = new multibranchesModel();
                        // Add operation
                        $multi_Id = $multibranchesModel->insert_data(array(
                        "multi_title" => $this->request->getVar('title'),
                        "multi_drop" => $this->request->getVar('drop'),
                        "branch_location" => $this->request->getVar('branch'),
                        "branch_address" => $this->request->getVar('address'),
                        ));
                        if(!empty($multi_Id) || $multi_Id != '' || $multi_Id != 0) {
                        session()->setFlashdata('message', 'Added Successfully!');
                        session()->setFlashdata('alert-class', 'alert-success');
                        return $this->response->redirect(site_url('multibranches'));
                        } else {
                        session()->setFlashdata('message', 'Do not Add!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('multibranches'));
                        }
                        }
                    } else {
                        return redirect()->to('login');
                    }
    
                }
              
                 //Update
                public function editMultibranches()
                     {
                $session = session();
                if($session->has('ID')) 
                {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'title' => 'required',
                    'drop' => 'required',
                    'branch' => 'required',
                    'address' => 'required',
                    ]);
                    if (!$input) {
                    session()->setFlashdata('message', 'Please fill all data!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('multibranches'));         
                    } 
                    else {
                    echo  $id = $this->request->getVar('id');
                    $multibranchesModel = new multibranchesModel();
                    // Add operation
                    $multi_Id = $multibranchesModel->update_data($this->request->getVar('id'), array(
                    "multi_title" => $this->request->getVar('title'),
                    "multi_drop" => $this->request->getVar('drop'),
                    "branch_location" => $this->request->getVar('branch'),
                    "branch_address" => $this->request->getVar('address'),
                    ));
                    if(!empty($multi_Id) || $multi_Id != '' || $multi_Id != 0) {
                    session()->setFlashdata('message', 'Updated Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('multibranches'));
                    } else {
                    session()->setFlashdata('message', 'Do not Update!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('multibranches'));
                    }
                    }
                }else {
                    return redirect()->to('login');
                }

            }
            
             //Delete Multibranches
             public  function deleteMultibranches()
             {
                 $id = $this->request->getVar('id');
                 $multibranchesModel = new multibranchesModel();
                 $multi_Id = $multibranchesModel->delete_data($id);
                 return $this->response->redirect(site_url('multibranches'));
             }


            public function multibranches_update()
            {
                $session = session();
                if($session->has('ID')) 
                {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'title' => 'required',
                    'drop' => 'required',
                    'branch' => 'required',
                    'address' => 'required',
                    ]);
                    if (!$input) {
                    session()->setFlashdata('message', 'Please fill all data!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('multibranches'));         
                    } 
                    else {
                    echo  $id = $this->request->getVar('id');
                    $multibranchesModel = new multibranchesModel();
                    // Add operation
                    $multi_Id = $multibranchesModel->update_data($id, array(
                    "multi_title" => $this->request->getVar('title'),
                    "multi_drop" => $this->request->getVar('drop'),
                    "branch_location" => $this->request->getVar('branch'),
                    "branch_address" => $this->request->getVar('address'),
                    ));
                    if(!empty($multi_Id) || $multi_Id != '' || $multi_Id != 0) {
                    session()->setFlashdata('message', 'Updated Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('multibranches'));
                    } else {
                    session()->setFlashdata('message', 'Do not Update!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('multibranches'));
                    }
                    }
                }else {
                    return redirect()->to('login');
                }

            }

            public function vission()
            {   
                $session = session();
                if($session->has('ID')) 
                {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'title' => 'required',
                    'image' => 'uploaded[image]',
                    'content' => 'required'
                    ]);
                    if (!$input) {
                    session()->setFlashdata('message', 'Please fill all data!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('vission'));
                    }
                    else {
                    $file = $this->request->getFile('image');
                    $vission ="vission_".$file->getName();
                    if($file->isValid()) {
                    $file->move('./assets/images/upload_image/', $vission, true);
                    }  
                    $vissionModel = new vissionModel();
                    // Add operation
                    $vission_Id = $vissionModel->insert_data(array(
                    "vission_title" =>  $this->request->getVar('title'),
                    "vission_image" =>  $vission,
                    "vission_content" => $this->request->getVar('content'),
                    ));
                    if(!empty($vission_Id) || $vission_Id != '' || $vission_Id != 0) {
                    session()->setFlashdata('message', 'Added Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('vission'));
                    } else {
                    session()->setFlashdata('message', 'Do not Add!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('vission'));
                    }
                    
                    }
                }else {
                    return redirect()->to('login');
                }
            }
            
            public function vission_update()
            {
                $session = session();
                if($session->has('ID')) 
                {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'title' => 'required',
                    'image' => 'uploaded[image]',
                    'content' => 'required'
                    ]);
                    if (!$input) {
                    session()->setFlashdata('message', 'Please fill all data!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('vission'));
                    }
                    else {
                    $file = $this->request->getFile('image');
                    $vission ="vission_".$file->getName();
                    if($file->isValid()) {
                    $file->move('./assets/images/upload_image/', $vission, true);
                    }  
                    echo  $id = $this->request->getVar('id');
                    $vissionModel = new vissionModel();
                    // Add operation
                    $vission_Id = $vissionModel->update_data($id, array(
                     "vission_title" =>  $this->request->getVar('title'),
                     "vission_image" =>  $vission,
                     "vission_content" => $this->request->getVar('content'),
                    ));
                    if(!empty($vission_Id) || $vission_Id != '' || $vission_Id != 0) {
                     session()->setFlashdata('message', 'Updated Successfully!');
                     session()->setFlashdata('alert-class', 'alert-success');
                     return $this->response->redirect(site_url('vission'));
                     } else {
                     session()->setFlashdata('message', 'Do not Update!');
                     session()->setFlashdata('alert-class', 'alert-danger');
                     return $this->response->redirect(site_url('vission'));
                    }
                    }
                }else {
                    return redirect()->to('login');
                }
            }
            public function mission()
            {   
                $session = session();
                if($session->has('ID')) 
                {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'title' => 'required',
                    'image' => 'uploaded[image]',
                    'content' => 'required'
                    ]);
                    if (!$input) {
                    session()->setFlashdata('message', 'Please fill all data!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('mission'));
                    }
                    else {
                    $file = $this->request->getFile('image');
                    $mission = "mission_".$file->getName();;
                    if($file->isValid()) {
                    $file->move('./assets/images/upload_image/', $mission, true);
                    }  
                    $missionModel = new missionModel();
                    // Add operation
                    $mission_Id = $missionModel->insert_data(array(
                    "mission_title" =>  $this->request->getVar('title'),
                    "mission_image" =>  $mission,
                    "mission_contents" => $this->request->getVar('content'),
                    ));
                    if(!empty($mission_Id) || $mission_Id != '' || $mission_Id != 0) {
                    session()->setFlashdata('message', 'Added Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('mission'));
                    } else {
                    session()->setFlashdata('message', 'Do not Add!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('mission'));
                    }
                    }
                }
                else {
                    return redirect()->to('login');
                }
            }
            public function mission_update()
            {  
                $session = session();
                if($session->has('ID')) 
                { 
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'title' => 'required',
                    'image' => 'uploaded[image]',
                    'content' => 'required'
                    ]);
                    if (!$input) {
                    session()->setFlashdata('message', 'Please fill all data!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('mission'));
                    }
                    else {
                    $file = $this->request->getFile('image');
                    $mission = "mission_".$file->getName();
                    if($file->isValid()) {
                    $file->move('./assets/images/upload_image/', $mission, true);
                    }  
                    $id = $this->request->getVar('id');
                    $missionModel = new missionModel();
                    // Add operation
                    $mission_Id = $missionModel->update_data($id, array(
                    "mission_title" =>  $this->request->getVar('title'),
                    "mission_image" =>  $mission,
                    "mission_contents" => $this->request->getVar('content'),
                    ));
                    if(!empty($mission_Id) || $mission_Id != '' || $mission_Id != 0) {
                    session()->setFlashdata('message', 'Updated Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('mission'));
                    } else {
                    session()->setFlashdata('message', 'Do not Update!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('mission'));
                    }
                   }
                }else{
                    return redirect()->to('login'); 
                }
                
            }
        public function logout() {
            $session = session();
            $session->destroy();
            return redirect()->to('login');
        }
    

        //services
        //Add services
        public function add_service()
        {   
            $session = session();
            if($session->has('ID')) 
            {
                $validation =  \Config\Services::validation();
            $input = $this->validate([
            'service' => 'required'
            ]);
            if (!$input) {
            session()->setFlashdata('message', 'Please fill all data!');
            session()->setFlashdata('alert-class', 'alert-danger');
            return $this->response->redirect(site_url('add_service'));
            }else{
            $add_serviceModel = new add_serviceModel();
            // Add operation
            $service_Id = $add_serviceModel->insert_data(array(
            "service_name" =>  $this->request->getVar('service')
            ));
            if(!empty($service_Id) || $service_Id != '' || $service_Id != 0) {
            session()->setFlashdata('message', 'Added Successfully!');
            session()->setFlashdata('alert-class', 'alert-success');
            return $this->response->redirect(site_url('add_service'));
            } else {
            session()->setFlashdata('message', 'Do not Add!');
            session()->setFlashdata('alert-class', 'alert-danger');
            return $this->response->redirect(site_url('add_service'));
            }
            }
            }else {
            return redirect()->to('login');
     }
    }   
    //Update services
    public function editService()
    {   
        $session = session();
        if($session->has('ID')) 
        {
            $validation =  \Config\Services::validation();
        $input = $this->validate([
        'service' => 'required'
        ]);
        if (!$input) {
        session()->setFlashdata('message', 'Please fill all data!');
        session()->setFlashdata('alert-class', 'alert-danger');
        return $this->response->redirect(site_url('add_service'));
        }else{
        $add_serviceModel = new add_serviceModel();
        // Add operation
        $service_Id = $add_serviceModel->update_data($this->request->getVar('id'),array(
        "service_name" =>  $this->request->getVar('service')
        ));
        if(!empty($service_Id) || $service_Id != '' || $service_Id != 0) {
        session()->setFlashdata('message', 'Updated Successfully!');
        session()->setFlashdata('alert-class', 'alert-success');
        return $this->response->redirect(site_url('add_service'));
        } else {
        session()->setFlashdata('message', 'Do not Update!');
        session()->setFlashdata('alert-class', 'alert-danger');
        return $this->response->redirect(site_url('add_service'));
        }
        }
        }else {
        return redirect()->to('login');
 }
}   
     //Delete services
     public  function delete_add_service()
     {
         $id = $this->request->getVar('id');
         $add_serviceModel = new add_serviceModel();
         $service_Id = $add_serviceModel->delete_data($id);
         return $this->response->redirect(site_url('add_service'));
     }
        
     //Add services Contents
     public function services_content()
     {   
             $session = session();
             if($session->has('ID')) 
             {
             $validation =  \Config\Services::validation();
             $input = $this->validate([
             'ser_name' => 'required',
             'sub_service_name' => 'required',
             'service_sub' => 'required',
             'service_img' => 'uploaded[service_img]',
             'service_content' => 'required'
         ]);
         if (!$input) {
             session()->setFlashdata('message', 'Please fill all data!');
             session()->setFlashdata('alert-class', 'alert-danger');
             return $this->response->redirect(site_url('services_content'));
         }
         else{
             $file = $this->request->getFile('service_img');
             $service = "service".$this->request->getVar('sub_service_name').$file->getName();
             if($file->isValid()) {
             $file->move('./assets/images/upload_image/', $service, true);
             }
             $services_contentModel = new services_contentModel();
             // Add operation
             $service_Id = $services_contentModel->insert_data(array(
             "services_id" =>  $this->request->getVar('ser_name'),
             "services_name" =>  $this->request->getVar('sername'),
             "sub_service_name" =>  $this->request->getVar('sub_service_name'),
             "service_subtitle" =>  $this->request->getVar('service_sub'),
             "service_image" =>  $service,
             "service_content" => $this->request->getVar('service_content'),
         ));
                if(!empty($service_Id) || $service_Id != '' || $service_Id != 0) {
                    session()->setFlashdata('message', 'Added Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('services_content'));
                    } else {
                    session()->setFlashdata('message', 'Do not Add!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('services_content'));
                }
            } 
                }else {
                    return redirect()->to('login');
                }
        }
        //Update services Contents
        public function edit_services_content()
        {   
            $session = session();
            if($session->has('ID')) 
            {
            $validation =  \Config\Services::validation();
            $input = $this->validate([
            'ser_name' => 'required',
            'sub_service_name' => 'required',
            'service_sub' => 'required',
            'service_content' => 'required'
            ]);
            if (!$input) {
            session()->setFlashdata('message', 'Please fill all data!');
            session()->setFlashdata('alert-class', 'alert-danger');
            return $this->response->redirect(site_url('services_content'));
            }
            else{
            if($this->request->getFile('service_img') == "") {
            $service = $this->request->getVar('hdn_serv_img');
            } else {
            $file = $this->request->getFile('service_img');
            $service = "service".$this->request->getVar('sub_service_name').$file->getName();
            if($file->isValid()) {
            $file->move('./assets/images/upload_image/', $service, true);
            }
        }
            $services_contentModel = new services_contentModel();
            // Add operation
            $service_Id = $services_contentModel->update_data($this->request->getVar('id'), array(
                "services_id" =>        $this->request->getVar('ser_name'),
                "services_name" =>      $this->request->getVar('sername'),
                "sub_service_name" =>      $this->request->getVar('sub_service_name'),
                "service_subtitle" =>   $this->request->getVar('service_sub'),
                "service_image" =>      $service,
                "service_content" =>    $this->request->getVar('service_content'),
                "status" => 1
            ));
            if(!empty($service_Id) || $service_Id != '' || $service_Id != 0) {
            session()->setFlashdata('message', 'Updated Successfully!');
            session()->setFlashdata('alert-class', 'alert-success');
            return $this->response->redirect(site_url('services_content'));
            } else {
            session()->setFlashdata('message', 'Do not Update!');
            session()->setFlashdata('alert-class', 'alert-danger');
            return $this->response->redirect(site_url('services_content'));
        }
        } 
        }else {
            return redirect()->to('login');
        }
        }
        //Delete Services content
        public  function delete_service_content()
        {
            $id = $this->request->getVar('services_id');
            $services_contentModel = new services_contentModel();
            $prod_Id = $services_contentModel->delete_data($id,array());
            return $this->response->redirect(site_url('services_content'));
        }
            //Ourstory

            //Insert
            public function ourstory()
            {  
                $session = session();
                if($session->has('ID')) 
                {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                        'ourstory' => 'required',
                        'story_subtitle' => 'required',
                        'story_img' => 'uploaded[story_img]',
                        'story_content' => 'required'
                    ]);
                    if (!$input) {
                        session()->setFlashdata('message', 'Please fill all data!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('ourstory'));
                    } 
                    else{
                        $file = $this->request->getFile('story_img');
                        $ourstory = "ourstory_".$file->getName();
                        if($file->isValid()) {
                        $file->move('./assets/images/upload_image/', $ourstory, true);
                        }
                        $ourstoryModel = new ourstoryModel();
                        // Add operation
                        $story_Id = $ourstoryModel->insert_data(array(
                        "our_story_title" =>  $this->request->getVar('ourstory'),
                        "our_story_subtitle" =>  $this->request->getVar('story_subtitle'),
                        "our_story_image" =>  $ourstory,
                        "our_story_content" => $this->request->getVar('story_content'),
                    ));
                    if(!empty($story_Id) || $story_Id != '' || $story_Id != 0) {
                        session()->setFlashdata('message', 'Added Successfully!');
                        session()->setFlashdata('alert-class', 'alert-success');
                        return $this->response->redirect(site_url('ourstory'));
                        } else {
                        session()->setFlashdata('message', 'Do not Add!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('ourstory'));
                    } 
                } 
                }else {
                        return redirect()->to('login');
                    }
               
             }
              //Update Our Story
             public function editourstory()
             {  
                 $session = session();
                 if($session->has('ID')) 
                 {
                     $validation =  \Config\Services::validation();
                     $input = $this->validate([
                         'ourstory' => 'required',
                         'story_subtitle' => 'required',
                         'story_content' => 'required'
                     ]);
                     if (!$input) {
                         session()->setFlashdata('message', 'Please fill all data!');
                         session()->setFlashdata('alert-class', 'alert-danger');
                         return $this->response->redirect(site_url('ourstory'));
                     } 
                     else{
                         if($this->request->getFile('story_img') == "") {
                         $ourstory = $this->request->getVar('hdn_story');
                         }else{
                         $file = $this->request->getFile('story_img');
                         $ourstory = "ourstory_".$file->getName();
                         if($file->isValid()) {
                         $file->move('./assets/images/upload_image/', $ourstory, true);
                                }
                         }
                         $ourstoryModel = new ourstoryModel();
                         // Add operation
                         $story_Id = $ourstoryModel->update_data($this->request->getvar('id'),array(
                         "our_story_title" =>  $this->request->getVar('ourstory'),
                         "our_story_subtitle" =>  $this->request->getVar('story_subtitle'),
                         "our_story_image" =>  $ourstory,
                         "our_story_content" => $this->request->getVar('story_content'),
                     ));
                     if(!empty($story_Id) || $story_Id != '' || $story_Id != 0) {
                         session()->setFlashdata('message', 'Updated Successfully!');
                         session()->setFlashdata('alert-class', 'alert-success');
                         return $this->response->redirect(site_url('ourstory'));
                         } else {
                         session()->setFlashdata('message', 'Do not Update!');
                         session()->setFlashdata('alert-class', 'alert-danger');
                         return $this->response->redirect(site_url('ourstory'));
                     } 
                 } 
                 }else {
                         return redirect()->to('login');
                     }
                
              }
              
               //Delete Our Story
               public  function deleteOurStory()
               {
                   $id = $this->request->getVar('id');
                   $ourstoryModel = new ourstoryModel();
                   $story_Id = $ourstoryModel->delete_data($id);
                   return $this->response->redirect(site_url('ourstory'));
               }


            //Our Expertise
            public function ourexpertise()
            {  
                $session = session();
                if($session->has('ID')) 
                {
                   $validation =  \Config\Services::validation();
                   $input = $this->validate([
                       'expertise' => 'required',
                       'expertise_subtitle' => 'required',
                       'expertise_img' => 'uploaded[expertise_img]',
                       'expertise_content' => 'required'
                   ]);
                   if (!$input) {
                       session()->setFlashdata('message', 'Please fill all data!');
                       session()->setFlashdata('alert-class', 'alert-danger');
                       return $this->response->redirect(site_url('ourexpertise'));
                   } 
                   else{
                       $file = $this->request->getFile('expertise_img');
                       $ourexpertise = "ourexpertise".$file->getName();
                       if($file->isValid()) {
                       $file->move('./assets/images/upload_image/', $ourexpertise, true);
                       }
                       $ourexpertiseModel = new ourexpertiseModel();
                       // Add operation
                       $expertise_Id = $ourexpertiseModel->insert_data(array(
                       "our_expertise_title" =>  $this->request->getVar('expertise'),
                       "our_expertise_subtitle" =>  $this->request->getVar('expertise_subtitle'),
                       "our_expertise_image" =>  $ourexpertise,
                       "our_expertise_content" => $this->request->getVar('expertise_content'),
                       ));
                       if(!empty($expertise_Id) || $expertise_Id != '' || $expertise_Id != 0) {
                       session()->setFlashdata('message', 'Added Successfully!');
                       session()->setFlashdata('alert-class', 'alert-success');
                       return $this->response->redirect(site_url('ourexpertise'));
                       } else {
                       session()->setFlashdata('message', 'Do not Add!');
                       session()->setFlashdata('alert-class', 'alert-danger');
                       return $this->response->redirect(site_url('ourexpertise'));
                           } 
                       } 
                       }else {
                           return redirect()->to('login');
                       }
          
                   }

                   //Update
                   public function editOurexpertise()
                   {  
                       $session = session();
                       if($session->has('ID')) 
                       {
                          $validation =  \Config\Services::validation();
                          $input = $this->validate([
                              'expertise' => 'required',
                              'expertise_subtitle' => 'required',
                              'expertise_content' => 'required'
                          ]);
                          if (!$input) {
                              session()->setFlashdata('message', 'Please fill all data!');
                              session()->setFlashdata('alert-class', 'alert-danger');
                              return $this->response->redirect(site_url('ourexpertise'));
                          } 
                           else{
                               if($this->request->getFile('expertise_img') == "") {
                               $ourexpertise = $this->request->getVar('hdn_exp_img');
                               }else{
                               $file = $this->request->getFile('expertise_img');
                               $ourexpertise = "ourexpertise".$file->getName();
                               if($file->isValid()) {
                               $file->move('./assets/images/upload_image/',$ourexpertise, true);
                               }
                              }
                              $ourexpertiseModel = new ourexpertiseModel();
                              // Add operation
                              $expertise_Id = $ourexpertiseModel->update_data($this->request->getvar('id'),array(
                              "our_expertise_title" =>  $this->request->getVar('expertise'),
                              "our_expertise_subtitle" =>  $this->request->getVar('expertise_subtitle'),
                              "our_expertise_image" =>  $ourexpertise,
                              "our_expertise_content" => $this->request->getVar('expertise_content'),
                              ));
                              if(!empty($expertise_Id) || $expertise_Id != '' || $expertise_Id != 0) {
                              session()->setFlashdata('message', 'Updated Successfully!');
                              session()->setFlashdata('alert-class', 'alert-success');
                              return $this->response->redirect(site_url('ourexpertise'));
                              } else {
                              session()->setFlashdata('message', 'Do not Update!');
                              session()->setFlashdata('alert-class', 'alert-danger');
                              return $this->response->redirect(site_url('ourexpertise'));
                                  } 
                              } 
                              }else {
                                  return redirect()->to('login');
                              }
                           }

                           //Delete
                    
                    public  function deleteOurexpertise()
                    {
                        $id = $this->request->getVar('id');
                        $ourexpertiseModel = new ourexpertiseModel();
                        $expertise_Id = $ourexpertiseModel->delete_data($id);
                        return $this->response->redirect(site_url('ourexpertise'));
                    }


        //Project Category
       public function proj_category()
       {   
           $session = session();
           if($session->has('ID')) 
           {
               $validation =  \Config\Services::validation();
           $input = $this->validate([
           'proj_category' => 'required'
           ]);
           if (!$input) {
           session()->setFlashdata('message', 'Please fill all data!');
           session()->setFlashdata('alert-class', 'alert-danger');
           return $this->response->redirect(site_url('proj_category'));
           }else{
           $proj_categoryModel = new proj_categoryModel();
           // Add operation
           $proj_Id = $proj_categoryModel->insert_data(array(
           "project_category" =>  $this->request->getVar('proj_category')
           ));
           if(!empty($proj_Id) || $proj_Id != '' || $proj_Id != 0) {
           session()->setFlashdata('message', 'Added Successfully!');
           session()->setFlashdata('alert-class', 'alert-success');
           return $this->response->redirect(site_url('proj_category'));
           } else {
           session()->setFlashdata('message', 'Do not Add!');
           session()->setFlashdata('alert-class', 'alert-danger');
           return $this->response->redirect(site_url('proj_category'));
           }
           }
           }else {
           return redirect()->to('login');
           }
       }
   //Update
   public function edit_project_category()
   {
       $session = session();
           if($session->has('ID')) 
           {
               $validation =  \Config\Services::validation();
           $input = $this->validate([
           'proj_category' => 'required'
           ]);
           if (!$input) {
           session()->setFlashdata('message', 'Please fill all data!');
           session()->setFlashdata('alert-class', 'alert-danger');
           return $this->response->redirect(site_url('proj_category'));
           }else{
           $proj_categoryModel = new proj_categoryModel();
           // Add operation
           $proj_Id = $proj_categoryModel->update_data($this->request->getvar('id'),array(
           "project_category" =>  $this->request->getVar('proj_category')
           ));
           if(!empty($proj_Id) || $proj_Id != '' || $proj_Id != 0) {
           session()->setFlashdata('message', 'Updated Successfully!');
           session()->setFlashdata('alert-class', 'alert-success');
           return $this->response->redirect(site_url('proj_category'));
           } else {
           session()->setFlashdata('message', 'Do not Update!');
           session()->setFlashdata('alert-class', 'alert-danger');
           return $this->response->redirect(site_url('proj_category'));
           }
           }
           }else {
           return redirect()->to('login');
           }
       
       }
       //Delete Project category
       public function delete_proj_category()
       {
         echo  $id = $this->request->getVar('id_class');
           $proj_categoryModel = new proj_categoryModel();
           $proj_Id = $proj_categoryModel->delete_data($id,array());
           return $this->response->redirect(site_url('proj_category'));
       }
           //Project

            //Insert
            public function add_proj_name()
            {   
                $session = session();
                if($session->has('ID')) 
                {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                        'proj_name' => 'required',
                        'proj_image' => 'uploaded[proj_image]',
                        'proj_url' => 'required',
                        'project_category' => 'required',
                        'proj_start_date' => 'required',
                        'proj_end_date' => 'required',
                        'proj_type' => 'required',
                        'proj_price' => 'required'

                    ]);
                    if (!$input) {
                        session()->setFlashdata('message', 'Please fill all data!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('add_proj_name'));
                    }
                    else {
                        $file = $this->request->getFile('proj_image');
                        echo $project = "project_".$file->getName();
                        if($file->isValid()) {
                        $file->move('./assets/images/upload_image/project_img/', $project,true);
                        }  
                    
                        $add_proj_nameModel = new add_proj_nameModel();
                        // Add operation
                        $proj_Id = $add_proj_nameModel->insert_data(array(
                            "project_name" =>  $this->request->getVar('proj_name'),
                            "proj_images" =>  $project,
                            "proj_url" => $this->request->getVar('proj_url'),
                            "project_category" => $this->request->getVar('project_category'),
                            "proj_start_date" => $this->request->getVar('proj_start_date'),
                            "proj_end_date" => $this->request->getVar('proj_end_date'),
                            "project_type" => $this->request->getVar('proj_type'),
                            "project_price" => $this->request->getVar('proj_price'),

                        ));
                        if(!empty($proj_Id) || $proj_Id != '' || $proj_Id != 0) {
                            session()->setFlashdata('message', 'Added Successfully!');
                            session()->setFlashdata('alert-class', 'alert-success');
                            return $this->response->redirect(site_url('add_proj_name'));
                            } else {
                            session()->setFlashdata('message', 'Do not Add!');
                            session()->setFlashdata('alert-class', 'alert-danger');
                            return $this->response->redirect(site_url('add_proj_name'));
                        }
                        
                    }
                }else {
                    return redirect()->to('login');
                }
            }

            //Update
            public function edit_project_name()
            {   
               echo $this->request->getVar('proj_cat_name');
                $session = session();
                if($session->has('ID')) 
                { 
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                        'project_name' => 'required',
                        'proj_url' => 'required',
                        'proj_cat_name' => 'required',
                        'proj_start_date' => 'required',
                        'proj_end_date' => 'required',
                        'proj_type' => 'required',
                        'proj_price' => 'required' 
                    ]);
                    if (!$input) {
                        session()->setFlashdata('message', 'Please fill all data!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('add_proj_name'));
                    }
                    else {
                        if($this->request->getFile('proj_image') == "") {
                           $project = $this->request->getVar('hdn_proj_img');
                           } else {
                           $file = $this->request->getFile('proj_image');
                           $project = "project".$file->getName();
                           if($file->isValid()) {
                           $file->move('./assets/images/upload_image/project_img/', $project, true);
                           }
                       }
                        $add_proj_nameModel = new add_proj_nameModel();
                        // Add operation
                        $proj_Id = $add_proj_nameModel->update_data($this->request->getvar('id'),array(
                           "project_name" =>  $this->request->getVar('project_name'),
                           "proj_images" =>  $project,
                           "proj_url" => $this->request->getVar('proj_url'),
                           "project_category" => $this->request->getVar('proj_cat_name'), 
                           "proj_start_date" => $this->request->getVar('proj_start_date'),
                           "proj_end_date" => $this->request->getVar('proj_end_date'),
                           "project_type" => $this->request->getVar('proj_type'),
                           "project_price" => $this->request->getVar('proj_price'),
                          ));
                        if(!empty($proj_Id) || $proj_Id != '' || $proj_Id != 0) {
                            session()->setFlashdata('message', 'Updated Successfully!');
                            session()->setFlashdata('alert-class', 'alert-success');
                            return $this->response->redirect(site_url('add_proj_name'));
                            } else {
                            session()->setFlashdata('message', 'Do not Update!');
                            session()->setFlashdata('alert-class', 'alert-danger');
                           return $this->response->redirect(site_url('add_proj_name'));
                        }
                       
                    }
                }else {
                    return redirect()->to('login');
                }
            }

             //Delete Project Name
               public function delete_proj_name()
               {
               echo  $id = $this->request->getVar('id');
                   $add_proj_nameModel = new add_proj_nameModel();
                   $proj_Id = $add_proj_nameModel->delete_data($id,array());
                   return $this->response->redirect(site_url('add_proj_name'));
               }
             //Add Project Contents
               public function proj_contents()
               {   
                       $session = session();
                       if($session->has('ID')) 
                       {
                       $validation =  \Config\Services::validation();
                       $input = $this->validate([
                       'project_name' => 'required',
                       'proj_img'=> 'uploaded[proj_img]'
                       . '|mime_in[proj_img,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                       'proj_content' => 'required'
                       ]);
                       if (!$input) {
                       session()->setFlashdata('message', 'Please fill all data!');
                       session()->setFlashdata('alert-class', 'alert-danger');
                       return $this->response->redirect(site_url('proj_contents'));
                       }
                       else{
                       $file = $this->request->getFile('proj_img');
                       $project = "project".$file->getName();
                       if($file->isValid()) {
                       $file->move('./assets/images/upload_image/project_img/', $project, true);
                       }
                       $proj_contentsModel = new proj_contentsModel();
                       // Add operation
                       $project_Id = $proj_contentsModel->insert_data(array(
                       "proj_name" =>  $this->request->getVar('project_name'),
                       "project_images" =>  $project,
                       "project_contents" => $this->request->getVar('proj_content'),
                       ));
                       if(!empty($project_Id) || $project_Id != '' || $project_Id != 0) {
                       session()->setFlashdata('message', 'Added Successfully!');
                       session()->setFlashdata('alert-class', 'alert-success');
                       return $this->response->redirect(site_url('proj_contents'));
                       } else {
                       session()->setFlashdata('message', 'Do not Add!');
                       session()->setFlashdata('alert-class', 'alert-danger');
                       return $this->response->redirect(site_url('proj_contents'));
                        }
                        } 
                       }else {
                       return redirect()->to('login');
                   }
               }
           
           //Update
           public function edit_proj_contents()
           {   
               $session = session();
               if($session->has('ID')) 
               {
                   $validation =  \Config\Services::validation();
                   $input = $this->validate([
                   'project_name' => 'required',
                   'proj_content' => 'required'
               ]);
                   if (!$input) {
                   session()->setFlashdata('message', 'Please fill all data!');
                   session()->setFlashdata('alert-class', 'alert-danger');
                   return $this->response->redirect(site_url('proj_contents'));
                   }
                   else {
                        if($this->request->getFile('proj_img') == "") {
                           $project = $this->request->getVar('hdn_proj_img');
                           }else{
                           $file = $this->request->getFile('proj_img');
                           $project = "project".$file->getName();
                           if($file->isValid()) {
                           $file->move('./assets/images/upload_image/project_img/',$project, true);
                           }
                    }  
                    
                   $proj_contentsModel = new proj_contentsModel();
                   // Add operation
                   $proj_Id = $proj_contentsModel->update_data($this->request->getVar('id'),array(
                   "proj_name" =>  $this->request->getVar('project_name'),
                   "project_images" =>  $project,
                   "project_contents" => $this->request->getVar('proj_content'),
                   // "status" => 1
                   ));
                   if(!empty($proj_Id) || $proj_Id != '' || $proj_Id != 0) {
                   session()->setFlashdata('message', 'Updated Successfully!');
                   session()->setFlashdata('alert-class', 'alert-success');
                   return $this->response->redirect(site_url('proj_contents'));
                   } else {
                   session()->setFlashdata('message', 'Do not Update!');
                   session()->setFlashdata('alert-class', 'alert-danger');
                   return $this->response->redirect(site_url('proj_contents'));
                   }
                   
                   }
               }else {
                   return redirect()->to('login');
               }
           }
           //Delete Project Content
           public function delete_proj_contents()
           {
           echo  $id = $this->request->getVar('id');
               $proj_contentsModel = new proj_contentsModel();
               $proj_Id = $proj_contentsModel->delete_data($id,array());
               return $this->response->redirect(site_url('proj_contents'));
           }

        //Partner
         public function add_partners()
         {   
             $session = session();
              if($session->has('ID')) 
              {
                 $validation =  \Config\Services::validation();
                 $input = $this->validate([
                 'partner_type' => 'required'
                 ]);
                 if (!$input) {
                 session()->setFlashdata('message', 'Please fill all data!');
                 session()->setFlashdata('alert-class', 'alert-danger');
                 return $this->response->redirect(site_url('add_partners'));
                 }else{
                 $partners_TypeModel = new partners_TypeModel();
                 // Add operation
                 $partner_Id = $partners_TypeModel->insert_data(array(
                 "partnersType" =>  $this->request->getVar('partner_type'),
                 ));
                  if(!empty($partner_Id) || $partner_Id != '' || $partner_Id != 0) {
                 session()->setFlashdata('message', 'Added Successfully!');
                 session()->setFlashdata('alert-class', 'alert-success');
                 return $this->response->redirect(site_url('add_partners'));
                 } else {
                 session()->setFlashdata('message', 'Do not Add!');
                 session()->setFlashdata('alert-class', 'alert-danger');
                 return $this->response->redirect(site_url('add_partners'));
                 }
                 }
                 }else {
                 return redirect()->to('login');
             }
         }

         public function edit_partner()
         {   
             $session = session();
              if($session->has('ID')) 
              {
                 $validation =  \Config\Services::validation();
                 $input = $this->validate([
                 'partner_type' => 'required',
                  ]);
                 if (!$input) {
                     session()->setFlashdata('message', 'Please fill all data!');
                     session()->setFlashdata('alert-class', 'alert-danger');
                     return $this->response->redirect(site_url('add_partners'));
                 }else{
                 $partners_TypeModel = new partners_TypeModel();
                 // Add operation
                 $partners_Id = $partners_TypeModel->update_data($this->request->getVar('id'),array(
                  "partnersType	" =>  $this->request->getVar('partner_type')
                  ));
                  if(!empty($partners_Id) || $partners_Id != '' || $partners_Id != 0) {
                     session()->setFlashdata('message', 'Updated Successfully!');
                     session()->setFlashdata('alert-class', 'alert-success');
                     return $this->response->redirect(site_url('add_partners'));
                 } else {
                     session()->setFlashdata('message', 'Do not Update!');
                     session()->setFlashdata('alert-class', 'alert-danger');
                     return $this->response->redirect(site_url('add_partners'));
                 }
                 }
             }else {
                 return redirect()->to('login');
             }
         }
         ////Delete Partner Type 
         public  function delete_partner()
         {
             $id = $this->request->getVar('id');
             $partners_TypeModel = new partners_TypeModel();
             $partner_Id = $partners_TypeModel->delete_data($id);
             return $this->response->redirect(site_url('add_partners'));
         }
         
         //Partners Content
             public function add_partners_content()
         {   
          $session = session();
          if($session->has('ID')) 
          {
           
              $validation =  \Config\Services::validation();
              $input = $this->validate([
                  'partner' => 'required',
                  'partners_Type'=>'required',
                  'partner_link'=>'required',
                  'partner_logo' => 'uploaded[partner_logo]',
                  'partner_content' => 'required'
              ]);
              if (!$input) {
                  session()->setFlashdata('message', 'Please fill all data!');
                  session()->setFlashdata('alert-class', 'alert-danger');
                  return $this->response->redirect(site_url('add_partners_content'));
              } 
               else{
                  $file = $this->request->getFile('partner_logo');
                  $partners = "partners_".$file->getName();
                  if($file->isValid()) {
                  $file->move('./assets/images/upload_image/partners/', $partners, true);
                  } 
                  $partners_contentModel = new partners_contentModel();
                          // Add operation
                  $partners_Id = $partners_contentModel->insert_data(array(
                  "partners_name" =>  $this->request->getVar('partner'),
                  "partnersType" =>  $this->request->getVar('partnerstype'),
                  "partners_logo" =>  $partners,
                  "partners_link" => $this->request->getVar('partner_link'),
                  "partners_contents" => $this->request->getVar('partner_content'),
                  ));
              if(!empty($partners_Id) || $partners_Id != '' || $partners_Id != 0) {
                  session()->setFlashdata('message', 'Added Successfully!');
                  session()->setFlashdata('alert-class', 'alert-success');
                  return $this->response->redirect(site_url('add_partners_content'));
                  } else {
                  session()->setFlashdata('message', 'Do not Add!');
                  session()->setFlashdata('alert-class', 'alert-danger');
                  return $this->response->redirect(site_url('add_partners_content'));
                  } 
      
              }
          }
          else {
              return redirect()->to('login');
          }
      }

    
      public function editpartnersContents()
      {   
       $session = session();
       if($session->has('ID')) 
       {
         
           $validation =  \Config\Services::validation();
           $input = $this->validate([
               'partner' => 'required',
               'partners_Type'=>'required',
               'partner_link'=>'required',
               'partner_content' => 'required'
           ]);
           if (!$input) {
               session()->setFlashdata('message', 'Please fill all data!');
               session()->setFlashdata('alert-class', 'alert-danger');
               return $this->response->redirect(site_url('add_partners_content'));
           } 
            else{
             if($this->request->getFile('partner_logo') == "") {
                 $partners = $this->request->getVar('hdn_partner_img');
             } else {
                $file = $this->request->getFile('partner_logo');
                $partners = "partners".$this->request->getVar('partner').$file->getName();
                if($file->isValid()) {
                $file->move('./assets/images/upload_image/partners/', $partners, true);
                
               }
               } 
               $partners_contentModel = new partners_contentModel();
                       // Add operation
               $partners_Id = $partners_contentModel->update_data($this->request->getVar('id'),array(
               "partners_name" =>  $this->request->getVar('partner'),
               "partnersType" =>  $this->request->getVar('partnerstype'),
               "partners_logo" =>  $partners,
               "partners_link" => $this->request->getVar('partner_link'),
               "partners_contents" => $this->request->getVar('partner_content'),
               ));
           if(!empty($partners_Id) || $partners_Id != '' || $partners_Id != 0) {
               session()->setFlashdata('message', 'Updated Successfully!');
               session()->setFlashdata('alert-class', 'alert-sucess');
               return $this->response->redirect(site_url('add_partners_content'));
               } else {
               session()->setFlashdata('message', 'Do not Update!');
               session()->setFlashdata('alert-class', 'alert-danger');
               return $this->response->redirect(site_url('add_partners_content'));
               } 
   
           }
       }
       else {
           return redirect()->to('login');
       }
   }

         //Delete
     public function deletePartnersContent()
     {
         
             $id = $this->request->getVar('id');
             $partners_contentModel = new partners_contentModel();
             $partners_Id = $partners_contentModel->delete_data($id);
             return $this->response->redirect(site_url('add_partners_content'));
         
     }

           //Fintech
           public function add_fintech()
            {   
                 $session = session();
                 if($session->has('ID')) 
                 {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'fintech' => 'required'
                    ]);
                    if (!$input) {
                    session()->setFlashdata('message', 'Please fill all data!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('add_fintech'));
                    }else{
                    $add_fintech_Model = new add_fintech_Model();
                    // Add operation
                    $fin_Id = $add_fintech_Model->insert_data(array(
                    "fintech_name" =>  $this->request->getVar('fintech'),
                    ));
                     if(!empty($fin_Id) || $fin_Id != '' || $fin_Id != 0) {
                    session()->setFlashdata('message', 'Added Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('add_fintech'));
                    } else {
                    session()->setFlashdata('message', 'Do not Add!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('add_fintech'));
                    }
                    }
                    }else {
                    return redirect()->to('login');
                }
            }

            public function edit_fintech()
            {   
                $session = session();
                 if($session->has('ID')) 
                 {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'fintech' => 'required',
                     ]);
                    if (!$input) {
                        session()->setFlashdata('message', 'Please fill all data!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('add_fintech'));
                    }else{
                    $add_fintech_Model = new add_fintech_Model();
                    // Add operation
                    $fin_Id = $add_fintech_Model->update_data($this->request->getVar('id'),array(
                     "fintech_name" =>  $this->request->getVar('fintech')
                     ));
                     if(!empty($fin_Id) || $fin_Id != '' || $fin_Id != 0) {
                        session()->setFlashdata('message', 'Updated Successfully!');
                        session()->setFlashdata('alert-class', 'alert-success');
                        return $this->response->redirect(site_url('add_fintech'));
                    } else {
                        session()->setFlashdata('message', 'Do not Update!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('add_fintech'));
                    }
                    }
                }else {
                    return redirect()->to('login');
                }
            }

            ////Delete Fintech Name 
            public  function delete_fintech()
            {
                $id = $this->request->getVar('id');
                $add_fintech_Model = new add_fintech_Model();
                $fin_Id = $add_fintech_Model->delete_data($id);
                return $this->response->redirect(site_url('add_fintech'));
            }
            //Fintech Contents
            public function add_fintech_content()
            {   
                $session = session();
                if($session->has('ID')) 
                {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'fintch_name' => 'required',
                    'fintch_title' => 'required',
                    'fintch_sub' => 'required',
                    'fintch_img' => 'uploaded[fintch_img]',
                    'fintch_content' => 'required'
                    ]);
                    if (!$input) {
                    session()->setFlashdata('message', 'Please fill all data!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('add_fintech_content'));
                    }
                    else {
                    $file = $this->request->getFile('fintch_img');
                    $fintch = "fintch".$file->getName();
                    if($file->isValid()) {
                    $file->move('./assets/images/upload_image/', $fintch, true);
                    }  
                    $fintech_contentsModel = new fintech_contentsModel();
                    // Add operation
                    $chain_Id = $fintech_contentsModel->insert_data(array(
                    "fintech_id" =>  $this->request->getVar('fintch_name'),
                    "fintech_name" =>  $this->request->getVar('fintchname'),
                    "fintech_title" =>  $this->request->getVar('fintch_title'),
                    "fintech_sub" =>  $this->request->getVar('fintch_sub'),
                    "fintech_img" =>  $fintch,
                    "fintech_content" => $this->request->getVar('fintch_content'),
                    ));
                    if(!empty($chain_Id) || $chain_Id != '' || $chain_Id != 0) {
                    session()->setFlashdata('message', 'Added Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('add_fintech_content'));
                    } else {
                    session()->setFlashdata('message', 'Do not Add!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('add_fintech_content'));
                    }
                    
                    }
                }else {
                    return redirect()->to('login');
                }
            }
            public function edit_fintech_contents()
            {   
                $session = session();
                if($session->has('ID')) 
                {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                    'fintch_name' => 'required',
                    'fintch_title' => 'required',
                    'fintch_sub' => 'required',
                    'fintch_content' => 'required'
                    ]);
                    if (!$input) {
                    session()->setFlashdata('message', 'Please fill all data!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('add_fintech_content'));
                    }
                    else {
                        if($this->request->getFile('fintch_img') == "") {
                            $fintch = $this->request->getVar('hdn_fintch_img');
                        } else {
                           $file = $this->request->getFile('fintch_img');
                           $fintch = "fintch".$this->request->getVar('fintchname').$file->getName();
                           if($file->isValid()) {
                           $file->move('./assets/images/upload_image/', $fintch, true);
                       }
                    }
                    $fintech_contentsModel = new fintech_contentsModel();
                    // Add operation
                    $chain_Id = $fintech_contentsModel->update_data($this->request->getVar('id'),array(
                    "fintech_id" =>  $this->request->getVar('fintch_name'),
                    "fintech_name" =>  $this->request->getVar('fintchname'),
                    "fintech_title" =>  $this->request->getVar('fintch_title'),
                    "fintech_sub" =>  $this->request->getVar('fintch_sub'),
                    "fintech_img" =>  $fintch,
                    "fintech_content" => $this->request->getVar('fintch_content'),
                    "status" => 1
                    ));
                    if(!empty($chain_Id) || $chain_Id != '' || $chain_Id != 0) {
                    session()->setFlashdata('message', 'Updated Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('add_fintech_content'));
                    } else {
                    session()->setFlashdata('message', 'Do not Update!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('add_fintech_content'));
                    }
                    
                    }
                }else {
                    return redirect()->to('login');
                }
            }

            //Delete Fintch Content
            public  function delete_fintech_contents()
            {
                $id = $this->request->getVar('fintch_id');
                $fintech_contentsModel = new fintech_contentsModel();
               $chain_Id = $fintech_contentsModel->delete_data($id,array());
               return $this->response->redirect(site_url('add_fintech_content'));
            }

            public function add_fintech_features()
            {   
                $session = session();
                if($session->has('ID')) 
                {
                   $validation =  \Config\Services::validation();
                   $input = $this->validate([
                        'fintchname' => 'required',
                        'title' => 'required',
                        'content' => 'required'
                   ]);

                   if (!$input) {
                   session()->setFlashdata('message', 'Please fill all data!');
                   session()->setFlashdata('alert-class', 'alert-danger');
                   return $this->response->redirect(site_url('add_fintech_features'));
                   }else{
                   $fintech_featuresModel = new fintech_featuresModel();
                   // Add operation
                   $fin_Id = $fintech_featuresModel->insert_data(array(
                   "fintech_id" =>  $this->request->getVar('fintch_name'),
                   "fintech_name" =>  $this->request->getVar('fintchname'),
                   "title" =>  $this->request->getVar('title'),
                   "content" =>  $this->request->getVar('content'),
                   ));
                    if(!empty($fin_Id) || $fin_Id != '' || $fin_Id != 0) {
                        session()->setFlashdata('message', 'Added Successfully!');
                        session()->setFlashdata('alert-class', 'alert-success');
                        return $this->response->redirect(site_url('add_fintech_features'));
                    } else {
                        session()->setFlashdata('message', 'Do not Add!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('add_fintech_features'));
                    }
                   }
                   }else {
                   return redirect()->to('login');
                }
            }
            // Edit Fintech Features
            public function edit_fintech_features()
            {   
                $session = session();
                 if($session->has('ID')) 
                 {
                    $validation =  \Config\Services::validation();
                    $input = $this->validate([
                        'fintchname' => 'required',
                        'title' => 'required',
                        'content' => 'required'
                     ]);
                    if (!$input) {
                        session()->setFlashdata('message', 'Please fill all data!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('add_fintech_features'));
                    }else{
                    $fintech_featuresModel = new fintech_featuresModel();
                    // Add operation
                    $fin_Id = $fintech_featuresModel->update_data($this->request->getVar('id'),array(
                        "fintech_id" =>  $this->request->getVar('fintch_name'),
                        "fintech_name" =>  $this->request->getVar('fintchname'),
                        "title" =>  $this->request->getVar('title'),
                        "content" =>  $this->request->getVar('content')
                     ));
                     if(!empty($fin_Id) || $fin_Id != '' || $fin_Id != 0) {
                        session()->setFlashdata('message', 'Updated Successfully!');
                        session()->setFlashdata('alert-class', 'alert-success');
                        return $this->response->redirect(site_url('add_fintech_features'));
                    } else {
                        session()->setFlashdata('message', 'Do not Update!');
                        session()->setFlashdata('alert-class', 'alert-danger');
                        return $this->response->redirect(site_url('add_fintech_features'));
                    }
                    }
                }else {
                    return redirect()->to('login');
                }
            }

            ////Delete Fintech Features 
            public  function delete_fintech_features()
            {
                $id = $this->request->getVar('id');
                $fintech_featuresModel = new fintech_featuresModel();
                $fin_Id = $fintech_featuresModel->delete_data($id);
                return $this->response->redirect(site_url('add_fintech'));
            }

             //Add Solutions
             public function add_solutions()
             {   
                 $session = session();
                 if($session->has('ID')) 
                 {
                     $validation =  \Config\Services::validation();
                 $input = $this->validate([
                 'solution' => 'required'
                 ]);
                 if (!$input) {
                 session()->setFlashdata('message', 'Please fill all data!');
                 session()->setFlashdata('alert-class', 'alert-danger');
                 return $this->response->redirect(site_url('add_solutions'));
                 }else{
                 $add_solutionModel = new add_solutionModel();
                 // Add operation
                 $solution_Id = $add_solutionModel->insert_data(array(
                 "solution_name" =>  $this->request->getVar('solution')
                 ));
                 if(!empty($solution_Id) || $solution_Id != '' || $solution_Id != 0) {
                 session()->setFlashdata('message', 'Added Successfully!');
                 session()->setFlashdata('alert-class', 'alert-success');
                 return $this->response->redirect(site_url('add_solutions'));
                 } else {
                 session()->setFlashdata('message', 'Do not Add!');
                 session()->setFlashdata('alert-class', 'alert-danger');
                 return $this->response->redirect(site_url('add_solutions'));
                 }
                 }
                 }else {
                 return redirect()->to('login');
          }
         }  
             //Update Solution Name
             
             public function edit_solutions()
             {   
             $session = session();
             if($session->has('ID')) 
             {
             $validation = \Config\Services::validation();
             $input = $this->validate([
             'solution' => 'required'
             ]);
             if (!$input) {
             session()->setFlashdata('message', 'Please fill all data!');
             session()->setFlashdata('alert-class', 'alert-danger');
             return $this->response->redirect(site_url('add_solutions'));
             }else{
             $add_solutionModel = new add_solutionModel();
             // Add operation
             $solution_Id = $add_solutionModel->update_data($this->request->getVar('id'),array(
             "solution_name" =>  $this->request->getVar('solution')
             ));
             if(!empty($solution_Id) || $solution_Id != '' || $solution_Id != 0) {
             session()->setFlashdata('message', 'Updated Successfully!');
             session()->setFlashdata('alert-class', 'alert-success');
             return $this->response->redirect(site_url('add_solutions'));
             } else {
             session()->setFlashdata('message', 'Do not Update!');
             session()->setFlashdata('alert-class', 'alert-danger');
             return $this->response->redirect(site_url('add_solutions'));
             }
             }
             }else {
             return redirect()->to('login');
             }
             } 
     
             //Delete Solution
              public  function delete_solution()
             {
              $id = $this->request->getVar('id');
              $add_solutionModel = new add_solutionModel();
              $solution_Id = $add_solutionModel->delete_data($id);
              return $this->response->redirect(site_url('add_solutions'));
             }
     
             //Add Solution Contents
          public function solutions_content()
          {   
                  $session = session();
                  if($session->has('ID')) 
                  {
                  $validation =  \Config\Services::validation();
                  $input = $this->validate([
                  'sol_name' => 'required',
                  'solname'=>'required',
                  'sub_solution_name' => 'required',
                  'solution_title' => 'required',
                  'solution_img' => 'uploaded[solution_img]',
                  'solution_content' => 'required'
              ]);
              if (!$input) {
                  session()->setFlashdata('message', 'Please fill all data!');
                  session()->setFlashdata('alert-class', 'alert-danger');
                  return $this->response->redirect(site_url('solutions_content'));
              }
              else{
                  $file = $this->request->getFile('solution_img');
                  $solution = "solution".$file->getName();
                  if($file->isValid()) {
                  $file->move('./assets/images/upload_image/', $solution, true);
                  }
                  $solution_contentModel = new solution_contentModel();
                  // Add operation
                  $solution_Id = $solution_contentModel->insert_data(array(
                  "solution_id" =>  $this->request->getVar('sol_name'),
                  "solution_name" =>  $this->request->getVar('solname'),
                  "sub_solution_name" =>  $this->request->getVar('sub_solution_name'),
                  "solution_subtitle" =>  $this->request->getVar('solution_title'),
                  "solution_image" =>  $solution,
                  "solution_content" => $this->request->getVar('solution_content'),
              ));
              if(!empty($solution_Id) || $solution_Id != '' || $solution_Id != 0) {
                  session()->setFlashdata('message', 'Added Successfully!');
                  session()->setFlashdata('alert-class', 'alert-success');
                  return $this->response->redirect(site_url('solutions_content'));
                  } else {
                  session()->setFlashdata('message', 'Do not Add!');
                  session()->setFlashdata('alert-class', 'alert-danger');
                  return $this->response->redirect(site_url('solutions_content'));
              }
                 } 
                     }else {
                         return redirect()->to('login');
                     }
             }
           //Update Solution Contents
      public function edit_solution_content()
      {   
          $session = session();
          if($session->has('ID')) 
          {
          $validation =  \Config\Services::validation();
          $input = $this->validate([
          'sol_name' => 'required',
          'sub_solution_name' => 'required',
          'solution_title' => 'required',
          'solution_content' => 'required'
          ]);
          if (!$input) {
          session()->setFlashdata('message', 'Please fill all data!');
          session()->setFlashdata('alert-class', 'alert-danger');
          return $this->response->redirect(site_url('solutions_content'));
          }
          else{
          if($this->request->getFile('solution_img') == "") {
          $solution = $this->request->getVar('hdn_sol_img');
          } else {
          $file = $this->request->getFile('solution_img');
          $solution = "solution".$file->getName();
          if($file->isValid()) {
          $file->move('./assets/images/upload_image/', $solution, true);
          }
          }
          $solution_contentModel = new solution_contentModel();
          // Add operation
          $solution_Id = $solution_contentModel->update_data($this->request->getVar('id'), array(
              "solution_id " =>        $this->request->getVar('sol_name'),
              "solution_name" =>      $this->request->getVar('solname'),
              "sub_solution_name" =>      $this->request->getVar('sub_solution_name'),
              "solution_subtitle" =>   $this->request->getVar('solution_title'),
              "solution_image" =>      $solution,
              "solution_content" =>    $this->request->getVar('solution_content'),
              "status" => 1
          ));
          if(!empty($solution_Id) || $solution_Id != '' || $solution_Id != 0) {
          session()->setFlashdata('message', 'Updated Successfully!');
          session()->setFlashdata('alert-class', 'alert-success');
          return $this->response->redirect(site_url('solutions_content'));
          } else {
          session()->setFlashdata('message', 'Do not Update!');
          session()->setFlashdata('alert-class', 'alert-danger');
             return $this->response->redirect(site_url('solutions_content'));
         }
         } 
         }else {
             return redirect()->to('login');
         }
         }
     
     
         //Delete Solution content
         public  function delete_solution_content()
         {
             $id = $this->request->getVar('solution_id');
             $solution_contentModel = new solution_contentModel();
             $solution_Id = $solution_contentModel->delete_data($id,array());
             return $this->response->redirect(site_url('solutions_content'));
         }

       //career
        //Insert
        public function career()
        {  
           $session = session();
           if($session->has('ID')) 
           { 
               $validation =  \Config\Services::validation();
               $input = $this->validate([
               'post' => 'required',
               'designation' => 'required',
               'company' => 'required',
               'deadline' => 'required',
               'job_type' => 'required',
               'timeFrom' => 'required',
               'timeTo' => 'required',
               'experienceFrom' => 'required',
               'experienceTo' => 'required',
               'location' => 'required',
               'emptotal' => 'required',
               'description' => 'required',
               'responsibility' => 'required',
               'education' => 'required',
               'add_req' => 'required',
               'other_Benefits' => 'required',
               'sal' => 'required'
               ]);
               if (!$input) {
               session()->setFlashdata('message', 'Please fill all data!');
               session()->setFlashdata('alert-class', 'alert-danger');
               return $this->response->redirect(site_url('career'));         
               }
               else {
               $careerModel = new careerModel();
               // Add operation
               $career_Id = $careerModel->insert_data(array(
               "post_name" => $this->request->getVar('post'),
               "Designation" => $this->request->getVar('designation'),
               "company_name" => $this->request->getVar('company'),
               "Deadline" => $this->request->getVar('deadline'),
               "Job_Type" => $this->request->getVar('job_type'),	
               "working_timeFrom" => $this->request->getVar('timeFrom'),	
               "working_timeTo" => $this->request->getVar('timeTo'),	
               "expFrom" => $this->request->getVar('experienceFrom'),	
               "expTo" => $this->request->getVar('experienceTo'),	
               "Location" => $this->request->getVar('location'),	
               "employees_total" => $this->request->getVar('emptotal'),
               "job_description" => $this->request->getVar('description'),
               "Job_Responsibility" => $this->request->getVar('responsibility'),
               "Education_Required" => $this->request->getVar('education'),
               "additional_req" => $this->request->getVar('add_req'),
               "benefits" => $this->request->getVar('other_Benefits'),
               "salary" => $this->request->getVar('sal'),
               ));
               if(!empty($career_Id) || $career_Id != '' || $career_Id != 0)
               {
               session()->setFlashdata('message', 'Added Successfully!');
               session()->setFlashdata('alert-class', 'alert-success');
               return $this->response->redirect(site_url('career'));
               } 
               else 
               {
               session()->setFlashdata('message', 'Do not Add!');
               session()->setFlashdata('alert-class', 'alert-danger');
               return $this->response->redirect(site_url('career'));
               }
               }
           }else {
               return redirect()->to('login');
           } 
       }

       //Update
      
       public function editCareer()
        {  
           $session = session();
           if($session->has('ID')) 
           { 
               $validation =  \Config\Services::validation();
               $input = $this->validate([
               'post' => 'required',
               'designation' => 'required',
               'company' => 'required',
               'deadline' => 'required',
               'job_type' => 'required',
               'timeFrom' => 'required',
               'timeTo' => 'required',
               'experienceFrom' => 'required',
               'experienceTo' => 'required',
               'location' => 'required',
               'emptotal' => 'required',
               'description' => 'required',
               'responsibility' => 'required',
               'education' => 'required',
               'add_req' => 'required',
               'other_Benefits' => 'required',
               'sal' => 'required'
               ]);
               if (!$input) {
               session()->setFlashdata('message', 'Please fill all data!');
               session()->setFlashdata('alert-class', 'alert-danger');
               return $this->response->redirect(site_url('career'));         
               }
               else {
               $careerModel = new careerModel();
               // Add operation
               $career_Id = $careerModel->update_data($this->request->getvar('id'),array(
               "post_name" => $this->request->getVar('post'),
               "Designation" => $this->request->getVar('designation'),
               "company_name" => $this->request->getVar('company'),
               "Deadline" => $this->request->getVar('deadline'),
               "Job_Type" => $this->request->getVar('job_type'),	
               "working_timeFrom" => $this->request->getVar('timeFrom'),	
               "working_timeTo" => $this->request->getVar('timeTo'),
               "expFrom" => $this->request->getVar('experienceFrom'),	
               "expTo" => $this->request->getVar('experienceTo'),	
               "Location" => $this->request->getVar('location'),	
               "employees_total" => $this->request->getVar('emptotal'),
               "job_description" => $this->request->getVar('description'),
               "Job_Responsibility" => $this->request->getVar('responsibility'),
               "Education_Required" => $this->request->getVar('education'),
               "additional_req" => $this->request->getVar('add_req'),
               "benefits" => $this->request->getVar('other_Benefits'),
               "salary" => $this->request->getVar('sal'),
               ));
               if(!empty($career_Id) || $career_Id != '' || $career_Id != 0)
               {
               session()->setFlashdata('message', 'Updated Successfully!');
               session()->setFlashdata('alert-class', 'alert-success');
               return $this->response->redirect(site_url('career'));
               } 
               else 
               {
               session()->setFlashdata('message', 'Do not Update!');
               session()->setFlashdata('alert-class', 'alert-danger');
               return $this->response->redirect(site_url('career'));
               }
               }
           }else {
               return redirect()->to('login');
           } 
       }
       //Delete
       public  function deleteCareer()
       {
           $id = $this->request->getVar('id');
           $careerModel = new careerModel();
           $career_Id = $careerModel->delete_data($id);
           return $this->response->redirect(site_url('career'));
       }

     //Youth Empowerment
    public function youthEmpowerment()
    {   
         $session = session();
         if($session->has('ID')) 
         {
             $validation =  \Config\Services::validation();
             $input = $this->validate([
                'youth_emp_title' => 'required',
                'youth_emp_subtitle' => 'required',
                'youth_content' => 'required'
             ]);
             if (!$input) {
             session()->setFlashdata('message', 'Please fill all data!');
             session()->setFlashdata('alert-class', 'alert-danger');
             return $this->response->redirect(site_url('youthEmpowerment'));
             }
             else {
                    $file = $this->request->getFile('youth_emp_img');
                    $img =  "YouthEmp".$file->getName();
                    if ($file->isValid()) {
                        $file->move('./assets/images/upload_image/', $img, true);
                    }
                
             $youthEmpowermentModel = new youthEmpowermentModel();
             // Add operation
             echo  $who_Id = $youthEmpowermentModel->insert_data(array(
             "youth_Title" => $this->request->getVar('youth_emp_title'),
             "youth_Subtitle" => $this->request->getVar('youth_emp_subtitle'),
             "youth_Img" => $img,
             "youth_Content" => $this->request->getVar('youth_content'),
             ));
             if(!empty($who_Id) || $who_Id != '' || $who_Id != 0) 
             {
             session()->setFlashdata('message', 'Added Successfully!');
             session()->setFlashdata('alert-class', 'alert-success');
             return $this->response->redirect(site_url('youthEmpowerment'));
             } else {
             session()->setFlashdata('message', 'Do not Add!');
             session()->setFlashdata('alert-class', 'alert-danger');
             return $this->response->redirect(site_url('youthEmpowerment'));
             }
             }
     } else {
         return redirect()->to('login');
     } 
    }

    //Update Youth Empowerment Contents
    public function edityouthEmpowerment()
    {   
        $session = session();
        if($session->has('ID')) 
        {
            $validation =  \Config\Services::validation();
            $input = $this->validate([
                'youth_emp_title' => 'required',
                'youth_emp_subtitle' => 'required',
                'youth_content' => 'required'
            ]);
            if (!$input) {
                session()->setFlashdata('message', 'Please fill all data!');
                session()->setFlashdata('alert-class', 'alert-danger');
                return $this->response->redirect(site_url('edit_youthEmpowerment/'.$this->request->getVar('id')));
            } else {
                if($this->request->getFile('youth_emp_img') == "") {
                $youth = $this->request->getVar('hdn_youth_emp_img');
                } else {
                $file = $this->request->getFile('youth_emp_img');
                $youth = "youth".$file->getName();
                if($file->isValid()) {
                $file->move('./assets/images/upload_image/', $youth, true);
                }
                }
                $youthEmpowermentModel = new youthEmpowermentModel();
                //Update operation
                $youth_Id = $youthEmpowermentModel->update_data($this->request->getVar('id'), array(
                    "youth_Title " => $this->request->getVar('youth_emp_title'),
                    "youth_Subtitle" => $this->request->getVar('youth_emp_subtitle'),
                    "youth_Img" => $youth,
                    "youth_Content" => $this->request->getVar('youth_content'),
                    "status" => 1
                ));
                if(!empty($youth_Id) || $youth_Id != '' || $youth_Id != 0) {
                    session()->setFlashdata('message', 'Updated Successfully!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    return $this->response->redirect(site_url('youthEmpowerment'));
                } else {
                    session()->setFlashdata('message', 'Do not Update!');
                    session()->setFlashdata('alert-class', 'alert-danger');
                    return $this->response->redirect(site_url('youthEmpowerment'));
                }
            }
        } else {
            return redirect()->to('login');
        }
    }

    //Delete Youth Empowerment
    public  function delete_youth_content()
    {
        $id = $this->request->getVar('youth_id');
        $youthEmpowermentModel = new youthEmpowermentModel();
        $youth_Id = $youthEmpowermentModel->delete_data($id,array());
        session()->setFlashdata('message', 'Delete Successful');
        session()->setFlashdata('alert-class', 'alert-danger');
        return $this->response->redirect(site_url('youthEmpowerment'));
    }

        //SEO 
        public function seo()
        {
            $session = session();
            if($session->has('ID'))
            {
                $validation = \Config\Services::validation();
                $input = $this->validate([
                    'metaTitle' => 'required',
                    // 'titleContent'  => 'required',
                    'metaKeyword' => 'required',
                    // 'metaKeywordContent' => 'required',
                    'metaDescription' => 'required',
                ]);
                if(!$input){
                    session()->setFlashdata('message','Please fill all data!');
                    session()->setFlashdata('alert-class','alert-danger');
                    return $this->response->redirect(site_url('seo'));
                
                }
                else{
                    $seoModel = new seoModel();
                    $seo_Id = $seoModel->insert_data(array(
                        "meta_title" => $this->request->getVar('metaTitle'),
                        // "meta_title_content" => $this->request->getVar('titleContent'),
                        "meta_keyword" => $this ->request-> getVar("metaKeyword"),
                        // "meta_keyword_content" => $this ->request-> getVar("metaKeywordContent"),
                        "meta_description" => $this ->request-> getVar("metaDescription"),
                    ));

                    if(!empty($seo_Id) || $seo_Id != '' || $seo_Id != 0)
                    {
                        session()->setFlashdata('message','Added Successfully!');
                        session()->setFlashdata('alert-class','alert-success');
                        return $this->response->redirect(site_url('seo'));
                    }
                    else{
                        session()->setFlashdata('message','Do not Add!');
                        session()->setFlashdata('alert-class','alert-danger');
                        return $this->response->redirect(site_url('seo'));
                    }
                }
            }
            else{
                return redirect()->to('login');
            }
        }
        
        public function seo_update()
             {  
                 $session = session();
                 if($session->has('ID')) 
                 {
                     $validation =  \Config\Services::validation();
                     $input = $this->validate([
                        'metaTitle' => 'required',
                        // 'titleContent'  => 'required',
                        'metaKeyword' => 'required',
                        // 'metaKeywordContent' => 'required',
                        'metaDescription' => 'required',
                     ]);
               
                     if (!$input)
                     {
                     session()->setFlashdata('message', 'Please fill all data!');
                     session()->setFlashdata('alert-class', 'alert-danger');
                     return $this->response->redirect(site_url('seo'));   
                     } 
                     else {
                     echo  $id = $this->request->getVar('id');
                     $seoModel = new seoModel();
                     // Add operation
                     echo $seo_Id = $seoModel->update_data($id, array(
                        "meta_title" => $this->request->getVar('metaTitle'),
                        // "meta_title_content" => $this->request->getVar('titleContent'),
                        "meta_keyword" => $this ->request-> getVar("metaKeyword"),
                        // "meta_keyword_content" => $this ->request-> getVar("metaKeywordContent"),
                        "meta_description" => $this ->request-> getVar("metaDescription"),
                     ));
               
                     if(!empty($seo_Id) || $seo_Id != '' || $seo_Id != 0)  {
                     session()->setFlashdata('message', 'Updated Successfully!');
                     session()->setFlashdata('alert-class', 'alert-success');
                     return $this->response->redirect(site_url('seo'));
                     } else {
                     session()->setFlashdata('message', 'Do not Update!');
                     session()->setFlashdata('alert-class', 'alert-danger');
                     return $this->response->redirect(site_url('seo'));
                     }
                     }
                 }else {
                     return redirect()->to('login');
                 } 
             }

    //         public function systemsetting_delete($id)
    //         {
            
    //         $systemsettingModel = new systemsettingModel();
    //         $systemsettingModel->where('id',$id)->delete();
    //             return redirect(site_url('systemsetting'));

    //         }
}


