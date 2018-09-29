<div class="layui-hide-xs">
  <div class="fly-panel fly-column">
    <div class="layui-container">
      <ul class="layui-clear">
        <li class="layui-hide-xs"><a href="/">首页</a></li> 
      </ul> 
    </div>
  </div>
</div>

<div class="layui-container">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md12 content detail">
      <div class="fly-panel detail-box">
        <h1><?php echo $new['news_title']?></h1>
        <div class="fly-detail-info">
          
          <div class="fly-admin-box" data-id="123">
           <hr>
          </div>
          <span class="fly-list-nums"> 
            <a href="#comment"><i class="iconfont" title="回答">&#xe60c;</i> 66</a>
            <i class="iconfont" title="人气">&#xe60b;</i> 99999
          </span>
        </div>
        <div class="detail-about">
          <div class="detail-hits" id="LAY_jieAdmin" data-id="123">
            <span class="layui-btn layui-btn-xs jie-admin" type="edit"><a href=<?php echo "/news/create_and_edit/" . $new['id']?>>编辑</a></span>
            <span class="layui-btn layui-btn-xs jie-admin" type="edit"><a href=<?php echo "/news/delete/" . $new['id']?>>删除</a></span>
          </div>
        </div>
        <div class="detail-body photos">
          <p>
            <?php echo htmlspecialchars($new['news_body'])?>
          </p>          
        </div>
      </div>
  </div>
</div>
