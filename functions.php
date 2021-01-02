<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form) {
    echo "<link rel='stylesheet' href='".__TYPECHO_THEME_DIR__."/design/css/setting.css'/>";
    //感谢大米api随机图调用
    echo "
    <div id='art-box' style='background-image: url(https://api.qqsuu.cn/api/img)'>
       <div id='ab-mask'>
         <div id=ab-content>
           <p>主题设置</p>
         </div>
       </div>
     </div>";

$sticky = new Typecho_Widget_Helper_Form_Element_Text('sticky', NULL,NULL, _t('文章置顶'), _t('置顶的文章cid，按照排序输入, 请以半角逗号或空格分隔'));
 $form->addInput($sticky);

$word = new Typecho_Widget_Helper_Form_Element_Text('word', NULL, NULL, _t('简短介绍'), _t('用于显示头部,建议少于10字'));
 $form->addInput($word);

$subtitle = new Typecho_Widget_Helper_Form_Element_Text('subtitle', NULL, NULL, _t('网站副标题'), _t('副标题,用于显示头部'));
 $form->addInput($subtitle);

$toux = new Typecho_Widget_Helper_Form_Element_Text('toux', NULL, NULL, _t('个人头像'), _t('在这里输入头像地址，注意:请加https://'));
 $form->addInput($toux);

$defaultPostIMG = new Typecho_Widget_Helper_Form_Element_Text('defaultPostIMG', NULL, NULL, _t('没有设置文章头图就用这里的图片') , _t('https://...'));
 $form->addInput($defaultPostIMG);

$wrapperIMG = new Typecho_Widget_Helper_Form_Element_Text('wrapperIMG', NULL, NULL, _t('网站整体背景图') , _t('https://...'));
 $form->addInput($wrapperIMG);

$github = new Typecho_Widget_Helper_Form_Element_Text('github', NULL, NULL, _t('Github'), _t('在这里输入github地址，注意:请加https://'));
 $form->addInput($github);
  
$weibo = new Typecho_Widget_Helper_Form_Element_Text('weibo', NULL, NULL, _t('微博'), _t('在这里输入微博地址，注意:请加https://'));
 $form->addInput($weibo);
  
$qq = new Typecho_Widget_Helper_Form_Element_Text('qq', NULL, NULL, _t('QQ'), _t('在这里输入QQ地址，注意:请加https://'));
 $form->addInput($qq);
  
$email = new Typecho_Widget_Helper_Form_Element_Text('email', NULL, NULL, _t('邮箱'), _t('在这里输入邮箱地址，注意:请加https://'));
 $form->addInput($email);

$beian = new Typecho_Widget_Helper_Form_Element_Text('beian', NULL, NULL, _t('备案号') , _t('没备案当我没说'));
 $form->addInput($beian);
  
$Links = new Typecho_Widget_Helper_Form_Element_Textarea('Links', NULL, NULL, _t('友情链接'), _t('按照格式输入链接信息，格式：<br><strong>链接名称,链接地址,链接描述,链接头像</strong><br>不同信息之间用英文逗号“,”分隔，例如：<br><strong>梦不落,https://yolen.cn/,记录自己更欣赏你们,https://yolen.cn/logo.png</strong><br>多个链接换行即可，一行一个'));
    $form->addInput($Links);

$JCountDownStatus = new Typecho_Widget_Helper_Form_Element_Select(
    'JCountDownStatus',
    array(
        'off' => '关闭（默认）',
        'on' => '开启',
    ),
        'off',
        '是否开启人生倒计时',
        '介绍：开启后归档页面将显示人生倒计时'
);
$JCountDownStatus->setAttribute('class', 'j-setting-content j-setting-aside');
    $form->addInput($JCountDownStatus->multiMode());

}

//自定义字段
function themeFields(Typecho_Widget_Helper_Layout $layout)
{
    $imgurl = new Typecho_Widget_Helper_Form_Element_Text('imgurl', null, null, '文章主图', '该图片会用于主页文章列表及文章头图的显示。');
    $layout->addItem($imgurl);
}

function GetOriginalContent($id){
  $db = Typecho_Db::get();
  $result = $db->fetchAll($db->select()->from('table.contents')
    ->where('status = ?','publish')
    ->where('type = ?', 'post')
    ->where('cid = ?',$id)
  );
  foreach($result as $val){
    $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
    $content = $val['text'];
    return $content;
  }
}

function getCommentAt($coid){
        $db   = Typecho_Db::get();
        $prow = $db->fetchRow($db->select('parent')
            ->from('table.comments')
            ->where('coid = ? AND status = ?', $coid, 'approved'));
        $parent = $prow['parent'];
        if ($parent != "0") {
            $arow = $db->fetchRow($db->select('author')
                ->from('table.comments')
                ->where('coid = ? AND status = ?', $parent, 'approved'));
            $author = $arow['author'];
            if($author){
            	$href   = '<a class="at" href="#comment-'.$parent.'">@'.$author.'</a>';
        	}else{
        		$href   = '<a href="javascript:void(0)">评论审核中···</a>';
        	}
            echo $href;
        } else {
            echo "";
        }
    }


//感谢泽泽大佬的代码
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('Gx','reply2see');
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('Gx','reply2see');
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('Gx', 'addButton');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('Gx', 'addButton');

class Gx {

    public static function reply2see($con,$obj,$text)
    {
      $text = empty($text)?$con:$text;
      if(!$obj->is('single')){
        $text = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'',$text);
      }
      return $text;
    }

    public static function addButton()
    {
      echo '  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/youranreus/R@v1.1.7/G/CSS/OwO.min.css?v=2" rel="stylesheet" />';

        echo '
        <style>
          .wmd-button-row{
            height:auto;
          }
          .wmd-button{
            color:#999;
          }
          .OwO{
            background:#fff;
          }
          #g-shortcode{
            line-height: 30px;
            background:#fff;
          }
          #g-shortcode a{
            cursor: pointer;
            font-weight:bold;
            font-size:14px;
            text-decoration:none;
            color: #999 !important;
            margin:5px;
            display:inline-block;
          }
        </style>
        ';

        echo '<script src="https://yolen.cn/usr/themes/design/js/editor.js"></script>';


    }

}

require_once __DIR__ . '/lib/Parsedown.php';
require_once __DIR__ . '/lib/shortcode.php';

/**
* 文章内容解析（短代码，表情）
*
* @access public
* @param mixed
* @return
*/
function emotionContent($content)
{
    //HyperDown解析
    //$Parsedown = new Parsedown();
    //$content =  $Parsedown->text($content);
    //表情解析
    $fcontent = preg_replace('#\@\((.*?)\)#','<img src="https://cdn.jsdelivr.net/gh/youranreus/R@v1.1.5/G/IMG/bq/$1.png" class="bq">',$content);
    //感谢Maicong大佬的短代码解析QwQ
    $fcontent = do_shortcode($fcontent);
    //输出最终结果
    echo $fcontent;
}

/**
* 文章内容解析（短代码，表情）
*
* @access public
* @param mixed
* @return
*/
function shortcodeContent($content)
{
    $Parsedown = new Parsedown();
    $fcontent =  $Parsedown->text($content);
    $fcontent = preg_replace('#\@\((.*?)\)#','<img src="https://cdn.jsdelivr.net/gh/youranreus/R@v1.1.5/G/IMG/bq/$1.png" class="bq">',$fcontent);
    return $fcontent;
}


//获取Gravatar头像 QQ邮箱取用qq头像
function getGravatar($email, $s = 96, $d = 'mp', $r = 'g', $img = false, $atts = array())
{
preg_match_all('/((\d)*)@qq.com/', $email, $vai);
if (empty($vai['1']['0'])) {
    $url = 'https://gravatar.yyer.net/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
}else{
  
$qquser = $vai['1']['0'];
$geturl = 'https://ptlogin2.qq.com/getface?&imgtype=1&uin='.$qquser;
$qqurl = file_get_contents($geturl);
$str1 = explode('sdk&k=', $qqurl);
$str2 = explode('&t=', $str1[1]);
$k = $str2[0];

$url = 'https://q1.qlogo.cn/g?b=qq&k='.$k.'&s=100';
 
}
return  $url;
}

//通过id获取文章信息
function GetPostById($id){

		$db = Typecho_Db::get();
		$result = $db->fetchAll($db->select()->from('table.contents')
			->where('status = ?','publish')
			->where('type = ?', 'post')
			->where('cid = ?',$id)
		);
		if($result){
			$i=1;
			foreach($result as $val){
				$val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
				$post_title = htmlspecialchars($val['title']);
				$post_permalink = $val['permalink'];
        $post_date = $val['created'];
        $post_date = date('Y-m-d',$post_date);
				return '<div class="ArtinArt">
                  <h4><a href="'.$post_permalink.'">'.$post_title.'</a></h4>
                  <p class="clear"><span style="float:left">ID:'.$id.'</span><span style="float:right">'.$post_date.'</span></p>
                </div>';
			}
		}
    else{
      return '<span>id无效QAQ</span>';
    }
}

//时间友好化
function formatTime($time)
{
    $text = '';
    $time = intval($time);
    $ctime = time();
    $t = $ctime - $time; //时间差
    if ($t < 0) {
        return date('Y-m-d', $time);
    }
    ;
    $y = date('Y', $ctime) - date('Y', $time);//是否跨年
    switch ($t) {
        case $t == 0:
            $text = '刚刚';
            break;
        case $t < 60://一分钟内
            $text = $t . '秒前';
            break;
        case $t < 3600://一小时内
            $text = floor($t / 60) . '分钟前';
            break;
        case $t < 86400://一天内
            $text = floor($t / 3600) . '小时前'; // 一天内
            break;
        case $t < 2592000://30天内
            if($time > strtotime(date('Ymd',strtotime("-1 day")))) {
                $text = '昨天';
            } elseif($time > strtotime(date('Ymd',strtotime("-2 days")))) {
                $text = '前天';
            } else {
                $text = floor($t / 86400) . '天前';
            }
            break;
        case $t < 31536000 && $y == 0://一年内 不跨年
            $m = date('m', $ctime) - date('m', $time) -1;

            if($m == 0) {
                $text = floor($t / 86400) . '天前';
            } else {
                $text = $m . '个月前';
            }
            break;
        case $t < 31536000 && $y > 0://一年内 跨年
            $text = (11 - date('m', $time) + date('m', $ctime)) . '个月前';
            break;
        default:
            $text = (date('Y', $ctime) - date('Y', $time)) . '年前';
            break;
    }

    return $text;
}

//文章阅读时间统计
function art_time ($cid){
  $db=Typecho_Db::get ();
  $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
  $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
  $text_word = mb_strlen($text,'utf-8');
  echo ceil($text_word / 400);
}

//文章字数统计
function  art_count ($cid){
    $db=Typecho_Db::get ();
    $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
    $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
    echo mb_strlen($text,'UTF-8');
}

//评论锚点修复
function Comment_hash_fix($archive){
  $header = "<script type=\"text/javascript\">
  (function () {
      window.TypechoComment = {
          dom : function (id) {
              return document.getElementById(id);
          },

          create : function (tag, attr) {
              var el = document.createElement(tag);

              for (var key in attr) {
                  el.setAttribute(key, attr[key]);
              }

              return el;
          },
          reply : function (cid, coid) {
              var comment = this.dom(cid), parent = comment.parentNode,
                  response = this.dom('" . $archive->respondId . "'), input = this.dom('comment-parent'),
                  form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                  textarea = response.getElementsByTagName('textarea')[0];
              if (null == input) {
                  input = this.create('input', {
                      'type' : 'hidden',
                      'name' : 'parent',
                      'id'   : 'comment-parent'
                  });
                  form.appendChild(input);
              }
              input.setAttribute('value', coid);
              if (null == this.dom('comment-form-place-holder')) {
                  var holder = this.create('div', {
                      'id' : 'comment-form-place-holder'
                  });
                  response.parentNode.insertBefore(holder, response);
              }
              comment.appendChild(response);
              this.dom('cancel-comment-reply-link').style.display = '';
              if (null != textarea && 'text' == textarea.name) {
                  textarea.focus();
              }
              return false;
          },
          cancelReply : function () {
              var response = this.dom('{$archive->respondId}'),
              holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');
              if (null != input) {
                  input.parentNode.removeChild(input);
              }
              if (null == holder) {
                  return true;
              }
              this.dom('cancel-comment-reply-link').style.display = 'none';
              holder.parentNode.insertBefore(response, holder);
              return false;
          }
      };
  })();
  </script>
  ";
  return $header;
}

//文章阅读次数
function get_post_view($archive)
{
$cid = $archive->cid;
$db = Typecho_Db::get();
$prefix = $db->getPrefix();
if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
$db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
echo 0;
return;
}
$row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
if ($archive->is('single')) {
$db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
}
echo $row['views'];
}

//新窗口打开
function parseContent($obj){
    $options = Typecho_Widget::widget('Widget_Options');
    if(!empty($options->src_add) && !empty($options->cdn_add)){
        $obj->content = str_ireplace($options->src_add,$options->cdn_add,$obj->content);
    }
    $obj->content = preg_replace("/<a href=\"([^\"]*)\">/i", "<a href=\"\\1\" target=\"_blank\">", $obj->content);
    echo trim($obj->content);
    }

//评论者认证    
function commentApprove($widget, $email = NULL)      
{      
    if (empty($email)) return;      
    //认证用户，再次添加认证用户邮箱      
    $handsome = array(      
        '544672716@qq.com',
        'love@muuzi.cn',
        '284993019@qq.com',
        '1466996001@qq.com',
        'gatesx@foxmail.com',
        '3308869544@qq.com'
    );      
    if ($widget->authorId == $widget->ownerId) {      
        echo '<span class="vip-admin" title="博主">博主</span>';
    } else if (in_array($email, $handsome)) {      
        echo '<span class="vip-user" title="好友">好友</span>';
    }      
}

//评论用户新窗口打开
function CommentAuthor($obj, $autoLink = NULL, $noFollow = NULL) {    //后两个参数是原生函数自带的，为了保持原生属性，我并没有删除，原版保留
    $options = Helper::options();
    $autoLink = $autoLink ? $autoLink : $options->commentsShowUrl;    //原生参数，控制输出链接
    $noFollow = $noFollow ? $noFollow : $options->commentsUrlNofollow;    //原生参数，控制输出链接额外属性
    if ($obj->url && $autoLink) {
        echo '<a href="'.$obj->url.'"'.($noFollow ? ' rel="external nofollow"' : NULL).(strstr($obj->url, $options->index) == $obj->url ? NULL : ' target="_blank"').'>'.$obj->author.'</a>';
    } else {
        echo $obj->author;
    }
}

//免插件实现友情链接功能
function Links($sorts = NULL) {
    $options = Typecho_Widget::widget('Widget_Options');
    $link = NULL;
    if ($options->Links) {
        $list = explode("\r\n", $options->Links);
        foreach ($list as $val) {
            list($name, $url, $description, $img) = explode(",", $val);
            if ($sorts) {
                $arr = explode(",", $sorts);
                if ($sort && in_array($sort, $arr)) {
                    $link .= $url ? '<a href="'.$url.'" title="'.$description.'" target="_blank" class="friends"><img src="'.$img.'"/><span class="name">'.$name.'</span></a></li>' : '<li class="clear"><a href="'.$url.'" title="'.$description.'" target="_blank" class="friends"></a><img src="'.$img.'"/><span class="name">'.$sort.'</span></a>';
                }
            } else {
                $link .= $url ? '<a href="'.$url.'" title="'.$description.'" target="_blank" class="friends"><img src="'.$img.'"/><span class="name">'.$name.'</span></a></li>' : '<li class="clear"><a href="'.$url.'" title="'.$description.'" target="_blank" class="friends"></a><img src="'.$img.'"/><span class="name">'.$sort.'</span></a>';
            }
        }
    }
    echo $link ? $link : '<no>暂无链接</no>';
}

//页面加载时间
function timer_start() {
global $timestart;
$mtime = explode( ' ', microtime() );
$timestart = $mtime[1] + $mtime[0];
return true;
}
timer_start();
function timer_stop( $display = 0, $precision = 3 ) {
global $timestart, $timeend;
$mtime = explode( ' ', microtime() );
$timeend = $mtime[1] + $mtime[0];
$timetotal = number_format( $timeend - $timestart, $precision );
$r = $timetotal < 1 ? $timetotal * 1000 . " ms" : $timetotal . " s";
if ( $display ) {
echo $r;
}
return $r;
}
