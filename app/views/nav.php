<div class="fly-header layui-bg-black">
  <div class="layui-container">

    <ul class="layui-nav">
      <li class="layui-nav-item">
        <a href="/" style="color: #fff;">
          <h3>首页</h3>
        </a>
      </li>
      <li class="layui-nav-item">
        <a href="/news/create_and_edit">
          <h3>发布新闻</h3>
        </a>
      </li>
    </ul>
    
    <ul class="fly-nav-user">
      <?php if(!isset($_SESSION)){session_start();} if (isset($_SESSION['username']) && isset($_SESSION['password'])) {?>
        <!-- 登入后的状态 -->
        <li class="layui-nav-item">
          <a class="iconfont icon-touxiang layui-hide-xs" href="javascript:;" style="color: #fff;"></a>
          <span class="layui-hide-xs">管理员</span>
          <a href="/users/logout" style="color: #fff;">退出</a>
        </li>
      <?php } else {?>
        <!-- 未登入的状态 -->
        <li class="layui-nav-item">
          <a class="iconfont icon-touxiang layui-hide-xs" href="/users/showLogin"></a>
        </li>
        <li class="layui-nav-item">
          <a href="/users/showLogin" style="color: #fff;">登 录</a>
        </li>
        <!-- <li class="layui-nav-item">
          <a href="user/reg.html">注册</a>
        </li> -->
      <?php }?>
    </ul>
  </div>
</div>