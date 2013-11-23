dir-listing-bootstrap
=====================

A simple php directory listing for lighttpd designed with Bootstrap


#### Story

I started this project to improve the module dir-listing of lighttpd. The original module is very fast (C written) but is not responsive, it does not display well on tablet/smartphone.

#### Requirement

- Web Server (tested with lighttpd)
- php5
- du (command line utility to view files size)

#### Configuration

The configuration file is:
/dir-listing-bootstrap/dir_listing_conf.php

#### Futures

- Responsive layout
- Automatic file type recognition (different icons)
- Option to hide/show "last modified" coloumn
- Option to hide/show hidden file
- Fixed navigable path
- Banner for "Empty folder"
- Banner for "Error opennig folder" ( no permissions to read)

#### Screens

![img](http://img834.imageshack.us/img834/6636/gcyx.png)
