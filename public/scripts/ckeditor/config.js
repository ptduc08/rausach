/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	//config.uiColor = '#AADC6E';
	//----- thiet lap chieu cao cho CKEditor
	config.height = 200;
	//----- thiet lap chieu rong cho CKEditor
	config.width = 760;
	//----- thiet lap ngon ngu cho CKEditor
	config.language = 'en';
	config.htmlEncodeOutput = false;
	//----- thiet lap che do hien thi unicode
	config.entities = false;
	//----- thiet lap khi nhan Tab thi nhay bao nhieu khoang trang
	config.tabSpaces = 30;
	//----- thiet lap che do khi nhan Enter thi chen the gi
	config.enterMode = CKEDITOR.ENTER_DIV;
	//----- thiet lap che do khi nhan Shit - Enter thi chen the gi
	config.shiftEnterMode = CKEDITOR.ENTER_BR;
	//----- loai bo cac the html nguy hiem
	config.removeFormatTags = 'b,big,code,del,dfn,em,font,i,ins,kbd,q,samp,small,span,strike,strong,sub,sup,tt,u,var';
	//----- thiet lap skin cho CKEditor
	config.skin = 'kama';
	// Load toolbar_Name where Name = Basic.
	CKEDITOR.config.toolbar_FullToolbar =
		[
			{ name: 'document',		items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
			{ name: 'clipboard',	items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
			{ name: 'editing',		items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
			'/',
			{ name: 'basicstyles',	items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
			{ name: 'paragraph',	items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
			{ name: 'links',		items : [ 'Link','Unlink','Anchor' ] },
			'/',
			{ name: 'insert',		items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
			{ name: 'styles',		items : [ 'Styles','Format','Font','FontSize' ] },
			{ name: 'colors',		items : [ 'TextColor','BGColor' ] },
			{ name: 'tools',		items : [ 'Maximize', 'ShowBlocks','-','About' ] }
		];
	CKEDITOR.config.toolbar_BasicToolbar =
		[
			{ name: 'basicstyles',	items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript' ] },
			{ name: 'paragraph',	items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
			{ name: 'styles',		items : [ 'Styles','Format','Font','FontSize' ] },
			{ name: 'colors',		items : [ 'TextColor','BGColor' ] },
		];

	config.toolbar = 'FullToolbar';
	
	//----- thiet lap upload file
	config.filebrowserBrowseUrl = '/public/scripts/ckeditor/plugins/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = '/public/scripts/ckeditor/plugins/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = '/public/scripts/ckeditor/plugins/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = '/public/scripts/ckeditor/plugins/kcfinder/browse.php?type=files';
	config.filebrowserImageUploadUrl = '/public/scripts/ckeditor/plugins/kcfinder/browse.php?type=images';
	config.filebrowserFlashUploadUrl = '/public/scripts/ckeditor/plugins/kcfinder/browse.php?type=flash';
};
