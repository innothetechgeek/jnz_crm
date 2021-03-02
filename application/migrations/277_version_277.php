<?php

class Migration_Version_277 extends CI_Migration
{
    public function up()
    {
        
     
      $fields = array(
            'active' => array('type' => 'TEXT')
      );
      $this->dbforge->add_column('agents', $fields);

   }

   public function down(){

   }

}