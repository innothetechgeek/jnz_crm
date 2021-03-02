<?php

class Migration_Version_272 extends CI_Migration
{
    public function up()
    {
        
            $this->dbforge->add_field(array(

                  'question_id' => array(
                        'type' => 'INT',
                        'constraint' => 10,
                        'unsigned' => TRUE,
                        'auto_increment' => TRUE
                  ),
                  'question' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                  ),
            ));
            $this->dbforge->add_key('question_id', TRUE);
            $this->dbforge->create_table('agent_signup_questions');



            //insertQuestions
      $questions = [
            0 =>"What languages do you speak?",
            1=>"Are you currently employed?",
            2=>"What cellphone do you have?",
            3=>"How much do you spend on DATA per month?",
            4 => "Are you married?",
            5 => "Do you have children?If Yes ,how many?",
            6 => "Are you on a social grant?",
            7 => "Are you disabled?",
            8 => "Do you have a drivers license?",
            9 => "Do you own a car?",
            10 => "What is your favorite brand that you use at for the following: 
             <ul class = 'agent-fav_brand'>
                  <li>Food</li>
                  <li>Clothing</li>
                  <li>Bank</li>
                  <li>Shopping Mall</li>
            </ul>"
      ];

      foreach($questions as $key => $question){

            $this->db->insert('tblagent_signup_questions', ['question'=>$question]);
      
      }
   }
}