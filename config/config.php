<?php

/*
       * You can place your custom package configuration in here.
       */
return [


  'logo_path' => env('YOUR_ORG_LOGO_PATH', ''), // if you don't have a logo we will use default


  'org_name' => env('ORG_NAME', 'BILL ME INC'), // If you don't have we will use default

  /** 
      * Fill in a flag of 1 if you want billme to send mail notification
      *Fill in 0 if you want to send your own custom mail notification
      */
  'send_mail' => env('BILL_ME_SEND_MAIL', '1'),


  /** 
      * Specify an email address that you are going to receive email order and invoice notifications
      */
  'your_mail_address' => env('BILL_ME_ORG_MAIL', 'info@billme.io'),



  /** 
      * Specify invoice due date
      * 5 days is default
      */

  'due_date_duration' => env('BILL_ME_INVOICE_DUE_DATE', '5'),

  'currency'=>env('BILL_ME_CURRENCY','USD')




];
