Static pages navigation
=======================

Navigation through static html files organized in folders. Originaly made to navigate through newsletters.


## Install

* Clone the repo
* Run composer `composer install`

## Pages

On folder ´pages´ create subfolders and put the ´index.html´.
The ´&lt;title&gt;´ will be used to build the page link.
´|´ (pipes) are converted to ´&lt;br&gt;´ and stores on ´htmlTitle´ attribute on Page object.

## Configurations

All paths are configurable on ´app/paths.php´.
Some customization can be done on ´app/config.php´
