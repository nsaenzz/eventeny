<?php

namespace App\Controllers\Vendors;

class VendorsDashboardController extends VendorsController
{

    /**
     * Show organizer index page
     * 
     */
    public function index()
    {
        $this->response->render('Vendors/indexVendors');
    }
}

?>