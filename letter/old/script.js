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

function show2()
{
 document.getElementById('popup').style.display="block";
 //popup.style.visibility='visible';
 document.getElementById('popupbg').style.display="block";
 //popup.style.visibility='visible';
}

function hide2()
{
 document.getElementById('popup').style.display="none";
  document.getElementById('popupbg').style.display="none";
// popup.style.visibility='hidden';
//  popup.style.display='inline';
// popup.style.visibility='hidden';
 //popup.style.display='inline';
 
}
function toggle_all(cb)
{
	var elements = document.forms[0].elements;
	
	for(var i = 0; i < elements.length; i++)
	{
		if (elements[i].type == "checkbox")
		{
			elements[i].checked = cb.checked;
		}
	}
}


function getFormAsHash(fobj,idcon)  {
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
      //var elements = fobj.elements;
      var elements = document.forms[0].elements;
 //   var hash = {};
	var ABI_ID= new Array();
	var tmp = 0;
	
	/*var orderid = document.getElementById('orderid').value
	if(orderid==-1)
	{
		alert('Выберите приказ!');
		return;
	}
	var musorid = document.getElementById('musorid').value
	if(musorid==-1)
	{
		alert('Выберите статус!');
		return;
	}*/
	for(var i = 0; i < elements.length; i++)
    {
        switch(elements[i].type) {  
            case "text":
            case "hidden":
            case "password":
            case "textarea":
            case "select-one":

          //  hash[elements[i].name] = encodeURIComponent(elements[i].value);
          
            break;

            case "checkbox":
            case "radio":
               
            if (elements[i].checked){
            	ABI_ID[tmp] =elements[i].name;
            	tmp++;  
                //hash[elements[i].name] = encodeURIComponent(elements[i].value);
            }
            
            break;

        }  //  switch
    }  //  for
    if(ABI_ID.length == 0)
    {
    	alert('Вы не выбрали ни одного абитуриента!');
    	return;
    }
if (confirm('Вы уверены, что хотите напечатать ' + ABI_ID.length + ' абитуриентов?')) {  
 
 //alert(ABI_ID)
 var id_con = document.getElementById('id_con').value
 
/* var url="SaveToOrder.php"
 url=url+"?orderid="+orderid
 url=url+"&musorid="+musorid
 url=url+"&abi_id="+ABI_ID
 url=url+"&id_con="+id_con
  url=url+"&sid="+Math.random()*/

   var url="print.php"
    url=url+"?ABI_ID="+ABI_ID
	url=url+"&id_con="+id_con
	url=url+"&sid="+Math.random()
  
 //xmlHttp.onreadystatechange=mainChanged
 //xmlHttp.open("GET",url,true)
 //xmlHttp.send(null)
 window.open(url)
} 
return false;
}


function SaveOrder()
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
	hide2()
 var ordernum = document.getElementById('ordernum').value
 var orderdate = document.getElementById('orderdate').value
 var ordercomment = document.getElementById('ordercomment').value
 var tnabor= document.getElementById('tnabor').value
 
 var url="SaveOrder.php"
 url=url+"?ordernum="+ordernum
 url=url+"&orderdate="+orderdate
 url=url+"&ordercomment="+ordercomment
 url=url+"&tnabor="+tnabor

 
 xmlHttp.onreadystatechange=mainChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}

function OrderRemove(abi_id,str,filter,sort)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
	

 var url="RemoveFromOrder.php"
 url=url+"?abi_id="+abi_id
 url=url+"&id_con="+str
 url=url+"&filter="+filter
 url=url+"&sort="+sort
 
 xmlHttp.onreadystatechange=mainChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}

function ViewCongroup(str,filter,sort)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
	

 var url="ViewCongroup.php"
 url=url+"?id_con="+str
 url=url+"&filter="+filter
 url=url+"&sort="+sort
 url=url+"&sid="+Math.random()

 xmlHttp.onreadystatechange=mainChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}
function PrintHtml(str)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
	

 var url="order_html.php"
 url=url+"?id="+str

window.open(url)
 /*xmlHttp.onreadystatechange=mainChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)*/
}
function PrintXls(str)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
	

 var url="order_xls.php"
 url=url+"?id="+str

window.open(url)
 /*xmlHttp.onreadystatechange=mainChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)*/
}
function PrintXls2(str,str2)
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
	

 var url="order_xls_prikaz.php"
 url=url+"?id="+str
 url=url+"&excel="+str2

window.open(url)
 /*xmlHttp.onreadystatechange=mainChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)*/
}
function ViewOrders()
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
	

 var url="ViewOrders.php"
 url=url+"?sid="+Math.random()


 xmlHttp.onreadystatechange=mainChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}


function ViewCongroups()
 { 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
	

 var url="ViewCongroups.php"
 url=url+"?sid="+Math.random()


 xmlHttp.onreadystatechange=mainChanged
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
}


 function mainChanged() 
 { 
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
  { 
  document.getElementById("main")
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