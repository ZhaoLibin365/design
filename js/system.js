//移动端补偿
var mobileHover = function () {
    $('*').on('touchstart', function () {
        $(this).trigger('hover');
    }).on('touchend', function () {
        $(this).trigger('hover');
    });
};

//代码高亮
if (typeof Prism !== 'undefined') {
var pres = document.getElementsByTagName('pre');
    for (var i = 0; i < pres.length; i++){
        if (pres[i].getElementsByTagName('code').length > 0)
            pres[i].className  = 'line-numbers';}
Prism.highlightAll(true,null);}

//灯箱
(function(a){a.extend({viewImage:function(c){var b=a.extend({target:".view-image img",exclude:"",delay:300},c);a(b.exclude).attr("view-image",!1);a(b.target).off().on("click",function(e){var f=e.currentTarget.src,d=e.currentTarget.href,c=".vi-"+Math.random().toString(36).substr(2);if(!a(this).attr("view-image")&&!a(this).is(b.exclude)&&(f||d&&d.match(/.+\.(jpg|jpeg|webp|gif|png)/gi)))return a("body").append("<style class='view-image-css'>.view-img{position:fixed;background:#fff;background:rgba(255,255,255,.92);width:100%;height:100%;top:0;left:0;text-align:center;padding:2%;z-index:999;cursor: zoom-out}.view-img img,.view-img span{max-width:100%;max-height:100%;position:relative;top:50%;transform: translateY(-50%);}.view-img img{animation:view-img-show .8s -0.1s ease-in-out}.view-img span{height:2em;color:#AAB2BD;overflow:hidden;position:absolute;top:50%;left:0;right:0;width:120px;text-align:center;margin:-1em auto;}.view-img span:after{content:'';position:absolute;bottom:0;left:0;transform: translateX(-100%);width:100%;height:2px;background:#ff9901;animation:view-img-load .8s -0.1s ease-in-out infinite;}@keyframes view-img-load{0%{transform: translateX(-100%);}100%{transform: translateX(100%);}}@keyframes view-img-show{0%{opacity:0;}100%{opacity:1;}}</style><div class='view-img'><span>loading...</span></div>"),setTimeout(function(){var b=new Image;b.src=f||d;b.onload=function(){a(".view-img").html('<img src="'+b.src+'" alt="ViewImage">')};a(".view-img").off().on("click",function(){a(".view-image-css").remove();a(this).remove()});a(c).html()},b.delay),!1})}})})(jQuery);

//菜单
window.addEventListener('scroll',
function() {
	let t = $('body, html').scrollTop();
	if (t > 0) {
		$('.menubar').addClass('shadow')
	} else {
		$('.menubar').removeClass('shadow')
	}
})

//人生倒计时
function init_life_time() {
function getAsideLifeTime() {
    /* 当前时间戳 */
    let nowDate = +new Date();
    /* 今天开始时间戳 */
    let todayStartDate = new Date(new Date().toLocaleDateString()).getTime();
    /* 今天已经过去的时间 */
    let todayPassHours = (nowDate - todayStartDate) / 1000 / 60 / 60;
    /* 今天已经过去的时间比 */
    let todayPassHoursPercent = (todayPassHours / 24) * 100;
    $('#dayProgress .title span').html(parseInt(todayPassHours));
    $('#dayProgress .progress .progress-inner').css('width', parseInt(todayPassHoursPercent) + '%');
    $('#dayProgress .progress .progress-percentage').html(parseInt(todayPassHoursPercent) + '%');
    /* 当前周几 */
    let weeks = {
        0: 7,
        1: 1,
        2: 2,
        3: 3,
        4: 4,
        5: 5,
        6: 6
    };
    let weekDay = weeks[new Date().getDay()];
    let weekDayPassPercent = (weekDay / 7) * 100;
    $('#weekProgress .title span').html(weekDay);
    $('#weekProgress .progress .progress-inner').css('width', parseInt(weekDayPassPercent) + '%');
    $('#weekProgress .progress .progress-percentage').html(parseInt(weekDayPassPercent) + '%');
    let year = new Date().getFullYear();
    let date = new Date().getDate();
    let month = new Date().getMonth() + 1;
    let monthAll = new Date(year, month, 0).getDate();
    let monthPassPercent = (date / monthAll) * 100;
    $('#monthProgress .title span').html(date);
    $('#monthProgress .progress .progress-inner').css('width', parseInt(monthPassPercent) + '%');
    $('#monthProgress .progress .progress-percentage').html(parseInt(monthPassPercent) + '%');
    let yearPass = (month / 12) * 100;
    $('#yearProgress .title span').html(month);
    $('#yearProgress .progress .progress-inner').css('width', parseInt(yearPass) + '%');
    $('#yearProgress .progress .progress-percentage').html(parseInt(yearPass) + '%');
}
    getAsideLifeTime();
    setInterval(() => {
    getAsideLifeTime();
    }, 1000);
}

 init_life_time()


//表情
function OwO_show(){
	if($("#OwO-container").css("display")=='none'){
		 $("#OwO-container").slideDown();
	}else{
		 $("#OwO-container").slideUp();
	 }
}

Smilies = {
    dom: function(id) {
        return document.getElementById(id);
    },
    grin: function(tag) {
        tag = ' ' + tag + ' ';
        myField = this.dom("textarea");
        document.selection ? (myField.focus(), sel = document.selection.createRange(), sel.text = tag, myField.focus()) : this.insertTag(tag);
    },
    insertTag: function(tag) {
        myField = Smilies.dom("textarea");
        myField.selectionStart || myField.selectionStart == "0" ? (startPos = myField.selectionStart, endPos = myField.selectionEnd, cursorPos = startPos, myField.value = myField.value.substring(0, startPos) + tag + myField.value.substring(endPos, myField.value.length), cursorPos += tag.length, myField.focus(), myField.selectionStart = cursorPos, myField.selectionEnd = cursorPos) : (myField.value += tag, myField.focus());
    }
}


//ajax评论
function ajaxc(){
		var replyTo = '',   //回复评论时候的ID
		submitButton = $(".submit").eq(0),  //提交评论按钮
		commentForm = $("#comment-form"),   //评论表单
		newCommentId = "";   //新评论的ID
		var bindButton = function () {
			$(".comment-reply a").click(function () {
					replyTo = $(this).parent().parent().parent().attr("id");
			});
			$(".cancel-comment-reply a").click(function () { replyTo = ''; });
	};
		bindButton();

		/**
		 * 发送前的处理
		 */
		function beforeSendComment() {
			$("#comment-loading").fadeIn();
			$(".submit").fadeOut();
			$("#OwO-container").slideUp();
		}

		/**
		 * 发送后的处理
		 * @param {boolean} ok
		 */
		function afterSendComment(ok) {
				if (ok) {
						$("#textarea").val('');
						replyTo = '';
				}
				bindButton();
		}
		$("#comment-form").submit(function () {
				commentData = $(this).serializeArray();
				beforeSendComment();
				$.ajax({
						type: $(this).attr('method'),
						url: $(this).attr('action'),
						data: commentData,
						error: function (e) {
								console.log('Ajax Comment Error');
								window.location.reload();
						},
						success: function (data) {
								if (!$('#comments', data).length) {
										var msg = $('title').eq(0).text().trim().toLowerCase() === 'error' ? $('.container', data).eq(0).text() : '评论提交失败！';

										toastr.warning(msg, 'QAQ');
										$("#comment-loading").fadeOut();
										$(".submit").fadeIn();
										afterSendComment(false);
										return false;
								}

								$("input,textarea", commentForm).attr('disabled', false);
								$("#textarea").val('');

								var newComment;
								newCommentId = $(".comment-list", data).html().match(/id=\"?comment-\d+/g).join().match(/\d+/g).sort(function (a, b) { return a - b }).pop();
								if('' === replyTo) {
										if(!$('.comment-list').length) {
												newComment  = $("#li-comment-" + newCommentId, data);
												$('.comments-header').after('<ol class="comment-list"></ol>');
												$('.comment-list').first().prepend((newComment).addClass('animated fadeInUp'));
										}
										else if($('.prev').length) {
												$('#page-nav ul li a').eq(1).click();
										}
										else {
												newComment  = $("#li-comment-" + newCommentId, data);
												$('.comment-list').first().prepend((newComment).addClass('animated fadeInUp'));
										}
										$('html,body').animate({scrollTop:$('#response').offset().top - 100},1000);
								}
								else {
										newComment = $("#li-comment-" + newCommentId, data);
										if ($('#' + replyTo).find('.comment-children').length) {
												$('#' + replyTo + ' .comment-children .comment-list').first().prepend((newComment).addClass('animated fadeInUp'));
												TypechoComment.cancelReply();
										}
										else {
												$('#' + replyTo).append('<div class="comment-children"><ol class="comment-list"></ol></div>');
												$('#' + replyTo + ' .comment-children .comment-list').first().prepend((newComment).addClass('animated fadeInUp'));
												TypechoComment.cancelReply();
										}
								}
								afterSendComment(true);

						},
						error:function(){
							$("#comment-loading").fadeOut();
							$(".submit").fadeIn();
						},
						complete:function(){
							toastr.success('送信完了', '发送成功');
							$("#comment-loading").fadeOut();
							$(".submit").fadeIn();
							//$.pjax.reload('#pjax-container', {container: '#pjax-container',fragment: '#pjax-container',timeout: 8000});
						}
				});
				return false;
		});
}

//返回顶部
(function($) {
    function mScrollTop(element, settings) {

        var _ = this,
            breakpoint;
        var scrollTo = 0;

        _.btnClass = '.material-scrolltop';
        _.revealClass = 'reveal';
        _.btnElement = $(_.btnClass);

        _.initial = {
            revealElement: 'body',
            revealPosition: 'top',
            padding: 0,
            duration: 350,
            easing: 'swing',
            onScrollEnd: false
        }

        _.options = $.extend({}, _.initial, settings);

        _.revealElement = $(_.options.revealElement);
        breakpoint = _.options.revealPosition !== 'bottom' ? _.revealElement.offset().top : _.revealElement.offset().top + _.revealElement.height();
        scrollTo = element.offsetTop + _.options.padding;

        $(document).scroll(function() {
            if (breakpoint < $(document).scrollTop()) {
                _.btnElement.addClass(_.revealClass);
            } else {
                _.btnElement.removeClass(_.revealClass);
            }
        });

        _.btnElement.click(function() {
            var trigger = true;
            $('html, body').animate({
                scrollTop: scrollTo
            }, _.options.duration, _.options.easing, function() {
                if (trigger) { // Fix callback triggering twice on chromium
                    trigger = false;
                    var callback = _.options.onScrollEnd;
                    if (typeof callback === "function") {
                        callback();
                    }
                }
            });
            return false;
        });
    }

    $.fn.materialScrollTop = function() {
        var _ = this,
            opt = arguments[0],
            l = _.length,
            i = 0;
        if (typeof opt == 'object' || typeof opt == 'undefined') {
            _[i].materialScrollTop = new mScrollTop(_[i], opt);
        }
        return _;
    };
}(jQuery));

//密码访问文章
$(".protected").submit(function () {
    var surl = $(".protected").attr("action"); //表单地址
    $.ajax({
        type: "POST",
        url: surl,
        data: $('.protected').serialize(), // 你的form
        async: true,
        error: function (request) {
            alert("密码提交失败，请刷新页面重试！"); //ajax提交失败报错
        },
        success: function (data) {
            if (data.indexOf("密码错误") >= 0 && data.indexOf("<title>Error</title>") >= 0) {
                swal({
                    title: "无访问权限",
                    text: "请输入正确密码或放弃阅读",
                    icon: "warning",
                    button: false,
                });
            } else {
                location.reload(); //密码正确刷新页面
            }
        }
    });
    return false;
});
