<?php
     foreach(glob("js/*.js") as $css_file)
     {
        echo '<script src="'.$css_file.'"></script>';
     }

     $str = <<<EOD
               <script
                  async
                  src="https://www.googletagmanager.com/gtag/js?id=G-9X14PJ858M"
                  />
               <script>
               window.dataLayer = window.dataLayer || [];
               function gtag(){dataLayer.push(arguments);}
               gtag('js', new Date());
               gtag('config', 'G-9X14PJ858M',{ page_path: window.location.pathname });
               </script>
              
EOD;
   
               echo $str;

?>