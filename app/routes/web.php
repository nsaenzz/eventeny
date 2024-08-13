<?php

use App\Controllers\ErrorsController;
use App\Controllers\HomepageController;
use App\Controllers\LoginController;
use App\Controllers\Organizer\ApplicationController;
use App\Controllers\Organizer\OrganizerDashboardController;
use App\Controllers\RegisterController;
use App\Controllers\Vendors\VendorsDashboardController;
use App\Controllers\Vendors\VendorsApplicationController;

return [
    ['GET', '/', [HomepageController::class, 'index']],
    ['GET', '/login', [LoginController::class, 'index']],
    ['GET', '/logout', [LoginController::class, 'logout']],
    ['POST', '/login', [LoginController::class, 'loginAuth']],
    ['GET', '/signup', [RegisterController::class, 'create']],
    ['POST', '/signup', [RegisterController::class, 'store']],

    //Organizer Pages
    ['GET', '/organizer', [OrganizerDashboardController::class, 'index']],
    ['GET', '/organizer/applications', [ApplicationController::class, 'index']],
    ['GET', '/organizer/applications/create', [ApplicationController::class, 'create']],
    ['POST', '/organizer/applications/create', [ApplicationController::class, 'store']],
    ['GET', '/organizer/applications/{id:\d+}', [ApplicationController::class, 'show']],
    ['PATCH', '/organizer/applications/submitted/{id:\d+}/status', [ApplicationController::class, 'changeApplicationStatus']],

    //Vendors Pages
    ['GET', '/vendors', [VendorsDashboardController::class, 'index']],
    ['GET', '/vendors/applications', [VendorsApplicationController::class, 'index']],
    ['GET', '/vendors/applications/{id:\d+}/apply', [VendorsApplicationController::class, 'apply']],
    ['POST', '/vendors/applications/{id:\d+}/apply', [VendorsApplicationController::class, 'store']],

    //Errors
    ['GET', '/404', [ErrorsController::class, 'notFound']],
];