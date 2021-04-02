<?php

use CRM_Jobchecker_ExtensionUtil as E;

class CRM_Jobchecker_Utils {

  /**
   * get List of active Scheduled Job
   *
   * @return array
   */
  public static function getActiveJobs() {

    $result = civicrm_api3('Job', 'get', [
      'sequential' => 1,
      'return' => ["id", "name"],
      'is_active' => 1,
      'api_action' => ['!=' => "Statuschecker"],
    ]);
    $jobList = [];
    foreach ($result['values'] as $job) {
      $jobList[$job['id']] = $job['name'];
    }

    return $jobList;
  }

  /**
   * @return array
   */
  public static function getRenderableElementNames() {
    return ['job_ids', 'job_alert', 'job_email'];
  }

  /**
   * @return array
   */
  public static function getJobSetting() {
    // use settings as defined in default domain
    $domainID = CRM_Core_Config::domainID();
    $settings = Civi::settings($domainID);
    $setDefaults = [];

    foreach (self::getRenderableElementNames() as $elementName) {
      $setDefaults[$elementName] = $settings->get($elementName);
    }

    return $setDefaults;
  }

  /**
   * Function to show alert Message or send email to admin
   * @param $messages
   */
  public static function showAlert($messages) {
    $getJobSetting = CRM_Jobchecker_Utils::getJobSetting();
    CRM_Jobchecker_Utils::setAlertMessage($messages);

    // email alert
    if ($getJobSetting['job_alert'] == 2 && !empty($getJobSetting['job_email'])) {
      $domainID = CRM_Core_Config::domainID();
      $settings = Civi::settings($domainID);
      $job_alert_message = $settings->get('job_alert_message');
      if (empty($job_alert_message)) {
        return;
      }
      $html = '<table>';
      $html .= '<tr><th>Job Name</th><th>Error Details</th></tr>';
      foreach ($job_alert_message as $jabName => $jobDetails) {
        foreach ($jobDetails as $jobDetail) {
          $html .= '<tr><td>' . $jabName . '</td><td>' . $jobDetail . '</td></tr>';
        }
      }
      $html .= '</table>';

      $tpl = "Email.tpl";
      $template = CRM_Core_Smarty::singleton();
      $config = CRM_Core_Config::singleton();
      $template->assign('job_list', $html);
      $str = trim($template->fetch($tpl));
      $mailBody = "<html><head></head><body>" . $str . "</body></html>";
      list($domainEmailName, $domainEmailAddress) = CRM_Core_BAO_Domain::getNameAndEmail();
      $subject = "Scheduled Job Failed Notification";
      $mailParams = [
        'groupName' => 'job notification',
        'from' => '"' . $domainEmailName . '" <' . $domainEmailAddress . '>',
        'subject' => $subject,
        'text' => $mailBody,
        'html' => $mailBody,
      ];
      $mailParams['toName'] = '';
      $mailParams['toEmail'] = $getJobSetting['job_email'] ?? NULL;
      //CRM_Core_Error::debug_var('job Statuschecker $mailParams', $mailParams);
      CRM_Utils_Mail::send($mailParams);
    }
  }

  /**
   * @return mixed
   */
  public static function getAlertMessage() {
    $domainID = CRM_Core_Config::domainID();
    $settings = Civi::settings($domainID);
    return $settings->get('job_alert_message');
  }

  /**
   * @param $messages
   */
  public static function setAlertMessage($messages) {
    $domainID = CRM_Core_Config::domainID();
    $settings = Civi::settings($domainID);
    $settings->set('job_alert_message', $messages);
  }

}