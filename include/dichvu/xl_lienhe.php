<?php
$thongbao="";
		if(isset($_POST['goiham']))
		{
			$lenhsuly=$_POST['goiham'];		
			if($lenhsuly=='lienhe')
				$thongbao=lien_he();	
		}	
//ham xu ly lien he cua khach hang

function lien_he()
{
	global $conn;
	if(isset($_POST['txtten']))
		$tenkhach=$_POST['txtten'];
		$_SESSION['tenkhach']=$tenkhach;
		
	if(isset($_POST['sdtlh']))
		$sdtkhach=$_POST['sdtlh'];
		$_SESSION['sdtkhach']=$sdtkhach;
		
	if(isset($_POST['txtemail']))
		$emailkhach=$_POST['txtemail'];
		$_SESSION['emailkhach']=$emailkhach;
		
	if(isset($_POST['gioitinh']))
		$gioitinhkhach=$_POST['gioitinh'];
		
	if(isset($_POST['txtdc']))
		$diachikhach=$_POST['txtdc'];
		$_SESSION['diachikhach']=$diachikhach;
			
	if(isset($_POST['txtnd']))
		$noidung=$_POST['txtnd'];
		$_SESSION['noidung']=$noidung;
	
	$strSQL="INSERT INTO lien_he(ten_nguoi_lh,sdt_nguoi_lh,email_nguoi_lh,gioi_nguoi_lh,diachi_nguoi_lh,noi_dung)
					VALUES ('{$tenkhach}','{$sdtkhach}','{$emailkhach}','{$gioitinhkhach}','{$diachikhach}','{$noidung}')";		
	mysqli_query($conn,$strSQL);
	
	return "Yêu Cầu Của Bạn Đã Được Gửi Đi, Cảm Ơn Bạn Đã Góp Ý!";
}
// hien thong bao
if($thongbao !="")
{
echo "<div style='width:587px; margin-left:3px; margin-right:3px;'>";
echo "<table width='587' cellpadding='0' cellspacing='0' border='0' style='border:#E9E9E9 1px solid; margin-top:3px;'>";
echo "<tr>";
echo "<td>";

echo "<p class='pp'><center><span style='color:#FF9900;'>{$thongbao}</span>"; 
echo "<br>";
echo "<a href='index.php' target='_parent'>Bấm Vào Đây Để Về Trang Chủ</a></center></p>";

echo "</td>";
echo "</tr>";
echo "</table>";
echo "</div>";
}

?>