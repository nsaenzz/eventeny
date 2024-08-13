<?php

namespace App\Controllers\Organizer;

class OrganizerDashboardController extends OrganizerController

{
    /**
     * Show organizer index page
     * 
     */
    public function index()
    {
        $this->response->render('Organizer/indexOrganizer');
    }
}