
http://photoswipe.com/documentation/getting-started.html



<!-- Core CSS file -->
<link rel="stylesheet" href="/assets/photoSwipe/dist/photoswipe.css"> 

<!-- Skin CSS file (styling of UI - buttons, caption, etc.)
     In the folder of skin CSS file there are also:
     - .png and .svg icons sprite, 
     - preloader.gif (for browsers that do not support CSS animations) -->
<link rel="stylesheet" href="/assets/photoSwipe/dist/default-skin/default-skin.css"> 

<!-- Core JS file -->
<script src="/assets/photoSwipe/dist/photoswipe.min.js"></script> 

<!-- UI JS file -->
<script src="/assets/photoSwipe/dist/photoswipe-ui-default.min.js"></script> 


<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe. 
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. 
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>                

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>





<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 video-item video-item-big">
    <div class="big-image-container">
		<div onclick="imageOpen('{{ $photo->src }}', {{ json_encode($photoset->photos->lists('src')) }})" class="img" style="background-image: url({{ $photo->src }})"></div>
	</div>

	{{-- <div class="home-page-images-cont">
        <div class="image-container">
			<div class="img" style="background-image: url({{ $photo->src }})"></div>
		</div>

	    <div class="photoset-info">
	        <div class="photoset-info-content">
	            <h4>{{ $photoset->title }}</h4>
	            <p class="description" title="">{{ $photoset->description }}</p>
	            <p>Number of pictures: {{ sizeof($photoset->photos) }} </p>
	        </div>
	        @if( Auth::check() )

				<a  href="{{ ams_url( 'payments/member/' . Auth::user()->auth_token . '/system/segpay/photoset/'.$photoset->id  ) }}" class="btn red-btn buttons-color text-uppercase" role="button">


					buy set {{ $photoset->price }} USD
				</a>
			@else
				<a href="{{ ams_url('/join') }}" class="btn red-btn buttons-color text-uppercase" role="button" >buy set {{ $photoset->price }} USD</a>
			@endif
	    </div>
	</div> --}}

	{{-- <div class="thumbnail">
		@if($photo->path != '')
			<div class="img" style="background-image: url('{{ $photo->src }}')"></div>
		@else
			<div class="img" style="background-image: url('/assets/images/photosets/default.jpg')"></div>
		@endif

		<div class="highlight">
			<p title="{{ $photoset->title }}">{{ $photoset->title }}</p>
		</div>
	</div> --}}
</div>

<script type="text/javascript">	
	function imageOpen(source, sources){		
		var pswpElement = document.querySelectorAll('.pswp')[0];

		// build items array
		var items = [
		    {
		        src: source,
		        w: 1200,
		        h: 900
		    }		    
		];
		for( var src in sources ){
			if( sources[src] !== source ){
				items.push({
					src: sources[src],
					w: 1200,
					h: 900
				})
			}
		}

		// define options (if needed)
		var options = {
		    // optionName: 'option value'
		    // for example:		 
		    bgOpacity : 0.2,   
		    index: 0 // start at first slide
		};

		// Initializes and opens PhotoSwipe
		var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
		gallery.init();		
	}
	
</script>