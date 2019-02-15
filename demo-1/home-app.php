<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>IHM-demo-1</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Thumbnail Proximity Effect with jQuery and CSS3" />
        <meta name="keywords" content="thumbnails, jquery, proximity, effect, css3, scale, mouse, hover" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico">
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style4.css" />
    </head>
    <body id="page">
        <div class="container">
			<!-- Codrops top bar -->
            <div class="codrops-top">
                <a href="https://www.chuv.ch/ihm/">
                    <strong>&laquo; Go to Institute page </strong>
                </a>
                <span class="right">
					<a href="https://commons.wikimedia.org/wiki/Category:Institut_universitaire_d%27histoire_de_la_m%C3%A9decine_et_de_la_sant%C3%A9_publique" target="_blank">wikimedia repository</a>
					<a href="http://creativecommons.org/licenses/by-nc/3.0/" target="_blank">CC BY-NC 3.0</a>
                </span>
                <div class="clr"></div>
            </div><!--/ Codrops top bar -->
			<header>
        <!-- <img src="./images/chuv.png" alt="logo CHUV"><p>hola</p> -->
        <h1><img src="./images/chuv.png" alt="logo CHUV" align="centre">Institut des humanités en médecine</h1>
			</header>
      <section class="pe-container">
				<ul id="pe-thumbs" class="pe-thumbs">
          <!-- <table> -->
          <?php
            $file_handle = fopen("data-form/matrix-70.data", "rb");

            while (!feof($file_handle) ) {
                $line_of_text = fgets($file_handle);
                $parts = explode(',', $line_of_text);
                if (!empty($parts[0])) {
                    echo "<li><a href=\"$parts[0]\"><img src=\"images/thumbs/$parts[1].jpg\" /><div class=\"pe-description\"><h3>$parts[2]</h3><p>$parts[3]</p></div></a></li>";
                }
            }
            fclose($file_handle);
          ?>
          <!-- </table> -->
				</ul>
			</section>
    </div>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.proximity.js"></script>
		<script type="text/javascript">
			$(function() {

				var Photo	= (function() {

						// list of thumbs
					var $list		= $('#pe-thumbs'),
						// list's width and offset left.
						// this will be used to know the position of the description container
						listW		= $list.width(),
						listL		= $list.offset().left,
						// the images
						$elems		= $list.find('img'),
						// the description containers
						$descrp		= $list.find('div.pe-description'),
						// maxScale : maximum scale value the image will have
						// minOpacity / maxOpacity : minimum (set in the CSS) and maximum values for the image's opacity
						settings	= {
							maxScale	: 1.3,
							maxOpacity	: 0.9,
							minOpacity	: Number( $elems.css('opacity') )
						},
						init		= function() {

							// minScale will be set in the CSS
							settings.minScale = _getScaleVal() || 1;
							// preload the images (thumbs)
							_loadImages( function() {

								_calcDescrp();
								_initEvents();

							});

						},
						// Get Value of CSS Scale through JavaScript:
						// http://css-tricks.com/get-value-of-css-rotation-through-javascript/
						_getScaleVal= function() {

							var st = window.getComputedStyle($elems.get(0), null),
								tr = st.getPropertyValue("-webkit-transform") ||
									 st.getPropertyValue("-moz-transform") ||
									 st.getPropertyValue("-ms-transform") ||
									 st.getPropertyValue("-o-transform") ||
									 st.getPropertyValue("transform") ||
									 "fail...";

							if( tr !== 'none' ) {

								var values = tr.split('(')[1].split(')')[0].split(','),
									a = values[0],
									b = values[1],
									c = values[2],
									d = values[3];

								return Math.sqrt( a * a + b * b );

							}

						},
						// calculates the style values for the description containers,
						// based on the settings variable
						_calcDescrp	= function() {

							$descrp.each( function(i) {

								var $el		= $(this),
									$img	= $el.prev(),
									img_w	= $img.width(),
									img_h	= $img.height(),
									img_n_w	= settings.maxScale * img_w,
									img_n_h	= settings.maxScale * img_h,
									space_t = ( img_n_h - img_h ) / 2,
									space_l = ( img_n_w - img_w ) / 2;

								$el.data( 'space_l', space_l ).css({
									height	: settings.maxScale * $el.height(),
									top		: -space_t,
									left	: img_n_w - space_l
								});

							});

						},
						_initEvents	= function() {

							$elems.on('proximity.Photo', { max: 80, throttle: 10, fireOutOfBounds : true }, function(event, proximity, distance) {

								var $el			= $(this),
									$li			= $el.closest('li'),
									$desc		= $el.next(),
									scaleVal	= proximity * ( settings.maxScale - settings.minScale ) + settings.minScale,
									scaleExp	= 'scale(' + scaleVal + ')';

								// change the z-index of the element once it reaches the maximum scale value
								// also, show the description container
								if( scaleVal === settings.maxScale ) {

									$li.css( 'z-index', 1000 );

									if( $desc.offset().left + $desc.width() > listL + listW ) {

										$desc.css( 'left', -$desc.width() - $desc.data( 'space_l' ) );

									}

									$desc.fadeIn( 800 );

								}
								else {

									$li.css( 'z-index', 1 );

									$desc.stop(true,true).hide();

								}

								$el.css({
									'-webkit-transform'	: scaleExp,
									'-moz-transform'	: scaleExp,
									'-o-transform'		: scaleExp,
									'-ms-transform'		: scaleExp,
									'transform'			: scaleExp,
									'opacity'			: ( proximity * ( settings.maxOpacity - settings.minOpacity ) + settings.minOpacity )
								});

							});

						},
						_loadImages	= function( callback ) {

							var loaded 	= 0,
								total	= $elems.length;

							$elems.each( function(i) {

								var $el = $(this);

								$('<img/>').load( function() {

									++loaded;
									if( loaded === total )
										callback.call();

								}).attr( 'src', $el.attr('src') );

							});

						};

					return {
						init	: init
					};

				})();

				Photo.init();

			});
      </script>
      <!-- End of script -->
    </body>
    <!-- End main body -->

    <footer>
       <?php include('footer.html'); ?>
    </footer>
  </html>
