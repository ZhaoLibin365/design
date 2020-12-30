<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$GLOBALS['theme_url'] = $this->options->themeUrl;
$header = Comment_hash_fix($this);
echo $header;
?>


<?php
function threadedComments($comments, $options) {
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

<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">

<div id="<?php $comments->theId(); ?>">
        <div class="comment-inner">
            <?php $email=$comments->mail; $imgUrl = getGravatar($email);echo '<img class="avatar" src="'.$imgUrl.'">'; ?>
            <div class="new-comment">
                <div class="comment-author comment-meta"> 
                <span class="user-yimg"><?php CommentAuthor($comments); ?></span>
                <?php commentApprove($comments, $comments->mail); ?> 
                <span class="comment-reply"><?php $comments->reply(); ?></span>
                </div>
                <span class="comment-meta-time"><?php $comments->date('Y-m-d H:i'); ?></span>
            </div>
            <div class="comment-meta">
                <!--<span><?php $comments->date('Y-m-d H:i'); ?></span>-->
            </div>
            <div class="comment-content">
            <span class="comment-author-at"><?php getCommentAt($comments->coid); ?></span>
              <?php
                $cos = preg_replace('#\@\((.*?)\)#','<img src="https://cdn.jsdelivr.net/gh/youranreus/R@v1.0.3/G/IMG/bq/$1.png" class="bq">',$comments->content);
                echo $cos;
              ?>
            </div>
        </div>
    </li>

<?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
</li>
<?php } ?>

<div id="comments">
    <h3 id="response" class="widget-title text-left comment-title"><span class="nice-b-line"><?php $this->commentsNum(_t('发表感想'), _t('仅有 1 条感想'), _t(' %d 条感想')); ?></span></h3>
    <?php $this->comments()->to($comments); ?>
    <div class="comments-header" id="<?php $this->respondId(); ?>" >
        <?php if($this->allow('comment')): ?>
          <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form">
          <div class="cancel-comment-reply clear">
          <?php $comments->cancelReply('取消回复'); ?>
          </div>
          <div id="response" class="widget-title text-left comment-title"></div>
              <?php if($this->user->hasLogin()): ?>
              <?php else: ?>
              <div class="row">
                <div class="comment-md-3">
            	<label for="author">昵称<span class="required">*</span></label>
                <input type="text" name="author" id="author" placeholder="Name" value="<?php $this->remember('author'); ?>" /></div>
                <div class="comment-md-3 comment-form-email">
                <label for="email" >邮箱<span class="required">*</span></label>
                <input type="email" name="mail" id="mail" placeholder="E-mail" value="<?php $this->remember('mail'); ?>" /></div>
                <div class="comment-md-3 comment-form-url">
                <label for="url">博客<span class="required"></span></label>
                <input type="text" name="url" id="url" placeholder="Site"  value="<?php $this->remember('url'); ?>" /></div></div>
              <?php endif; ?>
              <p>
                  <input name="_" type="hidden" id="comment_" value="<?php echo Helper::security()->getToken(str_replace(array('?_pjax=%23pjax-container', '&_pjax=%23pjax-container'), '', Typecho_Request::getInstance()->getRequestUrl()));?>"/>
                  <textarea rows="5" name="text" id="textarea" placeholder="此刻在想..." style="resize:none;"><?php $this->remember('text'); ?></textarea>
              </p>
              <div class="clear">
                <div class="OwO-logo" onclick="OwO_show()">
                  <span>
                  <svg t="1607603517804" class="icon" viewBox="0 0 1044 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2167" width="200" height="200"><path d="M515.00469688 992c-129.0309375 0-250.3471875-49.92-341.56500001-140.5153125C82.20407188 760.7815625 31.98219687 640.2490625 32.00000937 512c0-128.23125 50.2575-248.7825 141.5109375-339.4490625C264.72969687 81.92 386.04407188 32 515.09375937 32c129.084375 0 250.381875 49.92 341.63437501 140.5509375 188.3559375 187.2 188.338125 491.7159375 0 678.84375C765.45875938 942.0453125 644.09000937 992 515.00563438 992z m0.0890625-897.440625c-112.2496875 0-217.725 43.396875-297.084375 122.2228125C138.64813438 295.59125 94.95032188 400.461875 94.95032188 512c-0.01875 111.5559375 43.6621875 216.40875 122.986875 295.2534375 79.3415625 78.79125 184.8534375 122.240625 297.065625 122.240625 112.2675 0 217.831875-43.485 297.21-122.3296875 163.7859375-162.7378125 163.7859375-427.5909375 0-590.3821875-79.3603125-78.826875-184.87125-122.221875-297.12-122.221875zM343.41313437 643.0053125s56.604375 89.9025 171.57375 89.9025c114.9684375 0 190.3640625-89.9025 190.36406251-89.9025s42.7378125-0.1425 42.72 44.941875c0 0-74.0971875 104.889375-233.0840625 104.889375-158.986875 0-210.7378125-104.889375-210.7378125-104.889375s-1.5646875-44.941875 39.16406249-44.941875z m31.20000001-285.350625c-32.56875 0-59.1646875 26.32875-59.1646875 58.790625 0 32.4271875 26.578125 58.7559375 59.165625 58.7559375 32.728125 0 59.16375-26.32875 59.16375-58.7559375 0-32.461875-26.435625-58.790625-59.1646875-58.790625z m303.129375 0c-32.6221875 0-59.1290625 26.32875-59.1290625 58.790625 0 32.4271875 26.506875 58.7559375 59.128125 58.7559375 32.694375 0 59.165625-26.32875 59.165625-58.7559375 0-32.461875-26.47125-58.790625-59.165625-58.790625z" p-id="2168"></path></svg>&nbsp;表情</span>
                </div>
                <button type="submit" class="submit"><?php _e('发表'); ?></button>
              </div>
              <div id="OwO-container"><?php  $this->need('owo.php'); ?></div>
          </form>
        <?php endif; ?>
	  </div>
    <?php if ($comments->have()): ?>
        <?php $comments->listComments(); ?>
        <?php $comments->pageNav('<svg t="1607661256993" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="8178" width="200" height="200"><path d="M889.1914 955.2978c0 5.4016-2.8621 10.6404-7.9217 13.44-5.0616 2.7996-11.0193 2.4453-15.5955-0.426L191.0886 545.4162c-4.3295-2.7126-7.1997-7.5305-7.1997-13.014s2.8733-10.3014 7.1987-13.014L865.6732 96.4915c4.5773-2.8703 10.5339-3.2246 15.5955-0.426 5.0596 2.8006 7.9217 8.0384 7.9217 13.44V955.2977920000001L889.1914 955.2978z" p-id="8179"></path></svg>', '<svg t="1607661264754" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="8304" width="200" height="200"><path d="M134.8086 68.7022c0-5.4016 2.8621-10.6404 7.9217-13.44 5.0616-2.7996 11.0193-2.4453 15.59549999 0.426L832.9114 478.5838c4.32949999 2.7126 7.1997 7.5305 7.1997 13.014s-2.8733 10.3014-7.1987 13.014L158.32680001 927.5085c-4.5773 2.87029999-10.5339 3.2246-15.59550001 0.426-5.0596-2.8006-7.9217-8.0384-7.9217-13.44L134.8096 68.702208 134.8086 68.7022z" p-id="8305"></path></svg>'); ?>
    <?php endif; ?>
</div>