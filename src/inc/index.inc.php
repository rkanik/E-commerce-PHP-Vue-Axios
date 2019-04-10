<?php 
    class IndexInc{
        private $title = 'Home Page';

        public function getTitlle(){
            return $this->title;
        }
        
        public function getDbConnection(){
            echo 'in getDbConnection';
            require('db_connection.inc.php');
            //return $conn;
        }

        public function SubmitForm(){
            
            require('db_connection.inc.php');
            echo '<br>Form Submitted <br>';

        }
    }

    $ind = new IndexInc();

    if( isset($_POST['submit']) ){
        $ind->SubmitForm();
    }else{
        echo 'Form not Submitted';
        Header('Location: ../../index.php?e=e&iujkjh=jkjbfdcvdg');
    }
?>