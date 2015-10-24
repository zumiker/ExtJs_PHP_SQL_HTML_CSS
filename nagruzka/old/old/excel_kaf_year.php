<?php 

$kaf=$_GET['kaf'];
$god=$_GET['god'];
$sem=$_GET['sem'];

$god=$god.'/'.($god+1);

// Creating a worksheet
$worksheet =& $workbook->addWorksheet('Годовая');
$worksheet->setMargins_LR(0);
$worksheet->setMargins_TB(0);

$titleFormat1 =& $workbook->addFormat(); 
$titleFormat1->setFontFamily('Helvetica'); 
$titleFormat1->setAlign('merge'); 
$titleFormat1->setSize('10'); 
$titleFormat1->setColor('navy'); 
$titleFormat1->setTextWrap(1); 

$titleFormat =& $workbook->addFormat(); 
$titleFormat->setFontFamily('Helvetica'); 
$titleFormat->setSize('8'); 
$titleFormat->setColor('navy'); 
$titleFormat->setBottomColor('navy'); 
$titleFormat->setAlign('merge'); 
$titleFormat->setTop(2); 
$titleFormat->setBottom(2); 
$titleFormat->setLeft(2); 
$titleFormat->setRight(2);
$titleFormat->setTextWrap(1); 


$format =& $workbook->addFormat();
$format->setFontFamily('Helvetica'); 
$format->setAlign('center'); 
$format->setSize('8');
$format->setTop(1); 
$format->setBottom(1); 
$format->setLeft(1); 
$format->setRight(1);
$format->setTextWrap(1);

$verticalformat =& $workbook->addFormat();
$verticalformat->setFontFamily('Helvetica'); 
$verticalformat->setAlign('center'); 
$verticalformat->setSize('8');
$titleFormat1->setColor('navy'); 
$verticalformat->setTop(2); 
$verticalformat->setBottom(2); 
$verticalformat->setLeft(2); 
$verticalformat->setRight(2);
$verticalformat->setTextWrap(1);
$verticalformat->setTextRotation(270);

$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
/*
$sql="SELECT FAC ".
	 "FROM FACULTY WHERE FACID='$fac'";
$cur=ora_do($conn,$sql);

//$SPRING_AUTUMN=ora_getcolumn($cur,0);
$FACULTY=ora_getcolumn($cur,0);*/
/*$YEAR=ora_getcolumn($cur,1);	
$DIVABBREVIATE=ora_getcolumn($cur,2);*/			
//ora_fetch($cur);
$n=0;
$worksheet ->write($n,0, 'Российский Государственный Университет нефти и газа им. И.М. Губкина',$titleFormat1); 
$worksheet ->write($n,1, '',$titleFormat1); 
$worksheet ->write($n,2, '',$titleFormat1); 
$worksheet ->write($n,3, '',$titleFormat1); 
$worksheet ->write($n,4, '',$titleFormat1); 
$worksheet ->write($n,5, '',$titleFormat1); 
$worksheet ->write($n,6, '',$titleFormat1); 
$worksheet ->write($n,7, '',$titleFormat1); 
$worksheet ->write($n,8, '',$titleFormat1); 
$worksheet ->write($n,9, '',$titleFormat1); 
$worksheet ->write($n,10, '',$titleFormat1); 
$worksheet ->write($n,11, '',$titleFormat1); 
$worksheet ->write($n,12, '',$titleFormat1); 
$worksheet ->write($n,13, '',$titleFormat1); 
$worksheet ->write($n,14, '',$titleFormat1); 
$worksheet ->write($n,15, '',$titleFormat1); 
$worksheet ->write($n,16, '',$titleFormat1); 
$worksheet ->write($n,17, '',$titleFormat1); 
$worksheet ->write($n,18, '',$titleFormat1); 
$worksheet ->write($n,19, '',$titleFormat1); 
$worksheet ->write($n,20, '',$titleFormat1); 
$worksheet ->write($n,21, '',$titleFormat1); 
$worksheet ->write($n,22, '',$titleFormat1); 
$worksheet ->write($n,23, '',$titleFormat1); 
$worksheet ->write($n,24, '',$titleFormat1); 
$worksheet ->write($n,25, '',$titleFormat1); 
$worksheet ->write($n,26, '',$titleFormat1); 
if($zagod==1)$worksheet ->write($n,27, '',$titleFormat1);

$n++;

$worksheet ->write($n,0, 'преподавателей кафедры',$titleFormat1);
/*else
 $worksheet ->write($n,0, 'преподавателей факультета '.$FACULTY,$titleFormat1);*/
$worksheet ->write($n,1, '',$titleFormat1); 
$worksheet ->write($n,2, '',$titleFormat1); 
$worksheet ->write($n,3, '',$titleFormat1); 
$worksheet ->write($n,4, '',$titleFormat1); 
$worksheet ->write($n,5, '',$titleFormat1); 
$worksheet ->write($n,6, '',$titleFormat1); 
$worksheet ->write($n,7, '',$titleFormat1); 
$worksheet ->write($n,8, '',$titleFormat1); 
$worksheet ->write($n,9, '',$titleFormat1); 
$worksheet ->write($n,10, '',$titleFormat1); 
$worksheet ->write($n,11, '',$titleFormat1); 
$worksheet ->write($n,12, '',$titleFormat1); 
$worksheet ->write($n,13, '',$titleFormat1); 
$worksheet ->write($n,14, '',$titleFormat1); 
$worksheet ->write($n,15, '',$titleFormat1); 
$worksheet ->write($n,16, '',$titleFormat1); 
$worksheet ->write($n,17, '',$titleFormat1); 
$worksheet ->write($n,18, '',$titleFormat1); 
$worksheet ->write($n,19, '',$titleFormat1); 
$worksheet ->write($n,20, '',$titleFormat1); 
$worksheet ->write($n,21, '',$titleFormat1); 
$worksheet ->write($n,22, '',$titleFormat1); 
$worksheet ->write($n,23, '',$titleFormat1); 
$worksheet ->write($n,24, '',$titleFormat1); 
$worksheet ->write($n,25, '',$titleFormat1); 
$worksheet ->write($n,26, '',$titleFormat1);
if($zagod==1)$worksheet ->write($n,27, '',$titleFormat1);



//for($d=1;$d<=2;$d++)
{	
	/*if($d==1)
	{
		$sem='Осенний';
		$zagod=0;
	}
	else
	{
		$sem='Весенний';
		$zagod=1;
	}*/
	
	$n+=2;
	$worksheet ->write($n,0, 'Объем выполненой работы за  '.$god.' учебный год',$titleFormat1); 
	$worksheet ->write($n,1, '',$titleFormat1); 
	$worksheet ->write($n,2, '',$titleFormat1); 
	$worksheet ->write($n,3, '',$titleFormat1); 
	$worksheet ->write($n,4, '',$titleFormat1); 
	$worksheet ->write($n,5, '',$titleFormat1); 
	$worksheet ->write($n,6, '',$titleFormat1); 
	$worksheet ->write($n,7, '',$titleFormat1); 
	$worksheet ->write($n,8, '',$titleFormat1); 
	$worksheet ->write($n,9, '',$titleFormat1); 
	$worksheet ->write($n,10, '',$titleFormat1); 
	$worksheet ->write($n,11, '',$titleFormat1); 
	$worksheet ->write($n,12, '',$titleFormat1); 
	$worksheet ->write($n,13, '',$titleFormat1); 
	$worksheet ->write($n,14, '',$titleFormat1); 
	$worksheet ->write($n,15, '',$titleFormat1); 
	$worksheet ->write($n,16, '',$titleFormat1); 
	$worksheet ->write($n,17, '',$titleFormat1); 
	$worksheet ->write($n,18, '',$titleFormat1); 
	$worksheet ->write($n,19, '',$titleFormat1); 
	$worksheet ->write($n,20, '',$titleFormat1); 
	$worksheet ->write($n,21, '',$titleFormat1); 
	$worksheet ->write($n,22, '',$titleFormat1); 
	$worksheet ->write($n,23, '',$titleFormat1); 
	$worksheet ->write($n,24, '',$titleFormat1); 
	$worksheet ->write($n,25, '',$titleFormat1); 
	$worksheet ->write($n,26, '',$titleFormat1); 
	if($zagod==1)$worksheet ->write($n,27, '',$titleFormat1);
	
	$n+=2;
	
	$worksheet ->write($n,0, '',$titleFormat); 
	$worksheet ->write($n+1,0, '',$titleFormat); 
	$worksheet ->write($n,1, 'НАГРУЗКА ПО УЧЕБНОМУ ПЛАНУ',$titleFormat); 
	$worksheet ->write($n,2, '',$titleFormat); 
	$worksheet ->write($n,3, '',$titleFormat); 
	$worksheet ->write($n,4, '',$titleFormat); 
	$worksheet ->write($n,5, '',$titleFormat); 
	$worksheet ->write($n,6, '',$titleFormat); 
	$worksheet ->write($n,7, '',$titleFormat); 
	$worksheet ->write($n,8, '',$titleFormat); 
	$worksheet ->write($n,9, '',$titleFormat); 
	$worksheet ->write($n,10,'' ,$titleFormat); 
	$worksheet ->write($n,11,'',$titleFormat);
	$worksheet ->write($n,12,'',$titleFormat); 
	$worksheet ->write($n,13, 'Всего по учебному плану',$verticalformat); 
	$worksheet ->write($n+1,13, '',$verticalformat);
	$worksheet ->write($n+2,13, '',$verticalformat); 
	$worksheet ->write($n,14, 'ДРУГИЕ ВИДЫ УЧЕБНОЙ НАГРУЗКИ',$titleFormat);  
	$worksheet ->write($n,15, '',$titleFormat); 
	$worksheet ->write($n,16, '',$titleFormat); 
	$worksheet ->write($n,17, '',$titleFormat);
	$worksheet ->write($n,18, '',$titleFormat); 
	$worksheet ->write($n,19, '',$titleFormat);
	$worksheet ->write($n,20, '',$titleFormat);
	$worksheet ->write($n,21, 'ПРОЧИЕ ВИДЫ РАБОТ',$titleFormat); 
	$worksheet ->write($n,22, '',$titleFormat); 
	$worksheet ->write($n,23, '',$titleFormat); 
	$worksheet ->write($n,24, '',$titleFormat);
	$worksheet ->write($n,25, '',$titleFormat);
	$worksheet ->write($n,26, 'Всего',$verticalformat);
	$worksheet ->write($n,27, 'Всего за год',$verticalformat);  
	
	$n++;
		
	$worksheet ->write($n,0, '',$titleFormat); 
	$worksheet ->write($n,1, 'АУДИТОРНАЯ НАГРУЗКА',$titleFormat); 
	$worksheet ->write($n,2, '',$titleFormat); 
	$worksheet ->write($n,3, '',$titleFormat); 
	$worksheet ->write($n,4, '',$titleFormat); 
	$worksheet ->write($n,5, '',$titleFormat); 
	$worksheet ->write($n,6, '',$titleFormat); 
	$worksheet ->write($n,7, 'ВНЕАУДИТОРНАЯ НАГРУЗКА',$titleFormat); 
	$worksheet ->write($n,8, '',$titleFormat); 
	$worksheet ->write($n,9, '',$titleFormat); 
	$worksheet ->write($n,10,'' ,$titleFormat); 
	$worksheet ->write($n,11,'',$titleFormat);
	$worksheet ->write($n,12,'',$titleFormat); 
	$worksheet ->write($n,13, '',$titleFormat); 
	$worksheet ->write($n,14, ' ',$titleFormat);
	$worksheet ->write($n,15, '',$titleFormat); 
	$worksheet ->write($n,16, '',$titleFormat);  
	$worksheet ->write($n,17, '',$titleFormat); 
	$worksheet ->write($n,18, '',$titleFormat); 
	$worksheet ->write($n,19, '',$titleFormat);
	$worksheet ->write($n,20, '',$titleFormat); 
	$worksheet ->write($n,21, '  ',$titleFormat);
	$worksheet ->write($n,22, '',$titleFormat);
	$worksheet ->write($n,23, '',$titleFormat); 
	$worksheet ->write($n,24, '',$titleFormat); 
	$worksheet ->write($n,25, '',$titleFormat); 
	$worksheet ->write($n,26, '',$titleFormat);
	if($zagod==1)$worksheet ->write($n,27, '',$titleFormat);  
	
	$n++;
	
	$worksheet ->write($n,0, '',$titleFormat); 
	$worksheet ->write($n,1, 'ППС',$verticalformat); 
	$worksheet ->write($n,2, 'Лекции',$verticalformat); 
	$worksheet ->write($n,3, 'Практические',$verticalformat); 
	$worksheet ->write($n,4, 'Лабораторные',$verticalformat); 
	$worksheet ->write($n,5, 'Всего',$verticalformat); 
	$worksheet ->write($n,6, 'Зачёты, экзамены',$verticalformat); 
	$worksheet ->write($n,7, 'Итого',$verticalformat); 
	$worksheet ->write($n,8, 'Курсовой проект (раб.)',$verticalformat); 
	$worksheet ->write($n,9, 'Дипломное проектирование',$verticalformat); 
	$worksheet ->write($n,10, 'УНИРС',$verticalformat); 
	$worksheet ->write($n,11,'Учебная практика' ,$verticalformat); 
	$worksheet ->write($n,12,'Производственная практика',$verticalformat);
	$worksheet ->write($n,13,'Всего',$verticalformat); 
	$worksheet ->write($n,14, 'Всего по учебному плану',$verticalformat); 
	$worksheet ->write($n,15, 'Консультации',$verticalformat);
	$worksheet ->write($n,16, 'Проверка контр. работ',$verticalformat); 
	$worksheet ->write($n,17, 'Работа в ГАК',$verticalformat);  
	$worksheet ->write($n,18, 'Приём вступит. экзаменов',$verticalformat); 
	$worksheet ->write($n,19, 'Руководство аспирантами',$verticalformat); 
	$worksheet ->write($n,20, 'Руководство магистрами',$verticalformat);
	$worksheet ->write($n,21, 'Всего',$verticalformat); 
	$worksheet ->write($n,22, 'Факультативы',$verticalformat);
	$worksheet ->write($n,23, 'Кураторство, руководство СНО',$verticalformat);
	$worksheet ->write($n,24, 'ФПК преподавателей',$verticalformat); 
	$worksheet ->write($n,25, 'Прочее',$verticalformat); 
	$worksheet ->write($n,26, 'Всего',$verticalformat);
	$worksheet ->write($n,27, 'Всего за год',$verticalformat);
	//if($zagod==1)$worksheet ->write($n,28, 'Всего за год',$verticalformat);
	$n++;
	
	$worksheet ->write($n,0, '1',$titleFormat); 
	$worksheet ->write($n,1, '2',$titleFormat); 
	$worksheet ->write($n,2, '3',$titleFormat); 
	$worksheet ->write($n,3, '4',$titleFormat); 
	$worksheet ->write($n,4, '5',$titleFormat); 
	$worksheet ->write($n,5, '6',$titleFormat); 
	$worksheet ->write($n,6, '7',$titleFormat); 
	$worksheet ->write($n,7, '8',$titleFormat); 
	$worksheet ->write($n,8, '9',$titleFormat); 
	$worksheet ->write($n,9, '10',$titleFormat); 
	$worksheet ->write($n,10,'11',$titleFormat); 
	$worksheet ->write($n,11,'12',$titleFormat);
	$worksheet ->write($n,12,'13',$titleFormat); 
	$worksheet ->write($n,13, '14',$titleFormat); 
	$worksheet ->write($n,14, '15',$titleFormat);
	$worksheet ->write($n,15, '16',$titleFormat); 
	$worksheet ->write($n,16, '17',$titleFormat);  
	$worksheet ->write($n,17, '18',$titleFormat); 
	$worksheet ->write($n,18, '19',$titleFormat); 
	$worksheet ->write($n,19, '20',$titleFormat);
	$worksheet ->write($n,20, '21',$titleFormat); 
	$worksheet ->write($n,21, '22',$titleFormat);
	$worksheet ->write($n,22, '23',$titleFormat);
	$worksheet ->write($n,23, '24',$titleFormat); 
	$worksheet ->write($n,24, '25',$titleFormat); 
	$worksheet ->write($n,25, '26',$titleFormat);
	$worksheet ->write($n,26, '27',$titleFormat);
	$worksheet ->write($n,27, '28',$titleFormat);
	//if($zagod==1)$worksheet ->write($n,27, '28',$titleFormat);
	
	$n++;
		
	$worksheet->setColumn(0,0,25);
	$worksheet->setColumn(0,1,4);
	$worksheet->setColumn(0,2,4);
	$worksheet->setColumn(0,3,4);
	$worksheet->setColumn(0,4,4);
	$worksheet->setColumn(0,5,4);
	$worksheet->setColumn(0,6,5);
	$worksheet->setColumn(0,7,4);
	$worksheet->setColumn(0,8,4);
	$worksheet->setColumn(0,9,4);
	$worksheet->setColumn(0,10,4);
	$worksheet->setColumn(0,11,4);
	$worksheet->setColumn(0,12,4);
	$worksheet->setColumn(0,13,4);
	$worksheet->setColumn(0,14,4);
	$worksheet->setColumn(0,15,4);
	$worksheet->setColumn(0,16,4);
	$worksheet->setColumn(0,17,4);
	$worksheet->setColumn(0,18,4);
	$worksheet->setColumn(0,19,4);
	$worksheet->setColumn(0,20,4);
	$worksheet->setColumn(0,21,4);
	$worksheet->setColumn(0,22,4);
	$worksheet->setColumn(0,23,4);
	$worksheet->setColumn(0,24,4);
	$worksheet->setColumn(0,25,4);
	$worksheet->setColumn(0,26,4);
	$worksheet->setColumn(0,27,4);
	
	$worksheet ->setMerge(5,0,6,0);
	$worksheet ->setMerge(5,13,7,13);
	//$worksheet ->setMerge(5,25,7,25);
	$worksheet ->setMerge(5,26,7,26);
	$worksheet ->setMerge(5,27,7,27);
	
	$worksheet ->setMerge(5,14,6,20);
	
	$worksheet ->setMerge(5,21,6,25);
	
	$conn=ora_logon("GANGTEMP@IUSDB.DEVELOPERS","gdb");
	
	 
	for($j=1;$j<=7;$j++)
	{
		if($kaf=='999')
		{
			$FACUL="";
		}
		else
		{
			$FACUL="AND DIVID='$kaf' ";
		}
		
		switch($j)
		{
			
			case '1':
			$where="WHERE YEAR_GROCODE='$god' $FACUL AND FOR_SORT='1' AND GRUPPA='$j' group by DIVID,YEAR_GROCODE";
			 break;
			 
			case '2':
			$where="WHERE YEAR_GROCODE='$god' $FACUL AND FOR_SORT='1' AND GRUPPA='$j' group by DIVID,YEAR_GROCODE";
			 break;
			 
			case '3':
			$where="WHERE YEAR_GROCODE='$god' $FACUL AND FOR_SORT='1' AND GRUPPA='$j' group by DIVID,YEAR_GROCODE";
			 break;

			case '4':
			$where="WHERE YEAR_GROCODE='$god' $FACUL AND FOR_SORT='1' AND GRUPPA='$j' group by DIVID,YEAR_GROCODE";
			 break;
			 
			case '5':
			$where="WHERE YEAR_GROCODE='$god' $FACUL AND FOR_SORT='2' group by DIVID,YEAR_GROCODE";
			break;
			
			case '6':
			$where="WHERE YEAR_GROCODE='$god' $FACUL AND FOR_SORT='3' group by DIVID,YEAR_GROCODE";
			break;
			
			case '7':
			$where="WHERE YEAR_GROCODE='$god' $FACUL group by DIVID,YEAR_GROCODE";
			break;
		}
	
		/*$sql="SELECT DIVID, YEAR_GROCODE, YEAR_GROCODE, sum(LECTIME), sum(SEMTIME), sum(LABTIME), 
			 sum(VSEGO5), sum(EKZ_ZACH), sum(ITOGO7), sum(KPR), sum(N9), 
			 sum(N10), sum(N11), sum(N12), sum(VSEGO13), sum(VSEGOPLAN), 
			 sum(N15), sum(N16), sum(N17), sum(N18), sum(N19), 
			 sum(N20), sum(VSEGO21), sum(N22), sum(N23), sum(N24), 
			 sum(PRIM), sum(VSEGO25), sum(GOD), sum(F_LECTIME), sum(F_SEMTIME), 
			 sum(F_LABTIME), sum(F_VSEGO5), sum(F_EKZ_ZACH), sum(F_ITOGO7), sum(F_KPR), 
			 sum(F9), sum(F10), sum(F11), sum(F12), sum(F_VSEGO13), 
			 sum(F_VSEGOPLAN), sum(F15), sum(F16), sum(F17), sum(F18), 
			 sum(F19), sum(F20), sum(F_VSEGO21), sum(F22), sum(F23), 
			 sum(F24), sum(FPRIM), sum(F_VSEGO25), sum(F_GOD), GRUPPA, 
 			FACID, FAC, DIVABBREVIATE, FOR_SORT, FOR_SORT_NAME FROM Z_GOD $where";*/
 			
 		$sql="select DIVID, YEAR_GROCODE, sum(LECTIME) LECTIME,
		 sum(LECTIME) LECTIME, sum(SEMTIME) SEMTIME,  sum(LABTIME) LABTIME, 
		  sum(vsego5 ) vsego5,
		 sum(EKZ_ZACH) EKZ_ZACH, 
		 sum(itogo7)itogo7,
		  sum(KPR)  KPR, 
		  sum(N9) n9, sum(N10) n10, sum(N11) n11, sum(N12) n12, 
		  sum(vsego13) vsego13,
		  sum(vsegoplan)vsegoplan,
		  sum(N15) n15, 
		 sum(N16) n16, sum(N17) n17, sum(N18) n18, sum(N19) n19, sum(N20) n20, 
		 sum(vsego21) vsego21,
		  sum(N22) n22, sum(N23) n23, sum(N24) n24, sum(PRIM) prim, 
		  sum(vsego25)vsego25,
		  sum(GOD)GOD,
		  sum(f_LECTIME) f_LECTIME, sum(f_SEMTIME) f_SEMTIME,  sum( f_LABTIME) f_LABTIME, 
		  sum(f_vsego5)f_vsego5,
		  sum( f_ekz_zaCH ) f_ekz_zaCH, 
		  sum(f_itogo7)f_itogo7,
		  sum(F_KPR)  F_KPR, 
		  sum(f9) f9, sum(f10) f10, sum(f11) f11, sum(f12) f12, 
		  sum(f_vsego13) f_vsego13,
		  sum(f_vsegoplan )f_vsegoplan,
		  sum(f15) f15, 
		 sum(f16) f16, sum(f17) f17, sum(f18) f18, sum(f19) f19, sum(f20) f20, 
		 sum( f_vsego21)  f_vsego21,
		  sum(f22) f22, sum(f23) f23, sum(f24) f24, sum(fPRIM) fprim, 
		  sum(f_vsego25)  f_vsego25,
		  sum(f_GOD)f_GOD, sum(KOL_PREPOD) KOL_PREPOD, sum(KOL_STAVKI) KOL_STAVKI FROM Z_GOD $where";
		 
 		$cur=ora_do($conn,$sql);
		for ($i=0;$i<ora_numrows($cur);$i++)
				{
					$vsegozagod=0;
					$fvsegozagod=0;
					$DIVID=ora_getcolumn($cur,0); 
					$SPRING_AUTUMN=ora_getcolumn($cur,1); 
					$YEAR_GROCODE=ora_getcolumn($cur,2);  
					$LECTIME=ora_getcolumn($cur,3);  
					$SEMTIME=ora_getcolumn($cur,4);  
					 $LABTIME=ora_getcolumn($cur,5);  
					 $VSEGO5=ora_getcolumn($cur,6);  
					 $EKZ_ZACH=ora_getcolumn($cur,7);  
					 $ITOGO7=ora_getcolumn($cur,8);  
					 $KPR=ora_getcolumn($cur,9); 
					 $N9=ora_getcolumn($cur,10);  
					 $N10=ora_getcolumn($cur,11);  
					 $N11=ora_getcolumn($cur,12);  
					 $N12=ora_getcolumn($cur,13);  
					 $VSEGO13=ora_getcolumn($cur,14);  
					 $VSEGOPLAN=ora_getcolumn($cur,15);  
					 $N15=ora_getcolumn($cur,16);  
					 $N16=ora_getcolumn($cur,17);  
					 $N17=ora_getcolumn($cur,18);  
					 $N18=ora_getcolumn($cur,19);  
					 $N19=ora_getcolumn($cur,20);  
					 $N20=ora_getcolumn($cur,21);  
					 $VSEGO21=ora_getcolumn($cur,22);  
					 $N22=ora_getcolumn($cur,23);  
					 $N23=ora_getcolumn($cur,24);  
					 $N24=ora_getcolumn($cur,25);  
					 $PRIM=ora_getcolumn($cur,26);  
					 $VSEGO25=ora_getcolumn($cur,27);  
					 $GOD=ora_getcolumn($cur,28);  
					 $F_LECTIME=ora_getcolumn($cur,29);  
					 $F_SEMTIME=ora_getcolumn($cur,30);  
					 $F_LABTIME=ora_getcolumn($cur,31);  
					 $F_VSEGO5=ora_getcolumn($cur,32);  
					 $F_EKZ_ZACH=ora_getcolumn($cur,33);  
					 $F_ITOGO7=ora_getcolumn($cur,34);  
					 $F_KPR=ora_getcolumn($cur,35);  
					 $F9=ora_getcolumn($cur,36);  
					 $F10=ora_getcolumn($cur,37);  
					 $F11=ora_getcolumn($cur,38);  
					 $F12=ora_getcolumn($cur,39);  
					 $F_VSEGO13=ora_getcolumn($cur,40);  
					 $F_VSEGOPLAN=ora_getcolumn($cur,41);  
					 $F15=ora_getcolumn($cur,41);  
					 $F16=ora_getcolumn($cur,42);  
					 $F17=ora_getcolumn($cur,43);  
					 $F18=ora_getcolumn($cur,44);  
					 $F19=ora_getcolumn($cur,45);  
					 $F20=ora_getcolumn($cur,46);  
					 $F_VSEGO21=ora_getcolumn($cur,47);  
					 $F22=ora_getcolumn($cur,48);  
					 $F23=ora_getcolumn($cur,49);  
					 $F24=ora_getcolumn($cur,50);  
					 $FPRIM=ora_getcolumn($cur,51);  
					 $F_VSEGO25=ora_getcolumn($cur,52);  
					 $F_GOD=ora_getcolumn($cur,53);  
					 $KOL_PREPOD=ora_getcolumn($cur,55);
					 $KOL_STAVKI=ora_getcolumn($cur,56);
					 //$DIVABBREVIATE=ora_getcolumn($cur,54);  
							
					switch($j)
					{
						case '1':
							$ttt='Проф. и зав. каф. проф';
							break;
						case '2':
							$ttt='Доценты и зав. каф.-доц.';
							break;
						case '3':
							$ttt='Ст.преп. и зав.каф. ст. преп.';
							break;
						case '4':
							$ttt='Ассистенты и преподаватели';
							break;
						case '5':
							$ttt='Совместители';
							break;
						case '6':
							$ttt='Почасовики';
							break;
						case '7':
							$ttt='Всего';
							break;
					}
					
					$worksheet->writeString($n,0, trim($ttt), $format);
					$worksheet->writeString($n,1, trim($KOL_STAVKI), $format);
					$worksheet->writeString($n,2, trim($LECTIME), $format);
					$worksheet->writeString($n,3, trim($SEMTIME), $format);
					$worksheet->writeString($n,4, trim($LABTIME), $format);
					$worksheet->writeString($n,5, trim($VSEGO5), $format);
					$worksheet->writeString($n,6, trim($EKZ_ZACH), $format);
					$worksheet->writeString($n,7, trim($ITOGO7), $format);
					$worksheet->writeString($n,8, trim($KPR), $format);
					$worksheet->writeString($n,9, trim($N9), $format);
					$worksheet->writeString($n,10, trim($N10), $format);
					$worksheet->writeString($n,11, trim($N11), $format);
					$worksheet->writeString($n,12, trim($N12), $format);
					$worksheet->writeString($n,13, trim($VSEGO13), $format);
					$worksheet->writeString($n,14, trim($VSEGOPLAN), $format);
					$worksheet->writeString($n,15, trim($N15), $format);
					$worksheet->writeString($n,16, trim($N16), $format);
					$worksheet->writeString($n,17, trim($N17), $format);
					$worksheet->writeString($n,18, trim($N18), $format);
					$worksheet->writeString($n,19, trim($N19), $format);
					$worksheet->writeString($n,20, trim($N20), $format);
					$worksheet->writeString($n,21, trim($VSEGO21), $format);
					$worksheet->writeString($n,22, trim($N22), $format);
					$worksheet->writeString($n,23, trim($N23), $format);
					$worksheet->writeString($n,24, trim($N24), $format);
					$worksheet->writeString($n,25, trim($PRIM), $format);
					$worksheet->writeString($n,26, trim($VSEGO25), $format);
					$worksheet->writeString($n,27, trim($GOD), $format);

					$worksheet->writeString($n+1,0, trim(''), $format);
					$worksheet->writeString($n+1,1, trim($KOL_PREPOD), $format);
					$worksheet->writeString($n+1,2, trim($F2), $format);
					$worksheet->writeString($n+1,3, trim($F3), $format);
					$worksheet->writeString($n+1,4, trim($F4), $format);
					$worksheet->writeString($n+1,5, trim($F_VSEGO5), $format);
					$worksheet->writeString($n+1,6, trim($F6), $format);
					$worksheet->writeString($n+1,7, trim($F_ITOGO7), $format);
					$worksheet->writeString($n+1,8, trim($F8), $format);
					$worksheet->writeString($n+1,9, trim($F9), $format);
					$worksheet->writeString($n+1,10, trim($F10), $format);
					$worksheet->writeString($n+1,11, trim($F11), $format);
					$worksheet->writeString($n+1,12, trim($F12), $format);
					$worksheet->writeString($n+1,13, trim($F_VSEGO13), $format);
					$worksheet->writeString($n+1,14, trim($F_VSEGOPLAN), $format);
					$worksheet->writeString($n+1,15, trim($F15), $format);
					$worksheet->writeString($n+1,16, trim($F16), $format);
					$worksheet->writeString($n+1,17, trim($F17), $format);
					$worksheet->writeString($n+1,18, trim($F18), $format);
					$worksheet->writeString($n+1,19, trim($F19), $format);
					$worksheet->writeString($n+1,20, trim($F20), $format);
					$worksheet->writeString($n+1,21, trim($F_VSEGO21), $format);
					$worksheet->writeString($n+1,22, trim($F22), $format);
					$worksheet->writeString($n+1,23, trim($F23), $format);
					$worksheet->writeString($n+1,24, trim($F24), $format);
					$worksheet->writeString($n+1,25, trim($PRIM), $format);
					$worksheet->writeString($n+1,26, trim($F_VSEGO25), $format);
					$worksheet->writeString($n+1,27, trim($F_GOD), $format);
					
					$worksheet ->setMerge($n,0,$n+1,0);
					$n=$n+2;
					ora_fetch($cur);	
					}	
	}			
	
}
		$footerFormat =& $workbook->addFormat(); 
		$footerFormat->setFontFamily('Helvetica'); 
		$footerFormat->setSize('9'); 
		$footerFormat->setColor('navy'); 
		$footerFormat->setBold();
		$footerFormat->setAlign('center'); 

/*
		
			$d=date("d.m.Y H:i ");
			$zav_kaf="Зав. кафедрой  ";
			$hdate="$d";
			$i++;
			$n++;
			$worksheet->writeString($n,3, trim($zav_kaf), $footerFormat);
			$worksheet->writeString($n,15, trim($hdate), $footerFormat);*/
	?>