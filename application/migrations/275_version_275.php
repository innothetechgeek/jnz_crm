<?php

class Migration_Version_275 extends CI_Migration
{
    public function up()
    {
        
      $this->dbforge->add_field(array(

            'nok_id' => array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  'auto_increment' => TRUE
            ),
            'nok_name' => array(
                  'type' => 'VARCHAR',
                  'constraint' => '200',
            ),
            'nok_surname' => array(
                  'type' => 'VARCHAR',
                  'constraint' => '200',
            ),
            'nok_cell_number' => array(
                  'type' => 'VARCHAR',
                  'constraint' => '200',
            ),
            'fk_agent_id' => array(
                  'type' => 'INT',
                  'constraint' => 10,
            ),
      ));

      $this->dbforge->add_key('nok_id', TRUE);
      $this->dbforge->create_table('agent_next_of_kin');
   }

   public function down(){

   }

}