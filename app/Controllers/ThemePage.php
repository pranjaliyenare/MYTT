<?php

namespace App\Controllers;
use App\Models\ThemeModel;

class ThemePage extends BaseController
{
    public function Decentralized_Finance_Dev($page = 'Decentralized_Finance_Dev')
    {
        if (! is_file(APPPATH . 'Views/theme/DEFI/' .$page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }
         $themeModel = new ThemeModel();
         $data['template'] = $themeModel->template();
            
        $data['page'] = 'Decentralized Finance Development';
        echo view('theme/template/header', $data);
        echo view('theme/template/navbar');        
        echo view('theme/DEFI/'.$page);
        echo view('theme/template/footer');
    }

}