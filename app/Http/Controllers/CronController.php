<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Article;
use App\Models\SharedFile;
use App\Models\DiscussionForum;
use App\Models\Testimonial;
use App\Models\Event;
use App\Models\IndustryNews;
use App\Models\Promotion;
use App\Models\Partner;
use App\Helpers\MailFunctions;

class CronController extends Controller
{
  public function index(){
    $this->sendMailForArticle();
    $this->sendMailForSharedFile();
    $this->sendMailForDiscussionForum();
    $this->sendMailForTestimonial();
    $this->sendMailForEvent();
    $this->sendMailForIndustryNews();
    $this->sendMailForPromotion();
    $this->sendMailForPartner();
    echo "Cron run successfuly at ".date('d-m-Y H:i:s');
  
  }

  public function sendMailForArticle(){
    $articleObj = new Article();
    $data = Article::whereNotNull('need_emails')->get();
    foreach($data as $row){
      $send_emails = explode(',', $row->need_emails);
      if(in_array('SUBMIT', $send_emails)){
        $type = 'SUBMIT';
        $this->articleMailToAdmin($row, $type);
      }
      if(in_array('UPDATED', $send_emails)){
        $type = 'UPDATED';
        $this->articleMailToAdmin($row, $type);
      }

      if(in_array('APPROVED', $send_emails)){
        $type = 'APPROVED';
        $this->articleMailToCustomer($row, $type);
      }

      if(in_array('REJECTED', $send_emails)){
        $type = 'REJECTED';
        $this->articleMailToCustomer($row, $type);
      }

      if(in_array('FLAGGED', $send_emails)){
        $type = 'FLAGGED';
        $this->articleMailToCustomer($row, $type);
      }
      $row->need_emails = null;
      $row->save();
    }
  }


  public function sendMailForSharedFile(){
    $data = SharedFile::whereNotNull('need_emails')->get();
    foreach($data as $row){
      $send_emails = explode(',', $row->need_emails);
      if(in_array('SUBMIT', $send_emails)){
        $type = 'SUBMIT';
        $this->sharedFileMailToAdmin($row, $type);
      }
      if(in_array('UPDATED', $send_emails)){
        $type = 'UPDATED';
        $this->sharedFileMailToAdmin($row, $type);
      }

      if(in_array('APPROVED', $send_emails)){
        $type = 'APPROVED';
        $this->sharedFileMailToCustomer($row, $type);
      }

      if(in_array('REJECTED', $send_emails)){
        $type = 'REJECTED';
        $this->sharedFileMailToCustomer($row, $type);
      }

      if(in_array('FLAGGED', $send_emails)){
        $type = 'FLAGGED';
        $this->sharedFileMailToCustomer($row, $type);
      }
      $row->need_emails = null;
      $row->save();
    }
  }

  public function sendMailForDiscussionForum(){
    $data = DiscussionForum::whereNotNull('need_emails')->get();
    foreach($data as $row){
      $send_emails = explode(',', $row->need_emails);
      if(in_array('SUBMIT', $send_emails)){
        $type = 'SUBMIT';
        $this->discussionForumMailToAdmin($row, $type);
      }
      if(in_array('UPDATED', $send_emails)){
        $type = 'UPDATED';
        $this->discussionForumMailToAdmin($row, $type);
      }

      if(in_array('APPROVED', $send_emails)){
        $type = 'APPROVED';
        $this->discussionForumMailToCustomer($row, $type);
      }

      if(in_array('REJECTED', $send_emails)){
        $type = 'REJECTED';
        $this->discussionForumMailToCustomer($row, $type);
      }

      if(in_array('FLAGGED', $send_emails)){
        $type = 'FLAGGED';
        $this->discussionForumMailToCustomer($row, $type);
      }
      $row->need_emails = null;
      $row->save();
    }
  }


  public function sendMailForTestimonial(){
    $data = Testimonial::whereNotNull('need_emails')->get();
    foreach($data as $row){
      $send_emails = explode(',', $row->need_emails);
      if(in_array('SUBMIT', $send_emails)){
        $type = 'SUBMIT';
        $this->testimonialMailToAdmin($row, $type);
      }
      if(in_array('UPDATED', $send_emails)){
        $type = 'UPDATED';
        $this->testimonialMailToAdmin($row, $type);
      }

      if(in_array('APPROVED', $send_emails)){
        $type = 'APPROVED';
        $this->testimonialMailToCustomer($row, $type);
      }

      if(in_array('REJECTED', $send_emails)){
        $type = 'REJECTED';
        $this->testimonialMailToCustomer($row, $type);
      }

      if(in_array('FLAGGED', $send_emails)){
        $type = 'FLAGGED';
        $this->testimonialMailToCustomer($row, $type);
      }
      $row->need_emails = null;
      $row->save();
    }
  }



  public function sendMailForEvent(){
    $data = Event::whereNotNull('need_emails')->get();
    foreach($data as $row){
      $send_emails = explode(',', $row->need_emails);
      if(in_array('SUBMIT', $send_emails)){
        $type = 'SUBMIT';
        $this->eventMailToAdmin($row, $type);
      }
      if(in_array('UPDATED', $send_emails)){
        $type = 'UPDATED';
        $this->eventMailToAdmin($row, $type);
      }

      if(in_array('APPROVED', $send_emails)){
        $type = 'APPROVED';
        $this->eventMailToCustomer($row, $type);
      }

      if(in_array('REJECTED', $send_emails)){
        $type = 'REJECTED';
        $this->eventMailToCustomer($row, $type);
      }

      if(in_array('FLAGGED', $send_emails)){
        $type = 'FLAGGED';
        $this->eventMailToCustomer($row, $type);
      }
      $row->need_emails = null;
      $row->save();
    }
  }


  public function sendMailForIndustryNews(){
    $data = IndustryNews::whereNotNull('need_emails')->get();
    foreach($data as $row){
      $send_emails = explode(',', $row->need_emails);
      if(in_array('SUBMIT', $send_emails)){
        $type = 'SUBMIT';
        $this->industryNewsMailToAdmin($row, $type);
      }
      if(in_array('UPDATED', $send_emails)){
        $type = 'UPDATED';
        $this->industryNewsMailToAdmin($row, $type);
      }

      if(in_array('APPROVED', $send_emails)){
        $type = 'APPROVED';
        $this->industryNewsMailToCustomer($row, $type);
      }

      if(in_array('REJECTED', $send_emails)){
        $type = 'REJECTED';
        $this->industryNewsMailToCustomer($row, $type);
      }

      if(in_array('FLAGGED', $send_emails)){
        $type = 'FLAGGED';
        $this->industryNewsMailToCustomer($row, $type);
      }
      $row->need_emails = null;
      $row->save();
    }
  }


  public function sendMailForPromotion(){
    $data = Promotion::whereNotNull('need_emails')->get();
    foreach($data as $row){
      $send_emails = explode(',', $row->need_emails);
      if(in_array('SUBMIT', $send_emails)){
        $type = 'SUBMIT';
        $this->promotionMailToAdmin($row, $type);
      }
      if(in_array('UPDATED', $send_emails)){
        $type = 'UPDATED';
        $this->promotionMailToAdmin($row, $type);
      }

      if(in_array('APPROVED', $send_emails)){
        $type = 'APPROVED';
        $this->promotionMailToCustomer($row, $type);
      }

      if(in_array('REJECTED', $send_emails)){
        $type = 'REJECTED';
        $this->promotionMailToCustomer($row, $type);
      }

      if(in_array('FLAGGED', $send_emails)){
        $type = 'FLAGGED';
        $this->promotionMailToCustomer($row, $type);
      }
      $row->need_emails = null;
      $row->save();
    }
  }

  public function sendMailForPartner(){
    $data = Partner::whereNotNull('need_emails')->get();
    foreach($data as $row){
      $send_emails = explode(',', $row->need_emails);
      if(in_array('SUBMIT', $send_emails)){
        $type = 'SUBMIT';
        $this->partnerMailToAdmin($row, $type);
      }
      if(in_array('UPDATED', $send_emails)){
        $type = 'UPDATED';
        $this->partnerMailToAdmin($row, $type);
      }

      if(in_array('APPROVED', $send_emails)){
        $type = 'APPROVED';
        $this->partnerMailToCustomer($row, $type);
      }

      if(in_array('REJECTED', $send_emails)){
        $type = 'REJECTED';
        $this->partnerMailToCustomer($row, $type);
      }

      if(in_array('FLAGGED', $send_emails)){
        $type = 'FLAGGED';
        $this->partnerMailToCustomer($row, $type);
      }
      $row->need_emails = null;
      $row->save();
    }
  }

  function articleMailToAdmin($obj, $type){
    $user = ($obj->created_type == 1) ? $obj->adminUser : $obj->customerUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Article for approval';
    $mailObj->toEmail = \ViewsHelper::getConfigKeyData('admin_email');
    $html = $mailObj->sendmail("emails.article.admin_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }

  function articleMailToCustomer($obj, $type){
    $user = ($obj->created_type == 1) ? $obj->adminUser : $obj->customerUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Article Status Change Mail';
    $mailObj->toEmail = $user->email;
    $html = $mailObj->sendmail("emails.article.customer_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }



  function sharedFileMailToAdmin($obj, $type){
    $user = ($obj->created_type == 1) ? $obj->adminUser : $obj->customerUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Shared File for approval';
    $mailObj->toEmail = \ViewsHelper::getConfigKeyData('admin_email');
    $html = $mailObj->sendmail("emails.shared-file.admin_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }

  function sharedFileMailToCustomer($obj, $type){
    $user = ($obj->created_type == 1) ? $obj->adminUser : $obj->customerUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Shared File Status Change Mail';
    $mailObj->toEmail = $user->email;
    $html = $mailObj->sendmail("emails.shared-file.customer_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }


  function discussionForumMailToAdmin($obj, $type){
    $user = ($obj->created_type == 1) ? $obj->adminUser : $obj->customerUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Discussion Forum for approval';
    $mailObj->toEmail = \ViewsHelper::getConfigKeyData('admin_email');
    $html = $mailObj->sendmail("emails.discussion-forum.admin_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }

  function discussionForumMailToCustomer($obj, $type){
    $user = ($obj->created_type == 1) ? $obj->adminUser : $obj->customerUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Discussion Forum Status Change Mail';
    $mailObj->toEmail = $user->email;
    $html = $mailObj->sendmail("emails.discussion-forum.customer_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }


  function testimonialMailToAdmin($obj, $type){
    $user = ($obj->created_type == 1) ? $obj->adminUser : $obj->customerUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Testimonial for approval';
    $mailObj->toEmail = \ViewsHelper::getConfigKeyData('admin_email');
    $html = $mailObj->sendmail("emails.testimonial.admin_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }

  function testimonialMailToCustomer($obj, $type){
    $user = ($obj->created_type == 1) ? $obj->adminUser : $obj->customerUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Testimonial Status Change Mail';
    $mailObj->toEmail = $user->email;
    $html = $mailObj->sendmail("emails.testimonial.customer_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }


  function eventMailToAdmin($obj, $type){
    $user = $obj->adminUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Event for approval';
    $mailObj->toEmail = \ViewsHelper::getConfigKeyData('admin_email');
    $html = $mailObj->sendmail("emails.event.admin_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }

  function eventMailToCustomer($obj, $type){
    $user =  $obj->adminUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Event Status Change Mail';
    $mailObj->toEmail = $user->email;
    $html = $mailObj->sendmail("emails.event.customer_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }


  function industryNewsMailToAdmin($obj, $type){
    $user = $obj->adminUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Industry News for approval';
    $mailObj->toEmail = \ViewsHelper::getConfigKeyData('admin_email');
    $html = $mailObj->sendmail("emails.industry-news.admin_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }

  function industryNewsMailToCustomer($obj, $type){
    $user = $obj->adminUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Industry News Status Change Mail';
    $mailObj->toEmail = $user->email;
    $html = $mailObj->sendmail("emails.industry-news.customer_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }


  function promotionMailToAdmin($obj, $type){
    $user = $obj->adminUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Promotion for approval';
    $mailObj->toEmail = \ViewsHelper::getConfigKeyData('admin_email');
    $html = $mailObj->sendmail("emails.promotion.admin_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }

  function promotionMailToCustomer($obj, $type){
    $user = $obj->adminUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Promotion Status Change Mail';
    $mailObj->toEmail = $user->email;
    $html = $mailObj->sendmail("emails.promotion.customer_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }


  function partnerMailToAdmin($obj, $type){
    $user = $obj->adminUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Partner for approval';
    $mailObj->toEmail = \ViewsHelper::getConfigKeyData('admin_email');
    $html = $mailObj->sendmail("emails.partner.admin_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }

  function partnerMailToCustomer($obj, $type){
    $user = $obj->adminUser;
    $mailObj = new MailFunctions();
    $mailObj->auto = true;
    $mailObj->subject = 'Partner Status Change Mail';
    $mailObj->toEmail = $user->email;
    $html = $mailObj->sendmail("emails.partner.customer_mail", ['user' => $user, 'data' => $obj, 'type' => $type]);
  }

}