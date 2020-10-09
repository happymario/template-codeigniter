# CodeIgniter Template

Integrate RESTfull API, Base Model&Controller Template module and Push send module



## Features

* Provide Base Controller and Model  Template Module
* User create, update, remove
* User Photo review, agree, delete
* Push send, delete by Gotify or Openfire
* Support API Doc template
* Draw graphs of statistic with pie and stick chart

## Installtaion

It requires PHP 7.0 over, Mysql 5.0 over.

You can install it easily [XAMPP](https://www.apachefriends.org/index.html)  and edit your site place in 'httpd.conf'.

```
listen 9901
<VirtualHost *:9901>
    ServerAdmin happymario81@gmail.com
    DocumentRoot "D:\server\template-codeigniter"
    ServerName victoria.com/templates
</VirtualHost>
<Directory "D:\server\template-codeigniter">
    Options Indexes FollowSymLinks Includes ExecCGI
    AllowOverride All
    Require all granted
</Directory>
```

[Github](http://github.com/): clone source.

```
$ git clone https://github.com/happymario/template-codeigniter.git
```

And edit 'template-codeigniter/config.js'.

```
$config['base_url'] = 'http://codeigniter.app:9901/';
```

And you have to install sql on mysql server with 'database/init.sql'.



Last, open youre browser url: http://codeigniter.app:9901

## Screenshot

<img src="https://github.com/happymario/template-codeigniter/blob/master/uploads/screenshot.png" alt="screenshot" />



## Reference

* [Codeigniter-restserver][1]: A fully RESTful server implementation for CodeIgniter using one library, one config file and one controller.
* [codeigniter-base-model][2]: CodeIgniter base CRUD model to remove repetition and increase productivity
* [CodeIgniter-Template][3]: A Lightweight Codeigniter Template Libray
* [Gotify-server][4]: i18n library for CodeIgniter 2.1.x
* [Openfire-server][5]: codeigniter native session
* [D3.js][6]: Minimal Templating on Steroids

[1]: https://codeigniter.com/
[2]: https://github.com/appleboy/Codeigniter-Base-Model
[3]: https://github.com/appleboy/CodeIgniter-Template
[4]: https://gotify.net/
[5]: https://www.igniterealtime.org/projects/openfire/
[6]: https://d3js.org/