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
<div id="main">
