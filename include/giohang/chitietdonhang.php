<?php
	if(isset($_POST['madh']))
	{
		$madon=$_POST['madh'];
		$strSQL1="SELECT * FROM dondathang WHERE ma_dh={$madon}";
		$dondathang=mysqli_query($conn,$strSQL1);
		$rowDH=mysqli_fetch_array($dondathang);
			$ma_khach=$rowDH['ma_kh'];
		//lay khach hang
		$strSQL2="SELECT * FROM khach_hang WHERE ma_kh={$ma_khach}";
		$khachhang=mysqli_query($conn,$strSQL2);
		$rowKH=mysqli_fetch_array($khachhang);
	}
?>
<table width="587" cellpadding="2" cellspacing="0" border="0" class="admintable" style="border-right:#E9E9E9 1px solid; border-top:#E9E9E9 1px solid;" align="right">
	<tr>
		<td>
		<p class="pp">
		<center>Thông tin khách mua hàng</center>
		<br />
		<table width="490" cellpadding="2" cellspacing="0" border="0" 
		class="admintable" style="border-right:#E9E9E9 1px solid; border-top:#E9E9E9 1px solid;" align="center">
		<tr>
		<td width="190" align="center">
		Tên Người Mua Hàng: </td>
		<td width="300">
		&nbsp;&nbsp;<?php echo $rowKH['ho_kh']." ".$rowKH['ten_kh']; ?>
		</td>
		</tr>
		<tr>
		<td align="center">
		Số Điện Thoại:</td>
		<td>
		&nbsp;&nbsp;<?php echo $rowKH['sdt']; ?>.
		</td>
		</tr>
		<tr>
		<td align="center">
		Địa chỉ: </td>
		<td>
		&nbsp;&nbsp;<?php echo $rowKH['dia_chi']; ?>.
		</td>
		</tr>
		</table>
		<br />
		<center>Thông tin người nhận hàng</center>
		<br />
		<table width="490" cellpadding="2" cellspacing="0" border="0" 
		class="admintable" style="border-right:#E9E9E9 1px solid; border-top:#E9E9E9 1px solid;" align="center">
		<tr>
		<td width="190" align="center">
		Tên Người nhận Hàng: </td>
		<td width="300">
		&nbsp;&nbsp;<?php echo $rowDH['tennguoinhan'];?>
		</td>
		</tr>
		<tr>
		<td align="center">
		Số Điện Thoại:</td>
		<td>
		&nbsp;&nbsp;<?php echo $rowDH['sdt_ngnhan'];?>.
		</td>
		</tr>
		<tr>
		<td align="center">
		Địa chỉ Giao Hàng: </td>
		<td>
		&nbsp;&nbsp;<?php echo $rowDH['noi_giao'] ; ?>.
		</td>
		</tr>
		</table>
		<br />
		<center>Đơn Hàng Bao Gồm:</center>
		<br />
		<table width="490" cellpadding="2" cellspacing="0" border="0" 
		class="admintable" style="border-right:#E9E9E9 1px solid; border-top:#E9E9E9 1px solid;" align="center">
		<tr>
			<td width="40" align="center">STT</td>
			<td width="180" align="center">Tên qua</td>
			<td width="90" align="center">Số Lượng</td>
			<td width="90" align="center">Đơn Giá</td>
			<td width="90" align="center">Thành Tiền</td>
		</tr>
		<?php 
		$i=0;
		$tongtien=0;
		//lay thong tin chi tiet 
		$strSQL3="SELECT * FROM ct_dondathang WHERE ma_dh={$madon}";
		$chi_tiet=mysqli_query($conn,$strSQL3);
		
		while($rowCT=mysqli_fetch_array($chi_tiet))
		{
		$i+=1;
		?>
		<tr>
			<td align="center"><?php echo $i; ?></td>
			<td align="center">
				<?php
					//lay ten qua thong qua ma qua
					$strSQL4="SELECT * FROM qua WHERE ma_qua={$rowCT['ma_qua']}";
					$qua=mysqli_query($conn,$strSQL4);
					$row4=mysqli_fetch_array($qua);
					
					echo $row4['ten_qua'];
				?>
			</td>
			<td><?php echo $rowCT['sl_dat']; ?></td>
			<td><?php echo $rowCT['gia_ban']; ?></td>
			<td><?php echo $rowCT['gia_ban']*$rowCT['sl_dat']; ?></td>
		</tr>
		<?php 
		$tongtien+=$rowCT['gia_ban']*$rowCT['sl_dat'];
		} ?>
		</table>
		<center>
		<br />
		tổng tiá trị giỏ hàng: <?php echo number_format($tongtien,0,'.','.'); ?> VNĐ
		<br />
		Ngày Dự Kiến Giao Hàng: <?php echo $rowDH['ngay_gh']; ?>
		<br />
		
		<?php
			if($rowDH['hien_trang']==0)
				echo "<font color='#D14F10'>Đơn Đặt Hàng Này Đang Xử lý!</font>";
			if($rowDH['hien_trang']==1)
				echo "<font color='#D14F10'>Đơn Đặt Hàng Này <b>Đang Giao!</b></font>";
			if($rowDH['hien_trang']==2)
				echo "<font color='#D14F10'>Đơn Đặt Hàng Này <b>Đã Giao Nhận!</b></font>";
			if($rowDH['hien_trang']==-1)
				echo "<font color='#D14F10'>Đơn Đặt Này Đã Hủy!</font> Với lý do:'{$rowDH['ghichu']}'";
		?>
		</center>
		</td>
	</tr>	
</table>
