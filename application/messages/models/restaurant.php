<?php

return array(
    'name' => array(
        'not_empty' => 'You must provide the restaurant name.',
        'min_length' => 'The  name  must be at least :param2 characters long.',
        'max_length' => 'The  name  must be less than :param2 characters long.',
    ),
    'street_num' => array(
        'numeric' =>'Must enter a valid street number',
    ),
    'phone' => array(
        'not_empty' =>'Must enter main phone number'
            ),
    'email' =>  array(
        'email' =>'Not a valid email address'
            ),


);
 
