<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'Frontend\Home::index');
$routes->get("send-mail", "Frontend\Home::sendMail");
$routes->match(['get', 'post'],"login", "Frontend\Authenticate::login");
$routes->post("validate-otp", "Frontend\Authenticate::validateOtp");
$routes->match(['get', 'post'],"bookings", "Frontend\Bookings::index", ['filter' => 'authclient']);
$routes->match(['get', 'post'],"search-rooms", "Frontend\Bookings::search", ['filter' => 'authclient']);
$routes->match(['get', 'post'],"guest-details", "Frontend\Bookings::guestDetails", ['filter' => 'authclient']);
$routes->match(['get', 'post'],"preview-booking", "Frontend\Bookings::previewBooking", ['filter' => 'authclient']);
$routes->get("my-bookings", "Frontend\Bookings::allBookings", ['filter' => 'authclient']);

$routes->match(['get','post'],"profile", "Frontend\Home::profile", ['filter' => 'authclient']);

$routes->get('about-us', 'Frontend\Home::about');
$routes->get('terms-conditions', 'Frontend\Home::termsConditions');
$routes->get('refund-policy', 'Frontend\Home::refund');
$routes->get('privacy-policy', 'Frontend\Home::privacy');
$routes->match(['get', 'post'],'contact-us', 'Frontend\Home::contact');

$routes->get('logout', 'Frontend\Authenticate::logout');

//Payment
$routes->match(['get','post'],'payment/status', 'Frontend\Payment::index');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

/**ADMIN ROUTES */
// $routes->get('/admin', 'Admin\Dashboard::index');
// $routes->get('/admin/rooms', 'Admin\Rooms::index');
// $routes->get('/admin/login', 'Admin\Users::login');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'] ,static function ($routes) {

    $routes->get("/", 'Dashboard::index', ['filter' => 'authadmin']);
    $routes->get("dashboard/2", 'Dashboard::index2', ['filter' => 'authadmin']);
    $routes->get('dashboard', 'Dashboard::index', ['filter' => 'authadmin']);

    $routes->match(['get', 'post'], 'login', 'Users::login', ['filter' => 'noauthadmin']);
    $routes->get('logout', 'Users::logout');

    // Rooms
    $routes->get('rooms', 'Rooms::index', ['filter' => 'authadmin']);
    $routes->match(['get', 'post'], 'rooms/addCategory', 'Rooms::addRoomCat', ['filter' => 'authadmin']);
    $routes->match(['get','post'],'rooms/editCategory/(:num)', 'Rooms::editRoomCat/$1', ['filter' => 'authadmin']);
    $routes->post('rooms/deleteRoomCat', 'Rooms::deleteRoomCat', ['filter' => 'authadmin']);
    
    $routes->match(['get', 'post'], 'rooms/add/(:num)', 'Rooms::addRoom/$1', ['filter' => 'authadmin']);
    $routes->post('rooms/createRoomNo', 'Rooms::createRoomNo', ['filter' => 'authadmin']);
    $routes->post('rooms/updateRoomNo', 'Rooms::updateRoomNo', ['filter' => 'authadmin']);
    $routes->post('rooms/deleteRoomNo', 'Rooms::deleteRoomNo', ['filter' => 'authadmin']);

    //Bookings
    $routes->get('bookings', 'Bookings::index', ['filter' => 'authadmin']);
    $routes->get('bookings/new', 'Bookings::newBookings', ['filter' => 'authadmin']);
    $routes->get('bookings/pending', 'Bookings::pendingBookings', ['filter' => 'authadmin']);
    $routes->get('bookings/completed', 'Bookings::completedBookings', ['filter' => 'authadmin']);
    $routes->get('bookings/active', 'Bookings::activeBookings', ['filter' => 'authadmin']);
    $routes->get('bookings/cancelled', 'Bookings::cancelledBookings', ['filter' => 'authadmin']);
    $routes->post('fetchbookings', 'Bookings::fetchBookings');
    $routes->post('bookings/deleteBooking', 'Bookings::deleteBooking', ['filter' => 'authadmin']);

    //Offline Bookings
    $routes->get('bookings/offline/check-dates', 'Bookings::offlineBooking', ['filter' => 'authadmin']);
    $routes->post('bookings/offline/select-rooms', 'Bookings::selectOfflineRooms', ['filter' => 'authadmin']);
    $routes->get('bookings/offline/norooms', 'Bookings::getAvailableRooms', ['filter' => 'authadmin']);
    $routes->match(['get','post'],'bookings/offline/billing', 'Bookings::offlineBilling', ['filter' => 'authadmin']);
    $routes->match(['get','post'],'bookings/offline/preview', 'Bookings::previewBooking', ['filter' => 'authadmin']);

    $routes->match(['get','post'],'bookings/update/', 'Bookings::updateBooking', ['filter'=>'authadmin']);
    $routes->match(['get','post'],'bookings/update/customerdetails/', 'Bookings::updateBookingCustomer', ['filter'=>'authadmin']);

    //Bookings Process
    $routes->get('bookings/view/(:alphanum)', 'Bookings::viewBooking/$1', ['filter'=>'authadmin']);
    $routes->get('bookings/activate/(:alphanum)', 'Bookings::activateBooking/$1', ['filter'=>'authadmin']);
    $routes->match(['get','post'],'bookings/checkIN', 'Bookings::checkInBooking', ['filter'=>'authadmin']);
    $routes->match(['get','post'],'bookings/roomAssign', 'Bookings::roomAssign', ['filter'=>'authadmin']);
    $routes->match(['get','post'],'bookings/selectRooms', 'Bookings::selectRooms', ['filter'=>'authadmin']);
    $routes->match(['get','post'],'bookings/releaseRooms', 'Bookings::releaseRooms', ['filter'=>'authadmin']);
    $routes->match(['get','post'],'bookings/checkOut', 'Bookings::checkOutRooms', ['filter'=>'authadmin']);
    $routes->match(['get','post'],'bookings/printInvoice', 'Bookings::printInvoice', ['filter'=>'authadmin']);

    //Settings
    $routes->match(['get','post'],'settings', 'Dashboard::settings', ['filter' => 'authadmin']);

    //TV packages
    $routes->match(['get','post'],'packages/manage', 'Tvpackages::manage', ['filter' => 'authadmin']);
    $routes->match(['get','post'],'packages/create', 'Tvpackages::create', ['filter' => 'authadmin']);
    $routes->match(['get','post'],'packages/update', 'Tvpackages::update', ['filter' => 'authadmin']);
    $routes->match(['get','post'],'packages/delete', 'Tvpackages::delete', ['filter' => 'authadmin']);

    //Assign TV packages to Room
    $routes->match(['get','post'],'packages/assignRoom', 'Tvpackages::assign_room', ['filter' => 'authadmin']);
    $routes->match(['get','post'],'packages/updateRoom', 'Tvpackages::assign_room_package', ['filter' => 'authadmin']);

    //Transactions
    $routes->match(['get','post'],'transactions', 'Transactions::index', ['filter' => 'authadmin']);

    //Calendar
    $routes->get('bookings/calendar', 'Bookings::calendarView', ['filter' => 'authadmin']);
    $routes->get('bookings/calendar_json', 'Bookings::calendar_json', ['filter' => 'authadmin']);




});