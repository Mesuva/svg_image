<?php
defined('C5_EXECUTE') or die("Access Denied.");
$al = Loader::helper('concrete/asset_library');
$bf = null;
$bfo = null;

if ($controller->getFileID() > 0) {
    $bf = $controller->getFileObject();
}
if ($controller->getFileFallbackID() > 0) {
    $bfo = $controller->getFileFallbackObject();
}

if ($linkFID > 0) {
    $linkedFile = File::getByID($linkFID);
}

?>
<fieldset>
    <legend><?php echo t('SVG Image to Display')?></legend>

    <div class="form-group">
        <label><?php echo t('SVG File')?></label>
        <div class="input">
            <?php echo $al->image('ccm-b-image', 'fID', t('Choose SVG File'), $bf);?>
        </div>
    </div>
    <div class="form-group">
        <label><?php echo t('Fallback Bitmap Image')?></label>
        <div class="input">
            <?php echo $al->image('ccm-b-image-onstate', 'fallbackID', t('Choose Fallback Image'), $bfo);?>
        </div>
    </div>

</fieldset>


<fieldset>
    <legend><?php echo t('Link and Caption')?></legend>

    <div class="form-group">
        <?php echo $form->label('linkType', t('Image Links to:'))?>
        <div class="input">
            <select name="linkType" id="linkType" class="form-control">
                <option value="0" <?php echo (empty($externalLink) && empty($internalLinkCID) ? 'selected="selected"' : '')?>><?php echo t('Nothing')?></option>
                <option value="1" <?php echo (empty($externalLink) && !empty($internalLinkCID) ? 'selected="selected"' : '')?>><?php echo t('A Page')?></option>
                <option value="3" <?php echo ( $linkFID ? 'selected="selected"' : '')?>><?php echo t('A File')?></option>
                <option value="2" <?php echo (!empty($externalLink) ? 'selected="selected"' : '')?>><?php echo t('External URL')?></option>
            </select>
        </div>
    </div>

    <div id="linkTypePage" class="form-group" style="display: none;">
        <?php echo $form->label('internalLinkCID', t('Choose Page:'))?>
        <div class="input">
            <?php echo  Loader::helper('form/page_selector')->selectPage('internalLinkCID', $internalLinkCID); ?>
        </div>
    </div>

    <div id="linkTypeExternal" class="form-group" style="display: none;">
        <?php echo $form->label('externalLink', t('URL:'))?>
        <div class="input">
            <?php echo  $form->text('externalLink', $externalLink, array('style' => 'width: 250px')); ?>
        </div>
    </div>


    <div id="linkTypeExternal" class="form-group" style="display: none;">
        <?php echo $form->label('externalLink', t('URL:'))?>
        <div class="input">
            <?php echo  $form->text('externalLink', $externalLink, array('style' => 'width: 250px')); ?>
        </div>
    </div>

    <div id="linkTypeFile">
        <div  class="form-group">
            <label for="image_fID"><?php echo t('File');?></label>
            <?php  echo $al->file('linkFID', 'linkFID', t('Choose File'), $linkedFile); ?>
        </div>

        <div class="form-group">
            <?php  echo $form->checkbox('forceDownload', '1', $forceDownload); ?>
            <?php echo $form->label('forceDownload', t('Force linked file to download')); ?>
        </div>
    </div>


    <div class="form-group">
        <?php echo $form->label('altText', t('Alt Text/Caption'))?>
        <div class="input">
            <?php echo  $form->text('altText', $altText, array('style' => 'width: 250px')); ?>
        </div>
    </div>

</fieldset>

<script type="text/javascript">
    refreshLinkTypeControls = function() {
        var linkType = $('#linkType').val();
        $('#linkTypePage').toggle(linkType == 1);
        $('#linkTypeExternal').toggle(linkType == 2);
        $('#linkTypeFile').toggle(linkType == 3);
    }

    $(document).ready(function() {
        $('#linkType').change(refreshLinkTypeControls);
        refreshLinkTypeControls();
    });
</script>