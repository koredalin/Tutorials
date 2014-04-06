<?php

class CmsController extends MY_MainController {

    private $model;

    public function __construct() {
        parent::__construct();
        $this->load->model('Cms');
        $this->model = $this->Cms;
    }

    public function index() {
        $this->data['title'] = 'Famous quote questions - CMS';
        $this->getSiteUpdateTime();
        $this->load_view_navigation('header', 'title', 'cmsview', 'footer', $this->data);
    }

    public function setSiteUpdateTime() {
        //echo 'tralala';
        $this->model->setSiteUpdateTime();
        $this->index();
    }

    public function getSiteUpdateTime() {
        $updateTime = $this->model->getSiteUpdateTime();
        if (is_array($updateTime) && !empty($updateTime)) {
            $this->data['lastUpdate'] = $updateTime['time_update'];
        }
    }

}
