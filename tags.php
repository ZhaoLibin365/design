<?php
/**
 * 归档
 *
 * @package custom
 */
$this->need('header.php'); ?>
<div class="autopagerize_page_element">
  <div class="content">
    <div class="post_page">
	<div class="post animated fadeInDown">
	    <?php if ($this->options->JCountDownStatus === "on") : ?>
        <div class="aside aside-count">
            <div class="post_title post_detail_title">
                <h2>人生倒计时</h2>
            	<span class="date"></span>
                </div>
            <div class="content">
                <div class="item" id="dayProgress">
                    <div class="title">今日已经过去<span></span>小时</div>
                    <div class="progress">
                        <div class="progress-bar">
                            <div class="progress-inner progress-inner-1"></div>
                        </div>
                        <div class="progress-percentage"></div>
                    </div>
                </div>
                <div class="item" id="weekProgress">
                    <div class="title">这周已经过去<span></span>天</div>
                    <div class="progress">
                        <div class="progress-bar">
                            <div class="progress-inner progress-inner-2"></div>
                        </div>
                        <div class="progress-percentage"></div>
                    </div>
                </div>
                <div class="item" id="monthProgress">
                    <div class="title">本月已经过去<span></span>天</div>
                    <div class="progress">
                        <div class="progress-bar">
                            <div class="progress-inner progress-inner-3"></div>
                        </div>
                        <div class="progress-percentage"></div>
                    </div>
                </div>
                <div class="item" id="yearProgress">
                    <div class="title">今年已经过去<span></span>个月</div>
                    <div class="progress">
                        <div class="progress-bar">
                            <div class="progress-inner progress-inner-4"></div>
                        </div>
                        <div class="progress-percentage"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
	    
	<div class="post_title post_detail_title">
    <h2><?php $this->title() ?></h2>
	<span class="date"></span>
    </div>
	<div id="theme-tagcloud" class="tagcloud-wrap">
			<?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=30')->to($tags); ?>
			<?php while($tags->next()): ?>
			<a style="font-size:12px; text-transform:capitalize;" href="<?php $tags->permalink(); ?>">
			    <svg t="1609327052738" class="icon" viewBox="0 0 1228 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="36626" width="200" height="200"><path d="M1065.984 264.3968h-49.0496l-16.2816-64.7168a113.2544 113.2544 0 0 0-110.2848-85.6064H559.4112a37.888 37.888 0 0 1-22.6304-7.68L423.1168 22.528A113.9712 113.9712 0 0 0 355.6352 0H115.2C52.5312 0 1.6384 50.7904 1.4336 113.2544V854.016C0.6144 859.136 0 864.4608 0 869.7856 0 932.2496 50.688 983.04 113.4592 983.04h788.2752c48.128 0.6144 91.2384-30.4128 107.8272-77.4144l164.1472-490.9056a113.664 113.664 0 0 0-107.7248-150.4256v0.1024zM115.3024 75.5712h240.4352c8.192 0 16.0768 2.6624 22.528 7.5776l113.2544 84.1728c19.8656 14.5408 43.52 22.3232 67.6864 22.3232h331.0592c17.408 0 32.768 11.776 36.864 28.672l11.4688 46.08H310.5792a112.8448 112.8448 0 0 0-105.3696 71.4752L77.2096 654.9504v-541.696a38.2976 38.2976 0 0 1 37.9904-37.6832z m986.8288 314.1632L937.7792 880.4352a38.0928 38.0928 0 0 1-36.0448 27.2384H113.4592a37.888 37.888 0 0 1-37.0688-34.4064 16.0768 16.0768 0 0 0 0-3.6864v-13.9264l196.608-490.7008a37.7856 37.7856 0 0 1 35.1232-24.576h757.9648c10.1376 0 19.7632 4.096 26.8288 11.0592a38.0928 38.0928 0 0 1 9.1136 38.7072v-0.4096z" p-id="36627"></path></svg> <?php $tags->name(); ?></a>
			<?php endwhile; ?>
            </div>
            <section id="wrappe" class="home">
			<?php
$this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);   
    $year=0; $mon=0; $i=0; $j=0;  
    while($archives->next()):   
        $year_tmp = date('Y',$archives->created);   
        $mon_tmp = date('m',$archives->created);   
        $y=$year; $m=$mon;   
        if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';   
        if ($year != $year_tmp && $year > 0) $output .= '</ul>';   
        if ($year != $year_tmp) {   
            $year = $year_tmp;   
            @$output .= '<h3>'. $year .'</h3><ul class="post-list" id="post-list">'; //输出年份   
        }    
        $output .= '<li class="post-item"><div class="meta"><time datetime="'.date('Y-m-d ',$archives->created).'" itemprop="datePublished">'.date('Y-m-d ',$archives->created).'</time></div><span><a href="'.$archives->permalink .'">'. $archives->title .'</a></span></li>'; //输出文章日期和标题   
    endwhile;   
    $output .= '</ul>';
    echo $output;
?>

            </section>
        </div>
 <div class="post_footer"></div>
</div></div></div>
<?php $this->need('footer.php'); ?>
</div>