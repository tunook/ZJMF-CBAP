{include file="header"}
<!-- =======内容区域======= -->
<link rel="stylesheet" href="/{$template_catalog}/template/{$themes}/css/setting.css">
<script src="/{$template_catalog}/template/{$themes}/tinymce/tinymce.min.js"></script>
<div id="content" class="notice-email-template-create hasCrumb" v-cloak>
  <!-- crumb -->
  <div class="com-crumb">
    <span>{{lang.notice_interface}}</span>
    <t-icon name="chevron-right"></t-icon>
    <a href="notice_email.html">{{lang.email_notice}}</a>
    <t-icon name="chevron-right"></t-icon>
    <a href="notice_email_template.html">{{lang.email_temp_manage}}</a>
    <t-icon name="chevron-right"></t-icon>
    <span class="cur">{{lang.edit_template}}</span>
  </div>
  <t-card class="list-card-container">
    <!-- <p class="com-h-tit">{{lang.edit_template}}</p> -->
    <div class="box">
      <t-form :rules="rules" :data="formData" ref="userDialog" label-align="top">
        <t-form-item :label="lang.title" name="subject">
          <t-input v-model="formData.subject" :placeholder="lang.input+lang.title"></t-input>
        </t-form-item>
        <t-form-item :label="lang.content" name="message">
          <textarea id="emailTemp" :value="formData.message" :placeholder="lang.input+lang.content"></textarea>
        </t-form-item>
        <div class="com-f-btn">
          <t-button theme="primary" @click="submit">{{lang.hold}}</t-button>
          <t-button theme="default" variant="base" @click="close">{{lang.close}}</t-button>
        </div>
      </t-form>
    </div>
  </t-card>
</div>
<!-- =======页面独有======= -->
<script src="/{$template_catalog}/template/{$themes}/api/setting.js"></script>
<script src="/{$template_catalog}/template/{$themes}/js/notice_email_template_update.js"></script>
{include file="footer"}