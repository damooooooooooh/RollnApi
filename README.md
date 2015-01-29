Roll'n API
==========

This repository is a companion to a talk [Roll'n API](http://rollnapi.com) by Tom Anderson.


Entity Relationship Diagram
------
The [Skipper](http://www.skipper18.com) diagram is recommend: [rollnapi.skipper](https://github.com/TomHAnderson/RollnApi/blob/master/media/rollnapi.skipper)

If you do not have Skipper see the PDF: https://github.com/TomHAnderson/RollnApi/blob/master/media/rollnapi.pdf


Doctrine OAuth2 API with Apigility 
----------------------------------

This is written for PHP 5.3 but these instructions assume 5.4 or greater.

```
git clone git@github.com:TomHAnderson/RollnApi
cd RollnApi
cp config/autoload/local.php.dist config/autoload/local.php
Uncomment this section of local.php for a root API user:
    /*
   'data-fixture' => array(
       'RollNApi_Root_fixture' => __DIR__ . '/../src/RollNApi/Fixture/Root',
   ),
   */
./composer.phar install
php public/index.php orm:schema-tool:create
php public/index.php data-fixture:import
php -S localhost:8083 -t public/ public/index.php
```

See the [API Testing instructions](https://github.com/TomHAnderson/RollnApi/blob/master/docs/API_TESTING.md) for use.


Features
--------

A default Query Provider is used for UserAlbum so a user can only fetch or update their own UserAlbum.

A FetchAll Query Provider for UserAlbum is used so filters may be applied to a GET request.  See https://github.com/zfcampus/zf-doctrine-querybuilder for details.

A Query Create Filter is used for UserAlbum so the authenticated user is assigned to any new UserAlbum.

A Hydrator Filter is used for UserAlbum so the assigned user entity is not included in results.
