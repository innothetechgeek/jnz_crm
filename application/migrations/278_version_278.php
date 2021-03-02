<?php

class Migration_Version_278 extends CI_Migration
{
    public function up()
    {
        
     
      $fields = array(
            'idnumber' => array('type' => 'TEXT'),
            'landline' => array('type' => 'TEXT')
      );
      $this->dbforge->add_column('contacts', $fields);

   }

   public function down(){

   }

}