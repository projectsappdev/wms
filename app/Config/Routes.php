<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}
/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function () {
    return view('not_found');
});
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'authGuard']);
$routes->get('/logout', 'admin::logout');
$routes->get('/register', 'admin::register');
$routes->get('manage/users', 'ManageAccount::index', ['filter' => 'authGuard']);
$routes->get('manage/admin', 'ManageAccountAdmin::index', ['filter' => 'authGuard']);
$routes->get('waste/barangay', 'WasteBarangay::index', ['filter' => 'authGuard']);
$routes->get('waste/dumpsite', 'WasteDumpsite::index', ['filter' => 'authGuard']);
$routes->get('report', 'GenerateReport::index', ['filter' => 'authGuard']);
$routes->get('printPDF', 'GenerateReport::printpdf', ['filter' => 'authGuard']);
$routes->get('printExcel', 'GenerateReport::excel_monthly', ['filter' => 'authGuard']);
$routes->get('/others', 'Others::index', ['filter' => 'authGuard']);
$routes->get('manage/reports', 'ManageReports::index', ['filter' => 'authGuard']);

$routes->get('/barangay_daily_submission', 'Dashboard::brgyDaily', ['filter' => 'authGuard']);
$routes->get('/view_notification', 'Notif::viewNotif', ['filter' => 'authGuard']);
$routes->get('/dashboards', 'Dashboard::dashboardAdmin', ['filter' => 'authGuard']);
$routes->get('reports', 'GenerateReport::reportAdministrator', ['filter' => 'authGuard']);
$routes->get('/change_password_administrator', 'Password::AdministratorPass', ['filter' => 'authGuard']);
$routes->get('/change_password_superadmin', 'Password::SuperadminPass', ['filter' => 'authGuard']);
//$routes->get('Administrator', 'Administrator::index', ['filter' => 'authFilter']);
$routes->get('manage/waste', 'ManageWaste::index', ['filter' => 'authGuard']);
//$routes->get('/logouts', 'administrator::logout');

$routes->get('/dataEntry', 'UserBarangay::index', ['filter' => 'userLogAuth']);
$routes->get('/userlogin', 'UserLog::index');
$routes->get('/userlogout', 'UserLog::logout');
$routes->get('/review', 'UserBarangay::reviewB', ['filter' => 'userLogAuth']);
$routes->get('/change_password_barangay', 'Password::BarangayPass', ['filter' => 'userLogAuth']);
$routes->get('/backlog_barangay', 'UserBarangay::backlog_entry', ['filter' => 'userLogAuth']);

$routes->get('/dataEntryDump', 'UserDumpsite::index', ['filter' => 'userLogAuth']);
$routes->get('reviewDump', 'UserDumpsite::reviewD', ['filter' => 'userLogAuth']);
$routes->get('/change_password_dumpsite', 'Password::DumpsitePass', ['filter' => 'userLogAuth']);


//$routes->get('admin/v_printpdf', 'GenerateReport::printpdf', ['filter' => 'authGuard']);



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
