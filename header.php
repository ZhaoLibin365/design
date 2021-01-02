<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, width=device-width"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<!-- DNS预解析 -->
<link rel="dns-prefetch" href="//cdn.bootcss.com">
<link rel="dns-prefetch" href="//cdn.jsdelivr.net">
<link rel="shortcut icon" href="<?php $this->options->siteUrl(); ?>favicon.ico">
<title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?>
        <?php if ($this->is('index')): ?>- <?php $this->options->subtitle();?><?php endif; ?>
        </title>
<link rel="stylesheet" href="<?php $this->options->themeUrl('/style.css'); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('css/prism.css'); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('css/owo.css'); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('css/shortcode.css'); ?>">
</head>
<body id="pjax-container" class="wrapper" style="background-image:url(<?php $this->options->wrapperIMG();?>)">
<div class="menubar">
<div class="mhome"><a <?php if($this->is('index')): ?> class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></div>
<button id="menubutton" disable="enable" onclick="var qr=document.getElementById('menu');if(qr.style.display==='flex'){qr.style.display='none'}else{qr.style.display='flex'}">
<span><i></i><i></i><i></i></span></button>
<div id="menu">
    <nav id="nav-menu" role="navigation">
    <div class="menu menu-logo">
    <a class="home_a" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a>
    <div class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
    <li><a <?php if($this->is('index')): ?> class="currents"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></li>
	<?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
    <?php while($pages->next()): ?>
    <li><a <?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a></li>
    <?php endwhile; ?>
    </ul>
    </div>
	<div class="clearfix"></div>
    </nav>
    </div>
    <div class="clearfix"></div>
</div>
</div>
<div id="main">
