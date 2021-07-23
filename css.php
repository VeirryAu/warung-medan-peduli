<?php
     foreach(glob("css/*.css") as $css_file)
     {
        echo '<link rel="stylesheet" href="'.$css_file.'" type="text/css" medial="all"  />';
     }
 ?>