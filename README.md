# com.skvare.jobchecker

![Screenshot](/images/setting_form.png)

Extension to alert Admin about failed scheduled job in last 24 hours.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v7.0+
* CiviCRM (5.27)

## Installation (Web UI)

This extension has not yet been published for installation via the web UI.

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl com.skvare.jobchecker@https://github.com/Skvare/com.skvare.jobchecker/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/Skvare/com.skvare.jobchecker.git
cv en jobchecker
```

## Usage

This extension alerts the admin when any scheduled job fails. The type of alert is configured on setting page '/civicrm/admin/jobchecker'.

1. UI alert
2. Email alert.

For UI alert: if any cron jobs have an error alert that appeared in last 24 hours then the alert will be shown in the top right corner of the screen if UI alert is selected. Full details from the error log are available on the `CiviCRM System Status` (`/civicrm/a/#/status`) screen.

![Screenshot](/images/alert_ui.png)

This extension reads the logs of other cron jobs which are configured on the setting form. It only reads the last 24 hours of logs. If any failed entry is found then it provides an alert to admin. Admins can then cross verify failing job status and/or take appropriate remedial actions.
The menu 'Scheduled Job Status Checker' for accessing the setting is available under 'Administer/System Settings'.
