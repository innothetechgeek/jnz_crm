<?php

class Migration_Version_274 extends CI_Migration
{
    public function up()
    {
        
            $fields = array(
                  'password' => array('type' => 'TEXT')
            );
            $this->dbforge->add_column('agents', $fields);

   }

   public function down(){

   }


}