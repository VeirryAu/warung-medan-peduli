<?php
     foreach(glob("js/*.js") as $css_file)
     {
        echo '<script src="'.$css_file.'"></script>';
     }

     $str = <<<EOD
               <script
                  async
                  src="https://www.googletagmanager.com/gtag/js?id=G-RMKZFCDM2D"
                  />
               <script>
               window.dataLayer = window.dataLayer || [];
               function gtag(){dataLayer.push(arguments);}
               gtag('js', new Date());
               gtag('config', 'G-RMKZFCDM2D',{ page_path: window.location.pathname });
               </script>
              
EOD;
   
               echo $str;

?>