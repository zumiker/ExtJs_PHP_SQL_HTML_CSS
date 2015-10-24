var xmlHttp

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

var facs = document.getElementById('facs')
//facs.innerHTML = "<button onClick='GetReportFac()'>получить отчёт</button>"
facs.innerHTML = "<button onClick='GetReportFac(1,undefined)'>(Бюд.)</button>"
facs.innerHTML += "<button onClick='GetReportFac(2,undefined)'>(Цел.)</button>"
facs.innerHTML += "<button onClick='GetReportFac(3,undefined)'>(Ком.)</button>"
//facs.innerHTML += "<button onClick='GetReportFac(undefined,1)'>Только медалисты</button>"
//facs.innerHTML += "<button onClick='GetReportFac(undefined,2)'>Без медалистов</button>"

 xmlHttp.onreadystatechange=congrChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}
function GetReportFac(str, medal)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 
 

var fac = document.getElementById('fac')
/*var medal = window.document.form_1.radios

for (i=0;i<medal.length;i++) 
{  if (medal[i].checked) 
{   
var medalist = medal[i].value;  
} 
} */

 var url="in_pdf.php"
 url=url+"?id_fac="+fac.value
 url=url+"&medal="+medal
 url=url+"&nabor="+str
 url=url+"&sid="+Math.random()
 window.open(url)

}

function GetReportCon(str,medal)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }

 var con = document.getElementById('id_con')
 
var pdf = document.getElementById('pdf')

 
 var url="in_pdf.php"
 url=url+"?id_con="+con.value
 url=url+"&medal="+medal
 url=url+"&nabor="+str
 url=url+"&sid="+Math.random()
window.open(url)

}
function GetReportSpec(str,medal)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 

 var con = document.getElementById('id_spec')
 
var pdf = document.getElementById('pdf')

 
 var url="in_pdf.php"
 url=url+"?id_spec="+con.value
 url=url+"&medal="+medal
 url=url+"&nabor="+str
 url=url+"&sid="+Math.random()
window.open(url)



}

function GetReportAbi(str)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
  
 var con = document.getElementById('id_spec')
var abi = document.getElementById('id_abi')
 
 var url="in_pdf.php"
 url=url+"?id_abi="+abi.value
 url=url+"&id_spec="+con.value
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

function SpecChange(str)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 var url="ShowAbi.php"
 url=url+"?id_spec="+str
 url=url+"&sid="+Math.random()
 xmlHttp.onreadystatechange=abiChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}

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
 
function abiChanged() 
 { 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  { 

document.getElementById("abi")

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