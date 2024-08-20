<?php

namespace App\Controllers\Organizer;

use App\Helpers\FlashMessage;
use App\Models\SubmittedApplications;
use App\Requests\Request;

class ApplicationSubmittedController extends OrganizerController
{
    public function show(Request $request, $arguments)
    {
        $applicationModel = new SubmittedApplications($arguments['id']);
        if(isset($applicationModel->id)){
            $applicationSubmitted = $applicationModel->toArray();
            $customInputs = unserialize($applicationModel->custom_inputs);
            var_dump($applicationModel->application());
            $applicationSubmitted = [...$applicationSubmitted, ...$customInputs];
        } else {
            FlashMessage::flash("Error", "Application Not Found", FlashMessage::FLASH_ERROR);
            $this->response->back();
        }
    }

    public function changeApplicationStatus(Request $request, $args)
    {   
        $inputs = $request->params;
        $submittedApplication = new SubmittedApplications();
        if(in_array($inputs['status'], ['waitlist', 'approved', 'denied'])) {  
            try {
                $submittedApplication->find($args['id']);
                $submittedApplication->status = $inputs['status'];
                $submittedApplication->save();
            } catch (\Exception $e) {
                $this->response->json(["type" => "error", "message" => $e->getMessage()]);
            }
        }
        $this->response->json(["type" => "success", "message" => "saved successfully"]);
    }
}