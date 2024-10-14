<{if $all_content|default:false}>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr class="table-light">
            <th><{$smarty.const._MD_TADEMBED_BLOCKID}></th>
            <th><{$smarty.const._MD_TADEMBED_WIDTH}></th>
            <th><{$smarty.const._MD_TADEMBED_HEIGHT}></th>
            <th><{$smarty.const._MD_TADEMBED_BORDER}></th>
            <th><{$smarty.const._MD_TADEMBED_TITLE}></th>
            <th><{$smarty.const._MD_TADEMBED_UID}></th>
            <th><{$smarty.const._MD_TADEMBED_UPDATE_DATE}></th>
            <th><{$smarty.const._MD_TADEMBED_COUNTER}></th>
            <th><{$smarty.const._TAD_FUNCTION}></th>
            </tr>

            <tbody>
            <{foreach from=$all_content item=data}>
            <tr>
                <td><{$data.blockid}></td>
                <td><{$data.width}></td>
                <td><{$data.height}></td>
                <td><{$data.border}></td>
                <td><{$data.prefix}><a href="index.php?ebsn=<{$data.ebsn}>"><{$data.title}></a></td>
                <td><{$data.uid_name}></td>
                <td><{$data.update_date}></td>
                <td><{$data.counter}></td>
                <td>
                <a href="add.php?op=tad_embed_form&ebsn=<{$data.ebsn}>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square" aria-hidden="true"></i> <{$smarty.const._TAD_EDIT}></a>
                <a href="javascript:delete_tad_embed_func(<{$data.ebsn}>);" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> <{$smarty.const._TAD_DEL}></a>
                </td>
            </tr>
            <{/foreach}>
            </tbody>

        </table>
    </div>
<{/if}>
<div class="text-center">
    <a href="add.php?op=select_block" class="btn btn-primary my-3"><i class="fa fa-plus-square" aria-hidden="true"></i> <{$smarty.const._TAD_ADD}></a>
    <{if $all_content|default:false}>
        <{$bar|default:''}>
    <{/if}>
</div>