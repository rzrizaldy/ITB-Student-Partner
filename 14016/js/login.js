!(function($) {

"use strict"; // Start of use strict

    var attempt = 3; // Variable to count number of attempts.

    function validate(){
    	var username = document.getElementById(&quot;username&quot;).value;    // Mendefinisikan 
    	var password = document.getElementById(&quot;password&quot;).value;

        if (username == &quot;bubakecebet&quot; &amp;&amp; password == &quot;bubabuba&quot;) {
            window.location.replace(&quot;index.php&quot;); // Redirecting to other page.
            $(&#39;form&#39;).fadeOut(500);
            $(&#39;.wrapper&#39;).addClass(&#39;form-success&#39;);
            return false;
    	}

    	else {
    		attempt --; // Kurangi jumlah attempt
    		alert(&quot;You have left &quot;+attempt+&quot; attempt;&quot;);

    		// Menonaktifkan pilihan masukan ketika sudah 3x salah
    		if( attempt == 0){
    			document.getElementById(&quot;username&quot;).disabled = true;
    			document.getElementById(&quot;password&quot;).disabled = true;
                document.getElementById(&quot;login-button&quot;).disabled = true;
                window.location.replace(&quot;index.php&quot;); // Redirecting to other page.
                return false;
    		}
    	}
    };

    // Fitur Scrolling Page
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top + 50)
        }, 1250, 'easeInOutExpo');
        
        event.preventDefault();
    });

    // Memunculkan Navbar saat scrolling
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function(){ 
            $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

	$(document).ready(function() {
  $('.input').on('focus', function() {
    $('.login').addClass('clicked');
  });
  $('.login').on('submit', function(e) {
    e.preventDefault();
    $('.login').removeClass('clicked').addClass('loading');
  });
  $('.resetbtn').on('click', function(e){
      e.preventDefault();
    $('.login').removeClass('loading');
  });
});

})(jQuery); // End of use strict