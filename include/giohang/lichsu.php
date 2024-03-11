<?php
{
	$makh=$_SESSION['makhachhang'];
	$strSQL3="SELECT count(*) FROM  dondathang WHERE ma_kh= {$makh}";
	$qua=mysqli_query($conn,$strSQL3);
	$row=mysqli_fetch_array($qua);
	if($row[0] == 0)
		echo "Không có đơn hàng nào trước đây";
	else{
	$strSQL="SELECT * FROM  dondathang WHERE ma_kh= {$makh} ORDER BY ma_dh ";
	$dondathang=mysqli_query($conn,$strSQL);
	//////////////////////////////////////////////////////////////
?>
<div style="width:587px; margin-left:3px; margin-right:3px;">
<table width="587" border="1" cellpadding="0" cellspacing="0" style="magin-left=10px">
		<tr>
			<td style="height:25px; background:url(images/trang.jpg) repeat-x;" align="center" class="ht" colspan="6">
				Lịch sử mua hàng
			</td>
		</tr>
	<tr>
		<th width="40" align="center" style="border-left:#66A111 solid 1px;">
			STT
		</th>
		<th width="130">
			Tên Khách Đặt Hàng
		</th>
		<th width="130">
			Ngày giao dự kiến
		</th>
		<th width="130">
			Địa chỉ nhận hàng
		</th>
		<th width="130">
			Hiện Trạng
		</th>
		<th width="130">
			Tìm hiểu thêm
		</th>
	</tr>
		<?php $i = 0;
		while($row=mysqli_fetch_array($dondathang)) { $i+=1; ?>
	<tr>
	<?php 

		//xu ly mau cho dong
			if($i%2==0) 
				$mausac="style='background:#F8F8F8;'";
			 else 
			 	$mausac="style='background:#FFFFFF;'";
	?> 
		<td <?php echo $mausac; ?> >
			<?php echo $i; ?>
		</td>
		<td <?php echo $mausac; ?> >
		<?php 
			//lay chi tiet cua khach hang 
			$strSQL2="SELECT * FROM khach_hang WHERE ma_kh={$row['ma_kh']}";
			$khachhang=mysqli_query($conn,$strSQL2);
			$rowKH=mysqli_fetch_array($khachhang);
			
		?>
			<?php echo $rowKH['ho_kh']." ".$rowKH['ten_kh']; ?>
		</td>
		<td <?php echo $mausac; ?> >
			<?php 
				echo $row['ngay_gh'];
			?>
		</td>
		<td <?php echo $mausac; ?> >
			<?php 
				echo $row['noi_giao'];
			?>
		</td>
		<td <?php echo $mausac; ?> >
			<?php 
			if($row['hien_trang']==0)
				echo "<font color='#0000FF'> Đang xử lý </font>";
			if($row['hien_trang']==1)
				echo "<font color='#808000'> Đang Giao Hàng </font>";
			if($row['hien_trang']==2)
				echo "<font color='#666666'> Đã Giao Hàng </font>";
			if($row['hien_trang']==-1)
				echo "<font color='#fd0000'> Đơn hủy </font>";

			?>
		</td>
		<td width="100" align="center" <?php echo $mausac; ?>>
			<a href="#" onclick="xem_don('<?php echo $row['ma_dh']; ?>','chitiet_dh')">Xem chi tiết</a>
		</td>
	</tr>
		<?php } ?>
</table>
</div>
<?php }} ?>
<form name="chitietdon" action="" method="post">
	<input type="hidden" name="view" value="lichsudonhang"/>
	<input type="hidden" name="madh" value="" />
	<input type="hidden" name="viewchitiet" value="chitiet_dh" />
</form>
<?php
	//hien trang thong tin thanh toan
	if(isset($_POST['viewchitiet']))
	{
		$manhinh=$_POST['viewchitiet'];
			if($manhinh=='chitiet_dh')
				include_once('include/giohang/chitietdonhang.php');
	}
	
?>
<script>

	function xem_don(ma)
	{
		chitietdon.madh.value=ma
		chitietdon.submit()
	}
</script>