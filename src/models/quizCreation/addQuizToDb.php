<?php

    namespace models\quizCreation;

    use core\Db;

    class addQuizToDb extends Db
    {
        public $quiz_array;
        public function __construct(array $output_array)
        {
            $this->quiz_array = $output_array;

            parent::__construct();
            $this->saveQuizConfigToDb();
        }

        public function saveQuizConfigToDb()
        {
            if ($this->quiz_array[0] == 'draft'){
                $serialized_array = \serialize($this->quiz_array);
                $sql_query = 'INSERT INTO quizzes(user_id, serialized_quiz) VALUES(?,?)';
                $values = [$_SESSION['user']['id'], $serialized_array];
            }
            elseif ($this->quiz_array[0] == 'generate'){
                # not now
            }

            $this->query($sql_query, $values);

            die(\json_encode('Quiz successfully saved to database!'));
        }
    }
