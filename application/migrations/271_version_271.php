<?php

class Migration_Version_271 extends CI_Migration
{
    public function up()
    {
        
            $this->dbforge->add_field(array(

                  'agent_id' => array(
                        'type' => 'INT',
                        'constraint' => 10,
                        'unsigned' => TRUE,
                        'auto_increment' => TRUE
                  ),
                  'agent_name' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                  ),
                  'agent_surname' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                  ),
                  'agent_email' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                  ),
                  'agent_idnumber' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                  ),
                  'agent_cellphone_number' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                  ),
                  'agent_landline' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                        'null' => TRUE,
                  ),
            ));
            $this->dbforge->add_key('agent_id', TRUE);
            $this->dbforge->create_table('agents');
   }
}