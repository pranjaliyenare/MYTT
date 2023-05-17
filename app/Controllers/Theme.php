<?php

namespace App\Controllers;
use App\Models\ThemeModel;
use App\Models\sendMailModel;
use App\Models\sendQuoteModel;
use App\Models\aboutModel;
use App\Models\emailModel;
use App\Models\footersettingModel;
use App\Models\homeModel;
use App\Models\logoModel;
use App\Models\partnersModel;
use App\Models\privacyModel;
use App\Models\refundModel;
use App\Models\socialmediaModel;
use App\Models\systemsettingModel;
use App\Models\termsModel;
use App\Models\whoModel;
use App\Models\careerModel;
use App\Models\happycustomerModel;
use App\Models\contactusModel;
use App\Models\multibranchesModel;
use App\Models\vissionModel;
use App\Models\missionModel;
use App\Models\ourstoryModel;
use App\Models\ourexpertiseModel;
use App\Models\jobApplyModel;
use App\Models\fintech_featuresModel;
use App\Models\youthEmpowermentModel;

class Theme extends BaseController
{
    public function home()
    {
        echo view('index');
    }
    public function index($page = 'index')
    {
         if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
             // Whoops, we don't have a page for that!
             throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
         }
         $themeModel = new ThemeModel();
         $data['template'] = $themeModel->template();

         $aboutModel = new aboutModel();
            if($aboutModel->countAll()>0)
            {
                $about = $aboutModel->get_all_data();
                $data['title']  = $about[0]['about_header'];
                $data['subtitle']  = $about[0]['about_subtitle'];
                $data['image']  = $about[0]['image'];
                $data['content']  = $about[0]['about_content'];
            } else {
                $data['title'] = 'About Us';
                $data['subtitle'] = 'Helping SME To Digitalized And User Friendly Solutions.';
                $data['image'] =  'about.png';
                $data['content'] = 'At <b>MYTT</b> We design and build stunning bespoke websites and we can help with a large scale of Digital marketing strategies. We believe creating a website should be  simple to use, affordable, and reliable to help entrepreneurs, professionals, and bloggers grow digitally.';
            }

            $homeModel = new homeModel();
            if($homeModel->countAll()>0)
            {
                $data['home'] = $homeModel->get_all_data();
            } else {
                $data['home'] = "";
            }

         $data['page'] = $page;
         $data['title'] = 'Home';
         echo view('theme/template/header',$data);
         echo view('theme/template/navbar');
         echo view('theme/index');
         echo view('theme/quote');
         echo view('theme/template/footer');
    }

    public function clients_feedback($page = 'clients_feedback')
    {
        if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $data['page'] = $page;
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/'.$page);
        echo view('theme/template/footer');
    }

    public function about($page = 'aboutus')
    {
        if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
         $themeModel = new ThemeModel();
         $data['template'] = $themeModel->template();
 
            $aboutModel = new aboutModel();
            if($aboutModel->countAllResults()>0)
            {
                $about = $aboutModel->get_all_data();
                $data['title']  = $about[0]['about_header'];
                $data['subtitle']  = $about[0]['about_subtitle'];
                $data['image']  = $about[0]['image'];
                $data['content']  = $about[0]['about_content'];
            } else { 
                $data['title'] = 'About Us';
                $data['subtitle'] = '';
                $data['image'] =  'about.png';
                $data['content'] = '';
            }

            $ourstoryModel = new ourstoryModel();
            if($ourstoryModel->countAllResults()>0)
            {
                $data['story'] = $ourstoryModel->get_all_data();
            } else {
                $data['story'] = "";
            }

            $ourexpertiseModel = new ourexpertiseModel();
            if($ourexpertiseModel->countAllResults()>0)
            {
                $data['expertise'] = $ourexpertiseModel->get_all_data();
            } else {
                $data['expertise'] = "";
            }

        $data['page'] = $page;
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/'.$page);
        echo view('theme/template/footer');
    }

    public function vision($page = 'vision')
    {
        if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
         $themeModel = new ThemeModel();
         $data['template'] = $themeModel->template();
 
            $vissionModel = new vissionModel();
            if($vissionModel->countAllResults()>0)
            {
                $about = $vissionModel->get_all_data();
                $data['title']  = $about[0]['vission_title'];
                $data['image']  = $about[0]['vission_image'];
                $data['content']  = $about[0]['vission_content'];
            } else { 
                $data['title'] = 'Vision';
                $data['subtitle'] = '';
                $data['image'] =  'vision.jpg';
                $data['content'] = '';
            }

        $data['page'] = $page;
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        echo view('theme/'.$page);
        echo view('theme/template/footer');
    }

    public function mission($page = 'mission')
    {
        if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
         $themeModel = new ThemeModel();
         $data['template'] = $themeModel->template();
 
            $missionModel = new missionModel();
            if($missionModel->countAllResults()>0)
            {
                $about = $missionModel->get_all_data();
                $data['title']  = $about[0]['mission_title'];
                $data['image']  = $about[0]['mission_image'];
                $data['content']  = $about[0]['mission_contents'];
            } else { 
                $data['title'] = $page;
                $data['subtitle'] = '';
                $data['image'] =  'mission.jpg';
                $data['content'] = '';
            }

        $data['page'] = $page;
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        echo view('theme/'.$page);
        echo view('theme/template/footer');
    }

    public function contact($page = 'contact')
    {
         if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
             // Whoops, we don't have a page for that!
             throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
         }
         $themeModel = new ThemeModel();
         $data['template'] = $themeModel->template();

         $contactusModel = new contactusModel();
         if ($contactusModel->countAll()>0) {
             $contactus = $contactusModel->get_all_data();
             $data['title'] = 'Contact Us';
             $data['mobile']  = $contactus[0]['contact_mobile'];
             $data['email']  =  $contactus[0]['contact_email'];
             $data['address'] = $contactus[0]['contact_address'];
             $data['image']  =  base_url().'/assets/images/upload_image/'.$contactus[0]['contact_image'];
             $data['content'] = $contactus[0]['contact_content'];
         } else {
            $data['title'] = 'Contact Us';
            $data['mobile']  = "1234567890";
            $data['email']  = "info@mytt.in";
            $data['address'] = "Pune";
            $data['image']  = base_url().'/assets/images/upload_image/contact.png';
            $data['content'] = "";
         }

        $data['page'] = $page;


         echo view('theme/template/header', $data);
         echo view('theme/template/navbar');
         
         echo view('theme/'.$page);
         echo view('theme/template/footer');
    }

    public function send_message()
    {
        $session = session();
       $email = \Config\Services::email();
       $from = $this->request->getVar('email');
       $name = $this->request->getVar('name');
       $to = $this->request->getVar('support_email');
       $phone =$this->request->getVar('phone');
       $message =$this->request->getVar('message');

        //Send Messsage
         $email->setFrom($from, $name);
         $email->setTo($to);
         $email->setSubject($phone);
         $email->setMessage("<b>Phone : </b>".$phone."<br>".$message);

         if ($email->send())
		{
            echo $action="success";
            session()->setFlashdata('message', 'Send Message Successfully!');
            session()->setFlashdata('alert-class', 'alert-success');
        }
		else
		{
            echo $action="failed";
            session()->setFlashdata('message', 'Message Not Send, Please Check Your Email Id...!!!');
            session()->setFlashdata('alert-class', 'alert-danger');
        }

        $emailInsert = [
            'name' => $name,
            'from' => $from,
            'to'    => $to,
            'mobile'    => $phone,
            'message'    => $message,
            'action'    => $action
        ];
        $model = new sendMailModel();
        $model->save($emailInsert);
        return $this->response->redirect(site_url('contact'));
    }


    public function service($page = 'service')
    {
        if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $data['page'] = $page;
        $data['title'] = 'Services';
        $data['subtitle'] = 'The Best IT Solution With 10 Years of Experience';
        $data['image'] =  base_url().'/assets/images/upload_image/about.jpg';
        $data['content'] = 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna dolore erat amet';

        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/'.$page);
        echo view('theme/template/footer');
    }

    public function services($page)
    {
        if (! is_file(APPPATH . 'Views/theme/services.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();
        $data['service'] = $themeModel->service($page);
        
        if($data['service']) {
            $data['page'] = $page;
            $data['title'] = $page;
            
            echo view('theme/template/header', $data);
            echo view('theme/template/navbar');
            echo view('theme/services');
            echo view('theme/template/footer');
        } else {
            return $this->response->redirect(site_url('index'));
        }
    }

    public function ongoing_project($page = 'ongoing_project')
    {
        if (! is_file(APPPATH . 'Views/theme/project/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $data['page'] = $page;
        $data['title'] = 'Ongoing Projects';
        $data['subtitle'] = 'The Best IT Solution With 10 Years of Experience';
        $data['image'] =  base_url().'/assets/images/upload_image/about.jpg';
        $data['content'] = 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna dolore erat amet';

        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/project/'.$page, $data);
        echo view('theme/template/footer');
    }

    public function upcoming_project($page = 'upcoming_project')
    {
        if (! is_file(APPPATH . 'Views/theme/project/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $data['page'] = $page;
        $data['title'] = 'Upcoming Projects';
        $data['subtitle'] = 'The Best IT Solution With 10 Years of Experience';
        $data['image'] =  base_url().'/assets/images/upload_image/about.jpg';
        $data['content'] = 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna dolore erat amet';

        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/project/'.$page);
        echo view('theme/template/footer');
    }

    public function project($page, $id)
    {
        if (! is_file(APPPATH . 'Views/theme/project/project.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();
        $data['project'] = $themeModel->project($id);

        $data['page'] = $page;
        $data['title'] = $page;
        
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');        
        echo view('theme/project/project');
        echo view('theme/template/footer');
    }


    public function team($page = 'team')
    {
        if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $data['page'] = $page;
        $data['title'] = 'Team Members';
        $data['subtitle'] = 'The Best IT Solution With 10 Years of Experience';
        $data['image'] =  base_url().'/assets/images/upload_image/about.jpg';
        $data['content'] = 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna dolore erat amet';
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/'.$page);
        echo view('theme/template/footer');
    }

    public function testimonial($page = 'testimonial')
    {
        if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $data['page'] = $page;
        $data['title'] = 'Testimonial';
        $data['subtitle'] = 'The Best IT Solution With 10 Years of Experience';
        $data['image'] =  base_url().'/assets/images/upload_image/about.jpg';
        $data['content'] = 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna dolore erat amet';
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/'.$page);
        echo view('theme/template/footer');
    }

    public function price($page = 'price')
    {
        if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $data['page'] = $page;
        $data['title'] = 'Prices';
        $data['subtitle'] = 'The Best IT Solution With 10 Years of Experience';
        $data['image'] =  base_url().'/assets/images/upload_image/about.jpg';
        $data['content'] = 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna dolore erat amet';
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/'.$page);
        echo view('theme/template/footer');
    }

    public function quote($page = 'quote')
    {
        if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $data['page'] = $page;
        $data['title'] = 'Free Quote';
        $data['subtitle'] = 'Need A Free Quote? Please Feel Free to Contact Us';
        $data['image'] =  base_url().'/assets/images/upload_image/about.jpg';
        $data['content'] = "If You're Looking For Innovative, Creative, Short Time Deliverable Company, You've Come to the Right Place. We Offer Objective Advice, If You have Any Queries Fill Free To Contact Us";

        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/'.$page);
        echo view('theme/template/footer');
    }

    public function send_quote()
    {
        $session = session();
        $email = \Config\Services::email();
        $from = $this->request->getVar('email');
        $name = $this->request->getVar('name');
        $mobile =$this->request->getVar('mobile');
        $to = $this->request->getVar('quote_email');
        $subject =$this->request->getVar('service');
        $message =$this->request->getVar('message');

        //Send Messsage
         $email->setFrom($from, $name);
         $email->setTo($to);
         $email->setSubject($subject);
         $email->setMessage("Phone : ".$mobile." - <br/><br/>".$message);

         if ($email->send())
		{
            echo $action="success";
            session()->setFlashdata('message', 'Send Message Successfully!');
            session()->setFlashdata('alert-class', 'alert-success');
        }
		else
		{
            echo $action="failed";
            session()->setFlashdata('message', 'Message Not Send, Please Check Your Email Id...!!!');
            session()->setFlashdata('alert-class', 'alert-danger');
        }

        $quoteInsert = [
            'name' => $name,
            'mobile' => $mobile,
            'from' => $from,
            'to'    => $to,
            'service'    => $subject,
            'subject'    => $subject,
            'message'    => $message,
            'action'    => $action
        ];
        $model = new sendQuoteModel();
        $model->save($quoteInsert);
        return $this->response->redirect(site_url('Theme/quote'));
    }

    public function feature($page = 'feature')
    {
        if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $data['page'] = $page;
        $data['title'] = 'Feature';
        $data['subtitle'] = 'The Best IT Solution With 10 Years of Experience';
        $data['image'] =  base_url().'/assets/images/upload_image/about.jpg';
        $data['content'] = 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna dolore erat amet';
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/'.$page);
        echo view('theme/template/footer');
    }

    public function blog($page = 'blog')
    {
        if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $data['page'] = $page;
        $data['title'] = 'Blog Grid';
        $data['subtitle'] = 'The Best IT Solution With 10 Years of Experience';
        $data['image'] =  base_url().'/assets/images/upload_image/about.jpg';
        $data['content'] = 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna dolore erat amet';
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/'.$page);
        echo view('theme/template/footer');
    }

    public function detail($page = 'detail')
    {
        if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $data['page'] = $page;
        $data['title'] = 'Blog Details';
        $data['subtitle'] = 'The Best IT Solution With 10 Years of Experience';
        $data['image'] =  base_url().'/assets/images/upload_image/about.jpg';
        $data['content'] = '';

        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/'.$page);
        echo view('theme/template/footer');
    }

    public function terms_and_condition($page = 'terms_and_condition')
    {
        if (! is_file(APPPATH . 'Views/theme/legal/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $data['page'] = $page;
        $termsModel = new termsModel();
        if($termsModel->countAll()>0)
        {
            $terms = $termsModel->get_all_data();
            $data['title'] = $terms[0]['term_header'];
            $data['subtitle'] = $terms[0]['term_subtitle'];
            $data['image'] =  base_url().'/assets/images/upload_image/'.$terms[0]['image'];
            $data['content'] = $terms[0]['term_condition_content'];
         }
         else {
            $data['title'] = 'Terms And Conditions';
            $data['subtitle'] = 'Is a Terms and Conditions Agreement Required';
            $data['image'] =  base_url().'/assets/images/upload_image/terms.jpg';
            $data['content'] = '';
         }
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/legal/'.$page);
        echo view('theme/template/footer');
    }

    public function privacypolicy($page = 'privacypolicy')
    {
        if (! is_file(APPPATH . 'Views/theme/legal/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $data['page'] = $page;
        $privacyModel = new privacyModel();
        if($privacyModel->countAll()>0)
        {
            $privacy = $privacyModel->get_all_data();
            $data['title'] = $privacy[0]['privacy_header'];
            $data['subtitle'] = $privacy[0]['privacy_subtitle'];
            $data['image'] =  base_url().'/assets/images/upload_image/'.$privacy[0]['image'];
            $data['content'] = $privacy[0]['privacy_content'];

        } else {
            $data['title'] = 'Privacy Policy';
            $data['subtitle'] = 'MYTT Privacy Policy';
            $data['image'] =  base_url().'/assets/images/upload_image/privacy.jpg';
            $data['content'] = '';
        }
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/legal/'.$page);
        echo view('theme/template/footer');
    }

    public function refund_cancel($page = 'refund_cancel')
    {
        if (! is_file(APPPATH . 'Views/theme/legal/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $refundModel = new refundModel();
        if($refundModel->countAll()>0)
        {
            $refund = $refundModel->get_all_data();
            $data['page'] = $page;
            $data['title'] = $refund[0]['refund_header'];
            $data['subtitle'] = $refund[0]['refund_subtitle'];
            $data['image'] =  base_url().'/assets/images/upload_image/'.$refund[0]['image'];
            $data['content'] = $refund[0]['refund_content'];
        } else {
            $data['page'] = $page;
            $data['title'] = 'Refund And Cancellation';
            $data['subtitle'] = 'MYTT Refund And Cancellation';
            $data['image'] =  base_url().'/assets/images/upload_image/refund.png';
            $data['content'] = '';
        }

        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/legal/'.$page);
        echo view('theme/template/footer');
    }

    public function branch($page = 'branch')
    {
        if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $data['page'] = $page;

        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $multibranchesModel = new multibranchesModel();
        if($multibranchesModel->countAll()>0)
        {
            $data['title'] = 'Branches';
            $data['multibranches'] = $multibranchesModel->get_all_data();
        } else {
            $data['title'] = 'Branches';
            $data['multibranches'] = '';
        }
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        
        echo view('theme/'.$page);
        echo view('theme/template/footer');
    }

    public function partner($page)
    {
        if (! is_file(APPPATH . 'Views/theme/partner.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();
        //Partners
        $data['partner'] = $themeModel->partners($page);
        // $partnersModel = new partnersModel();
        // if($partnersModel->countAll()>0)
        // {
        //     $data['partner'] = $partnersModel->get_all_data();  
        // } else {
        //     $data['partner'] = "";
        // }

        $data['title'] = $page;
        $data['page'] = $page;
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');        
        echo view('theme/partner');
        echo view('theme/template/footer');
    }

    public function fintech($page, $id)
    {
        if (! is_file(APPPATH . 'Views/theme/fintech.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();
        $data['fintech'] = $themeModel->fintech($id);
        
        if($data['fintech']) {
            $fintech_featuresModel = new fintech_featuresModel();
            if($fintech_featuresModel->countAll()>0)
            {
                $data['fintch_feature'] = $fintech_featuresModel->get_all_data();  
            } else {
                $data['fintch_feature'] = "";
            }
        
            $data['id'] = $id;
            $data['page'] = $page;
            $data['title'] = $page;
            
             echo view('theme/template/header', $data);
             echo view('theme/template/navbar');
             echo view('theme/fintech');
             echo view('theme/template/footer');
        } else {
            return $this->response->redirect(site_url('index'));
        }
    }

    public function solution($page, $id)
    {
        if (! is_file(APPPATH . 'Views/theme/solution.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();
        $data['solution'] = $themeModel->solution($page);
        //print_r($data['solution']);
        if($data['solution']) {
            $data['page'] = $page;
            $data['title'] = $page;
            
             echo view('theme/template/header', $data);
             echo view('theme/template/navbar');
             echo view('theme/solution');
             echo view('theme/template/footer');
        } else {
            return $this->response->redirect(site_url('index'));
        }
    }
    
    public function youth_empowerment($page = 'youth_empowerment')
    {
        if (! is_file(APPPATH . 'Views/theme/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $youthEmpowermentModel = new youthEmpowermentModel();
        if($youthEmpowermentModel->countAll()>0)
        {
            $data['youth'] = $youthEmpowermentModel->get_all_data();  
        } else {
            $data['youth'] = "";
        }

        $data['page'] = 'Youth Empowerment';
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        echo view('theme/'.$page);
        echo view('theme/template/footer');
    }    

    //Career
    public function career($page = 'career')
    {
        if (! is_file(APPPATH . 'Views/theme/career/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $careerModel = new careerModel();
        if($careerModel->countAll()>0)
        {
            $data['career'] =$careerModel->get_all_data();
        
        } else {
                  
        }

        $data['page'] = $page;
        $data['title'] = 'Career'; 

        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        echo view('theme/career/'.$page);
        echo view('theme/template/footer');
    }

    public function careerContent($page, $id)
    {
        if (! is_file(APPPATH . 'Views/theme/career/careerContent.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

        $careerModel = new careerModel();
         if($careerModel->countAll()>0)
         {
            $data['careerContent'] = $careerModel->get_single_data($id);
         } else {
            $data['careerContent'] = '';
         }

         $data['page'] = $page;
         $data['title'] =$page;
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        echo view('theme/career/careerContent');
        echo view('theme/template/footer');
    }

    public function apply($page, $id)
    {
        if (! is_file(APPPATH . 'Views/theme/career/apply.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
        $themeModel = new ThemeModel();
        $data['template'] = $themeModel->template();

         $data['title'] = $page;
        $data['page'] = $page;
        $data['id'] = $id;
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');
        echo view('theme/career/apply');
        echo view('theme/template/footer');
    }

    public function applyForm()
    {
        $session = session();
        $email = \Config\Services::email();
        $name = $this->request->getVar('name');
        $from = $this->request->getVar('email');
        $to = $this->request->getVar('support_email');
        $job_type = $this->request->getVar('job_type');
        $job_id = $this->request->getVar('job_id');
        $phone =$this->request->getVar('phone');
        $message =$this->request->getVar('message');
        $cv =$this->request->getFile('cv');
        $cvName =$this->request->getVar('name')."".$cv->getName();
         if($cv->isValid()) {
             $cv->move('./assets/images/upload_image/Resume/', $cvName, true);
         } 
         //Send Messsage
          $email->setFrom($from, $name);
          $email->setTo($to);
          $email->setSubject('Job Apply : '.$job_type);
          $email->setMessage("Mobile :".$phone." <br/> Job Type : ".$job_type." <br/> ". $message);
          
          if ($email->send())
           {
              echo $action="success";
              session()->setFlashdata('message', 'Send Message Successfully!');
              session()->setFlashdata('alert-class', 'alert-success');
          }
           else
           {
              echo $action="failed";
              session()->setFlashdata('message', 'Message Not Send, Please Check Your Email Id...!!!');
              session()->setFlashdata('alert-class', 'alert-danger');
          }
 
         $jobInsert = [
             'name' => $name,
             'email' => $from,	
             'support_email' => $to,	
             'phone' =>$phone,
             'cv'=> $cvName,
             'job_type' => $job_type,
             'message' => $message
         ];
        
         $jobModel = new jobApplyModel();
         $jobModel->insert_data($jobInsert);
         
         return $this->response->redirect(site_url("apply/".$job_type."/".$job_id));
    }

}