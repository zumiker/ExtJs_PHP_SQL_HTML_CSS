/*------------------------------------------------------------------*/
Ext.define('mGroup',
{
	extend:'Ext.data.Model',
	fields:
	[
		{name:'GROCODE'},
		{name:'GROID'}
	]
});  
var sGroup=Ext.create('Ext.data.JsonStore',
{
	model:'mGroup',
	autoLoad:false,
	proxy: 
	{
		type:'ajax', 
		url:'php/get_group.php',
		reader: 
		{
			type:'json',
			root:'rows'
		}
	}
});

Ext.define('mStudents',
{
	extend:'Ext.data.Model',
	idProperty:'STUDENT_ID',
	fields:
	[
		{name:'STUDENT_ID'},
		{name:'FIO_FULL'},
		{name:'NA_OTPUSK', type: 'int'},
		{name: 'NOT_FORM', type: 'boolean'},
		{name: 'NOT_SPEC', type: 'boolean'},
		{name: 'MANID_PREDSEDATEL'}
	]
});  
var sStudents=Ext.create('Ext.data.JsonStore',
{
	model:'mStudents',
	autoLoad:false,
	autoSync:true,
	proxy: 
	{
		type:'ajax',
		api:
		{
			read:'php/get_spisok.php',
			update:'php/update.php'
		},
		reader: 
		{
			type:'json',
			root:'rows'
		},
		writer: 
		{
			type:'json',
			writeAllFields:true
		}
	}
});
var cOtpusk=Ext.create('Ext.data.Store',
{
	idProperty:'value',
	fields:
	[
		{name:'data'},
		{name:'value', type: 'int'}
	],
	data:
	[
		{
			data:	"без предоставления общежития",
			value:1
		},
		{
			data:	"с предоставлением общежития",
			value:2
		},
		{
			data:	"нет",
			value:0
		}
	]
});
Ext.define('ListPredsedM',
{
	extend:'Ext.data.Model',
	idProperty:'MANID',
	fields:
	[
		{name:'MANID'},
		//{name:'FACID'},
		{name:'PRED'}
	]
}); 
var ListPredsedSt=Ext.create('Ext.data.JsonStore',
{
	model:'ListPredsedM',
	autoLoad:true,
	proxy: 
	{
		type:'ajax', 
		url:'php/get_predsedatel.php',
		reader: 
		{
			type:'json',
			root:'rows'
		}
	}
});
 
