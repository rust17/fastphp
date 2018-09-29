<div class="layui-container fly-marginTop">
  <div class="fly-panel" pad20 style="padding-top: 5px;">
    <!--<div class="fly-none">没有权限</div>-->
    <div class="layui-form layui-form-pane">
      <div class="layui-tab layui-tab-brief" lay-filter="user">
        <ul class="layui-tab-title">
          <li class="layui-this"><?php echo $title?></li>
        </ul>
        <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
          <div class="layui-tab-item layui-show">
            <form action=<?php isset($new) ? print_r("/news/add_and_update/" . $new['id']) : print_r('/news/add_and_update')?> method="post">
              
              <input type="hidden" name="_csrf_token" value=<?php echo $_csrf_token;?>>

              <div class="layui-row layui-col-space15 layui-form-item">
                <div class="layui-col-md9">
                  <label for="L_title" class="layui-form-label">标题</label>
                  <div class="layui-input-block">
                    <input type="text" id="L_title" name="news_title" required lay-verify="required" autocomplete="off" class="layui-input" value=<?php isset($new) ? print_r($new['news_title']) : ''?>>
                    <input type="hidden" name="id" value=<?php isset($new) ? print_r($new['id']) : ''?>>
                  </div>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <div class="layui-input-block">
                  <textarea id="L_content" name="news_body" required lay-verify="required" placeholder="详细描述" class="layui-textarea fly-editor" style="height: 260px;"><?php isset($new) ? print_r(htmlspecialchars($new['news_body'])) : ''?></textarea>
                </div>
              </div>

              <div class="layui-form-item">
                <button class="layui-btn" lay-filter="*" lay-submit>提交</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>