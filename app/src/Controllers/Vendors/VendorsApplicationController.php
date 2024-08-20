<?php

namespace App\Controllers\Vendors;

use App\Auth\Auth;
use App\Helpers\FlashMessage;
use App\Helpers\Helper;
use App\Models\Applications;
use App\Models\SubmittedApplications;
use App\Requests\Request;
use App\Validation\NewSubmittedApplicationValidator;

class VendorsApplicationController extends VendorsController
{
    public function index()
    {
        $user = Auth::user();
        $applicationsModel = new Applications();
        $applicationsModel->getAvailableApplications();
        $applications = $applicationsModel->toArray();
        foreach ( $applications as &$application ) {
            $application['status'] = null;
            $submittedApplicationModel = new SubmittedApplications();
            $submittedApplication = $submittedApplicationModel->findByUserIdApplicationId($user->id, $application['id']);
            if ($submittedApplication) {
                $application['status'] = $submittedApplication->status;
            }
        }
        $this->data['applications'] = $applications;
        $this->response->render('Vendors/Applications/indexApplication', 
            $this->data
        );
    }

    public function apply(Request $request, $args)
    {
        $user = Auth::user();
        $submittedApplicationModel = new SubmittedApplications();
        $submittedApplication = $submittedApplicationModel->findByUserIdApplicationId($user->id, $args['id']);
        if ($submittedApplication) {
            FlashMessage::flash("Error", "You already sent your application", FlashMessage::FLASH_ERROR);
        } else {
            $application = new Applications();
            $application->find($args['id']);
            $this->data['application'] = $application;
            $this->data['userInfo'] = $user;
            $this->response->render('Vendors/Applications/applicationForm', 
                $this->data
            );
        }
    }

    public function store(Request $request, $args)
    {
        $user = Auth::user();
        $submittedApplicationModel = new SubmittedApplications();
        $submittedApplication = $submittedApplicationModel->findByUserIdApplicationId($user->id, $args['id']);
        if ($submittedApplication) {
            FlashMessage::flash("Error", "You already sent your application", FlashMessage::FLASH_ERROR);
            $this->response->back();
        } else {
            $newApplication = new NewSubmittedApplicationValidator();
            $inputs = $request->postParms;
            $validation = $newApplication->validate($inputs);
            if ($validation->failed()) {
                $_SESSION['old'] = $inputs;
                foreach($validation->getErrors() as $key=>$error) {
                    $errorName = "Errors In " . Helper::snakeToTitle($key);
                    FlashMessage::flash($errorName, implode(", ", $error), FlashMessage::FLASH_ERROR);
                    $this->response->back();
                }
            } else {           
                try{  
                    $application = new SubmittedApplications();
                    $defaultFormInputs= ['business_name', 'business_email', 'business_phone'];
                    $data = [];
                    $customInputs = [];
                    foreach($inputs as $key=>$input){
                        if(in_array($key, $defaultFormInputs)){
                            $data[$key] = $input;
                        } else {
                            $customInputs[$key] = $input;
                        }
                    }
                    $data['custom_inputs'] = serialize($customInputs);
                    $applicationData = [
                        ...$data,
                        'application_id' => $args['id'],
                        'user_id' => $user->id
                    ];
                    $application->create($applicationData);
                    FlashMessage::flash("Sucess", "Apllication sent successfully", FlashMessage::FLASH_SUCCESS);
                    $this->response->redirect(ROOT."/vendors/applications");
                } catch (\Exception $e) {
                    $_SESSION['old'] = $inputs;
                    FlashMessage::flash("Error", $e->getMessage(), FlashMessage::FLASH_ERROR);
                    $this->response->back();
                }
            }
        }
    }
}