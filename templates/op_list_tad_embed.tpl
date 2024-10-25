<div class="alert alert-info">
    <h3><{$smarty.const._MD_TADEMBED_PREVIEW}></h3>
    <div class="row">
        <div class="col-sm-6">
            <select onChange="location.href='index.php?ebsn='+this.value" class="form-control" title="select block">
                <option value="" ><{$smarty.const._MD_TADEMBED_SELECT_BLOCK}></option>
                <{foreach from=$menu item=block}>
                <option value="<{$block.ebsn}>" <{if $block.ebsn==$ebsn}>selected<{/if}>><{$block.title}></option>
                <{/foreach}>
            </select>
        </div>
        <{if $smarty.session.tad_embed_adm and $ebsn}>
            <div class="col-sm-2 d-grid gap-2">
                <a href="javascript:delete_tad_embed_func(<{$ebsn|default:''}>);" class="btn btn-danger btn-block"><i class="fa fa-trash" aria-hidden="true"></i> <{$smarty.const._TAD_DEL}></a>
            </div>
            <div class="col-sm-2 d-grid gap-2">
                <a href="add.php?op=tad_embed_form&ebsn=<{$ebsn|default:''}>" class="btn btn-warning btn-block"><i class="fa fa-pencil-square" aria-hidden="true"></i> <{$smarty.const._TAD_EDIT}></a>
            </div>
            <div class="col-sm-2 d-grid gap-2">
                <a href="add.php?op=select_block" class="btn btn-success btn-block"><i class="fa fa-plus-square" aria-hidden="true"></i> <{$smarty.const._TAD_ADD}></a>
            </div>
        <{/if}>
    </div>
</div>

<{if $ebsn and $embed}>
    <h3><{$smarty.const._MD_TADEMBED_COPY}></h3>

    <textarea class="form-control" id="embed_code" style="background: #000000; color: #ffee01; height: 100px; margin: 10px 0px;font-family: Arial, Helvetica, sans-serif"><base target="_parent">
<iframe src="<{$xoops_url}>/modules/tad_embed/tad_embed_demo.php?ebsn=<{$ebsn|default:''}>" style="<{$width_smarty|default:''}> <{$height_smarty|default:''}> <{$border_smarty|default:''}>" scrolling="<{$embed.scrolling}>" title="code"></iframe></textarea>

    <div id="copyMessage" style="display: none; color: green; margin-top: 10px;"><{$smarty.const._MD_TADEMBED_COPIED}></div>

    <div class="row">
        <div class="col-sm-2">
            <h3><{$smarty.const._MD_TADEMBED_DEMO}></h3>
        </div>
        <div class="col-sm-10">
            <form action="add.php" method="post" id="myForm" role="form">
                <!--寬度-->
                <div class="row g-1">
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend input-group-addon">
                                <span class="input-group-text"><{$smarty.const._MD_TADEMBED_WIDTH}></span>
                            </div>
                            <input type="text" name="width" class="form-control" value="<{$embed.width}>" id="width" >
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <div class="input-group-prepend input-group-addon">
                                <span class="input-group-text"><{$smarty.const._MD_TADEMBED_HEIGHT}></span>
                            </div>
                            <input type="text" name="height" class="form-control" value="<{$embed.height}>" id="height" >
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <div class="input-group-prepend input-group-addon">
                                <span class="input-group-text"><{$smarty.const._MD_TADEMBED_BORDER}></span>
                            </div>
                            <select name="border" id="border" class="form-select validate[required]">
                                <option value="0" <{if $embed.border != '1'}>selected<{/if}>><{$smarty.const._NO}></option>
                                <option value="1" <{if $embed.border == '1'}>selected<{/if}>><{$smarty.const._YES}></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-prepend input-group-addon">
                                <span class="input-group-text"><{$smarty.const._MD_TADEMBED_SCROLLING2}></span>
                            </div>
                            <select name="scrolling" id="scrolling" class="form-select validate[required]">
                                <option value="no" <{if $embed.scrolling == '1'}>selected<{/if}>><{$smarty.const._MD_TADEMBED_NO}></option>
                                <option value="yes" <{if $embed.scrolling == 'yes'}>selected<{/if}>><{$smarty.const._MD_TADEMBED_YES}></option>
                                <option value="auto" <{if $embed.scrolling == 'auto'}>selected<{/if}>><{$smarty.const._MD_TADEMBED_AUTO}></option>
                            </select>
                            <{if $smarty.session.tad_embed_adm and $ebsn}>
                            <!--流水號-->
                            <input type="hidden" name="ebsn" value="<{$ebsn|default:''}>">
                            <!--區塊編號-->
                            <input type="hidden" name="blockid" value="<{$embed.blockid}>">
                            <input type="hidden" name="op" value="update_tad_embed_config">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>  <{$smarty.const._TAD_SAVE}></button>
                            <{/if}>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div style="border:1px dotted #7daff0;">
        <iframe id="embed_demo" src="<{$xoops_url}>/modules/tad_embed/tad_embed_demo.php?ebsn=<{$ebsn|default:''}>" style="<{$width_smarty|default:''}> <{$height_smarty|default:''}> <{$border_smarty|default:''}>" scrolling="<{$embed.scrolling}>" title="demo">
        </iframe>
    </div>
    <div class="text-center mt-3">
        <a href="page.php?ebsn=<{$ebsn|default:''}>" class="btn btn-primary btn-block"><{$smarty.const._MD_TADEMBED_PAGE}></a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const embedCodeTextarea = document.getElementById('embed_code');
            const demoIframe = document.getElementById('embed_demo');

            // 監聽表單變化
            document.getElementById('width').addEventListener('input', updateEmbedCode);
            document.getElementById('height').addEventListener('input', updateEmbedCode);
            document.getElementById('border').addEventListener('change', updateEmbedCode);
            document.getElementById('scrolling').addEventListener('change', updateEmbedCode);

            function updateEmbedCode() {
                const width = document.getElementById('width').value;
                const height = document.getElementById('height').value;
                const border = document.getElementById('border').value === '1' ? '1px solid gray' : '0';
                const scrolling = document.getElementById('scrolling').value;

                // 更新嵌入代碼
                const newEmbedCode = `<base target="_parent">\n<iframe src="<{$xoops_url}>/modules/tad_embed/tad_embed_demo.php?ebsn=<{$ebsn|default:''}>" style="width: ${width}; height: ${height}; border: ${border};" scrolling="${scrolling}" title="code"></iframe>`;
                embedCodeTextarea.value = newEmbedCode;

                // 更新 iframe 預覽
                demoIframe.style.width = width;
                demoIframe.style.height = height;
                demoIframe.style.border = border;
                demoIframe.setAttribute('scrolling', scrolling);
            }

            // 點擊 textarea 複製內容
            embedCodeTextarea.addEventListener('click', function() {
                embedCodeTextarea.select();
                document.execCommand('copy');

                const copyMessage = document.getElementById('copyMessage');
                copyMessage.style.display = 'block';
                setTimeout(() => {
                    copyMessage.style.display = 'none';
                }, 2000);
            });
        });

    </script>
<{else}>
    <div class="alert alert-success">
        <h1><{$smarty.const._MD_TADEMBED_SELECT_BLOCK}></h1>
    </div>
<{/if}>


<{if $smarty.session.tad_embed_adm && $ebsn && $http_referer}>
    <div class="alert alert-info">
        <a href="<{$http_referer|default:''}>" target="_blank"><{$http_referer|default:''}></a>
    </div>
<{/if}>