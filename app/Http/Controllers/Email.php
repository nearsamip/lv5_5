<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendEmail;

class Email extends Controller
{
    //

    public function simpleMail()
    {
    	Mail::send( ['text'=>'emails.mail'],['name','samip'],function( $message ){
    		$message->to('nearsamip@gmail.com','dfdfdf')->subject('subject');
    		$message->from('nearsamip@gmail.com','dfdfdf');

    	} );
    }

    public function advanceMail()
    {
    	Mail::send(new SendEmail());
    }
}
