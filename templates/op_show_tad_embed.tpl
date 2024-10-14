<{if $xoops_version < 20511}>
    <{include file="$xoops_rootpath/modules/tad_embed/templates/block.tpl"}>
<{else}>
    <{if isset($embed.options)}>
        <{xoBlock id=$embed.blockid options=$embed.options}>
    <{else}>
        <{xoBlock id=$embed.blockid}>
    <{/if}>
<{/if}>
