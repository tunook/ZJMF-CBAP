{include file="header"}
<!-- =======内容区域======= -->
<link rel="stylesheet" href="/{$template_catalog}/template/{$themes}/css/setting.css">
<div id="content" class="notice-sms-template hasCrumb" v-cloak>
  <!-- crumb -->
  <div class="com-crumb">
    <span>{{lang.notice_interface}}</span>
    <t-icon name="chevron-right"></t-icon>
    <a href="notice_sms.html">{{lang.sms_notice}}</a>
    <t-icon name="chevron-right"></t-icon>
    <span class="cur">{{lang.sms_interface}}</span>
  </div>
  <t-card class="list-card-container">
    <!-- <ul class="common-tab">
      <li class="active">
        <a href="javascript:;">{{lang.sms_interface}}</a>
      </li>
      <li>
        <a href="notice_email.html">{{lang.email_interface}}</a>
      </li>
    </ul> -->
    <div class="common-header">
      <div class="left">
        <t-button @click="createTemplate" class="add">{{lang.create_template}}</t-button>
        <t-button theme="default" @click="back" class="add">{{lang.back}}</t-button>
      </div>
    </div>
    <t-table row-key="id" :data="data" size="medium" :columns="columns" :hover="hover" :loading="loading" :table-layout="tableLayout ? 'auto' : 'fixed'" @sort-change="sortChange" :hide-sort-tips="hideSortTips">
      <template #type="{row}">
        <span>{{ row.type === 1 ? lang.international : lang.domestic }}</span>
      </template>
      <template #status="{row}">
        <t-tag theme="warning" class="com-status" v-if="row.status===0" variant="light">{{lang.no_submit}}
        </t-tag>
        <t-tag theme="primary" class="com-status" v-if="row.status===1" variant="light">{{lang.under_review}}
        </t-tag>
        <t-tag theme="success" class="com-status" v-if="row.status===2" variant="light">{{lang.pass}}</t-tag>
        <t-tag theme="danger" class="com-status" v-if="row.status===3" variant="light">{{lang.fail}}</t-tag>
      </template>
      <template #op="{row}">
        <a class="common-look" @click="updateHandler(row)" :class="{disable: row.status===1}">{{lang.edit}}</a>
        <a class="common-look" @click="testHandler(row)" v-if="row.status===2">{{lang.test}}</a>
        <a class="common-look" @click="deleteHandler(row)">{{lang.delete}}</a>
      </template>
    </t-table>
  </t-card>

  <!-- 添加管理员 -->
  <t-dialog :visible.sync="visible" :header="addTip" :on-close="close" :footer="false" width="600">
    <t-form :rules="rules" :data="formData" ref="userDialog" @submit="onSubmit">
      <t-form-item :label="lang.choose_area" name="type">
        <t-radio-group v-model="formData.type">
          <t-radio value="0">{{lang.domestic}}</t-radio>
          <t-radio value="1">{{lang.international}}</t-radio>
        </t-radio-group>
      </t-form-item>
      <t-form-item :label="lang.template+'ID'" name="template_id">
        <t-input :placeholder="lang.input+lang.template+'ID'" v-model="formData.template_id" />
      </t-form-item>
      <t-form-item :label="lang.template+lang.status" name="status">
        <t-select v-model="formData.status" :placeholder="lang.select+lang.template+lang.status">
          <t-option key="0" :label="lang.no_submit_review" value="0"></t-option>
          <t-option key="2" :label="lang.pass_review" value="2"></t-option>
          <t-option key="3" :label="lang.fail_review" value="3"></t-option>
        </t-select>
      </t-form-item>
      <t-form-item :label="lang.title" name="title">
        <t-input :placeholder="lang.input+lang.title" v-model="formData.title" />
      </t-form-item>
      <t-form-item :label="lang.content" name="content">
        <t-textarea :placeholder="lang.input+lang.content" v-model="formData.content" />
      </t-form-item>
      <t-form-item :label="lang.notes" name="notes">
        <t-textarea :placeholder="lang.input+lang.notes" v-model="formData.notes" />
      </t-form-item>
      <div class="com-f-btn">
        <t-button theme="primary" type="submit">{{lang.hold}}</t-button>
        <t-button theme="default" variant="base" @click="close">{{lang.cancel}}</t-button>
      </div>
    </t-form>
  </t-dialog>

  <!-- 删除弹窗 -->
  <t-dialog theme="warning" :header="lang.sureDelete" :visible.sync="delVisible">
    <template slot="footer">
      <t-button theme="primary" @click="sureDel">{{lang.sure}}</t-button>
      <t-button theme="default" @click="delVisible=false">{{lang.cancel}}</t-button>
    </template>
  </t-dialog>

  <!-- 测试 -->
  <t-dialog :header="lang.sms_test" :visible.sync="statusVisble" :footer="false" width="600">
    <t-form :rules="rules" :data="testForm" ref="userDialog" @submit="testSubmit">
      <t-form-item :label="lang.phone" name="phone">
        <t-select v-model="testForm.phone_code" filterable style="width: 150px" :placeholder="lang.phone_code" :disabled="isChina">
          <t-option v-for="item in country" :value="item.phone_code" :label="item.name_zh + '+' + item.phone_code" :key="item.name">
          </t-option>
        </t-select>
        <t-input :placeholder="lang.input+lang.phone" v-model="testForm.phone" />
      </t-form-item>
      <div class="com-f-btn">
        <t-button theme="primary" type="submit">{{lang.sure}}</t-button>
        <t-button theme="default" variant="base" @click="closeTest">{{lang.cancel}}</t-button>
      </div>
    </t-form>
  </t-dialog>
</div>
<!-- =======页面独有======= -->
<script src="/{$template_catalog}/template/{$themes}/api/common.js"></script>
<script src="/{$template_catalog}/template/{$themes}/api/setting.js"></script>
<script src="/{$template_catalog}/template/{$themes}/js/notice_sms_template.js"></script>
{include file="footer"}