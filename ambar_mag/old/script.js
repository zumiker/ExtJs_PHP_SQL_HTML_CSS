var xmlHttp

function FacChange(str)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 
 //var url="ShowConGroup.php"
 //url=url+"?facid="+str
 //url=url+"&sid="+Math.random()

var facs = document.getElementById('facs')
facs.innerHTML = "<button onClick='GetReportFac()'>Все</button>"
facs.innerHTML += "<button onClick='GetReportFac(1)'>(Бюд.)</button>"
facs.innerHTML += "<button onClick='GetReportFac(2)'>(Цел.)</button>"
facs.innerHTML += "<button onClick='GetReportFac(3)'>(Ком.)</button>"
facs.innerHTML += "<button onClick='GetReportFac(4)'>(Иностр.)</button>"
 xmlHttp.onreadystatechange=congrChanged
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
 
 
 var start = document.getElementById('start')
 var end = document.getElementById('end')
 var fac = document.getElementById('fac')
 var pdf = document.getElementById('pdf')
 var sort1 = document.getElementById('sort1')
 //var sort = document.getElementById('sort')
 if(pdf.checked==1)
 {
 	pdf=1
 }
 else
 {
 	pdf=0
 }
 
 var url="report.php"
 //url=url+"?sort="+sort.value 
 //url=url+"&start="+start.value
 url=url+"?start="+start.value
 //url=url+"&pdf="+pdf
 url=url+"&end="+end.value
 url=url+"&nabor="+str
 url=url+"&id_fac="+fac.value
 url=url+"&sort1="+sort1.value
 url=url+"&sid="+Math.random()
 
 
window.open(url)

}

function GetReportCon(str)
{
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
 
 
 var start = document.getElementById('start')
 var end = document.getElementById('end')
 var con = document.getElementById('id_con')
 var pdf = document.getElementById('pdf') 
 var sort1 = document.getElementById('sort1')
 //var sort = document.getElementById('sort')
 if(pdf.checked==1)
 {
 	pdf=1
 }
 else
 {
 	pdf=0
 }
 
 var url="report.php"
 //url=url+"?sort="+sort.value 
 //url=url+"&id_con="+con.value
 url=url+"?id_con="+con.value
 //url=url+"&pdf="+pdf
 url=url+"&start="+start.value
 url=url+"&end="+end.value
 url=url+"&nabor="+str
  url=url+"&sort1="+sort1.value
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
 
 
 var start = document.getElementById('start')
 var end = document.getElementById('end')
 var con = document.getElementById('id_spec')
 var pdf = document.getElementById('pdf')
  var sort1 = document.getElementById('sort1')
 //var sort = document.getElementById('sort')
 if(pdf.checked==1)
 {
 	pdf=1
 }
 else
 {
 	pdf=0
 }
 
 var url="report.php"
 //url=url+"?sort="+sort.value 
 //url=url+"&id_spec="+con.value
 url=url+"?id_spec="+con.value
 //url=url+"&pdf="+pdf
 url=url+"&start="+start.value
 url=url+"&end="+end.value
 url=url+"&nabor="+str
   url=url+"&sort1="+sort1.value
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