README
======

This is the source code for the ItEN Retinue Builder, a web based application for creating retinues for the *In the Emperor's Name* skirmish wargame, hosted at http://rb.iten-game.org.

The RB is a LAMP based application and requires the following:

* Apache web server (other web servers may work)
* PHP
* MySQL database
* Smarty template engine
* DB_DataObject PEAR library (and either the DB or MDB2 PEAR libraries)
* Validate PEAR library
* Mail PEAR library
* Text_Password PEAR library

INSTALLATION
------------

1. Create a virtualhost which points to /path/to/code/www
2. Create a database using etc/schema.sql. Copy etc/config-sample.php to config.php and set the DSN for connecting to the database.
3. Run the bin/build.php on the web server to generate the DB_DataObject files and schemas
4. That's it!

LICENSE
-------

The ItEN Retinue Builder is Free Software released under the GNU General Public License. Please see the LICENSE file for further details.
