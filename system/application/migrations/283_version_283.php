<?php

class Migration_Version_283 extends CI_Migration
{
    public function up()
    {

      $fields = array(
            'fk_signup_reason' => array('type' => 'TEXT')
      );
      $this->dbforge->add_column('leads', $fields);

      }

   public function down(){

   }


}