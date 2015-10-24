var xmlHttp
var item;
function menuOver(itemName,ocolor){
item=itemName;
itemName.style.backgroundColor = ocolor; //background color change on mouse over

}

function menuOut(itemName,ocolor){
if(item)
itemName.style.backgroundColor = ocolor;

}

function OpenNag(divid)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
  if (confirm("Уверены, что хотите открыть нагрузку?")) {
	
	}
else {
	return;
	}

 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var kafedra = document.getElementById("fac")

 var url="Add/OpenNag.php"
 url=url+"?kafedra="+divid
 url=url+"&god="+god.value
 url=url+"&semestr="+semestr.value
 url=url+"&fac="+fac.value
 url=url+"&sid="+Math.random()

 document.getElementById("text").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged 
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 
 }
 
 function GetNag(divid)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
  if (confirm("Уверены, что хотите принять нагрузку?")) {
	
	}
else {
	return;
	}

 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var kafedra = document.getElementById("fac")

 var url="Add/GetNag.php"
 url=url+"?kafedra="+divid
 url=url+"&god="+god.value
 url=url+"&semestr="+semestr.value
 url=url+"&fac="+fac.value
 url=url+"&sid="+Math.random()

 document.getElementById("text").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged 
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 
 }
 
 function BackNag(divid)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
  if (confirm("Уверены, что хотите вернуть нагрузку?")) {
	
	}
else {
	return;
	}

 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var kafedra = document.getElementById("fac")

 var url="Add/BackNag.php"
 url=url+"?kafedra="+divid
 url=url+"&god="+god.value
 url=url+"&semestr="+semestr.value
 url=url+"&fac="+fac.value
 url=url+"&sid="+Math.random()

 document.getElementById("text").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged 
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 
 }
 
function checkAll(check,num) {
var i=0
for (i=0;i<num;i++) {
     if (check) { 
        document.forms['check'].check[i].checked=true
        }
     else {
        document.forms['check'].check[i].checked=false
        }
     }
	 ShowPrepods(num)
   }

function AddPrepF(manid,kaf)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 
 var n2 = document.getElementById("n2")
 var n3 = document.getElementById("n3")
 var n4 = document.getElementById("n4")
 var n6 = document.getElementById("n6")
 var n8 = document.getElementById("n8")
 var n9 = document.getElementById("n9")
 var n10 = document.getElementById("n10")
 var n11 = document.getElementById("n11")
 var n12 = document.getElementById("n12")
 var n15 = document.getElementById("n15")
 var n16 = document.getElementById("n16")
 var n17 = document.getElementById("n17")
 var n18 = document.getElementById("n18")
 var n19 = document.getElementById("n19")
 var n20 = document.getElementById("n20")
 var n22 = document.getElementById("n22")
 var n23 = document.getElementById("n23")
 var n24 = document.getElementById("n24")
 var prim = document.getElementById("prim")


var url="Add/AddPrepF.php"
 url=url+"?manid="+manid
 url=url+"&god="+god.value
 url=url+"&semestr="+semestr.value
 url=url+"&kafedra="+kaf
 url=url+"&n2="+n2.value
 url=url+"&n3="+n3.value
 url=url+"&n4="+n4.value
 url=url+"&n6="+n6.value
 url=url+"&n8="+n8.value
 url=url+"&n9="+n9.value
 url=url+"&n10="+n10.value
 url=url+"&n11="+n11.value
 url=url+"&n12="+n12.value
 url=url+"&n15="+n15.value
 url=url+"&n16="+n16.value
 url=url+"&n17="+n17.value
 url=url+"&n18="+n18.value
 url=url+"&n19="+n19.value
 url=url+"&n20="+n20.value
 url=url+"&n22="+n22.value
 url=url+"&n23="+n23.value
 url=url+"&n24="+n24.value
 url=url+"&prim="+prim.value

 document.getElementById("text3").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged3 
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}

function AddPrep(manid,kaf)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 
 var n9 = document.getElementById("n9")
 var n10 = document.getElementById("n10")
 var n11 = document.getElementById("n11")
 var n12 = document.getElementById("n12")
 var n15 = document.getElementById("n15")
 var n16 = document.getElementById("n16")
 var n17 = document.getElementById("n17")
 var n18 = document.getElementById("n18")
 var n19 = document.getElementById("n19")
 var n20 = document.getElementById("n20")
 var n22 = document.getElementById("n22")
 var n23 = document.getElementById("n23")
 var n24 = document.getElementById("n24")
 var prim = document.getElementById("prim")


var url="Add/AddPrep.php"
 url=url+"?manid="+manid
 url=url+"&god="+god.value
 url=url+"&semestr="+semestr.value
 url=url+"&kafedra="+kaf
 url=url+"&n9="+n9.value
 url=url+"&n10="+n10.value
 url=url+"&n11="+n11.value
 url=url+"&n12="+n12.value
 url=url+"&n15="+n15.value
 url=url+"&n16="+n16.value
 url=url+"&n17="+n17.value
 url=url+"&n18="+n18.value
 url=url+"&n19="+n19.value
 url=url+"&n20="+n20.value
 url=url+"&n22="+n22.value
 url=url+"&n23="+n23.value
 url=url+"&n24="+n24.value
 url=url+"&prim="+prim.value

 document.getElementById("text3").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged3 
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}

function ShowFactPlan(manid,kaf,god,sem)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 /*var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var kafedra = document.getElementById("kafedra")
 */

var url="step21.php"
 url=url+"?manid="+manid
 url=url+"&god="+god
 url=url+"&semestr="+sem
 url=url+"&kafedra="+kaf
 url=url+"&sid="+Math.random()
 
 document.getElementById("text2").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged2 
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}

function ShowPrepodF(manid,kaf,god,sem)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 /*var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var kafedra = document.getElementById("kafedra")
 */

var url="step2-1F.php"
 url=url+"?manid="+manid
 url=url+"&god="+god
 url=url+"&semestr="+sem
 url=url+"&kafedra="+kaf
 url=url+"&sid="+Math.random()
 
 document.getElementById("text3").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged3 
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}

function ShowPrepod(manid,kaf,god,sem)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 /*var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var kafedra = document.getElementById("kafedra")
 */

var url="step2-1.php"
 url=url+"?manid="+manid
 url=url+"&god="+god
 url=url+"&semestr="+sem
 url=url+"&kafedra="+kaf
 url=url+"&sid="+Math.random()
 
 document.getElementById("text3").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged3 
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}
function ShowPrepods(str,labnum)
 { 

 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }

	var i=0
	var groupnum=0;
	var groups=new Array()



	for (i=0;i<str;i++)
	{
		var id = "check"+i
	
		var check = document.getElementById(id)
		if(check.checked==true)
		{
			groups[i]= document.getElementById(id).value
			groupnum++;
		}
	}
	
 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var kafedra = document.getElementById("kafedra")
 var kurs = document.getElementById("kurs")
 var kod = document.getElementById("kod")
 
 var url="step4.php"
 url=url+"?kurs="+kurs.value
 url=url+"&god="+god.value
 url=url+"&semestr="+semestr.value
 url=url+"&kafedra="+kafedra.value
 url=url+"&kod="+kod.value
 url=url+"&groupnum="+groupnum
 url=url+"&groups="+groups
 url=url+"&labnum="+labnum
 url=url+"&str="+str
 url=url+"&sid="+Math.random()
 
document.getElementById("text4").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged4
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 }

function ShowRasp(kaf,god,sem)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }

 var url="ShowRasp.php"
 url=url+"?kaf="+kaf
 url=url+"&god="+god
 url=url+"&sem="+sem
 url=url+"&sid="+Math.random()

 window.open(url)
 /*document.getElementById("text3").innerHTML="<center><br/><img src='loading.gif'/></center>"
 document.getElementById("text4").innerHTML="<center><br/></center>"
 xmlHttp.onreadystatechange=stateChanged3
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)*/
 
 }
 
function ShowRaspExcel()
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }

 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var kaf = document.getElementById("kaf")

if(god.value==0)
{
	alert('Выберите год!')
	return;
}
if(semestr.value==0)
{
	alert('Выберите семестр!')
	return;
}
 var url="excel_kaf.php"
 url=url+"?kaf="+kaf.value
 url=url+"&god="+god.value
 url=url+"&sem="+semestr.value

 url=url+"&sid="+Math.random()

 window.open(url)
 /*document.getElementById("text3").innerHTML="<center><br/><img src='loading.gif'/></center>"
 document.getElementById("text4").innerHTML="<center><br/></center>"
 xmlHttp.onreadystatechange=stateChanged3
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)*/
 
 }


function ShowGroup(kod)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var kafedra = document.getElementById("kafedra")
 var kurs = document.getElementById("kurs")
 var url="step3.php"
 url=url+"?kurs="+kurs.value
 url=url+"&god="+god.value
 url=url+"&semestr="+semestr.value
 url=url+"&kafedra="+kafedra.value
 url=url+"&kod="+kod
 url=url+"&sid="+Math.random()
 document.getElementById("text3").innerHTML="<center><br/><img src='loading.gif'/></center>"
 document.getElementById("text4").innerHTML="<center><br/></center>"
 xmlHttp.onreadystatechange=stateChanged3
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 }

function AddLec(nagid,str)
 { 
xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
	var i=0
	var nagsnum=0;
	var nags=new Array()
	for (i=0;i<=nagid;i++)
	{
	   try{
     	var id = "nag"+i
		var check = document.getElementById(id)
		nags[nagsnum]= check.value
		nagsnum++
	    }
	  catch(e)
	  {
	
	  }
	}

 var potok = document.getElementById("potok")
 var lect = document.getElementById("lect")
 var lecroom = document.getElementById("lecroom")

 var url="Add/AddLec.php"
 url=url+"?nags="+nags
 url=url+"&manid="+lect.value
 url=url+"&room_lec="+lecroom.value
 if(potok)
 {
 	if(potok.checked) url=url+"&potok=1"
	else url=url+"&potok=2"
 }
 url=url+"&str="+str
 url=url+"&sid="+Math.random()
 
 document.getElementById("text5").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged5
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 }

function AddLab2(onenagid,str,num,semid)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
	var groupnum=0;
	var groups=new Array()



	for (i=0;i<str;i++)
	{
		var id = "check"+i
	
		var check = document.getElementById(id)
		if(check.checked==true)
		{
			groups[i]= document.getElementById(id).value
			groupnum++;
		}
	}
		
 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var kafedra = document.getElementById("kafedra")
 var kurs = document.getElementById("kurs")
 var kod = document.getElementById("kod")
 var id = "lab"+num
 var sem = document.getElementById(id)
 var id = "labroom"+num
 var semroom = document.getElementById(id)
 
 var url="Add/AddLab2.php"
 url=url+"?nagid="+onenagid
 url=url+"&manid="+sem.value
 url=url+"&semid="+semid 
 url=url+"&room_sem="+semroom.value
 url=url+"&str="+str
 url=url+"&kurs="+kurs.value
 url=url+"&god="+god.value
 url=url+"&semestr="+semestr.value
 url=url+"&kafedra="+kafedra.value
 url=url+"&kod="+kod.value
 url=url+"&groupnum="+groupnum
 url=url+"&groups="+groups
 url=url+"&sid="+Math.random()

document.getElementById("text4").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged4
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 }

function AddSem2(onenagid,str,num,semid)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
	var groupnum=0;
	var groups=new Array()



	for (i=0;i<str;i++)
	{
		var id = "check"+i
	
		var check = document.getElementById(id)
		if(check.checked==true)
		{
			groups[i]= document.getElementById(id).value
			groupnum++;
		}
	}
		
 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var kafedra = document.getElementById("kafedra")
 var kurs = document.getElementById("kurs")
 var kod = document.getElementById("kod")
 var id = "sem"+num
 var sem = document.getElementById(id)
 var id = "semroom"+num
 var semroom = document.getElementById(id)
 
 var url="Add/AddSem2.php"
 url=url+"?nagid="+onenagid
 url=url+"&manid="+sem.value
 url=url+"&semid="+semid 
 url=url+"&room_sem="+semroom.value
 url=url+"&str="+str
 url=url+"&kurs="+kurs.value
 url=url+"&god="+god.value
 url=url+"&semestr="+semestr.value
 url=url+"&kafedra="+kafedra.value
 url=url+"&kod="+kod.value
 url=url+"&groupnum="+groupnum
 url=url+"&groups="+groups
 url=url+"&sid="+Math.random()

document.getElementById("text4").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged4
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 }


function AddSem(nagid,str)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
	
	var i=0
	var nagsnum=0;
	var nags=new Array()
	for (i=0;i<=nagid;i++)
	{
	   try{
     	var id = "nag"+i
     	
		var check = document.getElementById(id)
		nags[nagsnum]= check.value
		
		nagsnum++
	    }
	  catch(e){
		}
	}
	
 var sem = document.getElementById("sem")
 var semroom = document.getElementById("semroom")
 var url="Add/AddSem.php"
 url=url+"?nags="+nags
 url=url+"&manid="+sem.value
 url=url+"&room_sem="+semroom.value
 url=url+"&str="+str
 url=url+"&sid="+Math.random()
 
document.getElementById("text5").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged5
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 }

function AddPrim(nagid,str)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
	
	var i=0
	var nagsnum=0;
	var nags=new Array()
	for (i=0;i<=nagid;i++)
	{
	   try{
     	var id = "nag"+i
     	
		var check = document.getElementById(id)
		nags[nagsnum]= check.value
		
		nagsnum++
	    }
	  catch(e){
		}
	}
	
var prim = document.getElementById("prim")
if(encodeURIComponent)
{
	PRIMUTF=encodeURIComponent(prim.value)
}
else
{
	PRIMUTF=escape(prim.value)
}
		
 var url="Add/AddPrim.php"
 url=url+"?nags="+nags
 url=url+"&prim="+PRIMUTF
 url=url+"&str="+str
 url=url+"&sid="+Math.random()

document.getElementById("text5").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged5
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 }
function AddLab(onenagid,num,labid,str)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
		
 
 var id = "lab"+num
 var lab = document.getElementById(id)

 var ids = "labroom"+num

 var labroom = document.getElementById(ids)

 var url="Add/AddLab.php"
 url=url+"?nag="+onenagid
 url=url+"&manid="+lab.value
 url=url+"&room="+labroom.value
 url=url+"&labid="+labid
 url=url+"&str="+str
 url=url+"&sid="+Math.random()
 document.getElementById("text5").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged5
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 }
 
function AddKolweeks(d1,d2,kod,sw,kw)
{
  xmlHttp=GetXmlHttpObject()
  if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
	
	var kolweeks = document.getElementById("kolweeks")
	var god = document.getElementById("god")
 	var semestr = document.getElementById("semestr")
 	
 	if(kw<kolweeks.value)
 	{
 	alert('Кол-во недель превышает допустимое! Запись не сохранена!');
 	return;
 	}
 	
		
 	var url="Add/AddKolweeks.php"
 	url=url+"?d1="+d1
 	url=url+"&d2="+d2
 	url=url+"&kod="+kod
 	url=url+"&sw="+sw
 	url=url+"&kolw="+kolweeks.value
 	url=url+"&god="+god.value
 	url=url+"&semestr="+semestr.value
 	
 	
 	url=url+"&sid="+Math.random()
 	
 	document.getElementById("text6").innerHTML="<center><br/><img src='loading.gif'/></center>"
 	
 	xmlHttp.onreadystatechange=stateChanged6
 	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)
}
function AddRep(onenagid,num,oldprep,str,numz)
 { 
 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 if(oldprep==999)
 oldprep=0;

 if(num==999)
 num='';
 var id = "prep"+num
 var prepid = document.getElementById(id)
 var sum = 0
 var v1 = document.getElementById("v1")
 var v2 = document.getElementById("v2")
 var v3 = document.getElementById("v3")
 var v4 = document.getElementById("v4")
 var v5 = document.getElementById("v5")
 var v7 = document.getElementById("v7")
 
var rep1 = document.getElementById("rep1")
var rep2 = document.getElementById("rep2")
var rep3 = document.getElementById("rep3")
var rep4 = document.getElementById("rep4")
var rep5 = document.getElementById("rep5")
var rep7 = document.getElementById("rep7")
var i=0;
  
 if(v1.value>0){
 
 for(i=0;i<numz;i++)
 {	
 
	id = "rep1"+i

 	var ttt = document.getElementById(id) 	
 	sum =  (sum*1) + (ttt.value*1)

 }
if(((sum*1)+(rep1.value*1))>v1.value)
{
 
alert('Сумма часов экзамена превышает допустимую, запись не сохранена!');
 return;
} 
}
 
 if(v2.value>0){
 sum=0;
 for(i=0;i<numz;i++)
 {	
	id = "rep2"+i

 	var ttt = document.getElementById(id)
 	
 	sum =  (sum*1) + (ttt.value*1)
 }
if(((sum*1)+(rep2.value*1))>v2.value)
 {
alert('Сумма часов диф.зачёта превышает допустимую, запись не сохранена!');
 	return;
 }
}

if(v3.value>0){
 sum=0;
 for(i=0;i<numz;i++)
 {	
 
	id = "rep3"+i

 	var ttt = document.getElementById(id)
 	
 	sum =  (sum*1) + (ttt.value*1)

 }
if(((sum*1)+(rep3.value*1))>v3.value)
 {
alert('Сумма часов зачёта превышает допустимую, запись не сохранена!');
 	return;
 }
}

if(v4.value>0){
 sum=0;
 for(i=0;i<numz;i++)
 {	
 
	id = "rep4"+i

 	var ttt = document.getElementById(id)
 	
 	sum =  (sum*1) + (ttt.value*1)

 }
if(((sum*1)+(rep4.value*1))>v4.value)
 {
alert('Сумма часов превышает допустимую, запись не сохранена!');
 	return;
 }
 }
 
 
if(v5.value>0){
  sum=0;
 for(i=0;i<numz;i++)
 {	
 
	id = "rep5"+i

 	var ttt = document.getElementById(id)
 	
 	sum =  (sum*1) + (ttt.value*1)

 }
if(((sum*1)+(rep5.value*1))>v5.value)
 {
alert('Сумма часов превышает допустимую, запись не сохранена!');
 	return;
 }
}

if(v7.value>0){
  sum=0;
 for(i=0;i<numz;i++)
 {	
 
	id = "rep7"+i

 	var ttt = document.getElementById(id)
 	
 	sum =  (sum*1) + (ttt.value*1)

 }
if(((sum*1)+(rep7.value*1))>v7.value)
 {
alert('Сумма часов превышает допустимую, запись не сохранена!');
 	return;
 }
 }
 
  id = "rep1"+num
 var rep1 = document.getElementById(id)
  id = "rep2"+num
 var rep2 = document.getElementById(id)
  id = "rep3"+num
 var rep3 = document.getElementById(id)
  id = "rep4"+num
 var rep4 = document.getElementById(id)
  id = "rep5"+num
 var rep5 = document.getElementById(id)
  id = "rep7"+num
 var rep7 = document.getElementById(id)
  
 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var kafedra = document.getElementById("kafedra")
 var kurs = document.getElementById("kurs")
 var kod = document.getElementById("kod")
 
 i=0
	var groupnum=0;
	var groups=new Array()



	for (i=0;i<str;i++)
	{
		var id = "check"+i
	
		var check = document.getElementById(id)
		if(check.checked==true)
		{
			groups[i]= document.getElementById(id).value
			groupnum++;
		}
	}
 
 var url="Add/AddRep.php"
 url=url+"?nag="+onenagid
 url=url+"&prepid="+prepid.value
 url=url+"&oldprep="+oldprep
 url=url+"&str="+str 
 url=url+"&rep1="+rep1.value
 url=url+"&rep2="+rep2.value
 url=url+"&rep3="+rep3.value
 url=url+"&rep4="+rep4.value
 url=url+"&rep5="+rep5.value
 url=url+"&rep7="+rep7.value
 url=url+"&kurs="+kurs.value
 url=url+"&god="+god.value
 url=url+"&semestr="+semestr.value
 url=url+"&kafedra="+kafedra.value
 url=url+"&kod="+kod.value
 url=url+"&groupnum="+groupnum
 url=url+"&groups="+groups
 
 
 
 document.getElementById("text4").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged4
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 }




function ShowPredmet(kurs)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var kafedra = document.getElementById("kafedra")

var url="step2.php"
 url=url+"?kurs="+kurs
 url=url+"&god="+god.value
 url=url+"&semestr="+semestr.value
 url=url+"&kafedra="+kafedra.value
 url=url+"&sid="+Math.random()
 document.getElementById("text2").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged2 
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 }

function ShowRaspPrepods()
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }

 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var fac = document.getElementById("fac")
if(god.value==0)
{
	alert('Выберите год!')
	return;
}
if(semestr.value==0)
{
	alert('Выберите семеcтр!')
	return;
}
 var url="ShowRaspPrepods.php"
 url=url+"?fac="+fac.value
 url=url+"&god="+god.value
 url=url+"&sem="+semestr.value

 url=url+"&sid="+Math.random()

 window.open(url)
 /*document.getElementById("text3").innerHTML="<center><br/><img src='loading.gif'/></center>"
 document.getElementById("text4").innerHTML="<center><br/></center>"
 xmlHttp.onreadystatechange=stateChanged3
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)*/
 
 }
 
 function ShowRaspPrepodsExcel()
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }

 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var fac = document.getElementById("fac")
if(god.value==0)
{
	alert('Выберите год!')
	return;
}
if(semestr.value==0)
{
	alert('Выберите семеcтр!')
	return;
}
 var url="excel_prepod_rasp.php"
 url=url+"?fac="+fac.value

 url=url+"&sid="+Math.random()

 window.open(url)
 /*document.getElementById("text3").innerHTML="<center><br/><img src='loading.gif'/></center>"
 document.getElementById("text4").innerHTML="<center><br/></center>"
 xmlHttp.onreadystatechange=stateChanged3
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)*/
 
 }

function ShowRaspExcelFull()
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }

 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var fac = document.getElementById("fac")
if(god.value==0)
{
	alert('Выберите год!')
	return;
}
if(semestr.value==0)
{
	alert('Выберите семестр!')
	return;
}
 var url="excel/excel_fac.php"
 url=url+"?fac="+fac.value
 url=url+"&god="+god.value
 url=url+"&sem="+semestr.value

 url=url+"&sid="+Math.random()

 window.open(url)
 /*document.getElementById("text3").innerHTML="<center><br/><img src='loading.gif'/></center>"
 document.getElementById("text4").innerHTML="<center><br/></center>"
 xmlHttp.onreadystatechange=stateChanged3
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)*/
 
 }
 
 function ShowPlanPPS()
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }

 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var fac = document.getElementById("fac")
if(god.value==0)
{
	alert('Выберите год!')
	return;
}

 var url="excel/excel_pps.php"
 url=url+"?fac="+fac.value
 url=url+"&god="+god.value
 url=url+"&sem="+semestr.value

 url=url+"&sid="+Math.random()

 window.open(url)
 }
 
 function ShowRaspShtat()
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }

 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var fac = document.getElementById("fac")
if(god.value==0)
{
	alert('Выберите год!')
	return;
}
if(semestr.value==0)
{
	alert('Выберите семестр!')
	return;
}
if(fac.value==999)
{
	alert('Выберите факультет!')
	return;
}
 var url="excel/excel_kaf.php"
 url=url+"?fac="+fac.value
 url=url+"&god="+god.value
 url=url+"&sem="+semestr.value

 url=url+"&sid="+Math.random()

 window.open(url)
 }
 
 function ShowRaspPochas()
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }

 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var fac = document.getElementById("fac")
if(god.value==0)
{
	alert('Выберите год!')
	return;
}
if(semestr.value==0)
{
	alert('Выберите семестр!')
	return;
}
if(fac.value==999)
{
	alert('Выберите факультет!')
	return;
}
 var url="excel_fac_pochas.php"
 url=url+"?fac="+fac.value
 url=url+"&god="+god.value
 url=url+"&sem="+semestr.value

 url=url+"&sid="+Math.random()

 window.open(url)
 }
 
 function ShowRaspSovm()
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }

 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var fac = document.getElementById("fac")
if(god.value==0)
{
	alert('Выберите год!')
	return;
}
if(semestr.value==0)
{
	alert('Выберите семестр!')
	return;
}
if(fac.value==999)
{
	alert('Выберите факультет!')
	return;
}
 var url="excel_fac_sovm.php"
 url=url+"?fac="+fac.value
 url=url+"&god="+god.value
 url=url+"&sem="+semestr.value

 url=url+"&sid="+Math.random()

 window.open(url)
 }
 
 
 function ShowRaspExcelItog()
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }

 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var fac = document.getElementById("fac")
if(god.value==0)
{
	alert('Выберите год!')
	return;
}
if(semestr.value==0)
{
	alert('Выберите семестр!')
	return;
}
 var url="excel_itog.php"
 url=url+"?fac="+fac.value
 url=url+"&god="+god.value
 url=url+"&sem="+semestr.value

 url=url+"&sid="+Math.random()

 window.open(url)
 /*document.getElementById("text3").innerHTML="<center><br/><img src='loading.gif'/></center>"
 document.getElementById("text4").innerHTML="<center><br/></center>"
 xmlHttp.onreadystatechange=stateChanged3
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)*/
 
 }
function ShowFac(fac)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 if(fac==999)
 {
 	 document.getElementById("text").innerHTML=""
 	 return
 }
 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var url="step1.php"
 url=url+"?fac="+fac
 url=url+"&god="+god.value
 url=url+"&semestr="+semestr.value
 url=url+"&sid="+Math.random()
 document.getElementById("text").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged 
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 }

function ShowKurs(kafedra)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 
 var god = document.getElementById("god")
 var semestr = document.getElementById("semestr")
 var url="step1.php"
 url=url+"?kafedra="+kafedra
 url=url+"&god="+god.value
 url=url+"&semestr="+semestr.value
 url=url+"&sid="+Math.random()
 document.getElementById("text").innerHTML="<center><br/><img src='loading.gif'/></center>"
 xmlHttp.onreadystatechange=stateChanged 
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 }

function stateChanged() 
 { 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  { 
  document.getElementById("text")
  .innerHTML=xmlHttp.responseText 
  } 
 }
 
 function stateChanged2() 
 { 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  { 
  document.getElementById("text2")
  .innerHTML=xmlHttp.responseText 
  } 
 }
 
  function stateChanged3() 
 { 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  { 
  document.getElementById("text3")
  .innerHTML=xmlHttp.responseText 
  } 
 }

  function stateChanged4() 
 { 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  { 
  document.getElementById("text4")
  .innerHTML=xmlHttp.responseText 
  } 
 }
 
  function stateChanged5() 
 { 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  { 
  document.getElementById("text5")
  .innerHTML=xmlHttp.responseText 
  } 
 }
  
  function stateChanged6() 
 { 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  { 
  document.getElementById("text6")
  .innerHTML=xmlHttp.responseText 
  } 
 }

function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 // Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}

    function pageLoad() {
    
        xmlHttp = false;
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                xmlHttp = false;
            }
        }
        if (!xmlHttp && typeof XMLHttpRequest != 'undefined')
          xmlHttp = new XMLHttpRequest();
        if (!xmlHttp)
          return;
        xmlHttp.open("GET", "?ajax", true);
        xmlHttp.send(null);
    } 
    
    

var Utf8 = {

    // public method for url encoding
    encode : function (string) {
        string = string.replace(/\r\n/g,"\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

    // public method for url decoding
    decode : function (utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while ( i < utftext.length ) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i+1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i+1);
                c3 = utftext.charCodeAt(i+2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

}

