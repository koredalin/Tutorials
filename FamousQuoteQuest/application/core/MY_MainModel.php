<?php

class MY_MainModel extends CI_Model {

    protected $now = NULL;
    protected $questionsNumber;

    public function __construct() {
        parent::__construct();
        $this->now = date('Y-m-d H:i:s', time() + 2 * 60 * 60);
        $this->questionsNumber = $this->getQuestionsNumber();
    }

    protected function getQuestions() {
        $this->db->select('*');
        $queryQuestions = $this->db->get('question');
        if ($this->db->affected_rows($queryQuestions) == 0) {
            return array();
        }
        $questions = $queryQuestions->result_array();
        return $questions;
    }

    protected function getQuestionsNumber() {
        $questions = $this->getQuestions();
        if (empty($questions)) {
            $number = 0;
        } else {
            $number = count($questions);
        }
        return $number;
    }

    public function setSiteUpdateTime() {
        $lastUpdate = $this->getSiteUpdateTime();
        if (empty($lastUpdate) || !$lastUpdate) {
            $data=array('update_id'=>1, 'type_update' => 'site', 'time_update' => $this->now);
            $queryInsertUpdate = $this->db->insert('site_update', $data);
            // echo $this->db->mysql_error;
            if ($this->db->affected_rows($queryInsertUpdate) == 0) {
                echo 'Insert of update date - failed!';
                return false;
            }
        }
        $this->db->where('update_id', 1);
        $querySetUpdate = $this->db->update('site_update', array('type_update' => 'site', 'time_update' => $this->now));
        if ($this->db->affected_rows($querySetUpdate) == 0) {
            echo 'Update Set Failed!';
            return false;
        }
        return true;
    }

    public function getSiteUpdateTime() {
        $this->db->select('*');
        $this->db->from('site_update');
        $this->db->where('update_id', 1);
        $queryGetUpdate = $this->db->get();
        if ($queryGetUpdate->num_rows() == 0) {
            return array();
        }
        $row = $queryGetUpdate->row_array();
        return $row;
    }

}
