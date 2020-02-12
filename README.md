## Users to Campaign Monitor

A plugin to push all new registered user's emails to Campaign Monitor.

### Getting Started

* [Download the latest release.](https://github.com/juicymedialtd/users-to-campaign-monitor/releases/download/v1.0.0/users-to-campaign-monitor-1.0.0.zip)
* Clone the repo: `git clone https://github.com/juicymedialtd/users-to-campaign-monitor.git`

Then, once the plugin has been installed and activated, define a username constant within `wp-config.php`.

```
define('UTCM_USERNAME', '');
```

`UTCM_LIST_ID` is the "API Subscriber List ID" within the list edit page. Lastly, enter your list ID within the back-end of your installation under "Tools > Users to Campaign Monitor".

Every time a new user is registered on your WordPress installation, a post request is executed to Campaign Monitor with the new user's email, first name and last name.

### Contributing

Feel free to submit a pull request with any changes that will help make this project better!
