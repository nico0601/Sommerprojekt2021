# Sommerprojekt2021
  Welcome  

# How to: add to admin space
In order to add functionality to the Admin space, you can copy the `adminTemplate.php` from the root folder into 
`/website/admin` as a new `.php` file. Then change the title and contents and add a link to your page in 
`adminMain.php`

When adding another page that requires login but shouldn't use the Admin Preset, it is **mandatory** to include 
```php
<?php
include "adminSpaceHeader.php";
?>
```
in the file in order to facilitate correct token and login evaluation. Note that `adminSpaceHeader.php` starts the session and thus has to be the first PHP code in your file
