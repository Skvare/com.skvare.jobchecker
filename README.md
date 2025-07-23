# com.skvare.jobchecker

![Screenshot](/images/setting_form.png)

## Overview

The Scheduled Job Checker extension provides comprehensive monitoring and alerting for CiviCRM's scheduled jobs, ensuring administrators are immediately notified when critical automated processes fail. This extension acts as a watchdog for your CiviCRM system, monitoring job execution logs and providing both visual and email alerts when failures occur within the last 24 hours.

**Key Features:**
- Real-time monitoring of scheduled job failures
- Dual alert system: UI notifications and email alerts
- 24-hour failure detection window
- Detailed error log analysis and reporting
- Integration with CiviCRM System Status dashboard
- Configurable alert preferences per job type

## Benefits

- **Proactive Monitoring:** Catch job failures before they impact your operations
- **Immediate Notification:** Get alerts the moment scheduled jobs fail
- **Detailed Diagnostics:** Access comprehensive error logs and failure analysis
- **System Reliability:** Ensure critical processes like mailings, memberships, and donations work correctly
- **Peace of Mind:** Continuous monitoring without manual log checking
- **Operational Efficiency:** Reduce downtime by quickly identifying and resolving issues

## Use Cases

This extension is essential for organizations that rely on:
- **Automated Mailings:** Email newsletters, reminders, and campaigns
- **Membership Processing:** Renewal reminders, status updates, grace periods
- **Recurring Donations:** Scheduled contribution processing
- **Event Management:** Registration confirmations, waitlist processing
- **Data Synchronization:** Integration with external systems
- **Reporting:** Automated report generation and distribution
- **Cleanup Tasks:** Database maintenance, log rotation, cache clearing

## Requirements

- **CiviCRM:** 5.27 or higher
- **PHP:** 7.0 or higher (recommended 7.4+)
- **Permissions:** Administrative access to system settings and scheduled jobs
- **Email Configuration:** SMTP setup required for email alerts
- **Cron Jobs:** Properly configured cron for scheduled job execution

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

## Configuration

### Initial Setup

After installation, configure the job monitoring settings:

1. **Navigate to Settings:**
  - Go to **Administer > System Settings > Scheduled Job Status Checker**
  - Or directly visit: `/civicrm/admin/jobchecker`

2. **Configure Alert Preferences:**
  - Choose between UI alerts, email alerts.
  - Select which scheduled jobs to monitor (e.g., Mailings, Memberships, Contributions).
  - Set recipient email addresses for failure notifications


## Support and Contributing

- **Issues:** Report bugs and feature requests on [GitHub Issues](https://github.com/Skvare/com.skvare.jobchecker/issues)

## Credits

Developed by [Skvare, LLC](https://skvare.com/contact) for the CiviCRM community.

## About Skvare

Skvare LLC specializes in CiviCRM development, Drupal integration, and providing technology solutions for nonprofit organizations, professional societies, membership-driven associations, and small businesses. We are committed to developing open source software that empowers our clients and the wider CiviCRM community.

**Contact Information**:
- Website: [https://skvare.com](https://skvare.com)
- Email: info@skvare.com
- GitHub: [https://github.com/Skvare](https://github.com/Skvare)

## Support

[Contact us](https://skvare.com/contact) for support or to learn more.

---

## Related Extensions

You might also be interested in other Skvare CiviCRM extensions:

- **Database Custom Field Check**: Prevents adding custom fields when table limits are reached
- **Image Resize**: Automatically resizes contact images for consistent display
- **Registration Button Label**: Customize button labels on event registration pages
- **Unlink User Account**: Safely unlink user accounts from contacts without deleting data

For a complete list of our open source contributions, visit our [GitHub organization page](https://github.com/Skvare).
