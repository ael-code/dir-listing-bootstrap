dir-listing-bootstrap
=====================

A simple php directory listing for lighttpd designed with Bootstrap


#### Story

I started this project to improve the module dir-listing of lighttpd. The original module is very fast (C written) but is not responsive, it does not display well on tablet/smartphone.

#### Futures

- Responsive layout
- Automatic file type recognition (different icons)
- Option to hide/show "last modified" coloumn
- Option to hide/show hidden file
- Fixed navigable path
- Banner for "Empty folder"
- Banner for "Error opennig folder" ( no permissions to read)


#### Requirement

- Web Server (tested with lighttpd)
- php5

#### Installation

Create a folder "dirl" in your web-root and put all files in there.
Edit your web server rules to redirect directory listing request to "dir_listing.php

#### Configuration

The configuration file is:
<pre>/dir-listing-bootstrap/dir_listing_conf.php</pre>

If you are on a 32bit machine like RaspberryPi you have to put
<pre>$use_du_command = true</pre>

#### Screens

![img](http://img834.imageshack.us/img834/6636/gcyx.png)
