<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
table {
	font-size: 12px;
	color:             #000000;
    background-color:  #ffffff;
	border-width:      0.1em;
    border-color:      #000000;
    border-style:      solid;
    border-collapse:   collapse;
    border-spacing:    0;
}

td {
	font-size: 12px;
	color:             #000000;
    background-color:  #ffffff;
border-width:      0.1em;
    border-color:      #000000;
    border-style:      solid;
    padding:           0.2em;
}

th {
	font-size: 12px;
	color:             #000000;
    background-color:  #0000FF;
		  border-width:      0.1em;
    border-color:      #000000;
    border-style:      solid;
	  padding:           0.2em;
    font-weight:       bold;
    background-color:  #e5e5e5;
}
</style>
<script>
window.onload = function() {
var dd=document.getElementById("input_bug").value;
document.getElementById("input_bug").focus();
document.getElementById("input_bug").value=dd;
}

function chk_post()
{
var input_bug=document.getElementById("input_bug").value;
var input_patch=document.getElementById("input_patch").value;
if(!input_bug){
alert("ระบุจำนวน BUG");
document.getElementById("input_bug").focus();
return false;
}
if(!input_patch){
alert("ระบุจำนวน Patch");
document.getElementById("input_patch").focus();
return false;
}

}
</script>
<h3>อนุพล  ศรีลา(580632022)</h3>
<hr>
<h3>Patch Fix  Bug Sample Input</h3>
<?
$input_bug=$_POST[input_bug];
$input_patch=$_POST[input_patch];
if($input_bug=="")$input_bug=3; //test1
if($input_patch=="")$input_patch=3;//test1

?>
<form action="?" method="post" enctype="multipart/form-data" onsubmit="return chk_post();">
    Input Bug:
    <input type="text" name="input_bug" id="input_bug" value="<?=$input_bug?>" size="5">
	Patch as:<input type="text" name="input_patch" id="input_patch" value="<?=$input_patch?>" size="5">
    <input type="submit" value="OK" name="submit">
</form>
<?
//===============================================start main
if($_POST[submit]=="OK" or $_POST[submit]=="Run")
{
?>
<hr><h2>Patch Input Table</h2>
<form action="?" method="post" enctype="multipart/form-data">
<table>
<tr><th>Patch No</th><th>Input</th><th>Output</th><th>Time</th></tr>
 <input type="hidden" name="input_bug" id="input_bug" value="<?=$input_bug?>">
<input type="hidden" name="input_patch" id="input_patch" value="<?=$input_patch?>">
  <?
 $patch_in=$_POST[patch_in];
$patch_out=$_POST[patch_out];
$time1=$_POST[time1];

$pp=$input_patch-1;
$pb=$input_bug-1;
for($i=0,$n=1;$i<=$pp;$i++,$n++)
	{
if(!$_POST[patch_in]){
$patch_in[$i]=patch_in($pb,$i);
$patch_out[$i]=patch_out($pb,$i);
$time1[$i]=rand(1,$pb);
}

  ?>
<tr>
<td><?=$n?></td>
<td><input type="text" name="patch_in[<?=$i?>]" id="patch_in[<?=$i?>]" value="<?=$patch_in[$i]?>"></td>
<td><input type="text" name="patch_out[<?=$i?>]" id="patch_out[<?=$i?>]" value="<?=$patch_out[$i]?>"></td>
<td><input type="text" name="time1[<?=$i?>]" id="time1[<?=$i?>]" value="<?=$time1[$i]?>"></td>
</tr>
<?
	}
?>
</table>
 <br>-->>>><input type="submit" value="Run" name="submit"><<<<--
</form>

<?
}
if($_POST[submit]=="Run")
{
$input_bug=$_POST[input_bug];
$input_patch=$_POST[input_patch];
for($i=0,$n=1;$i<=$input_patch-1;$i++,$n++)
	{
$patch[$i]=$time1[$i].",".$patch_in[$i].",".$patch_out[$i];
	}
	echo "<br>";
/////////////////////////////////test
#Product test 1
//$input_bug="3";
//$input_patch="3";
//$patch[0]="1,000,00-";
//$patch[1]="1,00-,0-+";
//$patch[2]="2,0--,-++";

#Product test 2
//$input_bug="4";
//$input_patch="1";
//$patch[0]="7,0-0+,----";
//////---------------------------------------- bug cre
for($i=0;$i<=$input_bug-1;$i++)
{
$bug=$bug."+";
}
//$bug1=array("-", "+", "-");
///////-------------------------------------

$p_old="";
$bug1=$bug;
$end_bug=str_replace("+","-",$bug);

//echo print_r($bug);
$dd_chk="";
echo "<hr><b>FIX BUG: $input_bug ($bug1)<br></b>";
$x=1;
$dd_chk=array();
$p_chk=array();
$time=0;
echo "<table>";
echo "<tr><th>No</th><th>Input<br>Bug</th><th>Output</th><th>patch</th><th>Time</th></tr>";
while(true)
{
$p_old=$p_old;
$bug1=$bug1;
$patch=$patch;
$dd_chk=patch_bug($p_old,$bug1,$patch);
if(!$dd_chk)
	{
	echo "<tr><td colspan=5><hr>Bugs cannot fixed.<hr></td></tr>";
	exit();
	}


for($l=0;$l<=count($dd_chk)-1;$l++)
	{
//echo $dd_chk[$l]."<br>";
$re_data=explode(" ",$dd_chk[$l]);

if (in_array($re_data[3], $p_chk)){
//echo "(ซ้ำ)";
//echo print_r($re_data)."<hr>";
}
else
		{
	//echo "(เลือก)";
//echo print_r($re_data)."<hr>";
echo "<tr><td>$x</td><td>$re_data[1]</td><td>$re_data[3]</td><td>$re_data[0]</td><td>$re_data[4]</td></tr>";
$p_old=$re_data[0];
$bug1=$re_data[3];
$time=$time+$re_data[4];
		}
$p_chk[]=$re_data[3];
//echo  "==>".print_r($p_chk);
//echo print_r($re_data)."<hr>";
if($bug1==$end_bug){
	echo "<tr><td colspan=5><hr>รวมเวลา:$time sec<hr></td></tr>";
exit();
}

	}
$x++;
}
echo "</table>";
}
//===============================================end main


function patch_in($pb,$i)
{
$pp1="";
for($k=0;$k<=$pb-$i;$k++)
{
$pp1=$pp1."0";
}
for($k=0;$k<=$i;$k++)
{
$pp2=$pp2."-";
}
$re=$pp1.$pp2;
$re=substr($re,0,$pb+1);
return $re;
}

function patch_out($pb,$i)
{
$pp1="";
for($k=0;$k<=$pb-$i-1;$k++)
{
$pp1=$pp1."0";
}
for($k=0;$k<=$i-1;$k++)
{
$pp2=$pp2."+";
}
$re=$pp1."-".$pp2;
$re=substr($re,0,$pb+1);
return $re;
}


function set_output($bug,$oh){
$out=$oh;
if($oh=="0")$out=$bug;
return $out;
}


function patch_bug($p_old,$bug1,$patch){
$bug=array();
///////////////////////////===================get bug to array
$input_bug=strlen($bug1);
for($b=0;$b<=$input_bug-1;$b++)
	{
$bug[]=substr($bug1,$b,1);
	}

//echo print_r($bug)."<br>";
//////////////////////////////////
for($i=0,$n=1;$i<=count($patch)-1;$i++,$n++)
{
if($n!=$p_old){
///////////////////////////===================patch to array and chk
$h=explode(",",$patch[$i]);
$dh=array();
$oh=array();
//echo "<hr>p".$i."<br>";
for($l=0;$l<=strlen($h[1])-1;$l++)
	{
$dh[]=substr($h[1],$l,1);
$oh[]=substr($h[2],$l,1);
	}
$th=$h[0];
///////////////////////////
//////////////////////////re bug
$chk=array();
$op="";
$bug_in="";
for($k=0;$k<=$input_bug-1;$k++)
{
	//echo "$bug[$k],$dh[$k],$oh[$k]<br>";
if($dh[$k]=="0")
	{
	$bug_in=$bug_in."$bug[$k]";
	$chk[$k]=1;
	$op=$op.set_output($bug[$k],$oh[$k]);
	}
	else if($bug[$k]=="+" and $dh[$k]=="-")
	{
$chk[$k]=0;
$op="";
	}
	else
	{
$bug_in=$bug_in."$bug[$k]";
$chk[$k]=1;// ++ or --
$op=$op.set_output($bug[$k],$oh[$k]);
	}
	
}
///////////////////////////===================
if($input_bug==array_sum($chk)){
	$output[]="$n $bug_in ".$h[2]." $op $th ".array_sum($chk);
}
else{
	//$output[]="end";
}

}
}
return $output;
// end patch
}

