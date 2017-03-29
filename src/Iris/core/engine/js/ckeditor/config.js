/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	
	// язык интерфейса редактора
	config.language = 'ru';
	
	// убираем плагины bottom
	config.removePlugins = 'elementspath,save,flash,forms,smiley,uicolor';
	config.resize_enabled = false;
	
	// Basic, Full 
	// Standart
	config.toolbar_Standart = [
			['Font','FontSize', '-', 'Bold','Italic','Underline','Strike', '-', 'NumberedList','BulletedList'],
			['TextColor','BGColor', 'Image'], 
			['Preview', 'Maximize', 'Source']
	];
	// Mini
	config.toolbar_Mini = [
		['Font','FontSize', 'Bold','Italic', '-', 'NumberedList','BulletedList'],
		['TextColor','BGColor', '-', 'Source']
	];
	// ReadOnly
	config.toolbar_ReadOnly = [
		['Preview', 'Source']
	];	
	config.toolbar = 'Standart';
};
