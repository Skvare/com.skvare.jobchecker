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

This extension alert the admin when any job get failed, type of alter is configured on setting page '/civicrm/admin/jobchecker'.

1. UI alert
2. Email alert.

For UI alert: if any appear in last 24 horus then alert will be shown in the top right conrner of the screen and full details error log available on `CiviCRM System Status` (`/civicrm/a/#/status`) screen.

![Screenshot](/images/alert_ui.png)

This extension read the logs of other job which are configured on setting form. it only ready last 24 hours log. If any failed entry found provide alter to admin. So that they can cross verify failing job status.

Menu 'Scheduled Job Status Checker' for accessing the setting are available under 'Administer/System Settings'.