
<div class="container-fluid">

  <{if $now_op=="list_tad_embed"}>
    <{if $all_content}>
      <script>
      function delete_tad_embed_func(ebsn){
        var sure = window.confirm("<{$smarty.const._TAD_DEL_CONFIRM}>");
        if (!sure)  return;
        location.href="main.php?op=delete_tad_embed&ebsn=" + ebsn;
      }
      </script>

      <table class="table table-striped table-bordered">
        <tr>
          <th><{$smarty.const._MA_TADEMBED_BLOCKID}></th>
          <th><{$smarty.const._MA_TADEMBED_WIDTH}></th>
          <th><{$smarty.const._MA_TADEMBED_HEIGHT}></th>
          <th><{$smarty.const._MA_TADEMBED_BORDER}></th>
          <th><{$smarty.const._MA_TADEMBED_TITLE}></th>
          <th><{$smarty.const._MA_TADEMBED_UID}></th>
          <th><{$smarty.const._MA_TADEMBED_UPDATE_DATE}></th>
          <th><{$smarty.const._MA_TADEMBED_HTTP_REFERER}></th>
          <th><{$smarty.const._MA_TADEMBED_COUNTER}></th>
          <th><{$smarty.const._TAD_FUNCTION}></th>
        </tr>

        <tbody>
        <{foreach from=$all_content item=data}>
          <tr>
            <td><{$data.blockid}></td>
            <td><{$data.width}></td>
            <td><{$data.height}></td>
            <td><{$data.border}></td>
            <td><{$data.prefix}><a href="../index.php?ebsn=<{$data.ebsn}>"><{$data.title}></a></td>
            <td><{$data.uid_name}></td>
            <td><{$data.update_date}></td>
            <td><a href="<{$data.http_referer}>" target="_blank"><{$data.http_referer}></a></td>
            <td><{$data.counter}></td>
            <td>
            <a href="main.php?op=tad_embed_form&ebsn=<{$data.ebsn}>" class="btn btn-warning"><{$smarty.const._TAD_EDIT}></a>
            <a href="javascript:delete_tad_embed_func(<{$data.ebsn}>);" class="btn btn-danger"><{$smarty.const._TAD_DEL}></a>
            </td>
          </tr>
        <{/foreach}>
        </tbody>

      </table>
    <{/if}>
    <a href="main.php?op=select_block" class="btn btn-info"><{$smarty.const._TAD_ADD}></a>
    <{$bar}>
  <{/if}>

  <{if $now_op=="select_block"}>
    <form action="main.php" method="post" id="myForm" role="form">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
          <{$smarty.const._MA_TADEMBED_SELECT_BLOCK}>
        </label>
        <div class="col-sm-8">
          <select name="blockid" class="form-control">
            <{foreach from=$arr key=blockid item=blockName}>
              <option value="<{$blockid}>"><{$blockName}></option>
            <{/foreach}>
          </select>
        </div>
        <div class="col-sm-2">
        <input type="hidden" name="op" value="tad_embed_form">
        <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
        </div>
      </div>
    </form>
  <{/if}>

  <{if $now_op=="tad_embed_form"}>
  <style type="text/css" media="screen">
    #options table{
      border: 1px solid black;
    }
    #options th, #options td{
      padding: 4px 8px;
      border: 1px solid black;
    }
    #options th{
      color: #000;
      background: #CCDAFC;
    }
    #options td{
      color: #000;
      background: #ffffff;
    }
  </style>
    <h2><{$smarty.const._MA_TAD_EMBED_FORM}></h2>

    <form action="main.php" method="post" id="myForm" enctype="multipart/form-data" role="form">
      <!--標題-->
      <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
          <{$smarty.const._MA_TADEMBED_TITLE}>
        </label>
        <div class="col-sm-10">
          <input type="text" name="title" class="form-control" value="<{$title}>" id="title" >
        </div>
      </div>

      <!--設定項目-->
      <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
          <{$smarty.const._MA_TADEMBED_BLOCK_OPTIONS}>
        </label>
        <div class="col-sm-10" id="options">
          <{$options}>
        </div>
      </div>

      <!--寬度-->
      <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
          <{$smarty.const._MA_TADEMBED_WIDTH}>
        </label>
        <div class="col-sm-10">
          <input type="text" name="width" class="form-control" value="<{$width}>" id="width" >
        </div>
      </div>


      <!--高度-->
      <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
          <{$smarty.const._MA_TADEMBED_HEIGHT}>
        </label>
        <div class="col-sm-10">
          <input type="text" name="height" class="form-control" value="<{$height}>" id="height" >
        </div>
      </div>


      <!--框線-->
      <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
          <{$smarty.const._MA_TADEMBED_BORDER}>
        </label>
        <div class="col-sm-10">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="border" id="border_1" value="1" <{if $border==1}>checked<{/if}>>
              <label class="form-check-label" for="border_1"><{$smarty.const._YES}></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="border" id="border_0" value="0" <{if $border!=1}>checked<{/if}>>
              <label class="form-check-label" for="border_0"><{$smarty.const._NO}></label>
            </div>
        </div>
      </div>

      <!--捲軸-->
      <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
          <{$smarty.const._MA_TADEMBED_SCROLLING}>
        </label>
        <div class="col-sm-10">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="scrolling" id="scrolling_no" value="no" <{if $scrolling=='no'}>checked<{/if}>>
              <label class="form-check-label" for="scrolling_no"><{$smarty.const._MA_TADEMBED_NO}></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="scrolling" id="scrolling_yes" value="yes" <{if $scrolling=='yes'}>checked<{/if}>>
              <label class="form-check-label" for="scrolling_yes"><{$smarty.const._MA_TADEMBED_YES}></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="scrolling" id="scrolling_auto" value="auto" <{if $scrolling=='auto' or $border==""}>checked<{/if}>>
              <label class="form-check-label" for="scrolling_auto"><{$smarty.const._MA_TADEMBED_AUTO}></label>
            </div>
        </div>
      </div>

      <!--備註-->
      <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
          <{$smarty.const._MA_TADEMBED_NOTE}>
        </label>
        <div class="col-sm-10">
          <textarea name="note" rows=2 id="note" class="form-control"><{$note}></textarea>
        </div>
      </div>

      <div class="text-center">
        <!--流水號-->
        <input type="hidden" name="ebsn" value="<{$ebsn}>">
        <!--區塊編號-->
        <input type="hidden" name="blockid" value="<{$blockid}>">
        <input type="hidden" name="op" value="<{$op}>">
        <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
      </div>
    </form>
  <{/if}>

</div>