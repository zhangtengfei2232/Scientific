<template>
    <div>
        <div class="datas">
            <div class="navL">
                <p>数据中心</p>
            </div>
            <el-row :gutter="20">
                <el-col :span="3">
                    <div class="grid-content bg-purple" style="background:rgb(92, 109, 133)">
                        <span>论文</span>
                        <p>21</p>
                    </div>
                </el-col>
                <el-col :span="3">
                    <div class="grid-content bg-purple" style="background:rgb(255, 135, 0)">
                        <span>项目</span>
                        <p>21</p>
                    </div>
                </el-col>
                <el-col :span="3">
                    <div class="grid-content bg-purple" style="background:rgb(0, 172, 255)">
                        <span>著作</span>
                        <p>21</p>
                    </div>
                </el-col>
                <el-col :span="3">
                    <div class="grid-content bg-purple" style="background:rgb(47, 101, 235)">
                        <span>获奖</span>
                        <p>21</p>
                    </div>
                </el-col>
                <el-col :span="3">
                    <div class="grid-content bg-purple" style="background:rgb(0, 142, 106)">
                        <span>专利</span>
                        <p>21</p>
                    </div>
                </el-col>
                <el-col :span="3">
                    <div class="grid-content bg-purple" style="background:rgb(3, 186, 0)">
                        <span>成果鉴定</span>
                        <p>21</p>
                    </div>
                </el-col>
                <el-col :span="3">
                    <div class="grid-content bg-purple" style="background:rgb(234, 75, 140)">
                        <span>举办会议</span>
                        <p>21</p>
                    </div>
                </el-col>
                <el-col :span="3">
                    <div class="grid-content bg-purple" style="background:rgb(255, 69, 48)">
                        <span>参加会议</span>
                        <p>21</p>
                    </div>
                </el-col>
                <el-col :span="3">
                    <div class="grid-content bg-purple" style="background:rgb(255, 189, 20)">
                        <span>专家讲学</span>
                        <p>21</p>
                    </div>
                </el-col>
                <el-col :span="3">
                    <div class="grid-content bg-purple" style="background:rgb(0, 199, 209)">
                        <span>担任学术团体职务</span>
                        <p>21</p>
                    </div>
                </el-col>
            </el-row>
        </div>
    </div>
</template>

<style>
    body{
      background: #f9fafc;  
      overflow-x: hidden; 
    }
  .el-row {
      margin-bottom: 20px;
      margin-left: 12% !important;
      margin-right: 0 !important;
      &:last-child {
        margin-bottom: 0;
      }
  }
  .el-col {
      border-radius: 4px;
  }
  .bg-purple {
      margin-top: 20px;
      color: #fff;
      font-size: 13px;
  }
  .bg-purple-light {
      background: #e5e9f2;
  }
  .grid-content {
      border-radius: 4px;
      min-height: 36px;
  }
  .row-bg {
      padding: 10px 0;
      background-color: #f9fafc;
  }
  .bg-purple span{
      display: inline-block;
      padding: 10px 20px;
      width: 100%;
      border-bottom: 1px solid #fff;
  }
  .bg-purple p{
      padding: 20px 0;
      width: 100%;
      text-align: center;
  }
  .datas{
      margin: 20px;
      background: #fff;
  }
  .datas .navL{
      border-bottom: 1px solid #e5e9f2;
      padding: 0 20px;
  }
 .datas .navL p{
      line-height: 60px;
      padding: 0 12%;
  }
</style>