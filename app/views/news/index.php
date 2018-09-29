<div class="fly-panel fly-column">
  <div class="layui-container">
    <ul class="layui-clear">
      <li class="layui-hide-xs"><a href="/">首页</a></li> 
    </ul> 
  </div>
</div>

<div class="layui-container">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md12">
      <div class="fly-panel" style="margin-bottom: 0;">

      	<?php if (count($news) > 0) {?>
        <ul class="fly-list"> 
        <?php foreach($news as $new) {?>         
          <li>
            <h2>
              <a class="layui-badge">分享</a>
              <a href=<?php echo "/news/show/" . $new['id']?>><?php echo $new['news_title']?></a>
            </h2>
            <div class="fly-list-info">
              <a href="#" link>
                <cite>管理员</cite>
                <!--
                <i class="iconfont icon-renzheng" title="认证信息：XXX"></i>
                <i class="layui-badge fly-badge-vip">VIP3</i>
                -->
              </a>
              <span><?php echo $new['created_at']?></span>
              
              <!-- <span class="fly-list-kiss layui-hide-xs" title="悬赏飞吻"><i class="iconfont icon-kiss"></i> 60</span> -->
              <!--<span class="layui-badge fly-badge-accept layui-hide-xs">已结</span>-->
              <span class="fly-list-nums"> 
                <i class="iconfont icon-pinglun1" title="回答"></i> 66
              </span>
            </div>
            <div class="fly-list-badge">
              <!-- <span class="layui-badge layui-bg-black">置顶</span> -->
              <!--<span class="layui-badge layui-bg-red">精帖</span>-->
            </div>
          </li>
        <?php }?>
        </ul>
        <?php } else {?>
        
        <div class="fly-none">没有相关数据</div>

    	<?php }?>
    
        <!-- <div style="text-align: center">
          <div class="laypage-main"><span class="laypage-curr">1</span><a href="/jie/page/2/">2</a><a href="/jie/page/3/">3</a><a href="/jie/page/4/">4</a><a href="/jie/page/5/">5</a><span>…</span><a href="/jie/page/148/" class="laypage-last" title="尾页">尾页</a><a href="/jie/page/2/" class="laypage-next">下一页</a></div>
        </div> -->

      </div>
    </div>
    
  </div>
</div>

