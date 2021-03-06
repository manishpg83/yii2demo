<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-advanced.svg)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```


<h1 align="center">Requirement</h1>

Below written is the description of Demo Tasks for Yii2:

1. Install Yii2
2. Create a database with three tables named as User, Gallery, and Images
3. A user_id will be foreign key in gallery table to represent gallery type(Art, Fiction, Scary, Natural) and images table will have gallery_id as foreign key to maintain the relationship between three tables.
4. Connect it with the application
5. Create a CRUD for the user so that if i add a user it will ask gallery type as well and upload two images in the form. Once submitted the data will goto three tables.
6. If i edit a user i can edit his gallery type and image as well.
7. If i delete a user all the data related to user will be deleted and images will be deleted from folder as well.
9. Push the code to Git in a repo 
9. Write the detail of work done in readme.md file
Note : While coding please maintain the SOLID principals


Setup project and update composer. 

I have used below module for file upload.

composer require kartik-v/yii2-widget-fileinput "*"

For created table using migration:
yii migrate/create create_users_table --fields="firstname:string(50):notNull,lastname:string(50):notNull"
yii migrate/create create_gallery_type_table --fields="gallery_type_name:string(50):notNull"
yii migrate/create create_gallery_table --fields="user_id:integer:notNull:foreignKey(users),gallery_type_id:integer:notNull:foreignKey(gallery_type)"
yii migrate/create create_images_table --fields="gallery_id:integer:notNull:foreignKey(gallery),imagename:string(255):notNull"


Created Gallery type from create from: frontend/web/index.php?r=gallerytype/create
Gallery type(Art, Fiction, Scary, Natural)

User Module URL: frontend/web/index.php?r=users

Images will be store on "frontend/web/uploads/gallery" So Make sure gallery folder should have 777 permission for upload images.


