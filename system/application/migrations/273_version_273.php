<?php

class Migration_Version_273 extends CI_Migration
{
    public function up()
    {
        
      $this->dbforge->add_field(array(

            'answer_id' => array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  'auto_increment' => TRUE
            ),
            'answer' => array(
                  'type' => 'VARCHAR',
                  'constraint' => '200',
            ),
            'fk_question_id' => array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  'auto_increment' => TRUE
            ),
      ));
      $this->dbforge->add_key('question_id', TRUE);
      $this->dbforge->create_table('agent_signup_questions');
   }
}