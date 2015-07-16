# ServerStatus
A PHP web interface for monitoring system resources on Linux servers.

# Testing
ServerStatus depends on a number of system files being in the right place. It has been tested on recent Debian based distributions, including Debian 6 and above, Ubuntu 12.04 and above, and all Raspbian builds. Other distributions should work, but if you notice anything missing on another distro please let me know!

# Installation
ServerStatus requires PHP to be installed on the server in order to work. There are a number of guides on the internet showing how to set up PHP for your preferred web server. PHP5 is recommended, but earlier versions should work too.

To install ServerStatus, clone this repository into your web-accessible directory using the following command :
```
git clone https://github.com/dan142/ServerStatus.git
```
It will then be accessible at "[yourdomain]/[yourdirectory]/ServerStatus", but you can copy the files wherever you like.

# Configuration
There are some ways you can configure ServerStatus to best suit your needs by editing the "serverstatus.ini" file in the "conf" directory. It allows you to show and hide sections of the page, and change some of the things that are measured.
