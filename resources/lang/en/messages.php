<?php

return [

    /*
    |--------------------------------------------------------------------------
      Success Messages
    |--------------------------------------------------------------------------
    */
    'success_changepassword' => "Password changed successfully",
    
    'user_success_add' => 'User added successfully',
    'user_success_update' => "User updated successfully",
    'user_success_changestatus' => "User status updated successfully",
    'user_success_createpassword' => "Password created successfully",
    'user_success_sendmail_resetpassword' => "Please check your email for reset the password",

    'reserveslot_success_book' => 'Slot booked Successfully',
    'permission_success_add' => 'Permission added successfully',
    'permission_success_update' => 'Permission updated successfully',
    'permission_success_delete' => 'Permission deleted successfully',

    'appointment_success_complete' => 'Appointment completed successfully',
    'appointment_success_cancel' => 'Appointment cancelled successfully',
    'appointment_success_reschedule' => 'Appointment updated successfully',

    'investment_success_check_validation' => 'Checked successfully',
    'tempinvestment_success_add' => 'Saved successfully',
    'investment_success_apply' => 'Saved successfully',
    'investment_success_update' => 'Saved successfully',

    'loan_success_check_validation' => 'Checked successfully',
    'temploan_success_add' => 'Saved successfully',
    'loan_success_apply' => 'Saved successfully',
    'loan_success_update' => 'Saved successfully',

    'customer_personalinfo_success_update' => 'Saved successfully',
    'customer_address_success_update' => 'Saved successfully',
    'customer_employmenthistory_success_update' => 'Saved successfully',
    'customer_identification_success_update' => 'Saved successfully',
    'customer_characterreference_success_update' => 'Saved successfully',
    'customer_expenditure_success_update' => 'Saved successfully',
    'customer_assets_success_update' => 'Saved successfully',
    'customer_success_sendmail_resetpassword' => "Please check your email for reset the password",
   
    'saved_successfully' => 'Saved successfully',

    /******************************************************************************************/ 


    /*
    |--------------------------------------------------------------------------
      Error Messages

    |--------------------------------------------------------------------------
    */

    'error_changepassword'  => 'Old Password does not match',
   
    'user_error_not_valid'  => 'This is not a valid user',
    'reserveslot_error_select_endtime'  => 'End time should be greater than start time',
    'reserveslot_error_select_timerange'  => 'Please select correct time range',
    'permission_error_update' => 'Something went wrong',
    'permission_error_delete' => 'Delete error',

    'appointment_error_slot_not_available' => 'This slots is not available',
    'appointment_error_incapable_to_complete_appointment' => "You can't complete this appointment before end time",
    'appointment_error_appointment_not_found_in_complete_meeting' => 'Appointment not found',
    'appointment_error_incapable_to_cancel_appointment' => "Now you can't able to cancel this appointment",
    'appointment_error_appointment_not_found_in_cancel_appointment' => 'Appointment not found',
    'appointment_error_incapable_to_reschedule_appointment' => "Now you can't able to reschedule this appointment",
    'appointment_error_appointment_not_found_in_reschedule_appointment' => 'Appointment not found',

    'investment_error_complete_your_profile' => 'Please complete your profile to submit the investment application form',
    'investment_error_customer_wrong_email' => 'Customer does not exist in our database',
    'investment_error_not_getAvailableSlots' => 'Something went wrong',

    'loan_error_complete_your_profile' => 'Please complete your profile to submit the loan application form',
    'loan_error_customer_wrong_email' => 'Customer does not exist in our database',
    'loan_error_not_getAvailableSlots' => 'Something went wrong',
    'loan_error_not_found' => 'Loan Application is not found',

    'customer_error_wrong_customerid' => 'Records not found',
    'customer_error_not_fillup_all_requiredvalue' => 'Please fill all required & valid info',
    

    'customer_address_error_wrong_state' => 'Please select valid state name',
    'customer_mailing_address_error_wrong_state' => 'Please select valid state name',
    'customer_employement_error_wrong_state' => 'Please select valid state name',
    'customer_identification_error_upload_two_forms' => 'Applicants are required to upload two forms of identification',
    'customer_characterreference_error_upload_two_forms' => 'Applicants are required to upload two forms of character reference',
    'customer_expenditure_error_already_performed_action' => 'You have already performed this action',
    'customer_expenditure_error_income_greater' => 'Total Income should be greater then total Expenditure',

    'customer_assets_error_already_performed_action' => 'You have already performed this action',
    'customer_assets_error_assets_greater' => 'Total Assets should be greater than total Liabilities',


    'check_income_greater_than_expenditure_remove_case' => 'You can not remove this field, because Total Income should be greater then total Expenditure',
    
    'check_assets_greater_than_liabilities_remove_case' => 'You can not remove this field, because Total Assets should be greater than total Liabilities',

];