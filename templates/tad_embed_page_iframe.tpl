<{if $smarty.get.ebsn and $embed}>
    <iframe src="<{$xoops_url}>/modules/tad_embed/tad_embed_demo.php?ebsn=<{$smarty.get.ebsn}>" style="<{$width_smarty|default:''}> <{$height_smarty|default:''}> <{$border_smarty|default:''}>" scrolling="<{$embed.scrolling}>" title="embed page">
    </iframe>
<{/if}>