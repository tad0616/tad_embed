
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
<h2><{$smarty.const._MD_TAD_EMBED_FORM}></h2>

<form action="add.php" method="post" id="myForm" enctype="multipart/form-data" role="form">
    <!--標題-->
    <div class="form-group row mb-3">
    <label class="col-sm-2 col-form-label text-sm-right text-sm-end control-label">
        <{$smarty.const._MD_TADEMBED_TITLE}>
    </label>
    <div class="col-sm-10">
        <input type="text" name="title" class="form-control" value="<{$title|default:''}>" id="title" >
    </div>
    </div>

    <{if $options|default:false}>
    <!--設定項目-->
    <div class="form-group row mb-3">
    <label class="col-sm-2 col-form-label text-sm-right text-sm-end control-label">
        <{$smarty.const._MD_TADEMBED_BLOCK_OPTIONS}>
    </label>
    <div class="col-sm-10" id="options">
        <{$options|default:''}>
    </div>
    </div>
    <{/if}>

    <!--寬度-->
    <div class="form-group row mb-3">
    <label class="col-sm-2 col-form-label text-sm-right text-sm-end control-label">
        <{$smarty.const._MD_TADEMBED_WIDTH}>
    </label>
    <div class="col-sm-10">
        <input type="text" name="width" class="form-control" value="<{$width|default:''}>" id="width" >
    </div>
    </div>


    <!--高度-->
    <div class="form-group row mb-3">
    <label class="col-sm-2 col-form-label text-sm-right text-sm-end control-label">
        <{$smarty.const._MD_TADEMBED_HEIGHT}>
    </label>
    <div class="col-sm-10">
        <input type="text" name="height" class="form-control" value="<{$height|default:''}>" id="height" >
    </div>
    </div>


    <!--框線-->
    <div class="form-group row mb-3">
    <label class="col-sm-2 col-form-label text-sm-right text-sm-end control-label">
        <{$smarty.const._MD_TADEMBED_BORDER}>
    </label>
    <div class="col-sm-10">
        <div class="form-check-inline radio-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="border" value="1" <{if $border=='1'}>checked<{/if}>>
                <{$smarty.const._YES}>
            </label>
        </div>
        <div class="form-check-inline radio-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="border" value="0" <{if $border=='0'}>checked<{/if}>>
                <{$smarty.const._NO}>
            </label>
        </div>
    </div>
    </div>

    <!--捲軸-->
    <div class="form-group row mb-3">
    <label class="col-sm-2 col-form-label text-sm-right text-sm-end control-label">
        <{$smarty.const._MD_TADEMBED_SCROLLING}>
    </label>
    <div class="col-sm-10">
        <div class="form-check-inline radio-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="scrolling" value="no" <{if $scrolling=='no'}>checked<{/if}>>
                <{$smarty.const._MD_TADEMBED_NO}>
            </label>
        </div>
        <div class="form-check-inline radio-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="scrolling" value="yes" <{if $scrolling=='yes'}>checked<{/if}>>
                <{$smarty.const._MD_TADEMBED_YES}>
            </label>
        </div>
        <div class="form-check-inline radio-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="scrolling" value="auto" <{if $scrolling=='auto'}>checked<{/if}>>
                <{$smarty.const._MD_TADEMBED_AUTO}>
            </label>
        </div>
    </div>
    </div>

    <!--備註-->
    <div class="form-group row mb-3">
    <label class="col-sm-2 col-form-label text-sm-right text-sm-end control-label">
        <{$smarty.const._MD_TADEMBED_NOTE}>
    </label>
    <div class="col-sm-10">
        <textarea name="note" rows=2 id="note" class="form-control"><{$note|default:''}></textarea>
    </div>
    </div>

    <div class="text-center">
    <!--流水號-->
    <input type="hidden" name="ebsn" value="<{$ebsn|default:''}>">
    <!--區塊編號-->
    <input type="hidden" name="blockid" value="<{$blockid|default:''}>">
    <input type="hidden" name="op" value="<{$op|default:''}>">
    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-disk" aria-hidden="true"></i>  <{$smarty.const._TAD_SAVE}></button>
    </div>
</form>