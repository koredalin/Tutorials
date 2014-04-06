<?php

class QuizController extends MY_MainController {
    private $model;
    public function __construct() {
        parent::__construct();
        $this->load->model('Quiz');
        $this->model=$this->Quiz;
    }
    
    public function index($elementsToRender='main') {
        $this->data['title']='Famous quote questions - Quiz';
        $this->data['elementsToRender']=$elementsToRender;
        $this->getSiteUpdateTime();
        $this->load_view_navigation('header', 'title', 'quizview', 'footer', $this->data);
    }
    
    public function getAllData() {
        $modelData=$this->model->getData();
        // var_dump($modelData);
        $this->echoResult($modelData);
    }
    
    public function getData() {
        $modelData=$this->model->getData();
        $firstElement=array();
        $firstElement[]=$modelData[0];
        // var_dump($modelData);
        $this->echoResult($firstElement);
    }
    
    public function getSiteUpdateTime() {
        $updateTime = $this->model->getSiteUpdateTime();
        if (is_array($updateTime) && !empty($updateTime)) {
            $this->data['lastUpdate'] = $updateTime['time_update'];
        }
    }
}

/*
 * 
if (empty($answer)) {
                        echo ('The database is NOT configured correctly. Fix it, please!');
                        exit;
                    } 
 * 
/**/