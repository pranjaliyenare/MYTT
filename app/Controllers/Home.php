<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\aboutModel;
use App\Models\add_serviceModel;
use App\Models\emailModel;
use App\Models\footersettingModel;
use App\Models\homeModel;
use App\Models\logoModel;
use App\Models\partnersModel;
use App\Models\privacyModel;
use App\Models\refundModel;
use App\Models\socialmediaModel;
use App\Models\systemsettingModel;
use App\Models\seoModel;
use App\Models\termsModel;
use App\Models\whoModel;
use App\Models\happycustomerModel;
use App\Models\contactusModel;
use App\Models\multibranchesModel;
use App\Models\vissionModel;
use App\Models\missionModel;
use App\Models\sendQuoteModel;
use App\Models\sendMailModel;
use App\Models\ourstoryModel;
use App\Models\ourexpertiseModel;
use App\Models\services_contentModel;
use App\Models\add_proj_nameModel;
use App\Models\proj_contentsModel;
use App\Models\proj_categoryModel;
use App\Models\add_fintech_Model;
use App\Models\fintech_contentsModel;
use App\Models\partners_contentModel;
use App\Models\partners_typeModel;
use App\Models\add_solutionModel;
use App\Models\solution_contentModel;
use App\Models\fintech_featuresModel;
use App\Models\careerModel;
use App\Models\youthEmpowermentModel;
use App\Models\jobApplyModel;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        if($session->has('ID')) {
                echo view('templates/header');
                echo view('templates/navbar');
                echo view('pages/index');
                echo view('templates/footer');            
        } else {
            return redirect()->to('login');
        }
    }
    public function email()
    { 
        $session = session();
        if($session->has('ID')) {
            $emailModel = new emailModel();
            if($emailModel->countAll()>0)
            {
            $email = $emailModel->get_all_data(); 
            $data['id'] =  $email[0]['id'];
            $data['general'] =  $email[0]['general_email'];
            $data['support'] =  $email[0]['support_email'];
            $data['quote'] =  $email[0]['quote_email'];
            $data['button']  = "Edit";
            $data['form']  = "email_update";
            }
            else {
                $data['id'] =  "";
                $data['general'] = "";
                $data['support'] =  "";
                $data['quote'] = "";
                $data['button']  = "Add";
                $data['form']  = "email";
            }
            echo view('templates/header');
            echo view('templates/navbar');
            echo view('setting/email',$data);
            echo view('templates/footer');
        } else {
            return redirect()->to('login');
        }
    }


     //Home Page
    public function home()
    {
        $session = session();
        if($session->has('ID'))
        {
            $homeModel = new homeModel();
            if($homeModel->countAll()>0)
            {
                $data['home'] = $homeModel->get_all_data();  
            } else {
                $data['home'] = "";
            }
            echo view('templates/header');
            echo view('templates/navbar');
            echo view('pages/home',$data);
            echo view('templates/footer');
        }
        else {
            return redirect()->to('login'); 
        }
    }
     //Update
    public function edithome($id)
    {
        $homeModel = new homeModel();
        if($homeModel->countAll()>0)
        {
            $home = $homeModel->get_single_data($id); 
            $data['id']  = $home[0]['id'];
            $data['home_header']  = $home[0]['home_header']; 
            $data['home_image1']  = $home[0]['home_image1']; 
            $data['home_content']  = $home[0]['home_content']; 
            } else {
        $data['id'] = "";
        $data['home_header'] = "";
        $data['home_image1'] = "";
        $data['home_content'] = "";
         }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('pages/edithome', $data);
        echo view('templates/footer');
      }

    public function systemsetting()  
    {  
        $session = session();
        if($session->has('ID')) {
                $systemsettingModel = new systemsettingModel();
            
                if($systemsettingModel->countAll()>0)
                {
                    $systemsetting = $systemsettingModel->get_all_data();     
                    $data['id']  = $systemsetting[0]['id'];  
                    $data['sitename']  = $systemsetting[0]['site_name'];
                    $data['shortsite']  = $systemsetting[0]['short_site'];
                    $data['siteurl']  = $systemsetting[0]['site_url'];
                    $data['address']  = $systemsetting[0]['site_address'];
                    $data['phone']  = $systemsetting[0]['phone'];
                    $data['email']  = $systemsetting[0]['email'];
                    $data['button']  = "Edit";
                    $data['form']  = "systemsetting_update";
                } else {
                    $data['id']  = "";
                    $data['sitename']  = "";
                    $data['shortsite']  = "";
                    $data['siteurl']  = "";
                    $data['address']  = '';
                    $data['phone']  = '';
                    $data['email']  = '';
                    $data['button']  = "Add";
                    $data['form']  = "systemsetting";
                }
                echo view('templates/header');
                echo view('templates/navbar');
                echo view('setting/systemsetting',$data);
                echo view('templates/footer');
            } else {
                return redirect()->to('login');
            }
    }

    //Our Expertise
    public function ourexpertise()
    {
        $ourexpertiseModel = new ourexpertiseModel();
        if($ourexpertiseModel->countAll()>0)
        {
        $data['expertise'] = $ourexpertiseModel->get_all_data();  
        } else {
        $data['expertise'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('pages/ourexpertise', $data);
        echo view('templates/footer');
       }

       //Update
       public function editOurexpertise($id)
    {
        $ourexpertiseModel = new ourexpertiseModel();
        if($ourexpertiseModel->countAll()>0)
        {
            $expertise = $ourexpertiseModel->get_single_data($id); 
            $data['id']  = $expertise[0]['id'];
            $data['our_expertise_title']  = $expertise[0]['our_expertise_title']; 
            $data['our_expertise_subtitle']  = $expertise[0]['our_expertise_subtitle']; 
            $data['our_expertise_image']  = $expertise[0]['our_expertise_image']; 
            $data['our_expertise_content']  = $expertise[0]['our_expertise_content'];   
        } else {
        $data['id'] = "";
        $data['our_expertise_title'] = "";
        $data['our_expertise_subtitle'] = "";
        $data['our_expertise_image'] = "";
        $data['our_expertise_content'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('pages/editOurexpertise', $data);
        echo view('templates/footer');
        
    }

    public function footersetting()
    {
            $session = session();
            if($session->has('ID')) 
            {
                $footersettingModel = new footersettingModel();
                if($footersettingModel->countAll()>0)
                {
                    $footersetting = $footersettingModel->get_all_data();
                    $data['id']  = $footersetting[0]['id'];  
                    $data['copy']  = $footersetting[0]['footer_copy'];
                    $data['link']  = $footersetting[0]['footer_link'];
                    $data['developedBy']  = $footersetting[0]['developed_by'];
                    $data['button']  = "Edit";
                    $data['form']  = "footersetting_update";
                }else{
                    $data['id']  = "";  
                    $data['copy']  ="";
                    $data['link']  = "";
                    $data['developedBy']  = "";
                    $data['button']  = "Add";
                    $data['form']  = "footersetting";
                }
                

                echo view('templates/header');
                echo view('templates/navbar');
                echo view('setting/footersetting',$data);
                echo view('templates/footer');
            } else {
            return redirect()->to('login');
        }
        
    }
    public function logo()
    { 
        $session = session();
        if($session->has('ID')) 
        {
                $logoModel = new logoModel();
                
                if($logoModel->countAll()>0)
                {   
                    $logo = $logoModel->get_all_data(); 
                    $data['id']  = $logo[0]['id'];  
                    $data['faviconImg']  = $logo[0]['favicon_file'];
                    $data['logoImg']  = $logo[0]['logo_file']; 
                    $data['button']  = "Edit";
                    $data['form']  = "logo_update";
                } else {
                    $data['id']  = "";
                    $data['faviconImg']  = "";
                    $data['logoImg']  = "";
                    $data['button']  = 'Add';
                    $data['form']  = "logo";
                }
                
                echo view('templates/header',$data);
                echo view('templates/navbar');
                echo view('setting/logo',$data);
                echo view('templates/footer');
        } else {
                return redirect()->to('login');
            }
        
    }
    public function terms()
    {
        $session = session();
        if($session->has('ID')) 
            {
                $termsModel = new termsModel();
                if($termsModel->countAll()>0)
                {
                $terms = $termsModel->get_all_data(); 
                $data['id'] =  $terms[0]['id'];
                $data['header'] =  $terms[0]['term_header'];
                $data['subtitle'] =  $terms[0]['term_subtitle'];
                $data['image'] =  $terms[0]['image'];
                $data['content'] =  $terms[0]['term_condition_content'];
                $data['button']  = "Edit";
                $data['form']  = "terms_update";
                }
                else {
                    $data['id'] =  "";
                    $data['header'] = "";
                    $data['subtitle'] =  "";
                    $data['image'] = "";
                    $data['content'] = "";
                    $data['button']  = "Add";
                    $data['form']  = "terms";
                }

                echo view('templates/header');
                echo view('templates/navbar');
                echo view('pages/terms',$data);
                echo view('templates/footer');
            }else {
                    return redirect()->to('login');
                }
        
    }

    public function contactus()
    {
        $session = session();
        if($session->has('ID'))
        {
                $contactusModel = new contactusModel();        
                if($contactusModel->countAll()>0)
                {
                    $contactus = $contactusModel->get_all_data();  
                    $data['id']  = $contactus[0]['id']; 
                    $data['title']  = $contactus[0]['contact_title']; 
                    $data['mobile']  = $contactus[0]['contact_mobile'];
                    $data['email']  = $contactus[0]['contact_email'];
                    $data['address']  = $contactus[0]['contact_address']; 
                    $data['contact_image']  = $contactus[0]['contact_image'];
                    $data['content']  = $contactus[0]['contact_content'];
                    $data['button']  = "Edit";
                    $data['form']  = "contactus_update";
                } else {
                    $data['id']  = "";
                    $data['title']  = "";
                    $data['mobile']  = "";
                    $data['email']  = "";
                    $data['address']  = "";
                    $data['contact_image']  = "";
                    $data['content']  = "";
                    $data['button']  = "Add";
                    $data['form']  = "contactus";
                }
                    echo view('templates/header');
                    echo view('templates/navbar');
                    echo view('pages/contactus',$data);
                    echo view('templates/footer');
        } else {
            return redirect()->to('login');
        }
     
    }
    public function privacy()
    {
        $session = session();
        if($session->has('ID'))
        {
            $privacyModel = new privacyModel();
        
            if($privacyModel->countAll()>0)
            {
                $privacy = $privacyModel->get_all_data();     
                $data['id']  = $privacy[0]['id'];  
                $data['header']  = $privacy[0]['privacy_header'];
                $data['subtitle']  = $privacy[0]['privacy_subtitle'];  
                $data['image']  = $privacy[0]['image']; 
                $data['content']  = $privacy[0]['privacy_content']; 
                $data['button']  = "Edit";
                $data['form']  = "privacy_update";
            } else {
                $data['id']  = "";
                $data['header']  = "";
                $data['subtitle']  = '';
                $data['image']  = "";
                $data['content']  = "";
                $data['button']  = "Add";
                $data['form']  = "privacy";
            }
            echo view('templates/header');
            echo view('templates/navbar');
            echo view('pages/privacy',$data);
            echo view('templates/footer');
        }    
        else {
            return redirect()->to('login');
        }
    }

    public function refund()
    {
        $session = session();
        if($session->has('ID'))
        {
                $refundModel = new refundModel();
            
                if($refundModel->countAll()>0)
                {
                    $refund = $refundModel->get_all_data();     
                    $data['id']  = $refund[0]['id'];  
                    $data['header']  = $refund[0]['refund_header'];
                    $data['subtitle']  = $refund[0]['refund_subtitle'];
                    $data['image']  = $refund[0]['image'];
                    $data['content']  = $refund[0]['refund_content']; 
                    $data['button']  = "Edit";
                    $data['form']  = "refund_update";
                } else {
                    $data['id']  = "";
                    $data['header']  = "";
                    $data['subtitle']  = "";
                    $data['image']  = "";
                    $data['content']  = '';
                    $data['button']  = 'Add';
                    $data['form']  = "refund";
                }
                echo view('templates/header');
                echo view('templates/navbar');
                echo view('pages/refund',$data);
                echo view('templates/footer');
            }
            else {
                return redirect()->to('login');
            }
    }

     //Social Media Setting
        //Insert
        public function socialmedia()
        {
            $session = session();
            if($session->has('ID'))
            {
                $socialmediaModel = new socialmediaModel();
                    if($socialmediaModel->countAll()>0)
                    {
                    $data['socialmedia'] = $socialmediaModel->get_all_data();  
                    } else {
                    $data['socialmedia'] = "";
                    }
                echo view('templates/header');
                echo view('templates/navbar');
                echo view('social/socialmedia',$data);
                echo view('templates/footer');
            }
            else {
                return redirect()->to('login');
            }
        }
    
            //Update
            public function editSocialmedia($id)
        {
            $socialmediaModel = new socialmediaModel();
            if($socialmediaModel->countAll()>0)
            {
                $social = $socialmediaModel->get_single_data($id); 
                $data['id']  = $social[0]['id'];
                $data['social_img']  = $social[0]['social_img']; 
                $data['social_name']  = $social[0]['social_name']; 
                $data['social_url']  = $social[0]['social_url']; 
               } else {
            $data['id'] = "";
            $data['social_img'] = "";
            $data['social_name'] = "";
            $data['social_url'] = "";
            }
            echo view('templates/header');
            echo view('templates/navbar');
            echo view('social/editSocialmedia', $data);
            echo view('templates/footer');
            
        }

    public function about()
    {
        $session = session();
        if($session->has('ID'))
        {
            $aboutModel = new aboutModel();
        
            if($aboutModel->countAll()>0)
            {
                $about = $aboutModel->get_all_data();     
                $data['id']  = $about[0]['id'];  
                $data['header']  = $about[0]['about_header'];
                $data['subtitle']  = $about[0]['about_subtitle'];
                $data['about_img']  = $about[0]['image'];
                $data['content']  = $about[0]['about_content']; 
                $data['button']  = "Edit";
                $data['form']  = "about_update";
            } else {
                $data['id']  = "";
                $data['header']  = "";
                $data['subtitle']  ="";
                $data['about_img']  = "";
                $data['content']  = '';
                $data['button']  = 'Add';
                $data['form']  = "about";
            }
            echo view('templates/header');
            echo view('templates/navbar');
            echo view('pages/about',$data);
            echo view('templates/footer');
        }
        else {
            return redirect()->to('login');
        }
    }
    
    
   
    public function mission()
    {
        $session = session();
        if($session->has('ID'))
        {
            $missionModel = new missionModel();
        
            if($missionModel->countAll()>0)
            {
                $mission = $missionModel->get_all_data();     
                $data['id']  = $mission[0]['id'];  
                $data['title']  = $mission[0]['mission_title'];
                $data['image']  = $mission[0]['mission_image'];
                $data['content']  = $mission[0]['mission_contents']; 
                $data['button']  = "Edit";
                $data['form']  = "mission_update";
            } else {
                $data['id']  = "";
                $data['title']  = "";
                $data['image']  = "";
                $data['content']  = "";
                $data['button']  = "Add";
                $data['form']  = "mission";
            }
            echo view('templates/header');
            echo view('templates/navbar');
            echo view('pages/mission',$data);
            echo view('templates/footer');
        }
        else {
            return redirect()->to('login');
        }
    }
    
    //Partner
    //Insert
    public function partners()
    {
        $session = session();
        if($session->has('ID'))
        {
            $partnersModel = new partnersModel();
            if($partnersModel->countAll()>0)
            {
            $data['partner'] = $partnersModel->get_all_data();  
            } else {
            $data['partner'] = "";
            }
            echo view('templates/header');
            echo view('templates/navbar');
            echo view('pages/partners',$data);
            echo view('templates/footer');
        }
        else {
            return redirect()->to('login');
        }
    }
    //Update
    public function editpartners($id)
    {
        $partnersModel = new partnersModel();
        if($partnersModel->countAll()>0)
        {
            $partner = $partnersModel->get_single_data($id); 
            $data['id']  = $partner[0]['id'];
            $data['partners_name']  = $partner[0]['partners_name']; 
            $data['partners_logo']  = $partner[0]['partners_logo']; 
            $data['partners_link']  = $partner[0]['partners_link']; 
            $data['partners_contents']  = $partner[0]['partners_contents'];
        } else {
            $data['id'] = "";
            $data['partners_name'] = "";
            $data['partners_logo'] = "";
            $data['partners_link']  ="";
            $data['partners_contents'] = "";
         }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('pages/editpartners', $data);
        echo view('templates/footer');
      }

    public function vission()
    {
        $session = session();
        if($session->has('ID'))
        {
            $vissionModel = new vissionModel();
            if($vissionModel->countAll()>0)
            {
                $vission = $vissionModel->get_all_data();     
                $data['id']  = $vission[0]['id'];  
                $data['title']  = $vission[0]['vission_title'];
                $data['image']  = $vission[0]['vission_image'];
                $data['content']  = $vission[0]['vission_content'];
                $data['button']  = "Edit";
                $data['form']  = "vission_update";
            } else {
                $data['id']  = "";
                $data['title']  = "";
                $data['image']  = "";
                $data['content']  = '';
                $data['button']  = "Add";
                $data['form']  = "vission";
            }
            echo view('templates/header');
            echo view('templates/navbar');
            echo view('pages/vission',$data);
            echo view('templates/footer');
        }
            else {
                return redirect()->to('login');
            }
            
    }
    
    public function who()
    {
        $session = session();
        if($session->has('ID'))
        {
            $whoModel = new whoModel();
            if($whoModel->countAll()>0)
            {
                $who = $whoModel->get_all_data();     
                $data['id']  = $who[0]['id'];  
                $data['title']  = $who[0]['who_title'];
                $data['subtitle']  = $who[0]['who_subtitle'];
                $data['image']  = $who[0]['who_image']; 
                $data['content']  = $who[0]['who_content']; 
                $data['button']  = "Edit";
                $data['form']  = "who_update";
            } else {
                $data['id']  = "";
                $data['title']  = "";
                $data['subtitle']  = "";
                $data['image']  = "";
                $data['content']  = '';
                $data['button']  = 'Add';
                $data['form']  = "who";
            }

            echo view('templates/header');
            echo view('templates/navbar');
            echo view('pages/who',$data);
            echo view('templates/footer');
        }else {
            return redirect()->to('login');
        }
    }
   
    public function vender()
    {
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('pages/vender');
        echo view('templates/footer');
        
    }
    public function happycustomer()
    {
        $session = session();
        if($session->has('ID'))
        {
                $happycustomerModel = new happycustomerModel();
                if($happycustomerModel->countAll()>0)
                {
                $data['customer'] = $happycustomerModel->get_all_data();  
                } else {
                $data['customer'] = "";
                }

                echo view('templates/header');
                echo view('templates/navbar');
                echo view('pages/happycustomer',$data);
                echo view('templates/footer');   
        } else {
            return redirect()->to('login');
        }    
    }
   
    //Multibranches
     //Insert
     public function multibranches()
     {
         $session = session();
         if($session->has('ID'))
         {
             $multibranchesModel = new multibranchesModel();
             if($multibranchesModel->countAll()>0)
             {
             $data['multibranches'] = $multibranchesModel->get_all_data(); 
             } else {
             $data['multibranches'] = "";
             }
             echo view('templates/header');
             echo view('templates/navbar');
             echo view('pages/multibranches', $data);
             echo view('templates/footer');
         }
         else {
         return redirect()->to('login');
         }
     }
     //Update
     public function editMultibranches($id)
     {
         $session = session();
         if($session->has('ID'))
         {
             $multibranchesModel = new multibranchesModel();
             if($multibranchesModel->countAll()>0)
             {
             $multi = $multibranchesModel->get_single_data($id); 
             $data['id']  = $multi[0]['id'];  
             $data['multi_title']  = $multi[0]['multi_title'];  
             $data['multi_drop']  = $multi[0]['multi_drop'];  
             $data['branch_location']  = $multi[0]['branch_location']; 
             $data['branch_address']  = $multi[0]['branch_address']; 
             } else {
             $data['id'] = "";
             $data['multi_title'] = "";
             $data['multi_drop'] = "";
             $data['branch_location'] = "";
             $data['branch_address'] = "";  
             }
             echo view('templates/header');
             echo view('templates/navbar');
             echo view('pages/editMultibranches', $data);
             echo view('templates/footer');
         }
         else {
         return redirect()->to('login');
         }
     }
   
    //Services

    public function add_service()
    {
        $add_serviceModel = new add_serviceModel();
        if($add_serviceModel->countAll()>0)
        {
            $data['services'] = $add_serviceModel->get_all_data();  
        } else {
            $data['services'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('services/add_service',$data);
        echo view('templates/footer');
        
    }
    
    public function editService($id)
    {
        $add_serviceModel = new add_serviceModel();
        if($add_serviceModel->countAll()>0)
        { 
            $service = $add_serviceModel->get_single_data($id);
            $data['id']  = $service[0]['id']; 
            $data['service_name']  = $service[0]['service_name'];    
        } else {
            $data['id'] = "";
            $data['service_name'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('services/editService',$data);
        echo view('templates/footer');
        
    }
    public function services_content() {

        $add_serviceModel = new add_serviceModel();
        if($add_serviceModel->countAll()>0)
        {
            $data['services'] = $add_serviceModel->get_all_data();  
        } else {
            $data['services'] = "";
        }

        $services_contentModel = new services_contentModel();
        if($services_contentModel->countAll()>0)
        {
            $data['service_content'] = $services_contentModel->get_all_data();  
        } else {
            $data['service_content'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('services/services_content',$data);
        echo view('templates/footer');
        
    }

    public function edit_service_content($id) {

        $add_serviceModel = new add_serviceModel();
        if($add_serviceModel->countAll()>0)
        {
            $data['services'] = $add_serviceModel->get_all_data();  
        } else {
            $data['services'] = "";
        }

        $services_contentModel = new services_contentModel();
        if($services_contentModel->countAll()>0)
        {
            $services = $services_contentModel->get_single_data($id);
           
            foreach($services as $serv) {
                $data['id'] =  $serv['id'];
                $data['services_id'] =  $serv['services_id'];
                $data['services_name'] =  $serv['services_name'];
                $data['sub_service_name'] =  $serv['sub_service_name'];
                $data['service_subtitle'] =  $serv['service_subtitle'];
                $data['service_image'] =  $serv['service_image'];
                $data['service_content'] =  $serv['service_content'];
            }  
            } else {
                $data['id'] = "";
                $data['services_id'] =  "";
                $data['services_name'] =  "";
                $data['sub_service_name'] =  "";
                $data['service_subtitle'] = "";
                $data['service_image'] =  "";
                $data['service_content'] ="";
            }

         echo view('templates/header');
         echo view('templates/navbar');
         echo view('services/edit_service_content',$data);
         echo view('templates/footer');
        
    }

    //Notification    
    public function sendQuote()
    {
        $session = session();
        if($session->has('ID'))
        {
            $sendQuoteModel = new sendQuoteModel();
            if($sendQuoteModel->countAll()>0)
            {
            $data['quote'] = $sendQuoteModel->get_all_data();  
            } else {
            $data['quote'] = "";
            }
        echo view('templates/header',$data);
        echo view('templates/navbar');
        echo view('notification/sendQuote');
        echo view('templates/footer');
        }else {
        return redirect()->to('login');
        }
    }	
    
    public function sendMail()
    {
        $session = session();
        if($session->has('ID'))
        {
            $sendMailModel = new sendMailModel();
            if($sendMailModel->countAll()>0)
            {
            $data['mail'] = $sendMailModel->get_all_data();  
            } else {
            $data['mail'] = "";
            }
        echo view('templates/header',$data);
        echo view('templates/navbar');
        echo view('notification/sendMail');
        echo view('templates/footer');
        }else {
        return redirect()->to('login');
        }
    }

    public function jobList()
    {
        $session = session();
        if($session->has('ID'))
        {
            $jobApplyModel = new jobApplyModel();
            if($jobApplyModel->countAll()>0)
            {
            $data['job'] = $jobApplyModel->get_all_data();  
            } else {
            $data['job'] = "";
            }
        echo view('templates/header',$data);
        echo view('templates/navbar');
        echo view('notification/jobList');
        echo view('templates/footer');
        }else {
        return redirect()->to('login');
        }
    }	

    //ourstory
    // Insert
    public function ourstory()
    {
        $ourstoryModel = new ourstoryModel();
        if($ourstoryModel->countAll()>0)
        {
        $data['story'] = $ourstoryModel->get_all_data();  
        } else {
        $data['story'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('pages/ourstory', $data);
        echo view('templates/footer');
        
    }

    //Update
    public function editourstory($id)
    {
        $ourstoryModel = new ourstoryModel();
        if($ourstoryModel->countAll()>0)
        {
            $ourStory = $ourstoryModel->get_single_data($id); 
            $data['id']  = $ourStory[0]['id'];
            $data['our_story_title']  = $ourStory[0]['our_story_title']; 
            $data['our_story_subtitle']  = $ourStory[0]['our_story_subtitle']; 
            $data['our_story_image']  = $ourStory[0]['our_story_image']; 
            $data['our_story_content']  = $ourStory[0]['our_story_content'];   
        } else {
        $data['id'] = "";
        $data['our_story_title'] = "";
        $data['our_story_subtitle'] = "";
        $data['our_story_image'] = "";
        $data['our_story_content'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('pages/editourstory', $data);
        echo view('templates/footer');
        
    }

    //Projects
    public function add_proj_name()
    {
        $proj_categoryModel = new proj_categoryModel();
        if($proj_categoryModel->countAll()>0)
        {
        $data['proj_category'] = $proj_categoryModel->get_all_data();  
        } else {
        $data['proj_category'] = "";
        }

        $add_proj_nameModel = new add_proj_nameModel();
        if($add_proj_nameModel->countAll()>0)
        {
        $data['project'] = $add_proj_nameModel->get_all_data();  
        } else {
        $data['project'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('projects/add_proj_name', $data);
        echo view('templates/footer');
        
    }
     public function edit_project_name($id)
    {
        $proj_categoryModel = new proj_categoryModel();
        if($proj_categoryModel->countAll()>0)
        {
        $data['proj_category'] = $proj_categoryModel->get_all_data();  
        } else {
        $data['proj_category'] = "";
        }
        
        $add_proj_nameModel = new add_proj_nameModel();
        if($add_proj_nameModel->countAll()>0)
        {
            $proj_content = $add_proj_nameModel->get_single_data($id); 
            $data['id'] = $proj_content[0]['id'];
            $data['project_name'] =$proj_content[0]['project_name'];
            $data['proj_images'] =$proj_content[0]['proj_images'];
            $data['proj_start_date'] =$proj_content[0]['proj_start_date'];
            $data['proj_end_date'] =$proj_content[0]['proj_end_date'];
            $data['project_type'] =$proj_content[0]['project_type'];
            $data['proj_url'] =$proj_content[0]['proj_url'];
            $data['project_category'] =$proj_content[0]['project_category'];
            $data['project_price'] =$proj_content[0]['project_price'];
        } else {
            $data['id'] = "";
            $data['project_name'] = "";
            $data['proj_images'] = "";
            $data['proj_start_date'] = "0000.00.00";
            $data['proj_end_date'] = "0000.00.00";
            $data['project_type'] = "";
            $data['proj_url'] = "";
            $data['project_category'] = "";
            $data['project_price'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('projects/edit_project_name', $data);
        echo view('templates/footer');
        
    }
    public function proj_category()
    {
        $proj_categoryModel = new proj_categoryModel();
        if($proj_categoryModel->countAll()>0)
        {
        $data['category'] = $proj_categoryModel->get_all_data();  
        } else {
        $data['category'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('projects/proj_category', $data);
        echo view('templates/footer');
        
    }
    public function edit_project_category($id)
    {
         $session = session();
         if($session->has('ID'))
         {
            $proj_categoryModel = new proj_categoryModel();
            if($proj_categoryModel->countAll()>0)
            {
                $category = $proj_categoryModel->get_single_data($id);    
                $data['id']  = $category[0]['id'];  
                $data['project_category']  = $category[0]['project_category'];
                
            } else {
                $data['id']  = "";
                $data['project_category']  = "";
              }

              echo view('templates/header');
              echo view('templates/navbar');
              echo view('projects/edit_project_category', $data);
               echo view('templates/footer');
        }else {
            return redirect()->to('login');
        }
    }
    public function proj_contents()
    {
        $add_proj_nameModel = new add_proj_nameModel();
        if($add_proj_nameModel->countAll()>0)
        {
        $data['proj_content'] = $add_proj_nameModel->get_all_data();  
        } else {
        $data['proj_content'] = "";
        }
        $proj_contentsModel = new proj_contentsModel();
        if($proj_contentsModel->countAll()>0)
        {
        $data['proj_cont'] = $proj_contentsModel->get_all_data();  
        } else {
        $data['proj_cont'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('projects/proj_contents', $data);
        echo view('templates/footer');
        
    }

    //Partner
    //Insert
    public function add_partners()
    {
         $partners_TypeModel = new partners_TypeModel();
         if($partners_TypeModel->countAllResults()>0)
         {
            $data['partners'] = $partners_TypeModel->get_all_data();  
         } else {
             $data['partners'] = "";
         }
        echo view('templates/header', $data);
        echo view('templates/navbar');
        echo view('pages/add_partners');
        echo view('templates/footer');
        
    }
    public function edit_partner($id)
    {
        $partners_TypeModel = new partners_TypeModel();
        if($partners_TypeModel->countAllResults()>0)
        {
            $part = $partners_TypeModel->get_single_data($id);
            $data['id']  = $part[0]['id']; 
            $data['partnersType']  = $part[0]['partnersType']; 
        } else {
            $data['id'] = "";
            $data['partnersType'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('pages/edit_partner',$data);
        echo view('templates/footer');
        
    }
    public function add_partners_content()
    {
        $session = session();
        if($session->has('ID'))
        {
            
            $partners_TypeModel = new partners_TypeModel();
            if($partners_TypeModel->countAll()>0)
            {
               $data['partners'] = $partners_TypeModel->get_all_data();  
            } else {
                $data['partners'] = "";
            }
            $partners_contentModel = new partners_contentModel();
            if($partners_contentModel->countAllResults()>0)
            {
            $data['partner'] = $partners_contentModel->get_all_data();  
            } else {
            $data['partner'] = "";
            }
            echo view('templates/header');
            echo view('templates/navbar');
            echo view('pages/add_partners_content',$data);
            echo view('templates/footer');
        }
        else {
            return redirect()->to('login');
        }
    }
    //Update
    public function editpartnersContents($id)
    {
        $partners_TypeModel = new partners_TypeModel();
        if($partners_TypeModel->countAll()>0)
        {
            $part = $partners_TypeModel->get_single_data($id);
            $data['id']  = $part[0]['id']; 
            $data['partnersType']  = $part[0]['partnersType']; 
            $data['partners'] = $partners_TypeModel->get_all_data();  
        } else {
            $data['id'] = "";
            $data['partnersType'] = "";
            $data['partners'] = "";
        }

        $partners_contentModel = new partners_contentModel();
        if($partners_contentModel->countAll()>0)
        {
            $partner = $partners_contentModel->get_single_data($id); 
            $data['id']  = $partner[0]['id'];
            $data['partners_name']  = $partner[0]['partners_name'];	 
            $data['partnersType']  = $partner[0]['partnersType'];	 
            $data['partners_logo']  = $partner[0]['partners_logo']; 
            $data['partners_link']  = $partner[0]['partners_link']; 
            $data['partners_contents']  = $partner[0]['partners_contents'];
        } else {
            $data['id'] = "";
            $data['partners_name'] = "";
            $data['partnersType'] = "";
            $data['partners_logo'] = "";
            $data['partners_link']  ="";
            $data['partners_contents'] = "";
         }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('pages/editpartnersContents', $data);
        echo view('templates/footer');
      }

       //Fintech
    public function add_fintech()
    {
        $add_fintech_Model = new add_fintech_Model();
        if($add_fintech_Model->countAll()>0)
        {
            $data['fintch'] = $add_fintech_Model->get_all_data();  
        } else {
            $data['fintch'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('fintech/add_fintech',$data);
        echo view('templates/footer');
        
    }


    public function edit_fintech($id)
    {
        $add_fintech_Model = new add_fintech_Model();
        if($add_fintech_Model->countAll()>0)
        {
            $fin = $add_fintech_Model->get_single_data($id);
            $data['id']  = $fin[0]['id']; 
            $data['fintech_name']  = $fin[0]['fintech_name']; 
        } else {
            $data['id'] = "";
            $data['fintech_name'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('fintech/edit_fintech',$data);
        echo view('templates/footer');
        
    }

    public function add_fintech_content()
    {
        $add_fintech_Model = new add_fintech_Model();
        if($add_fintech_Model->countAll()>0)
        {
            $data['fintch'] = $add_fintech_Model->get_all_data();  
        } else {
            $data['fintch'] = "";
        }

        $fintech_contentsModel = new fintech_contentsModel();
        if($fintech_contentsModel->countAll()>0)
        {
            $data['fintech_content'] = $fintech_contentsModel->get_all_data();  
        } else {
            $data['fintech_content'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('fintech/add_fintech_content',$data);
        echo view('templates/footer');
        
    }
    //Update Fintech Contents
    public function edit_fintech_contents($id)
    {
        $add_fin_Model = new fintech_contentsModel();
        if($add_fin_Model->countAll()>0)
        {
            $data['fintch'] = $add_fin_Model->get_all_data();  
        } else {
            $data['fintch'] = "";
        }

        $fintech_contentsModel = new fintech_contentsModel();
        if($fintech_contentsModel->countAll()>0)
        {
            $fintch=$fintech_contentsModel->get_single_data($id);
           foreach($fintch as $block){
                $data['id'] =  $block['id'];
                $data['fintech_id'] =  $block['fintech_id'];
                $data['fintech_name'] =  $block['fintech_name'];
                $data['fintech_title'] =  $block['fintech_title'];
                $data['fintech_sub'] =  $block['fintech_sub'];
                $data['fintech_img'] =  $block['fintech_img'];
                $data['fintech_content'] =  $block['fintech_content'];
            }  
        } else {
            $data['id'] = "";
                $data['fintech_id'] =  "";
                $data['fintech_name'] =  "";
                $data['fintech_title'] =  "";
                $data['fintech_sub'] = "";
                $data['fintech_img'] =  "";
                $data['fintech_content'] ="";
        }
        
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('fintech/edit_fintech_contents',$data);
        echo view('templates/footer');
        
    }

    
    public function add_fintech_features()
    {
        $add_fintech_Model = new add_fintech_Model();
        if($add_fintech_Model->countAll()>0)
        {
            $data['fintch'] = $add_fintech_Model->get_all_data();  
        } else {
            $data['fintch'] = "";
        }
        
        $fintech_featuresModel = new fintech_featuresModel();
        if($fintech_featuresModel->countAll()>0)
        {
            $data['fintch_feature'] = $fintech_featuresModel->get_all_data();  
        } else {
            $data['fintch_feature'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('fintech/add_fintech_features',$data);
        echo view('templates/footer');
    }

    public function edit_fintech_features($id)
    {
        $add_fintech_Model = new add_fintech_Model();
        if($add_fintech_Model->countAll()>0)
        {
            $data['fintch'] = $add_fintech_Model->get_all_data();  
        } else {
            $data['fintch'] = "";
        }

        $fintech_featuresModel = new fintech_featuresModel();
        if($fintech_featuresModel->countAll()>0)
        {
            $fin_feat = $fintech_featuresModel->get_single_data($id);
            $data['id']  = $fin_feat[0]['id'];
            $data['fintech_name']  = $fin_feat[0]['fintech_name']; 
            $data['title']  = $fin_feat[0]['title']; 
            $data['content']  = $fin_feat[0]['content']; 
        } else {
            $data['id'] = "";
            $data['fintech_name'] = "";
            $data['title'] = "";
            $data['content'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('fintech/edit_fintech_features',$data);
        echo view('templates/footer');
        
    }

      //Solutions//

      public function add_solutions()
      {
          $add_solutionModel = new add_solutionModel();
          if($add_solutionModel->countAllResults()>0)
          {
              $data['solutions'] = $add_solutionModel->get_all_data();  
          } else {
              $data['solutions'] = "";
          }
          echo view('templates/header');
          echo view('templates/navbar');
          echo view('solutions/add_solutions',$data);
          echo view('templates/footer');
          
      }
      //Update Solution Name
      public function edit_solutions($id)
      {
          $add_solutionModel = new add_solutionModel();
          if($add_solutionModel->countAllResults()>0)
          { 
              $solution = $add_solutionModel->get_single_data1($id);
              
              $data['id']  = $solution[0]['id']; 
              $data['solution_name']  = $solution[0]['solution_name'];    
          } else {
              $data['id'] = "";
              $data['solution_name'] = "";
          }
          echo view('templates/header');
          echo view('templates/navbar');
          echo view('solutions/edit_solutions',$data);
          echo view('templates/footer');
          
      }
      //Solutions Content
      public function solutions_content() {
  
          $add_solutionModel = new add_solutionModel();
          if($add_solutionModel->countAllResults()>0)
          {
              $data['solutions'] = $add_solutionModel->get_all_data();  
          } else {
              $data['solutions'] = "";
          }
  
          $solution_contentModel = new solution_contentModel();
          if($solution_contentModel->countAllResults()>0)
          {
              $data['solution_content'] = $solution_contentModel->get_all_data();  
          } else {
              $data['solution_content'] = "";
          }
          echo view('templates/header');
          echo view('templates/navbar');
          echo view('solutions/solutions_content',$data);
          echo view('templates/footer');
          
      }
      //Update Solutions Content
      public function edit_solution_content($id) {
  
          $add_solutionModel = new add_solutionModel();
          if($add_solutionModel->countAllResults()>0)
          {
              $data['solutions'] = $add_solutionModel->get_all_data();  
          } else {
              $data['solutions'] = "";
          }
  
          $solution_contentModel = new solution_contentModel();
          if($solution_contentModel->countAllResults()>0)
          {
              $solution = $solution_contentModel->get_single_data($id);
             
              foreach($solution as $sol) {
                  $data['id'] =  $sol['id'];
                  $data['solution_id'] =  $sol['solution_id'];
                  $data['solution_name'] =  $sol['solution_name'];
                  $data['sub_solution_name'] =  $sol['sub_solution_name'];
                  $data['solution_subtitle'] =  $sol['solution_subtitle'];
                  $data['solution_image'] =  $sol['solution_image'];
                  $data['solution_content'] =  $sol['solution_content'];
              }  
              } else {
                  $data['id'] = "";
                  $data['solution_id'] =  "";
                  $data['solution_name'] =  "";
                  $data['sub_solution_name'] =  "";
                  $data['solution_subtitle'] = "";
                  $data['solution_image'] =  "";
                  $data['solution_content'] ="";
              }
  
           echo view('templates/header');
           echo view('templates/navbar');
           echo view('solutions/edit_solution_content',$data);
           echo view('templates/footer');
          
      }

    //career
    public function career()
    {
        $session = session();
        if($session->has('ID'))
        {
            $careerModel = new careerModel();
            if($careerModel->countAll()>0)
            {
            $data['career'] = $careerModel->get_all_data();  
            } else {
            $data['career'] = "";
            }
            echo view('templates/header');
            echo view('templates/navbar');
            echo view('pages/career',$data);
            echo view('templates/footer');
        }  
            else {
            return redirect()->to('login');
            }     
    }
    //Update
    public function editCareer($id)
    {
        $session = session();
        if($session->has('ID'))
        {
            $careerModel = new careerModel();
            if($careerModel->countAll()>0)
            {
                $career = $careerModel->get_single_data($id);     
                $data['id']  = $career[0]['id'];  
                $data['post_name']  = $career[0]['post_name'];
                $data['Designation']  = $career[0]['Designation'];
                $data['company_name']  = $career[0]['company_name'];
                $data['Deadline']  = $career[0]['Deadline'];
                $data['Job_Type']  = $career[0]['Job_Type'];
                $data['working_timeFrom']  = $career[0]['working_timeFrom'];
                $data['working_timeTo']  = $career[0]['working_timeTo'];
                $data['expFrom']  = $career[0]['expFrom'];
                $data['expTo']  = $career[0]['expTo'];
                $data['Location']  = $career[0]['Location'];
                $data['employees_total']  = $career[0]['employees_total'];
                $data['job_description']  = $career[0]['job_description'];
                $data['Job_Responsibility']  = $career[0]['Job_Responsibility'];
                $data['Education_Required']  = $career[0]['Education_Required'];
                $data['additional_req']  = $career[0]['additional_req'];
                $data['benefits']  = $career[0]['benefits'];
                $data['salary']  = $career[0]['salary'];
            } else {
                $data['id']  = "";
                $data['post_name']  = "";
                $data['Designation']  = "";
                $data['company_name']  = "";
                $data['Deadline']  = "";
                $data['Job_Type']  = "";
                $data['working_timeFrom']  = "";
                $data['working_timeTo']  = "";
                $data['expFrom']  = "";
                $data['expTo']  = "";
                $data['Location']  = "";
                $data['employees_total']  = "";
                $data['job_description']  = "";
                $data['Job_Responsibility']  = "";
                $data['Education_Required']  = "";
                $data['additional_req']  = "";
                $data['benefits']  = "";
                $data['salary']  = "";
            }
            echo view('templates/header');
            echo view('templates/navbar');
            echo view('pages/editCareer',$data);
            echo view('templates/footer');
        }
            else {
                return redirect()->to('login');
            }
            
    }
    //Youth Empowerment//

    public function youthEmpowerment()
    {
        $youthEmpowermentModel = new youthEmpowermentModel();
        if($youthEmpowermentModel->countAllResults()>0)
        {
            $data['youth'] = $youthEmpowermentModel->get_all_data();  
        } else {
            $data['youth'] = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('pages/youthEmpowerment',$data);
        echo view('templates/footer');
        
    }
    //Update Youth Empowerment
    public function edit_youthEmpowerment($id)
    {
        $youthEmpowermentModel = new youthEmpowermentModel();
        if($youthEmpowermentModel->countAllResults()>0)
        { 
            $youth = $youthEmpowermentModel->get_single_data($id);            
            $data['id']  = $youth[0]['id']; 
            $data['youth_title']  = $youth[0]['youth_Title'];    
            $data['youth_subtitle']  = $youth[0]['youth_Subtitle'];    
            $data['youth_img']  = $youth[0]['youth_Img'];    
            $data['youth_cont']  = $youth[0]['youth_Content'];    
        } else {
            $data['id'] = "";
            $data['youth_title']  = "";
            $data['youth_subtitle'] ="";
            $data['youth_img']  = "";
            $data['youth_cont']  = "";
        }
        echo view('templates/header');
        echo view('templates/navbar');
        echo view('pages/edit_youthEmpowerment',$data);
        echo view('templates/footer');
        
    }

    //SEO
     public function seo()
     {
        $session = session();
        if($session->has('ID')) {
                $seoModel = new seoModel();
            
                if($seoModel->countAll()>0)
                {
                    $seo = $seoModel->get_all_data();     
                    $data['id']  = $seo[0]['id'];  
                    $data['metaTitle']  = $seo[0]['meta_title'];
                    // $data['titleContent']  = $seo[0]['meta_title_content'];
                    $data['metaKeyword']  = $seo[0]['meta_keyword'];
                    // $data['metaKeywordContent']  = $seo[0]['meta_keyword_content'];
                    $data['metaDescription']  = $seo[0]['meta_description'];
                    $data['button']  = "Edit";
                    $data['form']  = "seo_update";
                } else {
                    $data['id']  = "";
                    $data['metaTitle']  = "";
                    // $data['titleContent']  = "";
                    $data['metaKeyword']  = "";
                    // $data['metaKeywordContent']  = "";
                    $data['metaDescription']  = '';
                    $data['button']  = "Add";
                    $data['form']  = "seo";
                }
                echo view('templates/header');
                echo view('templates/navbar');
                echo view('setting/seo',$data);
                echo view('templates/footer');
            } else {
                return redirect()->to('login');
            }
        }
    
}
