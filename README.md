# ServerStatus
A PHP web interface for monitoring system resources on Linux servers.

# Testing
ServerStatus depends on a number of system files being in the right place. It has been tested on recent Debian based distributions, including Debian 6 and above, Ubuntu 12.04 and above, and all Raspbian builds. Other distributions should work just fine, but if you notice anything wrong on another distro please let me know!

On the client side, all modern HTML5 capable desktop and mobile browsers I've tested it on work just fine, but I have made absolutely no attempt to make it compatible with older versions of IE. Sorry about that.

# Installation
ServerStatus requires PHP to be installed on the server in order to work. There are a number of guides on the internet showing how to set up PHP for your preferred web server. PHP5 is recommended, but earlier versions should work too.

To install ServerStatus, clone this repository into your web-accessible directory using the following command :
```
git clone https://github.com/dan142/ServerStatus.git
```

You must then set the appropriate permissions on the conf.ini file, so that it can be both accessed and written to by ServerStatus. Skipping this step will lead to an inability to configure the page to your liking. To do this, simply 'cd' into the newly created ServerStatus directory and run the following command:
```
sudo chmod 666 conf.ini
```

It will then be accessible and fully functional at "[yourdomain]/[yourdirectory]/ServerStatus", but you can copy the files wherever you like.

# Configuration
There are some ways you can configure ServerStatus to best suit your needs by visiting the configuration page accesible form the footer. It allows you to show and hide sections of the page, and change some of the things that are measured.
