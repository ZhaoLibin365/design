<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="autopagerize_page_element">
<div id="post_thumb" style="background-image:url(<?php  $imgurl = $this->fields->imgurl;if($imgurl != ''){echo $imgurl;}else{$this->options->defaultPostIMG();}?>)">
<canvas id="header_canvas"style="position:absolute;bottom:0"></canvas>
<div class="post_title post_detail_title">
<h1><?php $this->title() ?></h1>
</div>
</div>
</div>
<div class="thumb_content">
    <div class="post_page">
      <div class="thumb_post animated fadeInDown">
        <div class="post_icon">
        <span class="postcat">
        <svg t="1607597538943" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1537" width="200" height="200"><path d="M702.4128 1018.3168H306.0224A255.1296 255.1296 0 0 1 51.2 763.4944V255.7952A255.1296 255.1296 0 0 1 306.0224 0.9728h396.4928a255.1296 255.1296 0 0 1 254.8224 254.8224v507.8016a255.2832 255.2832 0 0 1-254.976 254.72z" fill="#d84c29" p-id="1538"></path><path d="M306.0224 90.4704a165.4784 165.4784 0 0 0-165.3248 165.3248v507.8016a165.4784 165.4784 0 0 0 165.3248 165.3248h396.4928a165.4784 165.4784 0 0 0 165.3248-165.3248V255.7952a165.4784 165.4784 0 0 0-165.3248-165.3248H306.0224z" fill="#d84c29" p-id="1539"></path><path d="M683.1104 431.3088H325.2736a44.6976 44.6976 0 1 1 0-89.3952h357.9904a44.6976 44.6976 0 1 1-0.1536 89.3952z m-173.3632 246.1696H330.8544a44.6976 44.6976 0 1 1 0-89.3952h178.8928a44.6976 44.6976 0 1 1 0 89.3952z" fill="#FFFFFF" p-id="1540"></path></svg>
        <?php $this->category(' · '); ?></a></span>
        <span class="postcat_read">
        <svg t="1607597886283" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1537" width="200" height="200"><path d="M44.4416 806.1952m20.48 0l896 0q20.48 0 20.48 20.48l0 0q0 20.48-20.48 20.48l-896 0q-20.48 0-20.48-20.48l0 0q0-20.48 20.48-20.48Z" fill="#417EF5" p-id="1538"></path><path d="M358.4 785.7152V627.9168a63.1808 63.1808 0 0 0-64.6144-61.44h-108.544a63.1808 63.1808 0 0 0-64.6144 61.44v157.7984zM120.6272 806.1952h237.4656v40.1408H120.6272zM633.2416 785.7152V165.7856a63.1808 63.1808 0 0 0-64.6144-61.44H460.8a63.1808 63.1808 0 0 0-64.6144 61.44v619.9296zM395.6736 806.1952h237.4656v40.1408H395.6736zM906.0352 785.7152v-367.616a63.1808 63.1808 0 0 0-64.6144-61.44H733.184a63.1808 63.1808 0 0 0-64.6144 61.44v367.616zM668.5696 806.1952h237.4656v40.1408H668.5696z" fill="#417EF5" p-id="1539"></path></svg>
        <a><?php art_count($this->cid); ?> 字</a></span>
        <span class="post_detail_date">
        <svg t="1607597930443" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1663" width="200" height="200"><path d="M526.661818 531.316364m-424.261818 0a424.261818 424.261818 0 1 0 848.523636 0 424.261818 424.261818 0 1 0-848.523636 0Z" fill="#BAE2F8" p-id="1664"></path><path d="M497.338182 492.683636m-424.261818 0a424.261818 424.261818 0 1 0 848.523636 0 424.261818 424.261818 0 1 0-848.523636 0Z" fill="#27AAFA" p-id="1665"></path><path d="M393.774545 520.378182m46.545455 0l311.389091 0q46.545455 0 46.545454 46.545454l0 0q0 46.545455-46.545454 46.545455l-311.389091 0q-46.545455 0-46.545455-46.545455l0 0q0-46.545455 46.545455-46.545454Z" fill="#FFFFFF" p-id="1666"></path><path d="M397.498182 612.305455m0-46.545455l0-311.389091q0-46.545455 46.545454-46.545454l0 0q46.545455 0 46.545455 46.545454l0 311.389091q0 46.545455-46.545455 46.545455l0 0q-46.545455 0-46.545454-46.545455Z" fill="#FFFFFF" p-id="1667"></path></svg>
        <a>大概 <?php echo art_time($this->cid); ?> 分钟</a></span>
        <span class="posteye">
        <svg t="1607598953928" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1791" width="200" height="200"><path d="M604.37 488.16a93.87 93.87 0 1 1-93.92-93.88 94 94 0 0 1 93.92 93.88z" fill="#5788ff" p-id="1792"></path><path d="M510.5 179c-246 0-445.39 227.26-445.39 318.12 0 113.65 199.43 318.17 445.39 318.17s445.39-204.52 445.39-318.17C955.89 406.26 756.46 179 510.5 179z m0 477.33c-92.68 0-168.07-75.44-168.07-168.17S417.77 320 510.45 320s168.17 75.42 168.17 168.13-75.44 168.2-168.17 168.2z" fill="#5788ff" p-id="1793"></path></svg>
        <a><?php get_post_view($this) ?></a></span>
        </div>
        <div class="post_content markdown">
        <?php
			$db = Typecho_Db::get();
			$sql = $db->select()->from('table.comments')
			    ->where('cid = ?',$this->cid)
			    ->where('mail = ?', $this->remember('mail',true))
			    ->where('status = ?', 'approved')
			//只有通过审核的评论才能看回复可见内容
			    ->limit(1);
			$result = $db->fetchAll($sql);
			if($this->user->hasLogin() || $result) {
			    $content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="reply2see">$1</div>',$this->content);
			}
			else{
			    $content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="reply2see">此处内容需要评论回复后方可阅读。</div>',$this->content);
			}

			emotionContent($content);
		?>
		</div>
		<div class="post_eof"><span>END</span></div>
    <div class="post_footer">
    <div class="meta">
    <div class="info">
<span class="field tags"><svg t="1609328244402" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="44044" width="200" height="200"><path d="M789.4 20.2H235.8c-81.2 0-147.6 66.4-147.6 147.6v727c0 20.3 5.5 40.6 16.6 57.2 31.4 51.7 99.6 68.3 151.3 36.9L496 843.2c11.1-7.4 25.8-7.4 38.8 0l232.5 143.9c16.6 11.1 36.9 16.6 57.2 16.6 60.9 0 110.7-49.8 110.7-110.7V167.8C937 86.6 870.5 20.2 789.4 20.2zM863.2 893c0 20.3-16.6 36.9-36.9 36.9-7.4 0-12.9-1.8-18.5-5.5l-232.5-144c-35.1-22.1-79.3-22.1-114.4 0L221 926.2c-16.6 11.1-40.6 5.5-49.8-12.9-3.7-5.5-5.5-12.9-5.5-18.5v-727c0-40.6 33.2-73.8 73.8-73.8h553.6c40.6 0 73.8 33.2 73.8 73.8V893h-3.7z m0 0" p-id="44045"></path><path d="M660.2 241.6H365c-20.3 0-36.9 16.6-36.9 36.9 0 20.3 16.6 36.9 36.9 36.9h295.2c20.3 0 36.9-16.6 36.9-36.9 0-20.3-16.6-36.9-36.9-36.9zM552.1 421.8H372.2c-20.3 0-36.9 16.6-36.9 36.9 0 20.3 16.6 36.9 36.9 36.9h179.9c20.3 0 36.9-16.6 36.9-36.9 0-20.3-16.6-36.9-36.9-36.9z m0 0" p-id="44046"></path></svg><?php $this->tags(' ', true, '暂无'); ?>
</span>
</div>
</div>
</div>
<br>
<div class="prev-next">
<div class="prev-post">
<h3 class="post-title"><?php $this->thePrev('上一篇：%s', ''); ?></h3>
</div>
<div class="next-post">
<h3 class="post-title"><?php $this->theNext('下一篇：%s', ''); ?></h3>
</div>
</div>
</div>
</div>
<?php $this->need('comments.php'); ?>
</div>
</div>
<script>
/*气泡效果*/
(function() {
	var canvas, ctx, width, height, bubbles, animateHeader = true;
	initHeader();
	function initHeader() {
		canvas = document.getElementById('header_canvas');
		window_resize();
		ctx = canvas.getContext('2d');
		//建立泡泡
		bubbles = [];
		var num = width * 0.05;//气泡数量
		for (var i = 0; i < num; i++) {
			var c = new Bubble();
			bubbles.push(c);
		}
		animate();
	}
	function animate() {
		if (animateHeader) {
			ctx.clearRect(0, 0, width, height);
			for (var i in bubbles) {
				bubbles[i].draw();
			}
		}
		requestAnimationFrame(animate);
	}
	function window_resize() {
		//canvas铺满窗口
		//width = window.innerWidth;
		//height = window.innerHeight;

        //如果需要铺满内容可以换下面这个
        var panel = document.getElementById('post_thumb');
		width=panel.offsetWidth;
		height=panel.offsetHeight;

		canvas.width = width;
		canvas.height = height;
	}
    window.onresize = function(){
        window_resize();
    }
	function Bubble() {
		var _this = this;
		(function() {
			_this.pos = {};
			init();
		})();
		function init() {
			_this.pos.x = Math.random() * width;
			_this.pos.y = height + Math.random() * 100;
			_this.alpha = 0.1 + Math.random() * 0.3;//气泡透明度
			_this.alpha_change = 0.0002 + Math.random() * 0.0007;//气泡透明度变化速度
			_this.scale = 0.2 + Math.random() * 0.5;//气泡大小
			_this.scale_change = Math.random() * 0.002;//气泡大小变化速度
			_this.speed = 0.1 + Math.random() * 0.5;//气泡上升速度
		}
		//气泡
		this.draw = function() {
			if (_this.alpha <= 0) {
				init();
			}
			_this.pos.y -= _this.speed;
			_this.alpha -= _this.alpha_change;
			_this.scale += _this.scale_change;
			ctx.beginPath();
			ctx.arc(_this.pos.x, _this.pos.y, _this.scale * 10, 0, 2 * Math.PI, false);
			ctx.fillStyle = 'rgba(255,255,255,' + _this.alpha + ')';
			ctx.fill();
		}; 
	}
})();
</script>
<?php $this->need('footer.php'); ?>
