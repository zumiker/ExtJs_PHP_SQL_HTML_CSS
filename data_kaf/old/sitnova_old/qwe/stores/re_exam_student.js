var re_exam_student =  new Ext.data.Store
({
	url: 'php/get_student.php',
	reader: new Ext.data.JsonReader({
		root:'rows',
		fields:['student_id','fio_full']
	}),
	autoLoad: false
}); 