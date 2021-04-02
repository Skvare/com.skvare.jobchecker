<?php
use CRM_Jobchecker_ExtensionUtil as E;

/**
 * Job.Statuschecker API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_job_Statuschecker_spec(&$spec) {
}

/**
 * Job.Statuschecker API
 *
 * @param array $params
 *
 * @return array
 *   API result descriptor
 *
 * @see civicrm_api3_create_success
 *
 * @throws API_Exception
 */
function civicrm_api3_job_Statuschecker($params) {
  $list = CRM_Jobchecker_Utils::getJobSetting();
  $getFailedMessages = [];
  $failedCount = 0;
  // get the rows contain Failure word from last 24 hrs log of each job.
  foreach ($list['job_ids'] as $jobId) {
    $query = "SELECT run_time, name, description 
      FROM civicrm_job_log 
        WHERE job_id = {$jobId} and description like 'Finished execution%' 
        AND run_time >= now() - INTERVAL 24 HOUR
      ORDER BY run_time DESC";
    $dao = CRM_Core_DAO::executeQuery($query);
    while ($dao->fetch()) {
      if (preg_match("/Failure/i", $dao->description)) {
        $failedCount++;
        $getFailedMessages[$dao->name][$dao->run_time] = $dao->run_time . ' : ' . $dao->description;
      }
    }
  }

  if ($failedCount > 0) {
    CRM_Core_Error::debug_var('job Statuschecker failedCount', $failedCount);
    //CRM_Core_Error::debug_var('job Statuschecker $getFailedMessages', $getFailedMessages);
    CRM_Jobchecker_Utils::showAlert($getFailedMessages);
  }

  return civicrm_api3_create_success(TRUE, $params, 'Job', 'Statuschecker');
}
