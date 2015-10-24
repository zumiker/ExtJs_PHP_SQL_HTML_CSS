var xmlHttp

function TurChange(str)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 
 var url="ShowFac.php"
 url=url+"?tur="+str
 url=url+"&sid="+Math.random()

 xmlHttp.onreadystatechange=turChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}

function FacChange(str)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 
 var url="ShowConGroup.php"
 url=url+"?facid="+str
 url=url+"&sid="+Math.random()



 xmlHttp.onreadystatechange=congrChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}

function FacChange1(str)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 
 var url="ShowConGroup1.php"
 url=url+"?facid="+str
 url=url+"&sid="+Math.random()



 xmlHttp.onreadystatechange=congrChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}

function SaveDopusk(num)
{
	xmlHttp=GetXmlHttpObject()
 	if (xmlHttp==null)
  	{
  		alert ("Browser does not support HTTP Request")
  	return
  	}
  	
		var dop= new Array()
		var con= new Array()
  		var i=0
  		
	for(i=0;i<num;i++)
	{
		var dopi = document.getElementById('dop'+i)
		dop[i] = dopi.value
		coni = document.getElementById('con'+i)
		con[i]= coni.value
	}
	
 var url="SaveConGroups.php"
 url=url+"?con="+con
 url=url+"&dop="+dop
 url=url+"&sid="+Math.random()
 xmlHttp.onreadystatechange=calcChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 
 }
 
function Recalculate()
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
   //var podl = document.getElementById('podl')
   var tur = document.getElementById('fix_tur')
   var nab = document.getElementById('nab')
   if(tur.value==99 || nab.value==99)
   {
   	alert('Параметр не выбран')
   	return;
   }
   
 var url="recalculate.php"
 //url=url+"?podl=0"//+podl.value - считаются ВСЕ документы, без деления на подлинники
 url=url+"?nab="+nab.value
 url=url+"&tur="+tur.value
 url=url+"&sid="+Math.random()
 document.getElementById("calc").innerHTML="<center><img src='loader.gif'/></center>" 
 
 xmlHttp.onreadystatechange=calcChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}

function FixTur()
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }

   var tur = document.getElementById('fix_tur')
   if(fix_tur.value==99)
   {
   	alert('Параметр не выбран')
   	return;
   }
   
 var url="fix_tur.php"

 url=url+"?tur="+tur.value
 url=url+"&sid="+Math.random()
 document.getElementById("calc").innerHTML="<center><img src='loader.gif'/></center>" 
 
 xmlHttp.onreadystatechange=turChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}


function GetReportFac(str)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 
 

 var fac = document.getElementById('fac')
 
var pdf = document.getElementById('pdf')
 if(pdf.checked==1)
 {
 	pdf='p'
 }
 else
 {
 	pdf='p'
 }
 
 var url="report"+pdf+".php"
 url=url+"?id_fac="+fac.value
 url=url+"&nabor="+str
 url=url+"&sid="+Math.random()
window.open(url)

}

function GetReportConPodval(str1,str2)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 
 var con = document.getElementById('id_con')
 var tur = document.getElementById('id_tur')
 
var pdf = document.getElementById('pdf')
 if(pdf.checked==1)
 {
 	pdf='p'
 }
 else
 {
 	pdf='p'
 }
 
 //var url="report"+pdf+".php"
 var url="reportp_podval.php"
 url=url+"?id_con="+con.value
 url=url+"&nabor="+str1
 url=url+"&podl="+str2
 url=url+"&tur="+tur.value
 url=url+"&sid="+Math.random()
window.open(url)

}

function GetReportCon(str1,str2)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 
 var con = document.getElementById('id_con')
 var tur = document.getElementById('id_tur')
 
 //var fac = document.getElementById('fac')

  var pdf = document.getElementById('pdf')
 if(pdf.checked==1)
 {
 	pdf='p'
 }
 else
 {
 	pdf='p'
 }
 
//var url="report"+pdf+".php"
//var url="reportp.php"


//var url="ind.php"

var url="report"+pdf+".php"
var url="reportp.php"
 

url=url+"?id_con="+con.value
url=url+"&nabor="+str1
url=url+"&podl="+str2
url=url+"&tur="+tur.value
url=url+"&sid="+Math.random()

window.open(url)
}

function GetReportCon1(str)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 
 var con = document.getElementById('id_con')
 var tur = document.getElementById('id_tur') 
 
var pdf = document.getElementById('pdf')
 if(pdf.checked==1)
 {
 	pdf='p'
 }
 else
 {
 	pdf='p'
 }
 
 var url="reportphone.php"
 url=url+"?id_con="+con.value
 url=url+"&nabor="+str
 url=url+"&tur="+tur.value
 url=url+"&sid="+Math.random()
window.open(url)

}
function GetReportConEx(str1,str2)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 
 var con = document.getElementById('id_con')
  var tur = document.getElementById('id_tur')
 
var pdf = document.getElementById('pdf')
 if(pdf.checked==1)
 {
 	pdf='p'
 }
 else
 {
 	pdf='p'
 }
 
 var url="excel.php"
 url=url+"?id_con="+con.value
 url=url+"&nabor="+str1
 url=url+"&podl="+str2
 url=url+"&tur="+tur.value
 url=url+"&sid="+Math.random()
window.open(url)

}
function GetReportSpec(str)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 

 var con = document.getElementById('id_spec')
 
var pdf = document.getElementById('pdf')
 if(pdf.checked==1)
 {
 	pdf='p'
 }
 else
 {
 	pdf='p'
 }
 
 //var url="report"+pdf+".php"
 var url="report.php"
 url=url+"?id_spec="+con.value
 url=url+"&nabor="+str
 url=url+"&sid="+Math.random()
window.open(url)



}

function GetReportPred(str)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
  

 var fac = document.getElementById('fac')
// var con = document.getElementById('id_con')
// var spec = document.getElementById('id_spec')
 var pred = document.getElementById('id_pr')
 
var pdf = document.getElementById('pdf')
 if(pdf.checked==1)
 {
 	pdf='p'
 }
 else
 {
 	pdf='p'
 }
 
 //var url="report"+pdf+".php"
 var url="report.php"
 url=url+"?id_fac="+fac.value
// url=url+"&id_con="+con.value
// url=url+"&id_spec="+spec.value
 url=url+"&id_pr="+pred.value
 url=url+"&nabor="+str
 url=url+"&sid="+Math.random()
window.open(url)
}

function ConGrChange(str)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 

 var url="ShowSpec.php"
 url=url+"?id_con="+str
 url=url+"&sid="+Math.random()
 xmlHttp.onreadystatechange=specChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}

/*function SpecChange(str)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 

 var url="ShowPred.php"
 url=url+"?id_con="+str
 url=url+"&sid="+Math.random()
 xmlHttp.onreadystatechange=predChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}*/

function InputYear()
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }

 var year = document.getElementById('year')

 var url="Spec/Fac/ShowFac.php"
 url=url+"?year="+year.value
 url=url+"&sid="+Math.random()

 xmlHttp.onreadystatechange=FacChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}
function calcChanged() 
 { 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  { 

document.getElementById("calc")

  .innerHTML=xmlHttp.responseText 
  } 
 }
 
 function turChanged() 
 { 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  { 

document.getElementById("id_tur")

  .innerHTML=xmlHttp.responseText 
  } 
 }

function congrChanged() 
 { 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  { 

document.getElementById("congr")

  .innerHTML=xmlHttp.responseText 
  } 
 }
 
 function specChanged() 
 { 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  { 

document.getElementById("spec")

  .innerHTML=xmlHttp.responseText 
  } 
 }
 
 /* function predChanged() 
 { 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  { 

document.getElementById("pred")

  .innerHTML=xmlHttp.responseText 
  } 
 }*/
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