# Theme Starter Pack

###Changes

Moved all require_once into inc/includes.php file. <br>
Moved Redux into Frameworks Directory<br>
Now you also can create acf field from php. (help Link: https://www.advancedcustomfields.com/resources/register-fields-via-php/)<br>

###Update 2.0
- [x] Included ACF in theme
- [x] Included Gutenberg block example
- [x] Added WooCommerce Default Page Styles
- [x] Added ACF Helper


###ACF Helper uses
1. For Image Field, use cif_img() function and for subfield use cisf_img(). no need to use html img tag etc. just use this function. examples here:
```PHP
    <?php
        //for normal field
        cif_img('FieldID');

        //for subfield 
        cisf_img('FieldID');
    ?>
```
ACF Helper Features will update day by day