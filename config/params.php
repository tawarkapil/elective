<?php

return [

	'blogs_image' => array(
        'base_path' => 'public/uploads/blogs/',
        'path' => 'public/uploads/blogs/',
        'mimes' => array('image/jpeg', 'image/jpg', 'image/png'),
    ),

    'program_image' => array(
        'base_path' => 'public/uploads/programs/',
        'path' => 'public/uploads/programs/',
        'mimes' => array('image/jpeg', 'image/jpg', 'image/png'),
    ),

    'destination_image' => array(
        'base_path' => 'public/uploads/destinations/',
        'path' => 'public/uploads/destinations/',
        'mimes' => array('image/jpeg', 'image/jpg', 'image/png'),
    ),

    'cust_trips_image' => array(
        'base_path' => 'public/uploads/cust_trips/',
        'path' => 'public/uploads/cust_trips/',
        'mimes' => array('image/jpeg', 'image/jpg', 'image/png'),
    ),

    'tour_image' => array(
        'base_path' => 'public/uploads/tours/',
        'path' => 'public/uploads/tours/',
        'mimes' => array('image/jpeg', 'image/jpg', 'image/png'),
    ),

    'addon_image' => array(
        'base_path' => 'public/uploads/addons/',
        'path' => 'public/uploads/addons/',
        'mimes' => array('image/jpeg', 'image/jpg', 'image/png'),
    ),

    'our_member_image' => array(
        'base_path' => 'public/uploads/our-member/',
        'path' => 'public/uploads/our-member/',
        'mimes' => array('image/jpeg', 'image/jpg', 'image/png'),
    ),

    'customer_image' => array(
        'base_path' => 'public/uploads/customers/',
        'path' => 'public/uploads/customers/',
        'mimes' => array('image/jpeg', 'image/jpg', 'image/png'),
    ),

    'trip_durations' => [
        1 => '1 Week',
        2 => '2 Weeks',
        3 => '3 Weeks',
        4 => '4 Weeks',
        5 => '5 Weeks',
        6 => '6 Weeks',
        7 => '7 Weeks',
        8 => '8 Weeks',
        9 => '9 Weeks',
        10 => '10 Weeks',
        11 => '11 Weeks',
        12 => '12 Weeks'
    ],

    'referral_dropdown' => [
        'Google' => 'Google' ,
        'GoAbroad' => 'GoAbroad',
        'AMSA' => 'AMSA',
        'AAMC' => 'AAMC',
        'Referral' => 'Referral',
        'Facebook' => 'Facebook',
        'X (Twitter)' => 'X (Twitter)',
        'Other' => 'Other'
    ],


    'price_filter' => [
        0 => '0 - 100',
        1 => '101 - 200',
        2 => '201 - 300',
        3 => '301 - 400',
        4 => '401 - 500',
        5 => '501 - 600',
        6 => '601 - 700',
        7 => '701 - 800',
        8 => '801 - 900',
        9 => '901 - 1000',
        10 => 'Above 1000'
    ],

    'year_of_studies' => [
        1 => '1st',
        2 => '2nd',
        3 => '3rd',
        4 => '4th',
        5 => '5th',
        6 => '6th'
    ],

    'system_documents' => [
      
        1 => 'Fund my elective',

        2 => 'Predeparture - Visas',
        3 => 'Predeparture - Flights',
        4 => 'Predeparture - Insurance',
        5 => 'Predeparture - Health and Safety',
        6 => 'Predeparture - Packing List',
        7 => 'Predeparture - Pre-elective Discussion',
        8 => 'Predeparture - Log Book',

        9 => 'In-country - Orientation',
        10 => 'In-country - Accommodation',
        11 => 'In-country - Hospital/Center',
        12 => 'In-country - Mid-Elective Check-in',
        13 => 'In-country - Testimonial',
        14 => 'In-country - Departure',

        15 => 'After My Elective - Log Book',
        16 => 'After My Elective - Post-elective Debrief',
        17 => 'After My Elective - Certificate of Completion',
        18 => 'After My Elective - Blogs',
        19 => 'After My Elective - Work with Us',
    ],

    'student_documents' => [
        1 => [
            1 => 'Doc – Passport Scan',
            2 => 'Doc – Visa Scan',
            3 => 'Doc – Academic Verification',
        ],
        2 => [
            1 => 'Doc – Your Confirmed Visa',
        ],
        3 => [
            1 => 'Doc – Flight Itinerary',
        ],
        4 => [
            1 => 'Doc – Insurance Forms',
        ],
        5 => [
            1 => 'Doc – Health and Safety',
        ],
        6 => [],
        7 => [],
        8 => [
            1 => 'Doc – Curriculum Log Book',
        ],
        9 => [],
        10 => [],
        11 => [],
        12 => [],
        13 => [],
        14 => [],
        15 => [],
        16 => [],
        17 => [],
        18 => [],
        19 => [],
    ],

    'gcaptcha' => [
        'site_key' => '6LfPkaApAAAAAEMp1I_Yon13VPQa_4aXrXjUEyNT',
        'secret_key' => '6LfPkaApAAAAAHO9-LSeZBnMNIHDAOklokTg-Dnc'
    ],

    'registeration_deposit' => 350,
];