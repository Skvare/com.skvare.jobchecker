<?php

require_once 'jobchecker.civix.php';
// phpcs:disable
use CRM_Jobchecker_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function jobchecker_civicrm_config(&$config) {
  _jobchecker_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function jobchecker_civicrm_xmlMenu(&$files) {
  _jobchecker_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function jobchecker_civicrm_install() {
  _jobchecker_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function jobchecker_civicrm_postInstall() {
  _jobchecker_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function jobchecker_civicrm_uninstall() {
  _jobchecker_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function jobchecker_civicrm_enable() {
  _jobchecker_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function jobchecker_civicrm_disable() {
  _jobchecker_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function jobchecker_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _jobchecker_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function jobchecker_civicrm_managed(&$entities) {
  _jobchecker_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function jobchecker_civicrm_caseTypes(&$caseTypes) {
  _jobchecker_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function jobchecker_civicrm_angularModules(&$angularModules) {
  _jobchecker_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function jobchecker_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _jobchecker_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function jobchecker_civicrm_entityTypes(&$entityTypes) {
  _jobchecker_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function jobchecker_civicrm_themes(&$themes) {
  _jobchecker_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function jobchecker_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
function jobchecker_civicrm_navigationMenu(&$menu) {
  _jobchecker_civix_insert_navigation_menu($menu, 'Administer/System Settings', array(
    'label' => E::ts('Scheduled Job Status Checker'),
    'name' => 'jobchecker_menu',
    'url' => 'civicrm/admin/jobchecker',
    'permission' => 'administer CiviCRM',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _jobchecker_civix_navigationMenu($menu);
}

/**
 * @param $messages
 * @param array $statusNames
 * @param bool $includeDisabled
 */
function jobchecker_civicrm_check(&$messages, $statusNames = [], $includeDisabled = FALSE) {
  // get job setting with alert type
  $getJobSetting = CRM_Jobchecker_Utils::getJobSetting();
  // UI Alert , then show it
  if ($getJobSetting['job_alert'] == 1) {
    // get the all messages generated using scheduled job
    $job_alert_message = CRM_Jobchecker_Utils::getAlertMessage();
    $html = '';
    if ($job_alert_message) {
      // format the message
      $html = '<table>';
      $html .= '<tr><th>Job Name</th><th>Error Details</th></tr>';
      foreach ($job_alert_message as $jabName => $jobDetails) {
        foreach ($jobDetails as $jobDetail) {
          $html .= '<tr><td>' . $jabName . '</td><td>' . $jobDetail . '</td></tr>';
        }
      }
      $html .= '</table>';

      if (!empty($html)) {
        $messages[] =
          new CRM_Utils_Check_Message(
            __FUNCTION__,
            $html,
            ts('Job Status Checker'),
            \Psr\Log\LogLevel::ERROR,
            'fa-bug'
          );
      }
    }
  }
}
