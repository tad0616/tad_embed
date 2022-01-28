<{$toolbar}>
<h2><{$smarty.const._MD_TADEMBED_PREVIEW}></h2>
<div class="row">
    <div class="col-sm-6">
    <select onChange="location.href='index.php?ebsn='+this.value" class="form-control" title="select block">
        <option value="" ><{$smarty.const._MD_TADEMBED_SELECT_BLOCK}></option>
        <{foreach from=$menu item=menu}>
        <option value="<{$menu.ebsn}>" <{if $menu.ebsn==$ebsn}>selected<{/if}>><{$menu.title}></option>
        <{/foreach}>
    </select>
</div>
<{if $smarty.session.tad_embed_adm and $ebsn}>
    <div class="col-sm-2 d-grid gap-2">
        <a href="javascript:delete_tad_embed_func(<{$ebsn}>);" class="btn btn-danger btn-block"><{$smarty.const._TAD_DEL}></a>
    </div>
    <div class="col-sm-2 d-grid gap-2">
        <a href="admin/main.php?op=tad_embed_form&ebsn=<{$ebsn}>" class="btn btn-warning btn-block"><{$smarty.const._TAD_EDIT}></a>
    </div>
    <div class="col-sm-2 d-grid gap-2">
        <a href="admin/main.php?op=select_block" class="btn btn-success btn-block"><{$smarty.const._TAD_ADD}></a>
    </div>
<{/if}>
</div>

<{if $ebsn and $embed}>
    <h2><{$smarty.const._MD_TADEMBED_COPY}></h2>

    <textarea class="form-control" style="background: #634A3E; color: #FFFFFF; height: 100px; margin: 10px 0px;"><base target="_parent">
    <iframe src="<{$xoops_url}>/modules/tad_embed/tad_embed_demo.php?ebsn=<{$ebsn}>" style="<{$width_smarty}> <{$height_smarty}> <{$border_smarty}>" scrolling="<{$embed.scrolling}>" title="code"></iframe></textarea>
    <h2>呈現預覽</h2>
    <iframe src="<{$xoops_url}>/modules/tad_embed/tad_embed_demo.php?ebsn=<{$ebsn}>" style="<{$width_smarty}> <{$height_smarty}> <{$border_smarty}>" scrolling="<{$embed.scrolling}>" title="demo">
    </iframe>

    <a href="page.php?ebsn=<{$ebsn}>" class="btn btn-primary btn-block"><{$smarty.const._MD_TADEMBED_PAGE}></a>

<{else}>
    <div class="jumbotron" style="margin:20px auto;">
        <h1><{$smarty.const._MD_TADEMBED_SELECT_BLOCK}></h1>
    </div>
<{/if}>