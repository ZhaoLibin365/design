</div></div>
<div id="colophon" class="footer">
<div class="powered_by">
<p class="copyright">Copyright&copy;2019-<?php echo date('Y'); ?><br>Designed & Coded by <a href="https://yolen.cn/" target="_blank">Yolen</a> Load：<?php echo timer_stop();?><br><a href="https://beian.miit.gov.cn/" target="_blank"><?php $this->options->beian(); ?></a></p></div>
<div class="footer_slogan">
<img src="<?php $this->options->themeUrl('img/slogan.svg'); ?>" alt="重拾写作的乐趣">
</div>
<button class="material-scrolltop" type="button">
<span>
    <svg t="1609325923111" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="34631" width="200" height="200"><path d="M531.744 108.224c-10.944-13.504-28.768-13.44-39.68 0l-188.32 231.776c-10.944 13.472-5.44 24.416 11.52 24.416h81.76a36.224 36.224 0 0 1 35.04 31.232l60.48 512.992a20.192 20.192 0 0 0 19.648 17.248 19.84 19.84 0 0 0 18.848-17.216l60.768-512.96a36.48 36.48 0 0 1 35.072-31.2l81.792 0.032c17.344 0 22.4-10.976 11.52-24.416l-188.448-231.904z" p-id="34632"></path></svg>
</span>
</button>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/jquery.pjax/2.0.1/jquery.pjax.js"></script>
<script src="<?php $this->options->themeUrl('js/system.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('js/prism.js'); ?>"></script>
<script>
    $("a[href*='http://']:not([href*='"+location.hostname+"']),[href*='https://']:not([href*='"+location.hostname+"'])").addClass("external").attr("target","_blank");
</script>
<script>
    $('body').materialScrollTop();
</script>
<script>
jQuery(document).ready(function () {
    jQuery.viewImage({
        'target': '.markdown img',
        'exclude': '.OwO .OwO-body .OwO-items .OwO-item img',
        'delay': 270
    });
});
</script>
</body>
</html>
