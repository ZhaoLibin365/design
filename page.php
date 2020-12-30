<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="autopagerize_page_element">
  <div class="content">
    <div class="post_page">
      <div class="post animated fadeInDown">
        <div class="post_title post_detail_title">
          <h2><?php $this->title() ?>
          </h2><span class="date">	</span>
        </div>
      <div class="post_content markdown">
	  <?php
		    $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
		    $replacement = '<a href="$1" data-fancybox="gallery" /><img src="$1" alt="'.$this->title.'"></a>';
		    $content = preg_replace($pattern, $replacement, $this->content);
		    echo $content;
	  ?>
  </div>
  <div class="post_eof"><span>END</span></div>
<div class="post_footer"> </div>
</div>
<?php $this->need('comments.php'); ?>
</div></div>
<?php $this->need('footer.php'); ?>
