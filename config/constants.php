<?php
return [
	'logos_path' => array(
    	'DEFAULT_DARK_LOGO' => 'public/logos/default-logo-dark.png', 
    	'DEFAULT_WHITE_LOGO' => 'public/logos/default-logo-white.png', 

    	'LOAN_DARK_LOGO' => 'public/logos/loan-logo-dark.png', 
    	'LOAN_WHITE_LOGO' => 'public/logos/loan-logo-white.png', 

    	'INVESTMENT_DARK_LOGO' => 'public/logos/investment-logo-white.png', 
    	'INVESTMENT_WHITE_LOGO' => 'public/logos/investment-logo-white.png', 
    ),

    'google_recaptcha' => array(
    	'G_RECAPTCHA_SITE_KEY' => env('G_RECAPTCHA_SITE_KEY'),//'6LeggLIZAAAAAGXzJmrMonA0GlJU5ZhZGDH-5gCF',
		'G_RECAPTCHA_SCERET_KEY' => env('G_RECAPTCHA_SCERET_KEY'),//'6LeggLIZAAAAAMgLJ6ZW8E1txu9Qy_9OksyrjkDy',
    ),

    'MAIN_SITE_LINK' => env('MAIN_SITE_LINK'),
];
