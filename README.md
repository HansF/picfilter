picfilter
=========

A picture filter.

SETUP
=====
It's php, designed to run on a webserver. Database tech is SQLite, so nothing special needed, make sure you have SQLite3 support in PHP, If your batch imports are big, provide an acceptable execution time.

* To get an easy setup download http://zwamp.sourceforge.net/ 
* Download page : http://sourceforge.net/projects/zwamp/files/ (you don't need the 'full' version)
* edit \vdrive\.sys\php\php.ini change max_execution_time = 3000
* put files from this repo under \vdrive\web
* start zwamp
* open http://localhost
