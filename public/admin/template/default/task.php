
{include file="header"}
<!-- =======内容区域======= -->
<link rel="stylesheet" href="/{$template_catalog}/template/{$themes}/css/manage.css">
<div id="content" class="task table" v-cloak>
  <t-card class="list-card-container">
    <div class="common-header">
      <t-form :data="formData" ref="form" @submit="onSubmit" layout="inline" label-align="left">
        <t-form-item :label="lang.task_status" name="status">
          <t-select v-model="formData.status" :placeholder="lang.select+lang.status">
            <t-option v-for="item in statusOpt" :value="item.value" :label="item.label" :key="item.value">
            </t-option>
          </t-select>
        </t-form-item>
        <t-form-item name="keywords" class="search">
          <t-input v-model="formData.keywords" 
          :placeholder="`${lang.please_search}ID、${lang.description}`" 
          ></t-input>
        </t-form-item>
        <t-form-item class="f-btn">
          <t-button theme="primary" type="submit">{{lang.query}}</t-button>
          <t-button theme="default" variant="base" @click="reset">{{lang.reset}}</t-button>
        </t-form-item>
      </t-form>
    </div>
    <t-table row-key="id" :data="data" size="medium" :hide-sort-tips="true" :columns="columns" :hover="hover"
      :loading="loading" :table-layout="tableLayout ? 'auto' : 'fixed'" @sort-change="sortChange"
      :max-height="maxHeight">
      <template slot="sortIcon">
        <t-icon name="caret-down-small"></t-icon>
      </template>
      <template #status="{row}">
        <t-tag theme="warning" variant="light" v-if="row.status==='Wait'" class="com-status">{{lang.Wait}}</t-tag>
        <t-tag theme="primary" variant="light" v-if="row.status==='Exec'" class="com-status">{{lang.Exec}}</t-tag>
        <t-tag theme="warning" variant="light" v-if="row.status==='Finish'" class="com-status">{{lang.Finish}}</t-tag>
        <t-tag theme="danger" variant="light" v-if="row.status==='Failed'" class="com-status">{{lang.Failed}}</t-tag>
      </template>
      <template #start_time="{row}">
        {{row.start_time === 0 ? '-' : moment(row.start_time * 1000).format('YYYY-MM-DD HH:mm')}}
      </template>
      <template #finish_time="{row}">
        {{row.finish_time === 0 ? '-' : moment(row.finish_time * 1000).format('YYYY-MM-DD HH:mm')}}
      </template>
      <template #retry="{row}">
        <a class="common-look" v-if="row.retry" @click="retryFun(row.id)">{{lang.retry}}</a>
      </template>
    </t-table>
    <t-pagination v-if="total" :total="total" :page-size="params.limit" :page-size-options="pageSizeOptions"
      :on-change="changePage" :current="params.page"/>
  </t-card>
</div>
<!-- =======页面独有======= -->
<script src="/{$template_catalog}/template/{$themes}/api/manage.js"></script>
<script src="/{$template_catalog}/template/{$themes}/js/task.js"></script>
{include file="footer"}
