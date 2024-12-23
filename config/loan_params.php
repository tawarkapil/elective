<?php 

return [

	'loan_duration_type' => [
		1 => 'Short Term (1-3yrs)',
		2 => 'Mid Term (3-7yrs)',
		3 => 'Long Term (> 7yrs)'
	],


	'apply_loan_fees_types' => [
		1 => 'Fees paid upfront', 
		2 => 'Fees deducted from final disbursement', 
		3 => 'Capitalize Fees', 
		4 => 'Waive Fees'
	],

	'finance_base_service_percentage' => 100,

	'default_fees_arr' => [
		'loan_fees' => 8,//In Percent
		'capitalized_fess' => 175,//In Amount
		'monthly_saving_deposit' => 25,//In Amount
		'application_processing_fee' => 1.25,//In Percent
		'loan_commitment_fee' => 1.25,//In Percent
		'legal_fee' => 1.25,//In Percent
		'estate_planning_fees' => 360,//In Amount
		'training_fees' => 125,//In Amount
	] 
];