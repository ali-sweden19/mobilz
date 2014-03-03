ABOUT - mobilz
==============
In this website the users will be able to buy mobile phones and accessories online. They will be able to pay via paymill api.

DIRECTORY STRUCTURE
============================================
assets
css
data
images
protected
    components
    config
    controllers
    data
    extensions
    models
    runtime
    tests
    vendor
    views
    .htacccess
    yiic
    yiic.bat
    yiic.php
themes
README.md
index-test.php
index.php

REQUIREMENTS
=================
1. Yii 1.1.14 (yiiframework.com)
   Link: https://github.com/yiisoft/yii/releases/download/1.1.14/yii-1.1.14.f0fee9.tar.gz
2. Application (mobilz.se)
   https://github.com/ali-sweden19/mobilz/archive/master.zip
3. PHPUnit (for testing)

INSTALLATION
============
Follow the following steps to install the application.
1. Download the Yii framework 1.1.14 (link in Requirements above) and extract to a folder accessible by your webserver.
2. Download the application from (link in Requirements above) and extract in a location accessible by your webserver.
   NBS: The application directory may not contain mobilz/assets and mobilz/protected/runtime directory, please create, and give write permissions.
3. Open the files mobilz/index.php and mobilz/index-test.php and adjust the path to yii framework (i.e. yii.php file) as show below.
   $yii=dirname(__FILE__).'/../var/www/yii-1.1.14.f0fee9/framework/yii.php';
   NBS: You downloaded yii framework in step 1 above.
4. Create a DB named mobilz from the script mobilz.sql in mobilz/data directory.
5. Open the browser and open the site e.g. http://localhost/mobilz
   NBS: Ensure that .htaccess file exists at root and mod rewrite is enable in apache.


TESTING
=======
For unit testing the application follow these steps.

From Command line (Ubuntu)
1. cd to mobilz/protected/tests directory
2. Run the tests by typing:
   phpunit .

From Netbeans 7.4
You can also run the tests in netbeans configured with phpunit plugin.
1. Add the project to netbeans 
2. Goto project properties (right click project name) and click on Testing from left panel the check PHPUnit in the right panel.
3. Now in the same dialog box in the Testing section from the left panel, click PHPUnit.
   i. Now check 'Use Bootstrap' in the right panel and path e.g. /home/ali/projects/mobilz/protected/tests/bootstrap.php 
   ii. Check 'Use XML configuration' and add path e.g. /home/ali/projects/mobilz/protected/tests/phpunit.xml
4. Now right click the project again and click 'Test', if path is asked provide the path to protected/tests directory.
5. For code coverage right click the project again and click 'Code Coverage'; and after that 'Show Report'


TROUBLESHOOTING
=====================================================
1:- If you see an error like the following
Application runtime path "path/protected/runtime" is not valid. 
Sol: create/make the directory "path/protected/runtime" writeable by webserver

2:- If you see an error like the following
CAssetManager.basePath "path/mobilz/assets" is invalid. 
Sol: create/make the directory "path/mobilz/assets" writeable by webserver
