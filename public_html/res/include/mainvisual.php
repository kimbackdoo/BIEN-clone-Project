<style>
.swiper-mainvisual { width:100%; min-width:1200px; max-width:1919px; height:571px; position:relative; margin:0 auto; z-index:1; }
.swiper-mainvisual .swiper-slide { width:100%; min-width:1200px; max-width:1919px; height:571px; position:relative; margin:0 auto; }

.MainThumb .swiper-pagination-bullet { width: 16px; height: 16px; background: white; opacity: 0.7; }
.MainThumb .swiper-pagination-bullet-active { width: 34px; border-radius: 8px; background: white; opacity: 0.9;}
</style>

<div class="swiper-container swiper-mainvisual" >
	 <div class="swiper-wrapper">
		<?for($i=1; $i<=4; $i++){?>
			<div style="background:url('/res/images/mainvisual/<?=$i?>.jpg');width:100%;background-position:center center;" class="swiper-slide" >
			</div>
		<?}?>
	</div>

    <div class="swiper-pagination MainThumb"></div>
</div>


<script>
	
	var swiper_mainvisual = null;
	$(function(){
		swiper_mainvisual = new Swiper('.swiper-mainvisual', {
			spaceBetween: 0,
			centeredSlides: true,
			autoplay: {
				delay: 4000,
			},
			disableOnInteraction: false,
			speed: 1000,
			effect: 'fade',
			loop:true,
			slidesPerView:'auto',
			observer:true,
			simulateTouch: false,
			on:{
				transitionStart:function(){ },
				transitionEnd:function(){
					this.autoplay.stop();
					this.autoplay.start();
				}
			},
			navigation: {
				nextEl: '.navigation_next',
				prevEl: '.navigation_prev',
			},

			pagination: {
				el: '.MainThumb',
				clickable: true,
			},
		});
	});
</script>

