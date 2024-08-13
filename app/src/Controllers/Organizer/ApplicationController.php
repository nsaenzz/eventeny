<?php

namespace App\Controllers\Organizer;

use App\Helpers\FlashMessage;
use App\Helpers\Helper;
use App\Models\Applications;
use App\Models\SubmittedApplications;
use App\Requests\Request;
use App\Validation\NewApplicationValidator;
use Respect\Validation\Rules\Regex;

class ApplicationController extends OrganizerController
{
    /**
     * Show all created applications 
     */
    public function index()
    {
        $applications = new Applications();
        $this->data['applications'] = $applications->all();
        $this->response->render('Organizer/Applications/indexApplications', 
            $this->data
        );
    }

    /**
     * Show all created applications 
     */
    public function show(Request $request, $arguments)
    {
        $application = new Applications($arguments['id']);
        $this->data['application'] = $application;
        $this->response->render('Organizer/Applications/showApplication', 
            $this->data
        );
    }


    /**
     * Create vendor application event
     * 
     */
    public function create()
    {
        $this->response->render('Organizer/Applications/createApplication', $this->data);
    }

    /**
     * Store new vendor application event
     * 
     */
    public function store(Request $request)
    {
        $newApplication = new NewApplicationValidator();
        $inputs = $request->postParms;
        $coverPhoto = $request->files['cover_photo'];
        $inputs['cover_photo_type'] = $coverPhoto['type'];
        $inputs['cover_photo_size'] = $coverPhoto['size'];
        $validation = $newApplication->validate($inputs);
        if ($validation->failed()) {
            $_SESSION['old'] = $inputs;
            foreach($validation->getErrors() as $key=>$error) {
                $errorName = "Errors In " . Helper::snakeToTitle($key);
                FlashMessage::flash($errorName, implode(", ", $error), FlashMessage::FLASH_ERROR);
            }
            $this->response->redirect('create');
        }

        try {
            $fileTmp = $coverPhoto['tmp_name'];
            $fileName = pathinfo($coverPhoto['name'], PATHINFO_FILENAME);
            $fileNamePath = 'applications/' . uniqid("{$fileName}-") . '.' . pathinfo($coverPhoto['name'], PATHINFO_EXTENSION);
            move_uploaded_file($fileTmp, IMAGE_PATH . $fileNamePath);

        } catch (\Exception $e) {
            $_SESSION['old'] = $inputs;
            FlashMessage::flash("Error", $e->getMessage(), FlashMessage::FLASH_ERROR);
            $this->response->redirect('create');
        }
        $applicationData = [
            'title' => trim($inputs['title']),
            'description' => trim($inputs['description']),
            'deadline_from' => date('Y-m-d H:i:s', strtotime($inputs['deadline_from'] . " 00:00:00")),
            'deadline_to' => date('Y-m-d H:i:s', strtotime($inputs['deadline_to'] . " 23:59:59")),
            'cover_photo' => ROOT . '/public/img/' . $fileNamePath,
            'price' => number_format($inputs['price'], 2)
        ];

        $application = new Applications();
        $newApplication = $application->create($applicationData);

        $this->response->send($newApplication);
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