              _____ _             _       _                    _        
             / ____| |           | |     | |                  | |       
            | (___ | |_ _   _  __| |_   _| |__   __ ___      _| | _____ 
             \___ \| __| | | |/ _` | | | | '_ \ / _` \ \ /\ / / |/ / _ \
             ____) | |_| |_| | (_| | |_| | | | | (_| |\ V  V /|   <  __/
            |_____/ \__|\__,_|\__,_|\__, |_| |_|\__,_| \_/\_/ |_|\_\___|
                                     __/ |                              
                                    |___/                               

                         P R O J E C T   S T R U C T U R E

====================================================================================
FOLDERS
====================================================================================
   app                                                                  *don't touch
      > contains files for HTML DOM Parser.
   css
      > contains all css for [interface] files
      1. stylesheet.css
         > CSS data for index.php
      2. stylesheet-home.css
         > CSS data for home.php
      3. stylesheet-class.css
         > CSS data for class.php
   debug                                                                *tbd
      > contains resources for debugging
      1. six.html
         > Mock data for ol akademik student classes.
   images
      > contains image resources for [interface] files
      1. indexbg.jpg
         > index.php    -> background
      2. homebg.jpg
         > home.php     -> hero header
      3. homepar.jpg
         > home.php     -> classes background
   includes
      > contains php scripts to fetch information from database
      1. getclass.php
      2. gettodo.php

====================================================================================
MAIN DIRECTORY
====================================================================================
   INTERFACE
      1. index.php
         > Main homepage for Studyhawke
      2. home.php
         > Professor dashboard
      3. class.php
         > Student dashboard
   SCRIPTS
      1. htmlparser.php
         > Parses html file from student ol akademik files into arrays containing 
           the classes they take.
      2. login.php
         > Debug code to attempt to scrape data from student ol akademik account.
      3. ollogin.php
         > Contains backup script to retrieve ol akademik's login info POST address 
           (UNSTABLE. Has a tendency to fail for unknown reasons.
      4. olurl.php
         > Contains script to retrieve ol akademik's login info POST address (More 
           stable).
      5. simple_html_dom.php
         > HTML DOM Parser.

====================================================================================
TO-DO
====================================================================================
   1. Upload design documents for web service
   2. Create database for prototype
   3. Finish UI for:
      [a] Login page
      [b] Student dashboard
      [c] Student class dashboard
      [d] Common announcement board
      (e) Common to-do list - - - - - - - - - - - - - - - - - - - - - - -(Cancelled)
      [f] Common upcoming lessons
      [g] Class announcement board
      [h] Class assignment list
      [i] Class journal
      [j] Class scoreboard
      [l] Professor dashboard
      [m] Professor class dashboard
      [n] Score input
      [o] Assignment input
      [p] Syllabus input
      [q] Announcement input
      [r] Journal input
   4. Create php function to retrieve class list from ol akademik - - - - - (FAILED)
   5. Integrate login capabilities
   6. Make sure every path referred in code is absolute
   7. Upload mysql database
   8. Delete unused files
   9. Complete and finish README