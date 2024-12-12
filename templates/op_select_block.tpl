<form action="add.php" method="post" id="myForm" class="form-horizontal" role="form">
    <div class="form-group row mb-3">
      <label class="col-sm-2 col-form-label text-sm-right text-sm-end control-label">
        <{$smarty.const._MD_TADEMBED_SELECT_BLOCK}>
      </label>
      <div class="col-sm-8">
        <select name="blockid" class="form-control form-select">
          <{foreach from=$arr key=blockid item=blockName}>
            <option value="<{$blockid|default:''}>"><{$blockName|default:''}></option>
          <{/foreach}>
        </select>
      </div>
      <div class="col-sm-2">
      <input type="hidden" name="op" value="tad_embed_form">
      <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-disk" aria-hidden="true"></i>  <{$smarty.const._TAD_SAVE}></button>
      </div>
    </div>
  </form>