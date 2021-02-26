<?php

class Migration_Version_281 extends CI_Migration
{
    public function up()
    {

          
            $this->dbforge->add_field(array(

                  'id' => array(
                        'type' => 'INT',
                        'constraint' => 10,
                        'unsigned' => TRUE,
                        'auto_increment' => TRUE
                  ),
                  'signup_reason' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                  ),
                  'fk_compaign_id' => array(
                        'type' => 'INT', 
                     'constraint' => 10,
                  )

            ));

            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('lead_signup_reasons');

            $signup_reasons = [
                   //campain_id => signup reason
                   1 => [
                         'Vehicle tracking system',
                        'Motorplan',
                        'Extended Vehicle warranty',
                        'Funeral Cover-lead only',
                        'School Online Tutor System'
                  ],
                  2 => [
                        'Funeral Policy',
                        'Credit card',
                        'Loyality Program'
                  ],
                   3 => [
                         'Insurance',
                        'Medical Aid or Gap Covers'
                  ],
                  4 => [
                        'ADT alarm system',
                        'Cellphone contract'
                  ],
                   6 => ['looking to buy a new car'],
                   
                   7 => ['I want to buy a house'],
                
            ];

            foreach($signup_reasons as $compain_id => $reasons){

               foreach($reasons as $index => $reason){
                  $this->db->insert('lead_signup_reasons', ['signup_reason'=>$reason,'fk_compaign_id'=>$compain_id]);
                  $this->db->insert_id();
               }

            } 

      }

   public function down(){

   }


}