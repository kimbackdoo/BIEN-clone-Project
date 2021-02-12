<style>

.swiper-mainvisual-container {margin:0 auto; width:100%; height:370px; position:relative; left:0; top:0; right:0; z-index:1; overflow:hidden; }

.swiper-pagination .swiper-pagination-bullet { width: 16px; height: 16px; background: white; opacity: 0.7; }
.swiper-pagination .swiper-pagination-bullet-active { width: 34px; border-radius: 8px; background: white; opacity: 0.9;}

</style>

<div class="swiper-mainvisual-container swiper-mainvisual-container1" >


	 <div class="swiper-wrapper">
		<?for($i=1; $i<=4; $i++){?>
			<div style="background:url('/m/images/mainvisual/<?=$i?>.jpg');width:100%;background-position:center center;" class="swiper-slide" >
				&nbsp;
			</div>
		<?}?>
	</div>

	
	
	<div class="swiper-pagination swiper-pagination-m swiper-pagination-bullets"></div>
</div>


<script>

	window.onload = function(){
	var swiper_mainvisual = null;

	$(function(){

		swiper_mainvisual = new Swiper('.swiper-mainvisual-container1', {
						spaceBetween: 0,
						centeredSlides: true,
						autoplay: {
							delay: 4000,
						},
						disableOnInteraction: false,
						effect:'fade',
						speed: 1000,
						loop:true,
						loopAdditionalSlides:1,
						loopedSlides:1,
						slidesPerView:'auto',
						observer:true,
						simulateTouch: false,
						on:{
						transitionEnd:function(){
							this.autoplay.stop();
							this.autoplay.start();
							}
						},
						touchRatio:0,
						pagination: {
							el: '.swiper-pagination',
							clickable: 'false',
						 },
						
						
						
					});


		

	});
	}

</script>

