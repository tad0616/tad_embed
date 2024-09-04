<{if $embed.options}>
    <{block name="$embed.blockid" id=$embed.blockid options=$embed.options}>
<{else}>
    <{block name="$embed.blockid" id=$embed.blockid}>
<{/if}>