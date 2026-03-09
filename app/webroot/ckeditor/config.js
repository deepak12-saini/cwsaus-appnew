/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	//config.autoParagraph = false;
	config.fillEmptyBlocks = false;
	config.ignoreEmptyParagraph = true;
	CKEDITOR.config.autoParagraph = false;
	
	//config.format_tags = 'p;h1;h2;h3;pre';
	config.allowedContent = true;
	
	
	config.entities = false;
	config.basicEntities = false;
	
	config.enterMode = CKEDITOR.ENTER_BR;
	config.shiftEnterMode = CKEDITOR.ENTER_BR;
	
	config.extraAllowedContent = '*(*);*{*}';
	config.removeFormatAttributes = '';
	CKEDITOR.dtd.$removeEmpty['i'] = false
	
	//preg_replace('/\s&nbsp;\s/i', ' ', $text);
	// config.tabSpaces = 0;
	//preg_replace("#<p>\s*(<img [^>]*>)\s*</p>#iUum", "$1", $text);

	//preg_replace("/[\<]p[\>][\s]+&nbsp;[\<][\/]p[\>]/" , " " , $pre_comment);
};
