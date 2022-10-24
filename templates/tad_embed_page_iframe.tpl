<{if $smarty.get.ebsn and $embed}>
    <iframe src="<{$xoops_url}>/modules/tad_embed/tad_embed_demo.php?ebsn=<{$smarty.get.ebsn}>" style="<{$width_smarty}> <{$height_smarty}> <{$border_smarty}>" scrolling="<{$embed.scrolling}>" title="embed page">
    </iframe>
<{/if}>