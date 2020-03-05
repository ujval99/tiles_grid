CONTENTS OF THIS FILE
---------------------
   
 * Introduction
 * Features
 * Requirements
 * Installation
 * Configuration
 * Maintainers


INTRODUCTION
------------

Tiles Grid module provides a feature to display tiles.
This module provides both page and block to display tiles.

DEMO:  https://dev-tiles-grid.pantheonsite.io
Credentials:
Admin: admin/admin
Content Moderator: moderator/moderator

FEATURES:
---------

* Install Tile Content type.
* Install and setup different fields for Tile Content type.
* Selection of the Tile Type.
* Tile can be reference to the Article Content Type
* There is an option to select data source while Article Reference is selected.
* Entity Queue has been setup to manage tiles display order.
* Entity Queue allows only tiles which are published and promoted to front page.
* Content Moderator Role has been created and given in the configuration.
* Required permissions are assigned to the Content Moderator.
* Font awesome icon support is provided.
* Tags have font awesome icon field is enabled, which allows Content Moderator to
  select required icons for an individual tag.
* YouTube Video feature support is provided.
* Tiles will have Video icon available.
* Tiles Images style is available. Scale (350px) * (350px)


REQUIREMENTS
------------

1. Contributed Module:
  * entityqueue
  * fontawesome
  * twig_tweak
  * colorbox
  * video_embed_field

2. Libraries:
  * colorbox
  * fontawesome


INSTALLATION
------------

1. Install the module as normal, see link for instructions.
   Link: https://www.drupal.org/documentation/install/modules-themes/modules-8

2. Download and unpack the Colorbox plugin in "libraries".
   Download and unpack the Fontawesome library in "libraries".

3. Go to "Administer" -> "Extend" and enable the Tiles Grid module.


CONFIGURATION
-------------

 * Page can be retrieved using - <YOUR-DOMAIN>/tiles-grid
 * Block can be configured using - <YOUR-DOMAIN>/admin/structure/block
   Name: tiles grid block
   Category: tiles_component


MAINTAINERS
-----------
Developed by
https://www.linkedin.com/in/ujvalshah