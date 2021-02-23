<?php

class Migration_Version_279 extends CI_Migration
{
    public function up()
    {
        
            $fields = array(
                  'contact_type' => array('type' => 'TEXT')
            );
            $this->dbforge->add_column('contacts', $fields);

   }

   public function down(){

   }


}