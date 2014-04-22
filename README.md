Static pages navigation
=======================

Navigation through static html files organized in folders. Originaly made to navigate through newsletters.


## Install

* Clone the repo
* Run composer `composer install`

## Pages

On folder ´pages´ create subfolders and put the ´index.html´.
The ´<title>´ will be used to build the page link.
´|´ (pipes) are converted to ´<br>´ and stores on ´htmlTitle´ attribute on Page object.

## Configurations

All paths are configurable on ´app/paths.php´.
