/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function(config) {
    config.filebrowserBrowseUrl = '/public/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl = '/public/ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = '/public/ckfinder/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = '/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = '/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = '/public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
