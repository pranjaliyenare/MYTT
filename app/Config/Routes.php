<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Theme::index');
$routes->get('index', 'Theme::index');

//Admin Panel
$routes->get('login', 'Admin::index');
$routes->get('dashboard', 'Home::index');
$routes->get('email', 'Home::email');
$routes->get('systemsetting', 'Home::systemsetting');
$routes->get('footersetting', 'Home::footersetting');
$routes->get('logo', 'Home::logo');
$routes->get('privacy', 'Home::privacy');
$routes->get('refund', 'Home::refund');
$routes->get('terms', 'Home::terms');
$routes->get('socialmedia', 'Home::socialmedia');
$routes->get('editSocialmedia/(:num)', 'Home::editSocialmedia/$1');
$routes->get('admin', 'Home::admin');
$routes->get('about', 'Home::about');
$routes->get('home', 'Home::home');
$routes->get('edithome/(:num)', 'Home::edithome/$1');
$routes->get('contactus', 'Home::contactus');
$routes->get('mission', 'Home::mission');
$routes->get('add_partners', 'Home::add_partners');
$routes->get('edit_partner/(:num)', 'Home::edit_partner/$1');
$routes->get('add_partners_content', 'Home::add_partners_content');
$routes->get('editpartnersContents/(:num)', 'Home::editpartnersContents/$1');
$routes->get('vission', 'Home::vission');
$routes->get('projects', 'Home::projects');
$routes->get('multibranches', 'Home::multibranches');
$routes->get('editMultibranches/(:num)', 'Home::editMultibranches/$1');
$routes->get('who', 'Home::who');
$routes->get('vender', 'Home::vender');
$routes->get('happycustomer', 'Home::happycustomer');
$routes->get('sendMail', 'Home::sendMail');
$routes->get('sendQuote', 'Home::sendQuote');
$routes->get('business', 'Home::business');
$routes->get('careerMYTT', 'Home::career');
$routes->get('editCareer/(:num)', 'Home::editCareer/$1');
$routes->get('ourexpertise', 'Home::ourexpertise');
$routes->get('editOurexpertise/(:num)', 'Home::editOurexpertise/$1');
$routes->get('ourstory', 'Home::ourstory');
$routes->get('editourstory/(:num)', 'Home::editourstory/$1');
$routes->get('add_service', 'Home::add_service');
$routes->get('edit_service_content/(:num)', 'Home::edit_service_content/$1');
$routes->get('services_content', 'Home::services_content');
$routes->get('editService/(:num)', 'Home::editService/$1');
$routes->get('add_proj_name', 'Home::add_proj_name');
$routes->get('proj_category', 'Home::proj_category');
$routes->get('proj_contents', 'Home::proj_contents');
$routes->get('edit_project_name/(:num)', 'Home::edit_project_name/$1');
$routes->get('edit_project_category/(:num)', 'Home::edit_project_category/$1');
$routes->get('add_fintech', 'Home::add_fintech');
$routes->get('add_fintech_content', 'Home::add_fintech_content');
$routes->get('edit_fintech/(:num)', 'Home::edit_fintech/$1');
$routes->get('edit_fintech_contents/(:num)', 'Home::edit_fintech_contents/$1');
$routes->get('add_fintech_features', 'Home::add_fintech_features');
$routes->get('edit_fintech_features/(:num)', 'Home::edit_fintech_features/$1');
$routes->get('logout', 'Admin::logout');
$routes->get('add_solutions', 'Home::add_solutions');
$routes->get('edit_solutions/(:num)', 'Home::edit_solutions/$1');
$routes->get('solutions_content', 'Home::solutions_content');
$routes->get('edit_solution_content/(:num)', 'Home::edit_solution_content/$1');
$routes->get('edit_youthEmpowerment/(:num)', 'Home::edit_youthEmpowerment/$1');
$routes->get('youthEmpowerment', 'Home::youthEmpowerment');
$routes->get('jobList', 'Home::jobList');
$routes->get('seo', 'Home::seo');

//Theme 
$routes->get('index', 'Theme::index');
$routes->get('aboutus', 'Theme::about');
$routes->get('contact', 'Theme::contact');
$routes->get('service', 'Theme::service');
$routes->get('project/(:any)/(:num)', 'Theme::project/$1/$2');
$routes->get('team', 'Theme::team');
$routes->get('quote', 'Theme::quote');
$routes->get('branch', 'Theme::branch');
$routes->get('partner/(:any)', 'Theme::partner/$1');
$routes->get('terms_and_condition', 'Theme::terms_and_condition');
$routes->get('privacypolicy', 'Theme::privacypolicy');
$routes->get('refund_cancel', 'Theme::refund_cancel');
$routes->get('clients_feedback', 'Theme::clients_feedback');
$routes->get('services/(:any)', 'Theme::services/$1');
$routes->get('comp_vision', 'Theme::vision');
$routes->get('comp_mission', 'Theme::mission');
$routes->get('fintech/(:any)/(:num)', 'Theme::fintech/$1/$2');
$routes->get('solution/(:any)/(:num)', 'Theme::solution/$1/$2');
$routes->get('career', 'Theme::career');
$routes->get('careerContent/(:any)', 'Theme::careerContent/$1');
$routes->get('apply/(:any)', 'Theme::apply/$1');
$routes->get('youth_empowerment', 'Theme::youth_empowerment');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
