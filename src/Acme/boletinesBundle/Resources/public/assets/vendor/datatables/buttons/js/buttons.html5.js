/*!
 * HTML5 export buttons for Buttons and DataTables.
 * 2015 SpryMedia Ltd - datatables.net/license
 *
 * FileSaver.js (2015-05-07.2) - MIT license
 * Copyright © 2015 Eli Grey - http://eligrey.com
 */

(function( factory ){
	if ( typeof define === 'function' && define.amd ) {
		// AMD
		define( ['jquery', 'datatables.net', 'datatables.net-buttons'], function ( $ ) {
			return factory( $, window, document );
		} );
	}
	else if ( typeof exports === 'object' ) {
		// CommonJS
		module.exports = function (root, $) {
			if ( ! root ) {
				root = window;
			}

			if ( ! $ || ! $.fn.dataTable ) {
				$ = require('datatables.net')(root, $).$;
			}

			if ( ! $.fn.dataTable.Buttons ) {
				require('datatables.net-buttons')(root, $);
			}

			return factory( $, root, root.document );
		};
	}
	else {
		// Browser
		factory( jQuery, window, document );
	}
}(function( $, window, document, undefined ) {
'use strict';
var DataTable = $.fn.dataTable;


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * FileSaver.js dependency
 */

/*jslint bitwise: true, indent: 4, laxbreak: true, laxcomma: true, smarttabs: true, plusplus: true */

var _saveAs = (function(view) {
	// IE <10 is explicitly unsupported
	if (typeof navigator !== "undefined" && /MSIE [1-9]\./.test(navigator.userAgent)) {
		return;
	}
	var
		  doc = view.document
		  // only get URL when necessary in case Blob.js hasn't overridden it yet
		, get_URL = function() {
			return view.URL || view.webkitURL || view;
		}
		, save_link = doc.createElementNS("http://www.w3.org/1999/xhtml", "a")
		, can_use_save_link = "download" in save_link
		, click = function(node) {
			var event = doc.createEvent("MouseEvents");
			event.initMouseEvent(
				"click", true, false, view, 0, 0, 0, 0, 0
				, false, false, false, false, 0, null
			);
			node.dispatchEvent(event);
		}
		, webkit_req_fs = view.webkitRequestFileSystem
		, req_fs = view.requestFileSystem || webkit_req_fs || view.mozRequestFileSystem
		, throw_outside = function(ex) {
			(view.setImmediate || view.setTimeout)(function() {
				throw ex;
			}, 0);
		}
		, force_saveable_type = "application/octet-stream"
		, fs_min_size = 0
		// See https://code.google.com/p/chromium/issues/detail?id=375297#c7 and
		// https://github.com/eligrey/FileSaver.js/commit/485930a#commitcomment-8768047
		// for the reasoning behind the timeout and revocation flow
		, arbitrary_revoke_timeout = 500 // in ms
		, revoke = function(file) {
			var revoker = function() {
				if (typeof file === "string") { // file is an object URL
					get_URL().revokeObjectURL(file);
				} else { // file is a File
					file.remove();
				}
			};
			if (view.chrome) {
				revoker();
			} else {
				setTimeout(revoker, arbitrary_revoke_timeout);
			}
		}
		, dispatch = function(filesaver, event_types, event) {
			event_types = [].concat(event_types);
			var i = event_types.length;
			while (i--) {
				var listener = filesaver["on" + event_types[i]];
				if (typeof listener === "function") {
					try {
						listener.call(filesaver, event || filesaver);
					} catch (ex) {
						throw_outside(ex);
					}
				}
			}
		}
		, auto_bom = function(blob) {
			// prepend BOM for UTF-8 XML and text/* types (including HTML)
			if (/^\s*(?:text\/\S*|application\/xml|\S*\/\S*\+xml)\s*;.*charset\s*=\s*utf-8/i.test(blob.type)) {
				return new Blob(["\ufeff", blob], {type: blob.type});
			}
			return blob;
		}
		, FileSaver = function(blob, name) {
			blob = auto_bom(blob);
			// First try a.download, then web filesystem, then object URLs
			var
				  filesaver = this
				, type = blob.type
				, blob_changed = false
				, object_url
				, target_view
				, dispatch_all = function() {
					dispatch(filesaver, "writestart progress write writeend".split(" "));
				}
				// on any filesys errors revert to saving with object URLs
				, fs_error = function() {
					// don't create more object URLs than needed
					if (blob_changed || !object_url) {
						object_url = get_URL().createObjectURL(blob);
					}
					if (target_view) {
						target_view.location.href = object_url;
					} else {
						var new_tab = view.open(object_url, "_blank");
						if (new_tab === undefined && typeof safari !== "undefined") {
							//Apple do not allow window.open, see http://bit.ly/1kZffRI
							view.location.href = object_url;
						}
					}
					filesaver.readyState = filesaver.DONE;
					dispatch_all();
					revoke(object_url);
				}
				, abortable = function(func) {
					return function() {
						if (filesaver.readyState !== filesaver.DONE) {
							return func.apply(this, arguments);
						}
					};
				}
				, create_if_not_found = {create: true, exclusive: false}
				, slice
			;
			filesaver.readyState = filesaver.INIT;
			if (!name) {
				name = "download";
			}
			if (can_use_save_link) {
				object_url = get_URL().createObjectURL(blob);
				save_link.href = object_url;
				save_link.download = name;
				click(save_link);
				filesaver.readyState = filesaver.DONE;
				dispatch_all();
				revoke(object_url);
				return;
			}
			// Object and web filesystem URLs have a problem saving in Google Chrome when
			// viewed in a tab, so I force save with application/octet-stream
			// http://code.google.com/p/chromium/issues/detail?id=91158
			// Update: Google errantly closed 91158, I submitted it again:
			// https://code.google.com/p/chromium/issues/detail?id=389642
			if (view.chrome && type && type !== force_saveable_type) {
				slice = blob.slice || blob.webkitSlice;
				blob = slice.call(blob, 0, blob.size, force_saveable_type);
				blob_changed = true;
			}
			// Since I can't be sure that the guessed media type will trigger a download
			// in WebKit, I append .download to the filename.
			// https://bugs.webkit.org/show_bug.cgi?id=65440
			if (webkit_req_fs && name !== "download") {
				name += ".download";
			}
			if (type === force_saveable_type || webkit_req_fs) {
				target_view = view;
			}
			if (!req_fs) {
				fs_error();
				return;
			}
			fs_min_size += blob.size;
			req_fs(view.TEMPORARY, fs_min_size, abortable(function(fs) {
				fs.root.getDirectory("saved", create_if_not_found, abortable(function(dir) {
					var save = function() {
						dir.getFile(name, create_if_not_found, abortable(function(file) {
							file.createWriter(abortable(function(writer) {
								writer.onwriteend = function(event) {
									target_view.location.href = file.toURL();
									filesaver.readyState = filesaver.DONE;
									dispatch(filesaver, "writeend", event);
									revoke(file);
								};
								writer.onerror = function() {
									var error = writer.error;
									if (error.code !== error.ABORT_ERR) {
										fs_error();
									}
								};
								"writestart progress write abort".split(" ").forEach(function(event) {
									writer["on" + event] = filesaver["on" + event];
								});
								writer.write(blob);
								filesaver.abort = function() {
									writer.abort();
									filesaver.readyState = filesaver.DONE;
								};
								filesaver.readyState = filesaver.WRITING;
							}), fs_error);
						}), fs_error);
					};
					dir.getFile(name, {create: false}, abortable(function(file) {
						// delete file if it already exists
						file.remove();
						save();
					}), abortable(function(ex) {
						if (ex.code === ex.NOT_FOUND_ERR) {
							save();
						} else {
							fs_error();
						}
					}));
				}), fs_error);
			}), fs_error);
		}
		, FS_proto = FileSaver.prototype
		, saveAs = function(blob, name) {
			return new FileSaver(blob, name);
		}
	;
	// IE 10+ (native saveAs)
	if (typeof navigator !== "undefined" && navigator.msSaveOrOpenBlob) {
		return function(blob, name) {
			return navigator.msSaveOrOpenBlob(auto_bom(blob), name);
		};
	}

	FS_proto.abort = function() {
		var filesaver = this;
		filesaver.readyState = filesaver.DONE;
		dispatch(filesaver, "abort");
	};
	FS_proto.readyState = FS_proto.INIT = 0;
	FS_proto.WRITING = 1;
	FS_proto.DONE = 2;

	FS_proto.error =
	FS_proto.onwritestart =
	FS_proto.onprogress =
	FS_proto.onwrite =
	FS_proto.onabort =
	FS_proto.onerror =
	FS_proto.onwriteend =
		null;

	return saveAs;
}(window));



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Local (private) functions
 */

/**
 * Get the file name for an exported file.
 *
 * @param {object}  config       Button configuration
 * @param {boolean} incExtension Include the file name extension
 */
var _filename = function ( config, incExtension )
{
	// Backwards compatibility
	var filename = config.filename === '*' && config.title !== '*' && config.title !== undefined ?
		config.title :
		config.filename;

	if ( typeof filename === 'function' ) {
		filename = filename();
	}

	if ( filename.indexOf( '*' ) !== -1 ) {
		filename = filename.replace( '*', $('title').text() );
	}

	// Strip characters which the OS will object to
	filename = filename.replace(/[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g, "");

	return incExtension === undefined || incExtension === true ?
		filename+config.extension :
		filename;
};

/**
 * Get the sheet name for Excel exports.
 *
 * @param {object}  config       Button configuration
 */
var _sheetname = function ( config )
{
	var sheetName = 'Sheet1';

	if ( config.sheetName ) {
		sheetName = config.sheetName.replace(/[\[\]\*\/\\\?\:]/g, '');
	}

	return sheetName;	
};

/**
 * Get the title for an exported file.
 *
 * @param {object}  config  Button configuration
 */
var _title = function ( config )
{
	var title = config.title;

	if ( typeof title === 'function' ) {
		title = title();
	}

	return title.indexOf( '*' ) !== -1 ?
		title.replace( '*', $('title').text() ) :
		title;
};

/**
 * Get the newline character(s)
 *
 * @param {object}  config Button configuration
 * @return {string}        Newline character
 */
var _newLine = function ( config )
{
	return config.newline ?
		config.newline :
		navigator.userAgent.match(/Windows/) ?
			'\r\n' :
			'\n';
};

/**
 * Combine the data from the `buttons.exportData` method into a string that
 * will be used in the export file.
 *
 * @param  {DataTable.Api} dt     DataTables API instance
 * @param  {object}        config Button configuration
 * @return {object}               The data to export
 */
var _exportData = function ( dt, config )
{
	var newLine = _newLine( config );
	var data = dt.buttons.exportData( config.exportOptions );
	var boundary = config.fieldBoundary;
	var separator = config.fieldSeparator;
	var reBoundary = new RegExp( boundary, 'g' );
	var escapeChar = config.escapeChar !== undefined ?
		config.escapeChar :
		'\\';
	var join = function ( a ) {
		var s = '';

		// If there is a field boundary, then we might need to escape it in
		// the source data
		for ( var i=0, ien=a.length ; i<ien ; i++ ) {
			if ( i > 0 ) {
				s += separator;
			}

			s += boundary ?
				boundary + ('' + a[i]).replace( reBoundary, escapeChar+boundary ) + boundary :
				a[i];
		}

		return s;
	};

	var header = config.header ? join( data.header )+newLine : '';
	var footer = config.footer && data.footer ? newLine+join( data.footer ) : '';
	var body = [];

	for ( var i=0, ien=data.body.length ; i<ien ; i++ ) {
		body.push( join( data.body[i] ) );
	}

	return {
		str: header + body.join( newLine ) + footer,
		rows: body.length
	};
};

/**
 * Safari's data: support for creating and downloading files is really poor, so
 * various options need to be disabled in it. See
 * https://bugs.webkit.org/show_bug.cgi?id=102914
 * 
 * @return {Boolean} `true` if Safari
 */
var _isSafari = function ()
{
	return navigator.userAgent.indexOf('Safari') !== -1 &&
		navigator.userAgent.indexOf('Chrome') === -1 &&
		navigator.userAgent.indexOf('Opera') === -1;
};


// Excel - Pre-defined strings to build a minimal XLSX file
var excelStrings = {
	"_rels/.rels": '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>\
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">\
	<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>\
</Relationships>',

	"xl/_rels/workbook.xml.rels": '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>\
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">\
	<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>\
</Relationships>',

	"[Content_Types].xml": '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>\
<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">\
	<Default Extension="xml" ContentType="application/xml"/>\
	<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>\
	<Default Extension="jpeg" ContentType="image/jpeg"/>\
	<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>\
	<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>\
</Types>',

	"xl/workbook.xml": '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>\
<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">\
	<fileVersion appName="xl" lastEdited="5" lowestEdited="5" rupBuild="24816"/>\
	<workbookPr showInkAnnotation="0" autoCompressPictures="0"/>\
	<bookViews>\
		<workbookView xWindow="0" yWindow="0" windowWidth="25600" windowHeight="19020" tabRatio="500"/>\
	</bookViews>\
	<sheets>\
		<sheet name="__SHEET_NAME__" sheetId="1" r:id="rId1"/>\
	</sheets>\
</workbook>',

	"xl/worksheets/sheet1.xml": '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>\
<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" mc:Ignorable="x14ac" xmlns:x14ac="http://schemas.microsoft.com/office/spreadsheetml/2009/9/ac">\
	<sheetData>\
		__DATA__\
	</sheetData>\
</worksheet>'
};



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Buttons
 */

//
// Copy to clipboard
//
DataTable.ext.buttons.copyHtml5 = {
	className: 'buttons-copy buttons-html5',

	text: function ( dt ) {
		return dt.i18n( 'buttons.copy', 'Copy' );
	},

	action: function ( e, dt, button, config ) {
		var exportData = _exportData( dt, config );
		var output = exportData.str;
		var hiddenDiv = $('<div/>')
			.css( {
				height: 1,
				width: 1,
				overflow: 'hidden',
				position: 'fixed',
				top: 0,
				left: 0
			} );

		if ( config.customize ) {
			output = config.customize( output, config );
		}

		var textarea = $('<textarea readonly/>')
			.val( output )
			.appendTo( hiddenDiv );

		// For browsers that support the copy execCommand, try to use it
		if ( document.queryCommandSupported('copy') ) {
			hiddenDiv.appendTo( dt.table().container() );
			textarea[0].focus();
			textarea[0].select();

			try {
				document.execCommand( 'copy' );
				hiddenDiv.remove();

				dt.buttons.info(
					dt.i18n( 'buttons.copyTitle', 'Copy to clipboard' ),
					dt.i18n( 'buttons.copySuccess', {
							1: "Copied one row to clipboard",
							_: "Copied %d rows to clipboard"
						}, exportData.rows ),
					2000
				);

				return;
			}
			catch (t) {}
		}

		// Otherwise we show the text box and instruct the user to use it
		var message = $('<span>'+dt.i18n( 'buttons.copyKeys',
				'Press <i>ctrl</i> or <i>\u2318</i> + <i>C</i> to copy the table data<br>to your system clipboard.<br><br>'+
				'To cancel, click this message or press escape.' )+'</span>'
			)
			.append( hiddenDiv );

		dt.buttons.info( dt.i18n( 'buttons.copyTitle', 'Copy to clipboard' ), message, 0 );

		// Select the text so when the user activates their system clipboard
		// it will copy that text
		textarea[0].focus();
		textarea[0].select();

		// Event to hide the message when the user is done
		var container = $(message).closest('.dt-button-info');
		var close = function () {
			container.off( 'click.buttons-copy' );
			$(document).off( '.buttons-copy' );
			dt.buttons.info( false );
		};

		container.on( 'click.buttons-copy', close );
		$(document)
			.on( 'keydown.buttons-copy', function (e) {
				if ( e.keyCode === 27 ) { // esc
					close();
				}
			} )
			.on( 'copy.buttons-copy cut.buttons-copy', function () {
				close();
			} );
	},

	exportOptions: {},

	fieldSeparator: '\t',

	fieldBoundary: '',

	header: true,

	footer: false
};

//
// CSV export
//
DataTable.ext.buttons.csvHtml5 = {
	className: 'buttons-csv buttons-html5',

	available: function () {
		return window.FileReader !== undefined && window.Blob;
	},

	text: function ( dt ) {
		return dt.i18n( 'buttons.csv', 'CSV' );
	},

	action: function ( e, dt, button, config ) {
		// Set the text
		var newLine = _newLine( config );
		var output = _exportData( dt, config ).str;
		var charset = config.charset;

		if ( config.customize ) {
			output = config.customize( output, config );
		}

		if ( charset !== false ) {
			if ( ! charset ) {
				charset = document.characterSet || document.charset;
			}

			if ( charset ) {
				charset = ';charset='+charset;
			}
		}
		else {
			charset = '';
		}

		_saveAs(
			new Blob( [output], {type: 'text/csv'+charset} ),
			_filename( config )
		);
	},

	filename: '*',

	extension: '.csv',

	exportOptions: {},

	fieldSeparator: ',',

	fieldBoundary: '"',

	escapeChar: '"',

	charset: null,

	header: true,

	footer: false
};

//
// Excel (xlsx) export
//
DataTable.ext.buttons.excelHtml5 = {
	className: 'buttons-excel buttons-html5',

	available: function () {
		return window.FileReader !== undefined && window.JSZip !== undefined && ! _isSafari();
	},

	text: function ( dt ) {
		return dt.i18n( 'buttons.excel', 'Excel' );
	},

	action: function ( e, dt, button, config ) {
		// Set the text
		var xml = '';
		var data = dt.buttons.exportData( config.exportOptions );
		var addRow = function ( row ) {
			var cells = [];

			for ( var i=0, ien=row.length ; i<ien ; i++ ) {
				if ( row[i] === null || row[i] === undefined ) {
					row[i] = '';
				}

				// Don't match numbers with leading zeros or a negative anywhere
				// but the start
				cells.push( typeof row[i] === 'number' || (row[i].match && $.trim(row[i]).match(/^-?\d+(\.\d+)?$/) && row[i].charAt(0) !== '0') ?
					'<c t="n"><v>'+row[i]+'</v></c>' :
					'<c t="inlineStr"><is><t>'+(
						! row[i].replace ?
							row[i] :
							row[i]
								.replace(/&(?!amp;)/g, '&amp;')
								.replace(/</g, '&lt;')
								.replace(/>/g, '&gt;')
								.replace(/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F-\x9F]/g, ''))+ // remove control characters
					'</t></is></c>'                                                      // they are not valid in XML
				);
			}

			return '<row>'+cells.join('')+'</row>';
		};

		if ( config.header ) {
			xml += addRow( data.header );
		}

		for ( var i=0, ien=data.body.length ; i<ien ; i++ ) {
			xml += addRow( data.body[i] );
		}

		if ( config.footer ) {
			xml += addRow( data.footer );
		}

		var zip           = new window.JSZip();
		var _rels         = zip.folder("_rels");
		var xl            = zip.folder("xl");
		var xl_rels       = zip.folder("xl/_rels");
		var xl_worksheets = zip.folder("xl/worksheets");

		zip.file(           '[Content_Types].xml', excelStrings['[Content_Types].xml'] );
		_rels.file(         '.rels',               excelStrings['_rels/.rels'] );
		xl.file(            'workbook.xml',        excelStrings['xl/workbook.xml'].replace( '__SHEET_NAME__', _sheetname( config ) ) );
		xl_rels.file(       'workbook.xml.rels',   excelStrings['xl/_rels/workbook.xml.rels'] );
		xl_worksheets.file( 'sheet1.xml',          excelStrings['xl/worksheets/sheet1.xml'].replace( '__DATA__', xml ) );

		_saveAs(
			zip.generate( {type:"blob", mimeType:'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'} ),
			_filename( config )
		);
	},

	filename: '*',

	extension: '.xlsx',

	exportOptions: {},

	header: true,

	footer: false
};

//
// PDF export - using pdfMake - http://pdfmake.org
//
DataTable.ext.buttons.pdfHtml5 = {
	className: 'buttons-pdf buttons-html5',

	available: function () {
		return window.FileReader !== undefined && window.pdfMake;
	},

	text: function ( dt ) {
		return dt.i18n( 'buttons.pdf', 'PDF' );
	},

	action: function ( e, dt, button, config ) {
		var newLine = _newLine( config );
		var data = dt.buttons.exportData( config.exportOptions );
		var rows = [];

		if ( config.header ) {
			rows.push( $.map( data.header, function ( d ) {
				return {
					text: typeof d === 'string' ? d : d+'',
					style: 'tableHeader'
				};
			} ) );
		}

		for ( var i=0, ien=data.body.length ; i<ien ; i++ ) {
			rows.push( $.map( data.body[i], function ( d ) {
				return {
					text: typeof d === 'string' ? d : d+'',
					style: i % 2 ? 'tableBodyEven' : 'tableBodyOdd'
				};
			} ) );
		}

		if ( config.footer ) {
			rows.push( $.map( data.footer, function ( d ) {
				return {
					text: typeof d === 'string' ? d : d+'',
					style: 'tableFooter'
				};
			} ) );
		}

		var doc = {
			pageSize: config.pageSize,
			pageOrientation: config.orientation,
			content: [{
                image: 'data:image/png;base64,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',
                width: 64
            },
				{
					table: {
						headerRows: 1,
						body: rows
					},
					layout: 'noBorders'
				}
			],
			styles: {
				tableHeader: {
					bold: true,
					fontSize: 15,
					color: 'black',
					fillColor: '#FFFFFF',
					alignment: 'center'
				},
				tableBodyEven: {},
				tableBodyOdd: {
					fillColor: '#f3f3f3'
				},
				tableFooter: {
					bold: true,
					fontSize: 11,
					color: 'white',
					fillColor: '#2d4154'
				},
				title: {
					alignment: 'center',
					fontSize: 15
				},
				message: {}
			},
			defaultStyle: {
				fontSize: 10
			}
		};

		if ( config.message ) {
			doc.content.unshift( {
				text: config.message,
				style: 'message',
				margin: [ 0, 0, 0, 12 ]
			} );
		}

		if ( config.title ) {
			doc.content.unshift( {
				text: _title( config, false ),
				style: 'title',
				margin: [ 0, 0, 0, 12 ]
			} );
		}

		if ( config.customize ) {
			config.customize( doc, config );
		}

		var pdf = window.pdfMake.createPdf( doc );

		if ( config.download === 'open' && ! _isSafari() ) {
			pdf.open();
		}
		else {
			pdf.getBuffer( function (buffer) {
				var blob = new Blob( [buffer], {type:'application/pdf'} );

				_saveAs( blob, _filename( config ) );
			} );
		}
	},

	title: '*',

	filename: '*',

	extension: '.pdf',

	exportOptions: {},

	orientation: 'portrait',

	pageSize: 'A4',

	header: true,

	footer: false,

	message: null,

	customize: null,

	download: 'download'
};


return DataTable.Buttons;
}));
