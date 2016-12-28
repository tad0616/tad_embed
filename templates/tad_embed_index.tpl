<{$toolbar}>
<h1><{$smarty.const._MD_TADEMBED_PREVIEW}></h1>


  <div class="row">
    <div class="col-sm-6">
      <select onChange="location.href='index.php?ebsn='+this.value" class="form-control">
        <option value="" ><{$smarty.const._MD_TADEMBED_SELECT_BLOCK}></option>
        <{foreach from=$menu item=menu}>
          <option value="<{$menu.ebsn}>" <{if $menu.ebsn==$ebsn}>selected<{/if}>><{$menu.title}></option>
        <{/foreach}>
      </select>
    </div>
    <{if $isAdmin and $ebsn}>
      <div class="col-sm-2">
        <a href="javascript:delete_tad_embed_func(<{$ebsn}>);" class="btn btn-danger btn-block"><{$smarty.const._TAD_DEL}></a>
      </div>
      <div class="col-sm-2">
        <a href="admin/main.php?op=tad_embed_form&ebsn=<{$ebsn}>" class="btn btn-warning btn-block"><{$smarty.const._TAD_EDIT}></a>
      </div>
      <div class="col-sm-2">
        <a href="admin/main.php?op=select_block" class="btn btn-success btn-block"><{$smarty.const._TAD_ADD}></a>
      </div>
    <{/if}>
  </div>

<{if $ebsn and $embed}>
  <h2><{$smarty.const._MD_TADEMBED_COPY}></h2>

  <textarea class="form-control" style="background: #634A3E; color: #FFFFFF; height: 100px; margin: 10px 0px;"><base target="_parent">
<iframe src="<{$xoops_url}>/modules/tad_embed/tad_embed_demo.php?ebsn=<{$ebsn}>" style="<{$width_smarty}> <{$height_smarty}> <{$border_smarty}>" scrolling="<{$embed.scrolling}>"></iframe></textarea>
  <h2>呈現預覽</h2>
  <iframe src="<{$xoops_url}>/modules/tad_embed/tad_embed_demo.php?ebsn=<{$ebsn}>" style="<{$width_smarty}> <{$height_smarty}> <{$border_smarty}>" scrolling="<{$embed.scrolling}>">
  </iframe>

<!--
  <h2><{$smarty.const._MD_TADEMBED_COPY}></h2>
  <textarea class="form-control" style="background: #4A633E; color: #FFFFFF; height: 200px; margin: 10px 0px;"><div id="iframe<{$ebsn}>"></div>
<script type="text/javascript">
  $(document).ready(function(){
    $.get("<{$xoops_url}>/modules/tad_embed/tad_embed_demo2.php?ebsn=<{$ebsn}>",function(data){
      $("#iframe<{$ebsn}>").html(data);
    });
  });
</script></textarea>


<div id="iframe<{$ebsn}>"></div>
<script type="text/javascript">
  $(document).ready(function(){
    $.get("<{$xoops_url}>/modules/tad_embed/tad_embed_demo.php?ebsn=<{$ebsn}>",function(data){
      $("#iframe<{$ebsn}>").html(data);
    });
  });
</script>
-->
<{else}>
  <div class="jumbotron" style="margin:20px auto;">
    <h1><{$smarty.const._MD_TADEMBED_SELECT_BLOCK}></h1>
  </div>
<{/if}>