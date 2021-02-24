<?php

class Migration_Version_282 extends CI_Migration
{
    public function up()
    {

      $fields = array(
            'idnumber' => array('type' => 'TEXT')
      );
      $this->dbforge->add_column('leads', $fields);

      }

   public function down(){

   }


}