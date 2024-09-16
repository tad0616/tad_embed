<{if $embed.options|default:false}>
    <{block name="$embed.blockid" id=$embed.blockid options=$embed.options}>
<{else}>
    <{block name="$embed.blockid" id=$embed.blockid}>
<{/if}>