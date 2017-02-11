<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
  <head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- 必须在最上面 -->

    <!-- 页面标题 -->
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <!-- Bootstrap -->
    <link href="<?php $this->options->themeUrl('css/bootstrap.css'); ?>" rel="stylesheet">

    <!-- Theme Kibou 所使用的 CSS -->
    <link href="<?php $this->options->themeUrl('css/normalize.css'); ?>" rel="stylesheet">
    <link href="<?php $this->options->themeUrl('css/style.css'); ?>" rel="stylesheet">
    <link href="<?php $this->options->themeUrl('css/highlight.css'); ?>" rel="stylesheet">

    <!-- 转为 macOS 中 Safari 打造的毛玻璃效果 -->
    <link href="<?php $this->options->themeUrl('css/transparent.css'); ?>" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php $this->header(); ?>
  </head>

  <body>

    <!--[if lt IE 10]>
      <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
    <![endif]-->

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a <?php if($this->is('index')): ?> class="blog-nav-item active" <?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a>
          <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
              <a<?php if($this->is('page', $pages->slug)): ?> class="blog-nav-item active"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
          <?php endwhile; ?>
        </nav>
      </div>
    </div>


    <div class="container">

      <!-- Header -->
      <div class="blog-header">
        <h1 class="blog-title"><a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a></h1>
        <p class="lead blog-description"><?php $this->options->description() ?></p>
      </div>

      <!-- Search -->
      <div class="site-search col-3 kit-hidden-tb">
        <form id="search" method="post" action="./" role="search">
          <label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
            <input type="text" name="s" class="text" placeholder="<?php _e('输入关键字搜索'); ?>" />
            <button type="submit" class="submit"><?php _e('搜索'); ?></button>
        </form>
      </div>

      <div class="row">
