<?php 
namespace App\Models;
use CodeIgniter\Model;

class ThemeModel extends Model
{
    //Footer
    public function template()
    {
            $template['name'] = "";
            $template['url'] = "";
            $template['address'] ="";
            $template['phone'] ="";
            $template['email'] ="";
            $template['footer_copy'] = "";
            $template['footer_link'] = "";
            $template['developed_by'] ="";
            $template['general_email'] = "";
            $template['support_email'] = "";
            $template['quote_email'] = "";

             $template['meta_title'] = "";
             $template['meta_keyword'] = "";
             $template['meta_description'] = "";

        $db = \Config\Database::connect();
        $query = $db->table('mytt_web_system_setting_table')->get();
            foreach ($query->getResult() as $row) {
                $template['name'] = $row->site_name;
                $template['url'] = $row->site_url;
                $template['address'] = $row->site_address;
                $template['phone'] = $row->phone;
                $template['email'] = $row->email;
            }

        $queryFooter = $db->table('mytt_web_footer_setting_table')->get();
            foreach ($queryFooter->getResult() as $rowFooter) {
                $template['footer_copy'] = $rowFooter->footer_copy;
                $template['footer_link'] = $rowFooter->footer_link;
                $template['developed_by'] = $rowFooter->developed_by;
            }

        $queryEmail = $db->table('mytt_web_email_setting_table')->get();
            foreach ($queryEmail->getResult() as $rowEmail) {
                $template['general_email'] = $rowEmail->general_email;
                $template['support_email'] = $rowEmail->support_email;
                $template['quote_email'] = $rowEmail->quote_email;
            }

            $queryMeta = $db->table('mytt_web_seo_table')->get();
            foreach($queryMeta->getResult() as $meta){
                $template['metaTitle'] = $meta->meta_title;
                $template['metaKeyword'] = $meta->meta_keyword;
                $template['metaDescription'] = $meta->meta_description;
            }

        $queryService = $db->table('mytt_web_add_service_table')->where('status != ', 2)->get();
        $template['service'] = $queryService->getResultArray();

        $queryServiceContent = $db->table('mytt_web_service_content_table')->where('status != ', 2)->get();
        $template['service_content'] = $queryServiceContent->getResultArray();

        $queryProduct = $db->table('mytt_web_add_proj_name_table')->where('status != ', 2)->get();
        $template['projects'] = $queryProduct->getResultArray();

        $queryCategory = $db->table('mytt_web_proj_category_table')->where('status != ', 2)->get();
        $template['category'] = $queryCategory->getResultArray();

        $queryProjName = $db->table('mytt_web_add_proj_name_table')->where('status != ', 2)->get();
        $template['projName'] = $queryProjName->getResultArray();

        $queryfintech = $db->table('mytt_web_fintech_table')->where('status != ', 2)->get();
        $template['fintech'] = $queryfintech->getResultArray();

        $querypartnersType = $db->table('mytt_web_partners_type_table')->where('status != ', 2)->get();
        $template['partnersType'] = $querypartnersType->getResultArray();

        $querySolution = $db->table('mytt_web_add_solution_table')->get();
        $template['solution'] = $querySolution->getResultArray();

        return $template;
    }

    // Services Pages
    public function service($id)
    {
        $db = \Config\Database::connect();
        $queryService = $db->table('mytt_web_service_content_table')->where('sub_service_name', $id)->get();
        $services = $queryService->getResultArray();
        return $services;
    }

    // Projects Pages
    public function project($id)
    {
         $db = \Config\Database::connect();
        $query = $db->query("SELECT *  FROM `mytt_web_add_proj_content_table` AS proj_cont  INNER JOIN `mytt_web_add_proj_name_table` AS proj_name ON proj_name.id = proj_cont.proj_name AND proj_name.status != 2 WHERE proj_cont.`status` != 2 AND proj_cont.proj_name = ".$id."");
        $projects = $query->getResultArray();
        return $projects;
    }

     // Projects Content
     public function fintech($id)
     {
          $db = \Config\Database::connect();
         $query = $db->query("SELECT *  FROM `mytt_web_fintech_content_table` AS fin_cont  WHERE 'status' != 2 AND `fintech_id` = '".$id."'");
         $fintech = $query->getResultArray();
         return $fintech;
     }

     // Projects Content
     public function partners($id)
     {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT *  FROM `mytt_web_partners_contents_table`  WHERE 'status' != 2 AND `partnersType` = '".$id."'");
        $partner = $query->getResultArray();
        return $partner;
     }

     public function solution($id)
     {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT *  FROM `mytt_web_solution_content_table`  WHERE 'status' != 2 AND `solution_name` = '".$id."'");
        $partner = $query->getResultArray();
        return $partner;
     }
}