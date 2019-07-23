<?php
    namespace models\quizCreation;

    /**
     * This class takes quiz config from forms on quiz creation page
     * by POST, validate it, create an array with this data
     */

    class quizArrayBuild
    {
        # Tuning page - name of quiz
        private $quiz_name;
        # Tuning page - description of quiz
        private $quiz_descr;

        private $questions_data = [];
        # Contacts page - title of contact block
        private $cb_header;
        # Contacts page - subtitle of contact block
        private $cb_descr;
        # Contacts page - data that user must enter to send results of quiz
        private $user_data = [];
        # Contacts page - email where quiz results should come
        private $recipient;

        # Hidden input - contains the number
        # of answer options for each question
        private $qc;

        # add to draft OR generate quiz code and add to database (draft || generate)
        private $quiz_operation;

        # Output array that contains all of data from forms in orderly form
        public $output_array = [];


        public function __construct()
        {
            $this->quiz_operation = $_POST['quiz_operation'] ?? false;

            # Tuning form
            $this->quiz_name = $_POST['quiz_name'] ?? false;
            $this->quiz_descr = $_POST['quiz_descr'] ?? false;

            # Contacts form
            $this->cb_header = $_POST['cb_header'] ?? false;
            $this->cb_descr = $_POST['cb_descr'] ?? false;
            $this->recipient = $_POST['recipient'] ?? false;

            $this->qc = explode(',', $_POST['qc']) ?? false;

            \array_push($this->user_data, $_POST['user_name'] ?? false, $_POST['user_phone'] ?? false, $_POST['user_email'] ?? false);

            $this->parseQuestionConfig();

            $this->validFormData();

            # add all received data to the array
            \array_push($this->output_array,
                        $this->quiz_operation,
                        $this->quiz_name,
                        $this->quiz_descr,
                        $this->questions_data,
                        $this->cb_header,
                        $this->cb_descr,
                        $this->user_data,
                        $this->recipient);
        }

        /**
         * Take data from question forms
         * and create a structured array with them.
         *
         * @method parseQuestionConfig
         */

        private function parseQuestionConfig() : void
        {
            for ($i = 0; $i < count($this->qc); $i++) {
                $answers = [];
                for ($j = 0; $j < $this->qc[$i]; $j++) {
                    \array_push($answers, $_POST["{$i}_question-{$j}_answer"]);
                }
                $out_arr = [
                    "question_{$i}" => [
                        'name' => $_POST["{$i}_question_name"],
                        'descr' => $_POST["{$i}_question_descr"],
                        'answer_choices' => $_POST["{$i}_answer_choices"],
                        'answers' => $answers
                    ]
                ];
                \array_push($this->questions_data, $out_arr);
            }
        }


        /**
         * Fields checking for emptiness
         *
         * @method validFormData
         */

        private function validFormData() : void
        {
            if ($this->quiz_operation == 'generate'){
                if ($this->quiz_name == false || $this->cb_header == false || $this->recipient == false){
                    die(\json_encode(['error' => 'Please, fill in all required fields (quiz name, contact block header and recipient email)!']));
                }
                $i = 0;
                foreach($this->user_data as $key => $value){
                    if ($value == false) $i++;
                    if ($i >= 2) die(\json_encode(['error' => 'You must checked minimum two checkbox!']));
                }
            }
            foreach($this->questions_data[0] as $key){
                if ($key['name'] == false)
                    die(\json_encode(['error' => 'You must fill in all the question!']));
                foreach($key['answers'] as $k => $v){
                    if ($v == false)
                        die(\json_encode(['error' => 'You must fill in all answer fields!']));
                }
            }
        }
    }
