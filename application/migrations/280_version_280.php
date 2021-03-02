<?php

class Migration_Version_280 extends CI_Migration
{
    public function up()
    {

          
            $this->dbforge->add_field(array(

                  'campaign_id' => array(
                        'type' => 'INT',
                        'constraint' => 10,
                        'unsigned' => TRUE,
                        'auto_increment' => TRUE
                  ),
                  'campain_title' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                  ),
                  'campain_image' => array(
                     'type' => 'VARCHAR',
                     'constraint' => '200',
               ),

            ));

            $this->dbforge->add_key('campaign_id', TRUE);
            $this->dbforge->create_table('campaigns');


            $this->dbforge->add_field(array(

                  'referal_type_id' => array(
                        'type' => 'INT',
                        'constraint' => 10,
                        'unsigned' => TRUE,
                        'auto_increment' => TRUE
                  ),
                  'referal_type_title' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '200',
                  ),
                  'fk_compaign_id' => array(
                        'type' => 'INT', 
                     'constraint' => 10,
                  )
            ));

            $this->dbforge->add_key('referal_type_id', TRUE);
            $this->dbforge->create_table('campaign_referal_types');

            $campaigns = [
                  'EARN R50 when you sign a client for:' => [
                      'referal_types' => [
                      'Vehicle tracking system-lead only not sale',
                      'Motorplan-refer lead for vehicle owner for motorplan',
                      'Extended Vehicle warranty-refer vehicle owner',
                      'Funeral Cover-lead only',
                      'School Online Tutor System'],
                      'image'=> 'https://coinhutt.com/wp-content/uploads/2016/03/Mandela-R50-AA-prefix-notes-A-1.jpg',
                  ],
      
                  'EARN R100' => [
                      'referal_types' => [
                          'Refer a funeral policy client',
                          'Refer a credit card client',
                          'Refer a credit card client',
                          'Refer a client for Loyality Program'
                      ],
                      'image' => "https://coinhutt.com/wp-content/uploads/2016/03/Mandela-R100-AA-prefix-notes-B.jpg",
                  ],
                  'EARN R350' => [
                      'referal_types' =>
                          [
                              'Refer a client looking for insurance',
                              'Medical Aid or Gap Covers'
                          ],
                       'image' => 'https://thumbs.dreamstime.com/z/south-african-money-notes-20915489.jpg'
                  ],
                  'EARN R500' => [
                      'referal_types' =>
                          [
                          'refer a client that needs an ADT alarm system',
                          'Mefer a client for cellphone contract'
                      ],
                      'image'=> 'https://us.123rf.com/450wm/lcswart/lcswart1605/lcswart160500004/56493842-stack-spread-selection-of-used-south-african-bank-notes.jpg?ver=6',
                  ],
                  'EARN R1000' => [
                      'referal_types' =>
                          [ 
                              'Refer a client that is looking to buy a new car.'
                          ],
                       'image' => 'https://thumbs.dreamstime.com/z/pile-south-african-rand-notes-money-isolated-white-surface-space-text-featuring-nelson-mandela-pile-south-152084743.jpg'
                  ],
                  'EARN R3000' => [
                      'referal_types' =>
                          [   
                              'Mefer a client that wants to buy a house'
                          ],
                     'image' =>'https://i.pinimg.com/originals/52/0f/bd/520fbdea80b7fd772967a046013ab25f.jpg'
                  ]
              ];

             
              foreach($campaigns as $campaign => $campain_details){

                  $this->db->insert('campaigns', ['campain_title'=>$campaign,'campain_image'=>$campain_details['image']]);
                  $compain_id = $this->db->insert_id();
                     
                  foreach($campain_details['referal_types'] as $key => $referal_type){

                     $this->db->insert('campaign_referal_types', ['referal_type_title'=>$referal_type, 'fk_compaign_id' =>  $compain_id ]);
                        
                  }

              } 

      }

   public function down(){

   }


}