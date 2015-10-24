var xmlHttp

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

 xmlHttp.onreadystatechange=stateChanged4
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
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
	  catch(e){
		}
	}
	
 var lect = document.getElementById("lect")
 var lecroom = document.getElementById("lecroom")
 var url="Add/AddLec.php"
 url=url+"?nags="+nags
 url=url+"&manid="+lect.value
 url=url+"&room_lec="+lecroom.value
 url=url+"&str="+str
 url=url+"&sid="+Math.random()
 xmlHttp.onreadystatechange=stateChanged5
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
	var nagsnum=0
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
 xmlHttp.onreadystatechange=stateChanged5
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
 xmlHttp.onreadystatechange=stateChanged2 
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