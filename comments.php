<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div id="comments">

  <!-- Default -->
  <?php function threadedComments($comments, $options) {
      $commentClass = '';
        if ($comments->authorId) {
          if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
          } else {
            $commentClass .= ' comment-by-user';
        }
      }
      $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    ?>
      <li id="li-<?php $comments->theId(); ?>" class="media<?php
        if ($comments->levels > 0) {
            echo ' comment-child';
            $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
        } else {
            echo ' comment-parent';
        }
        $comments->alt(' comment-odd', ' comment-even');
        echo $commentClass;
      ?> comments">
      <div class="media-left">
          <?php $comments->gravatar('50', ''); ?>
      </div>
      <div class="media-body">
        <p class="media-heading"><?php $comments->content(); ?></p>
        <span class="text-muted comment-meta"><?php $comments->author(); ?><span style="font-size:13px"><?php $comments->date('Y-m-d H:i'); ?></span><?php $comments->reply(); ?></span>
      </div>
      <?php if ($comments->children) { ?>
          <div class="comment-children">
              <?php $comments->threadedComments($options); ?>
          </div>
      <?php } ?>
      </li>
    <?php } ?>
  <?php $this->comments()->to($comments); ?>

  <?php if($this->allow('comment')): ?>

    <?php if (!$this->options->neteaseCommentsProductKey): ?>

      <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="comments-content">
          <!-- Comment Form -->
          <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" class="kami-comment-form" role="form">
            <h2 id="response"><?php _e('评论卡'); ?></h2>
            <?php if($this->user->hasLogin()): ?>
            <p><?php _e('你好，'); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>。<?php _e('不是？'); ?><a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?></a></p>
            <?php else: ?>
              <input type="text" name="author" maxlength="12" id="author" class="kami-form-control kami-input-control" placeholder="<?php _e('称呼'); ?>" value="<?php $this->remember('author'); ?>" required>
              <input type="email" name="mail" id="mail" class="kami-form-control kami-input-control" placeholder="<?php _e('Email'); ?>" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
              <input type="url" name="url" id="url" class="kami-form-control kami-input-control" placeholder="<?php _e('网址'); ?>" <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>>
            <?php endif; ?>
            <textarea name="text" id="textarea" class="kami-form-control" placeholder="<?php _e('请填写您的内容。'); ?>" required></textarea>
            <?php $comments->cancelReply(); ?>
            <button type="submit" class="btn btn-transparent" id="misubmit">提交</button>
          </form>
        </div>
      </div>

      <?php if ($comments->have()): ?>
        <h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>
        <?php $comments->listComments(); ?>
        <?php $comments->pageNav('&laquo;', '&raquo;', 5, '...', array('wrapTag' => 'ul', 'wrapClass' => 'page-change', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'active', 'prevClass' => 'prev', 'nextClass' => 'next')); ?>
      <?php endif; ?>

    <?php else: ?>
      <div id="cloud-tie-wrapper" class="cloud-tie-wrapper"></div>
      <script src="https://img1.cache.netease.com/f2e/tie/yun/sdk/loader.js"></script>
      <script>
      var cloudTieConfig = {
        url: document.location.href,
        sourceId: "",
        productKey: "<?php $this->options->neteaseCommentsProductKey(); ?>",
        target: "cloud-tie-wrapper"
      };
      var yunManualLoad = true;
      Tie.loader("<?php $this->options->neteaseCommentsTieLoader(); ?>", true);
      </script>
      <?php if (($this->options->enableTransparent == 1) && (UACheck::isSafari() == true)): ?>
        <link href="<?php $this->options->themeUrl('css/red-trans.css'); ?>" rel="stylesheet">
      <?php endif;
    endif;
  endif; ?>

</div>
