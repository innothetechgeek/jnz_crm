<?php

class Migration_Version_276 extends CI_Migration
{
    public function up()
    {
        
      $this->dbforge->add_field(array(

            'add_id' => array(
                  'type' => 'INT',
                  'constraint' => 10,
                  'unsigned' => TRUE,
                  'auto_increment' => TRUE
            ),
            'add_line1' => array(
                  'type' => 'VARCHAR',
                  'constraint' => '200',
            ),
            'add_line2' => array(
                  'type' => 'VARCHAR',
                  'constraint' => '200',
                  'null' => TRUE,
            ),
            'add_city' => array(
                  'type' => 'VARCHAR',
                  'constraint' => '200',
            ),
            'add_postal_code' => array(
                  'type' => 'VARCHAR',
                  'constraint' => '200',
            ),
            'add_type' => array(
                  'type' => 'INT',
                  'constraint' => 10,
            ),
            'fk_agent_id' => array(
                  'type' => 'INT',
                  'constraint' => 10,
            ),
      ));

      $this->dbforge->add_key('add_id', TRUE);
      $this->dbforge->create_table('agent_address');
   }

   public function down(){

   }

}