# Offline WP #

Put your WP install into a "standalone" local install and get rid of all the checking for update e.g. on WordPress.org
Really useful when in the train or somewhere without any internet connection or wifi.

## Warning & disclaimer

I was sick and tired of this wordpress.org automatic checking which can slow every single page load when offline.
I mean like a lot. So here is this simple plugin.

I'm not pretending that I disable all the things that can be disabled. There are a lot ! 
But this should speed up your local install and there's a toggle button as admin bar button.
So if you grab wifi codes or something else you can disable offline mod without deactivating all the thing.

##  Features

* an admin bar toggle to enable / disable offline mod

##  Filters

* offline-wp/hide_admin_bar : determine who can/cannot access to the admin bar toggle
* offline-wp/admin_bar_styles : in case you do not enjoy my colors. Important cause otherwise you could spend hours with them ^^

## Constants

* WP_OFFLINE_MOD_ENABLED, set it to false or true

## How to install

1. Install and activate this plugin
2. Enjoy

## Screenshots

![offline mode enabled](/assets/img/screen-enabled.png)

![offline mode disabled](/assets/img/screen-disabled.png)

## Requirements

* PHP 5.4

## Changelog

### Jan 2018

* 0.74
* fix use of constant to enable mod not working
* use wrapper instead

* 0.73
* initial
* First plugin of the Year \0/