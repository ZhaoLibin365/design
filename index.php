<?php
/**
 * 简约不简单，人人都可以是设计师
 * @package Design
 * @author YOLEN
 * @version 1.0
 * @link https://yolen.cn
 */
?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; $this->need('header.php'); ?>
<?php
$sticky = $this->options->sticky; //置顶的文章cid，按照排序输入, 请以半角逗号或空格分隔
if($sticky && $this->is('index') || $this->is('front')){
    $sticky_cids = explode(',', strtr($sticky, ' ', ','));//分割文本 
    $sticky_html = "<span class='post-top'><svg t='1607672933871' class='icon' viewBox='0 0 2560 1024' version='1.1' xmlns='http://www.w3.org/2000/svg' p-id='1537' width='200' height='200'><path d='M341.333333 56.888889h2161.777778a455.111111 455.111111 0 0 1-455.111111 455.111111H796.444444a455.111111 455.111111 0 0 1-455.111111-455.111111z' fill='#FFEDDF' p-id='1538'></path><path d='M440.888889 56.888889A99.555556 99.555556 0 0 0 341.333333 156.444444v67.527112a227.555556 227.555556 0 0 1-97.166222 186.481777L98.986667 512l145.180444 101.546667A227.555556 227.555556 0 0 1 341.333333 800.028444v67.527112c0 54.954667 44.600889 99.555556 99.555556 99.555555H2389.333333a113.777778 113.777778 0 0 0 113.777778-113.777778V170.666667a113.777778 113.777778 0 0 0-113.777778-113.777778H440.888889z m0-56.888889H2389.333333a170.666667 170.666667 0 0 1 170.666667 170.666667v682.666666a170.666667 170.666667 0 0 1-170.666667 170.666667H440.888889A156.444444 156.444444 0 0 1 284.444444 867.555556v-67.527112a170.666667 170.666667 0 0 0-72.817777-139.889777L66.332444 558.648889a56.888889 56.888889 0 0 1 0-93.297778l145.180445-101.489778A170.666667 170.666667 0 0 0 284.444444 223.971556V156.444444A156.444444 156.444444 0 0 1 440.888889 0z' fill='#FF7200' p-id='1539'></path><path d='M785.976889 370.232889H1046.755556l3.413333-32.085333h-221.184V202.296889h503.808v135.850667H1115.022222l-3.413333 32.085333h264.192v48.469333h-272.384l-6.826667 30.72h195.242667v297.642667H1388.088889v50.517333H773.688889v-50.517333h96.256V449.422222h163.157333l6.144-30.72h-253.269333v-48.469333z m148.138667 376.832h293.546666v-36.181333h-293.546666v36.181333z m0-74.410667h293.546666v-34.133333h-293.546666v34.133333z m0-73.045333h293.546666v-34.133333h-293.546666v34.133333z m0-73.045333h293.546666v-33.450667h-293.546666v33.450667z m337.237333-232.789334v-44.373333h-86.016v44.373333h86.016z m-144.042667 0v-44.373333h-92.842666v44.373333h92.842666z m-150.869333 0v-44.373333h-86.016v44.373333h86.016zM1719.182222 203.662222h349.525334v62.805334H1923.982222c-2.275556 18.204444-5.006222 37.546667-8.192 58.026666h134.485334v330.410667h-63.488V383.886222H1797.688889v271.701334h-63.488v-331.093334h116.053333c3.640889-25.486222 6.144-44.828444 7.509334-58.026666H1719.182222V203.662222z m234.837334 448.512c50.517333 38.229333 91.249778 74.865778 122.197333 109.909334l-47.104 47.104c-27.761778-34.588444-67.584-72.817778-119.466667-114.688l44.373334-42.325334z m-96.256-234.837333h63.488V538.168889c-2.730667 72.362667-21.390222 130.616889-55.978667 174.762667-34.133333 40.504889-89.201778 71.907556-165.205333 94.208l-34.816-55.296c73.272889-20.935111 122.88-47.559111 148.821333-79.872 26.396444-34.588444 40.96-79.189333 43.690667-133.802667V417.336889z m-376.149334 382.293333l-14.336-61.44c23.210667 2.730667 45.511111 4.096 66.901334 4.096 15.473778 0 23.210667-9.557333 23.210666-28.672v-447.146666h-99.669333V203.662222h241.664v62.805334h-76.458667v463.530666c0 46.421333-22.072889 69.632-66.218666 69.632h-75.093334z' fill='#FF7200' p-id='1540'></path></svg></span>"; //置顶标题的 html
    $db = Typecho_Db::get();
    $pageSize = $this->options->pageSize;
    $select1 = $this->select()->where('type = ?', 'post');
    $select2 = $this->select()->where('type = ? && status = ? && created < ?', 'post','publish',time());
    //清空原有文章的列队
    $this->row = [];
    $this->stack = [];
    $this->length = 0;
    $order = '';
    foreach($sticky_cids as $i => $cid) {
        if($i == 0) $select1->where('cid = ?', $cid);
        else $select1->orWhere('cid = ?', $cid);
        $order .= " when $cid then $i";
        $select2->where('table.contents.cid != ?', $cid); //避免重复
    }
    if ($order) $select1->order(null,"(case cid$order end)"); //置顶文章的顺序 按 $sticky 中 文章ID顺序
    if ($this->_currentPage == 1) foreach($db->fetchAll($select1) as $sticky_post){ //首页第一页才显示
        $sticky_post['sticky'] = $sticky_html;
        $this->push($sticky_post); //压入列队
    }
$uid = $this->user->uid; //登录时，显示用户各自的私密文章
    if($uid) $select2->orWhere('authorId = ? && status = ?',$uid,'private');
    $sticky_posts = $db->fetchAll($select2->order('table.contents.created', Typecho_Db::SORT_DESC)->page($this->_currentPage, $this->parameter->pageSize));
    foreach($sticky_posts as $sticky_post) $this->push($sticky_post); //压入列队
    $this->setTotal($this->getTotal()-count($sticky_cids)); //置顶文章不计算在所有文章内
}	?>

<div class="headers animated fadeInDown">
        <div class="site_title_container">
          <div class="site_title">
            <p class="sub_title"><?php $this->options->word();?></p>
            </div>
            <div class="my_socials">
            <a href="<?php $this->options->github();?>" target="_blank">
            <svg t="1607347155449" class="icon" viewBox="0 0 1049 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3805" width="200" height="200"><path d="M524.979332 0C234.676191 0 0 234.676191 0 524.979332c0 232.068678 150.366597 428.501342 358.967656 498.035028 26.075132 5.215026 35.636014-11.299224 35.636014-25.205961 0-12.168395-0.869171-53.888607-0.869171-97.347161-146.020741 31.290159-176.441729-62.580318-176.441729-62.580318-23.467619-60.841976-58.234462-76.487055-58.234463-76.487055-47.804409-32.15933 3.476684-32.15933 3.476685-32.15933 53.019436 3.476684 80.83291 53.888607 80.83291 53.888607 46.935238 79.963739 122.553122 57.365291 152.97411 43.458554 4.345855-33.897672 18.252593-57.365291 33.028501-70.402857-116.468925-12.168395-239.022047-57.365291-239.022047-259.012982 0-57.365291 20.860106-104.300529 53.888607-140.805715-5.215026-13.037566-23.467619-66.926173 5.215027-139.067372 0 0 44.327725-13.906737 144.282399 53.888607 41.720212-11.299224 86.917108-17.383422 131.244833-17.383422s89.524621 6.084198 131.244833 17.383422C756.178839 203.386032 800.506564 217.29277 800.506564 217.29277c28.682646 72.1412 10.430053 126.029806 5.215026 139.067372 33.897672 36.505185 53.888607 83.440424 53.888607 140.805715 0 201.64769-122.553122 245.975415-239.891218 259.012982 19.121764 16.514251 35.636014 47.804409 35.636015 97.347161 0 70.402857-0.869171 126.898978-0.869172 144.282399 0 13.906737 9.560882 30.420988 35.636015 25.205961 208.601059-69.533686 358.967656-265.96635 358.967655-498.035028C1049.958663 234.676191 814.413301 0 524.979332 0z" fill="#191717" p-id="3806"></path><path d="M199.040177 753.571326c-0.869171 2.607513-5.215026 3.476684-8.691711 1.738342s-6.084198-5.215026-4.345855-7.82254c0.869171-2.607513 5.215026-3.476684 8.691711-1.738342s5.215026 5.215026 4.345855 7.82254z m-6.953369-4.345856M219.900283 777.038945c-2.607513 2.607513-7.82254 0.869171-10.430053-2.607514-3.476684-3.476684-4.345855-8.691711-1.738342-11.299224 2.607513-2.607513 6.953369-0.869171 10.430053 2.607514 3.476684 4.345855 4.345855 9.560882 1.738342 11.299224z m-5.215026-5.215027M240.760389 807.459932c-3.476684 2.607513-8.691711 0-11.299224-4.345855-3.476684-4.345855-3.476684-10.430053 0-12.168395 3.476684-2.607513 8.691711 0 11.299224 4.345855 3.476684 4.345855 3.476684 9.560882 0 12.168395z m0 0M269.443034 837.011749c-2.607513 3.476684-8.691711 2.607513-13.906737-1.738342-4.345855-4.345855-6.084198-10.430053-2.607513-13.037566 2.607513-3.476684 8.691711-2.607513 13.906737 1.738342 4.345855 3.476684 5.215026 9.560882 2.607513 13.037566z m0 0M308.555733 853.526c-0.869171 4.345855-6.953369 6.084198-13.037566 4.345855-6.084198-1.738342-9.560882-6.953369-8.691711-10.430053 0.869171-4.345855 6.953369-6.084198 13.037566-4.345855 6.084198 1.738342 9.560882 6.084198 8.691711 10.430053z m0 0M351.145116 857.002684c0 4.345855-5.215026 7.82254-11.299224 7.82254-6.084198 0-11.299224-3.476684-11.299224-7.82254s5.215026-7.82254 11.299224-7.82254c6.084198 0 11.299224 3.476684 11.299224 7.82254z m0 0M391.126986 850.049315c0.869171 4.345855-3.476684 8.691711-9.560882 9.560882-6.084198 0.869171-11.299224-1.738342-12.168395-6.084197-0.869171-4.345855 3.476684-8.691711 9.560881-9.560882 6.084198-0.869171 11.299224 1.738342 12.168396 6.084197z m0 0" fill="#191717" p-id="3807"></path></svg>
            </a>
            <a href="<?php $this->options->weibo();?>" target="_blank">
            <svg t="1607347254082" class="icon" viewBox="0 0 1026 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4669" width="200" height="200"><path d="M1012.49024 451.55328v0.15872c-6.69696 20.6592-28.86144 31.98976-49.44896 25.28768a39.35232 39.35232 0 0 1-25.28768-49.58208l-0.06656-0.03072c20.53632-63.60064 7.51616-136.15616-40.31488-189.3632-47.89248-53.21216-118.5024-73.55392-183.7312-59.65824-21.2224 4.53632-42.13248-9.04704-46.63808-30.30016-4.5056-21.25312 9.02144-42.19392 30.23872-46.73024 91.70944-19.56352 191.11424 8.98048 258.46784 83.88096 67.35872 74.83904 85.51424 176.84992 56.7808 266.33728z" fill="#d81e06" p-id="4670"></path><path d="M740.4288 304.34816v-0.03072c-18.21696 3.97312-36.17792-7.7312-40.05888-26.0096-3.94752-18.30912 7.76192-36.37248 25.97888-40.25344 44.69248-9.5488 93.14304 4.32128 125.88544 40.7808 32.86528 36.49536 41.63072 86.1696 27.60704 129.77152a33.83296 33.83296 0 0 1-42.56256 21.84704c-17.78176-5.76-27.48416-24.91392-21.72416-42.69056h-0.06144c6.8864-21.34528 2.56512-45.63456-13.46048-63.47264-16.0256-17.8176-39.75168-24.54528-61.60384-19.9424zM770.47808 496.53248c-14.45888-4.352-24.35072-7.32672-16.77312-26.35264 16.3328-41.31328 18.02752-76.96384 0.31744-102.38464-33.31072-47.73376-124.45184-45.1328-228.8384-1.28 0-0.06144-32.79872 14.36672-24.41216-11.70432 16.05632-51.77344 13.6448-95.18592-11.36128-120.192-56.65792-56.87808-207.30368 2.11968-336.47616 131.64032C56.18688 463.31904 0 566.13888 0 655.09888c0 170.08128 217.50272 273.49504 430.27968 273.49504 278.91712 0 464.52736-162.50368 464.52736-291.58912 0-77.93664-65.54624-122.19392-124.32896-140.47232z m-339.6352 371.08736c-169.77408 16.83968-316.34944-60.15488-327.36768-171.96032-11.04896-111.73888 117.71904-216.03328 287.488-232.87296 169.8048-16.83968 316.35456 60.16 327.36768 171.904 11.01824 111.86688-117.6832 216.0896-287.488 232.92928z" fill="#d81e06" p-id="4671"></path><path d="M447.80544 548.85888c-80.78336-21.08928-172.11904 19.28704-207.2064 90.6496-35.74272 72.86272-1.18784 153.68192 80.44032 180.10112 84.57728 27.35616 184.23296-14.52544 218.88-93.14816 34.18112-76.81024-8.47872-155.93984-92.11392-177.60256z m-61.68576 185.9328c-16.43008 26.2912-51.584 37.80608-78.06464 25.66144-26.10688-11.88864-33.83296-42.43968-17.40288-68.0448 16.21504-25.53856 50.20672-36.86912 76.49792-25.856 26.60352 11.392 35.08736 41.68704 18.9696 68.23936z" fill="#2c2c2c" p-id="4672"></path></svg>
            </a>
            <a href="<?php $this->options->qq();?>" target="_blank">
            <svg t="1607347312394" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6419" width="200" height="200"><path d="M505.731879 947.2c-79.313455 0-152.141576-24.762182-198.997334-61.750303-23.800242 6.640485-54.272 17.314909-73.479757 30.564848-16.446061 11.29503-14.398061 22.838303-11.419152 27.523879 13.032727 20.48 223.20097 13.032727 283.896243 6.671515v-3.009939z" fill="#FAAD08" p-id="6420"></path><path d="M491.426909 947.2c79.313455 0 152.110545-24.762182 198.997333-61.750303 23.800242 6.640485 54.24097 17.314909 73.479758 30.564848 16.446061 11.29503 14.398061 22.838303 11.419152 27.523879-13.032727 20.48-223.20097 13.032727-283.896243 6.671515v-3.009939z" fill="#FAAD08" p-id="6421"></path><path d="M491.892364 469.550545c130.544485-0.868848 235.178667-25.537939 270.646303-34.971151 8.440242-2.265212 12.970667-6.299152 12.970666-6.299152 0-1.179152 0.527515-20.728242 0.527515-30.844121 0-170.046061-82.292364-340.867879-284.609939-340.867879-202.317576 0-284.609939 170.852848-284.609939 340.867879 0 10.115879 0.496485 29.66497 0.527515 30.844121 0 0 3.692606 3.785697 10.426182 5.585455 32.73697 8.905697 139.326061 34.78497 273.159757 35.684848h0.96194zM851.223273 613.251879a1451.969939 1451.969939 0 0 0-30.099394-84.805818s-6.392242-0.775758-9.619394 0.155151c-99.638303 28.889212-220.408242 47.321212-312.475152 46.204121h-0.930909c-91.539394 1.086061-211.502545-17.128727-310.799515-45.738666-3.816727-1.086061-11.29503-0.620606-11.29503-0.620606a1450.852848 1450.852848 0 0 0-30.099394 84.805818c-38.322424 123.097212-25.910303 174.017939-16.446061 175.16606 20.262788 2.451394 78.941091-92.656485 78.941091-92.656484 0 96.628364 87.381333 245.015273 287.526788 246.380606h5.275152c200.145455-1.365333 287.526788-149.752242 287.526787-246.380606 0 0 58.647273 95.107879 78.972122 92.656484 9.433212-1.148121 21.845333-52.068848-16.446061-175.16606" fill="#000000" p-id="6422"></path><path d="M429.800727 313.592242c-27.61697 1.241212-51.2-29.789091-52.658424-69.228606-1.520485-39.470545 19.642182-72.424727 47.259152-73.665939 27.585939-1.241212 51.16897 29.789091 52.658424 69.228606 1.520485 39.470545-19.642182 72.424727-47.259152 73.665939m204.489697-69.228606c-1.458424 39.408485-25.041455 70.438788-52.658424 69.197576-27.61697-1.210182-48.748606-34.164364-47.228121-73.634909 1.489455-39.439515 25.072485-70.438788 52.658424-69.228606 27.61697 1.241212 48.748606 34.195394 47.259152 73.665939" fill="#FFFFFF" p-id="6423"></path><path d="M676.770909 364.761212c-7.261091-17.43903-80.213333-36.83297-170.573576-36.83297h-0.930909c-90.360242 0-163.312485 19.393939-170.573576 36.83297a6.11297 6.11297 0 0 0 0.465455 5.833697c6.11297 9.619394 87.133091 57.406061 170.077091 57.406061h0.961939c82.97503 0 163.995152-47.755636 170.077091-57.406061a6.299152 6.299152 0 0 0 0.465455-5.833697" fill="#FAAD08" p-id="6424"></path><path d="M462.723879 253.672727c1.241212 15.732364-7.323152 29.696-19.083637 31.216485-11.791515 1.551515-22.341818-9.960727-23.58303-25.693091-1.241212-15.732364 7.323152-29.696 19.052606-31.216485 11.791515-1.551515 22.372848 9.991758 23.58303 25.693091m72.362667 7.850667c2.482424-4.06497 19.611152-25.475879 55.016727-17.687273 9.309091 2.048 13.622303 5.057939 14.522182 6.237091 1.334303 1.768727 1.706667 4.251152 0.341334 7.602424-2.699636 6.671515-8.254061 6.485333-11.326061 5.182061-1.985939-0.837818-26.686061-15.732364-49.369212 6.485333-1.551515 1.551515-4.344242 2.048-7.012849 0.248243-2.668606-1.830788-3.754667-5.492364-2.172121-8.067879" fill="#000000" p-id="6425"></path><path d="M499.029333 578.342788h-0.930909c-62.929455 0.744727-139.201939-7.447273-213.05406-21.690182-6.330182 35.902061-10.146909 80.989091-6.857697 134.764606 8.285091 135.943758 90.670545 221.401212 217.832727 222.642424h5.15103c127.131152-1.241212 209.516606-86.698667 217.801697-222.642424 3.258182-53.775515-0.558545-98.893576-6.888727-134.764606-73.852121 14.273939-150.124606 22.434909-213.054061 21.721212" fill="#FFFFFF" p-id="6426"></path><path d="M319.891394 570.957576v136.005818s64.232727 12.567273 128.651636 3.878788v-125.486546a1220.049455 1220.049455 0 0 1-128.651636-14.39806" fill="#EB1C26" p-id="6427"></path><path d="M779.791515 428.00097s-120.676848 39.936-280.731151 41.084121h-0.930909c-159.806061-1.117091-280.389818-40.96-280.793213-41.084121l-40.432484 105.813333c101.127758 31.961212 226.428121 52.565333 321.194666 51.386182h0.930909c94.766545 1.210182 220.097939-19.42497 321.194667-51.386182l-40.401455-105.813333z" fill="#EB1C26" p-id="6428"></path></svg>
            </a>
            <a href="<?php $this->options->email();?>" target="_blank">
            <svg t="1607347636694" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="41476" width="200" height="200"><path d="M735.872 968.96H241.28c-112.256 0-203.264-91.008-203.264-203.264V271.104c0-112.256 91.008-203.264 203.264-203.264h494.592c112.256 0 203.264 91.008 203.264 203.264v494.592c0 112.256-91.008 203.264-203.264 203.264z" fill="#00A9FA" p-id="41477"></path><path d="M538.112 560.768L768 330.88c-5.504-3.328-11.776-4.736-18.304-4.736H227.84c-5.76 0-11.52 1.28-16.64 3.712l230.912 230.912c26.368 26.368 69.376 26.368 96 0zM192.384 346.752c-3.584 6.016-5.504 12.8-5.504 20.096v302.976c0 8.32 2.56 15.872 6.784 22.144l172.8-171.52-174.08-173.696z" fill="#FFFFFF" p-id="41478"></path><path d="M555.648 578.432c-17.408 17.664-40.704 27.392-65.664 27.392-24.832 0-48.256-9.856-65.92-27.392l-39.936-39.936-170.88 169.088c4.48 2.048 9.344 3.072 14.592 3.072h521.856c7.04 0 13.568-1.792 19.328-5.248L597.888 536.192l-42.24 42.24z m230.144-229.888L615.808 518.272l170.496 168.96c2.56-5.248 3.968-11.008 3.968-17.408V366.848c0-6.528-1.408-12.8-4.48-18.304z" fill="#FFFFFF" p-id="41479"></path></svg>
            </a>
        </div>
        <div class="description">
        <div class="with_font">
        <a href="<?php $this->options->siteUrl(); ?>">
        <img class="custom-header" src="<?php $this->options->toux();?>" alt=""></a>
</div>
</div>
</div>
</div>
<div class="autopagerize_page_element">
  <div class="content">
  <?php while($this->next()): ?>
    <div class="post animated fadeInDown">
      <div class="post_title">
        <h2><a href="<?php $this->permalink() ?>" ><?php if (isset($this->fields->title)): ?><?php  $this->fields->title(); $this->sticky() ?><?php else: ?><?php $this->title(); $this->sticky() ?><?php endif; ?></a>
        </h2>
      </div>
      <div class="list">
        <div class="index_content">
          <p class="list-exc"><?php $this->excerpt(80,'...'); ?></p>
          <div class="list-thumb" style="background-image:url(<?php  $imgurl = $this->fields->imgurl;if($imgurl != ''){echo $imgurl;}else{$this->options->defaultPostIMG();}?>)"></div>
        </div>
      </div>
      <div class="post_footer">
        <div class="meta">
          <div class="info">
            <span class="field">
            <span class="date"><svg t="1607602897409" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2042" width="200" height="200"><path d="M176.937 147.034c6.933-54.037 29.152-79.667 68.183-81.046 42.736-1.509 64.841 21.767 75.308 80.622 127.59 0 255.481 0 376.951 0 14.576-24.866 24.551-49.271 41.281-67.465 9.044-9.834 29.639-12.442 45.002-12.391 37.193 0.129 56.966 25.212 65.844 81.516 10.855 0 22.436-0.151 34.003 0.025 49.523 0.762 76.35 26.671 76.58 76.274 0.519 112.881 0.185 225.767 0.19 338.655 0 104.333 0.141 208.665-0.061 313.001-0.115 60.164-23.918 83.858-83.837 83.867-241.159 0.061-482.323 0.061-723.489 0.006-63.267-0.015-86.934-23.483-86.945-86.169-0.050-212.941-0.035-425.883-0.007-638.827 0.007-62.435 23.869-86.221 86.799-86.892 7.554-0.080 15.097-0.718 24.201-1.177zM120.287 394.786c0 12.784 0 21.23 0 29.676 0 148.753-0.025 297.503 0.021 446.257 0.007 33.282 0.972 34.229 34.801 34.229 238.54 0.041 477.085 0.041 715.629 0.007 34.661-0.007 36.020-1.248 36.039-36.1 0.091-147.901-0.571-295.812 0.622-443.705 0.205-25.493-8.031-30.959-32.039-30.876-241.105 0.837-482.217 0.509-723.329 0.509-9.214 0-18.436 0-31.744 0zM733.959 196.631c0.115 0 0.231 0.003 0.352 0.003 0 21.3-1.465 42.729 0.371 63.869 2.245 25.814 20.419 41.929 43.308 41.772 23.858-0.163 42.028-18.033 42.704-44.986 0.997-40.039 0.912-80.131 0.091-120.178-0.553-26.734-18.266-44.567-42.49-45.45-23.343-0.85-42.465 17.152-44.084 43.618-1.253 20.379-0.252 40.895-0.252 61.351zM204.681 194.401c0.119 0 0.229 0 0.351 0 0 22.165-1.413 44.442 0.371 66.462 2.025 25.063 21.212 41.781 43.798 41.427 23.127-0.364 41.453-17.057 42.274-42.729 1.343-41.735 1.333-83.577-0.030-125.309-0.827-25.17-19.78-42.282-42.621-42.646-23.542-0.374-42.555 17.907-43.934 43.971-1.041 19.557-0.21 39.213-0.21 58.825zM226.103 815.255c0-20.989 0-39.568 0-59.924 41.613 0 82.213 0 124.723 0 0 19.002 0 38.226 0 59.924-40.425 0-81.586 0-124.723 0zM452.183 815.857c0-20.729 0-39.971 0-60.758 41.683 0 82.063 0 123.835 0 0 20.652 0 39.785 0 60.758-41.915 0-82.364 0-123.835 0zM676.985 815.968c0-22.493 0-40.922 0-60.867 40.403 0 79.319 0 120.332 0 0 19.574 0 39.423 0 60.867-39.739 0-79.391 0-120.332 0zM351.625 498.885c0 19.917 0 38.276 0 58.389-41.483 0-81.923 0-124.478 0 0-18.841 0-37.791 0-58.389 40.639 0 81.13 0 124.478 0zM452.333 557.040c0-20.505 0-38.823 0-58.31 41.743 0 82.033 0 123.735 0 0 19.729 0 38.017 0 58.31-41.121 0-81.356 0-123.735 0zM226.505 685.41c0-19.719 0-38.009 0-57.676 41.969 0 82.484 0 124.608 0 0 19.109 0 37.41 0 57.676-40.679 0-81.185 0-124.608 0zM452.553 627.515c41.989 0 81.692 0 123.154 0 0 19.388 0 37.63 0 57.872-40.875 0-81.164 0-123.154 0 0-18.865 0-37.166 0-57.872zM797.657 557.428c-40.26 0-79.616 0-120.588 0 0-19.875 0-38.175 0-58.319 39.938 0 79.387 0 120.588 0 0 18.958 0 37.883 0 58.319zM798.429 628.406c0 19.756 0 37.445 0 57.029-40.335 0-79.737 0-121.068 0 0-18.958 0-37.206 0-57.029 40.609 0 80.698 0 121.068 0z" p-id="2043"></path></svg>
            <span><?php $this->date('Y.m.d'); ?></span>
            </span>
        </div>
     </div>
  </div>
</div>
<?php endwhile; ?>
<div class="paginator pager pagination" >
<div class="paginator_container pagination_container"><a class="btn pre newer-posts newer_posts"><?php $this->pageLink('返回上一页'); ?></a>
<a class="btn next older-posts older_posts"><?php $this->pageLink('阅读更多文章','next'); ?></a>
</div>
<div style="clear:both;height:0;"></div>
</div>
</div>
</div>
</div>
<?php $this->need('footer.php'); ?>