<?php

class Quiz extends MY_MainModel {

    public function __construct() {
        parent::__construct();
    }

    public function getData() {
        if ($this->questionsNumber === 0) {
            return array();
        }
        $questions = $this->getQuestions();
        $question = 0;
        for ($row = 0; $row < $this->questionsNumber; $row++) {
            $question = $questions[$row];
            foreach ($question as $key => $value) {
                if ($question['right_answer_id']==1) {
                    $questions[$row]['right_answer']=true;
                }
                else if ($question['right_answer_id']==2) {
                    $questions[$row]['right_answer']=false;
                }
                else {
                    $answer=$this->getAnswerById($question['right_answer_id']);
                    if (empty($answer)) {
                        echo '<p>No right answer into the DB!</p>';
                        return array();
                    }
                    $questions[$row]['right_answer']=$answer['answer'];
                    $possibleAnswers=$this->getPossibleAnswersByQuestionId($question['question_id']);
                    if (empty($possibleAnswers)) {
                        echo '<p>No possible answers into the DB!</p>';
                        return array();
                    }
                    $questions[$row]['possible_answers']=$possibleAnswers;
                }
            }
        }
        // var_dump($question);
        return $questions;
    }
    
    public function getAnswerById($answerId) {
        $this->db->select('answer');
        $this->db->from('answer');
        $this->db->where('answer_id', $answerId);
        $queryAnswer=$this->db->get();
        if ($queryAnswer->num_rows()==0) {
            return array();
        }
        $row = $queryAnswer->row_array();
        return $row;
    }

    public function getPossibleAnswersByQuestionId($questionId) {
        $this->db->select('*');
        $this->db->from('possible_answer');
        $this->db->where('question_id', $questionId);
        $queryPossibleAnswers=$this->db->get();
        if ($queryPossibleAnswers->num_rows()==0) {
            return array();
        }
        $possibleAnswers=$queryPossibleAnswers->result_array();
        foreach ($possibleAnswers as $key => $row) {
            $pAnswer=$this->getAnswerById($possibleAnswers[$key]['answer_id']);
            $pAnswers[]= $pAnswer['answer'];
        }
        return $pAnswers;
    }
    
    public function getSiteUpdateTime() {
        return parent::getSiteUpdateTime();
    }
}
