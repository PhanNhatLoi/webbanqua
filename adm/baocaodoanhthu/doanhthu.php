<?php
	$tukhoa="";
	$dieukien = " ";

	if(isset($_POST['kieu_dt']))
	{
		$kieu_dt=$_POST['kieu_dt'];
		if($kieu_dt=="ngay"){
			$ngay_bd=$_POST['txtngay_bd'];
			$dieukien = "and ngay_gh = '{$ngay_bd}'";
		}
		if($kieu_dt=="nhieu_ngay"){
			$ngay_bd=$_POST['txtngay_bd'];
		$ngay_kt=$_POST['txtngay_kt'];
		$dieukien = "and ngay_gh BETWEEN '{$ngay_bd}' and '{$ngay_kt}'";
		}
		
	}
?>

<form name="doanhthu" action="" method="post">
<table border="0"> 
<td>
	<select id="dang_dt" name="dang_dt" onchange="myFunction2()">
				<option value="dang_sp">Sản phẩm</option>
				<option value="dang_donhang">Đơn hàng</option>
	</select>
</td>
	<td>
        <select id="kieu_dt" name="kieu_dt" onchange="myFunction()">
			<option value="null">Chọn kiểu xem</option>
            <option value="ngay">Một Ngày</option>
			<option value="nhieu_ngay">Nhiều Ngày</option>
        </select>
		<td><input type="hidden" name="txtngay_bd" id="txtngay_bd" style="width:100px;" placeholder="yyyy/mm/dd" value="" onchange="setEndDay()"/>
			<input type="hidden" name="txtngay_kt" id="txtngay_kt" style="width:100px;" placeholder="yyyy/mm/dd" value=""/>
			<input name="trangchuyen" type="hidden" value="quanlydoanhthu" />
			<input type="submit" value="Tìm" name="submit"/>
	</td>

</table>
</form>
<table id="table_donhang" width="750" cellpadding="2" cellspacing="0" border="0" class="admintable" style="display :none;border-right:#E9E9E9 1px solid; border-top:#E9E9E9 1px solid;" align="right">
	<tr>
		<th width="100" align="center" style="border-left:#66A111 solid 1px;">
			STT
		</th>
		<th width="100" align="center" style="border-left:#66A111 solid 1px;">
			 Mã Đơn hàng
		</th>
		<th width="90" align="center">
			Ngày giao
		</th>
		<th width="220">
			Khách hàng
		</th>
		<th width="200">
			Tổng giá trị
		</th>
    </tr>
	<?php 
		$i=0;
		$tongdoanhthu=0;
		$strSQL="SELECT * FROM dondathang Where hien_trang = 2 {$dieukien}";
		$dondathang=mysqli_query($conn,$strSQL);
		while($row=mysqli_fetch_array($dondathang))
		{
		$tongtien=0;
		$i+=1;
		$strCTDH="SELECT * FROM ct_dondathang WHERE ma_dh={$row['ma_dh']}";
		$CTDH=mysqli_query($conn,$strCTDH);
		?>
		<tr>
			<td align="center"><?php echo $i; ?></td>
			<td align="center"><?php echo $row['ma_dh']; ?></td>
			<td align="center"><?php echo $row['ngay_gh']; ?></td>
			<td align="center"><?php echo $row['tennguoinhan']; ?></td>
			<td align="center">
				<?php
					//lay ten qua thong qua ma qua
					$strCTDH="SELECT * FROM ct_dondathang WHERE ma_dh={$row['ma_dh']}";
					$CTDH=mysqli_query($conn,$strCTDH);
					while($rowCTDH=mysqli_fetch_array($CTDH))
					{
						$tongtien +=$rowCTDH['gia_ban']*$rowCTDH['sl_dat'];
						$tongdoanhthu += $rowCTDH['gia_ban']*$rowCTDH['sl_dat'];
					}
						echo $tongtien;
					?>
		</tr>
		<?php
		} ?>
		<th>
		Tổng doanh thu: 
		</th>
		<td>
		</td>
		<td>
		</td>
		<td>
		</td>
		<th width="200" align="center" style="border-left:#66A111 solid 1px;">
		<?php echo $tongdoanhthu?>
		</th>

		<!-- liet ke danh sach qua ban dc -->
		</table>

		<table id="table_sp" width="750" cellpadding="2" cellspacing="0" border="0" class="admintable" style="border-right:#E9E9E9 1px solid; border-top:#E9E9E9 1px solid;" align="right">
	<tr>
		<th width="100" align="center" style="border-left:#66A111 solid 1px;">
			STT
		</th>
		<th width="100" align="center" style="border-left:#66A111 solid 1px;">
			 Tên sản phẩm
		</th>
		<th width="90" align="center">
			Số lượng
		</th>
		<th width="220">
			Đơn giá
		</th>
		<th width="200">
			Tổng giá trị
		</th>
    </tr>
	<?php 
		$i=0;
		$strSQL="SELECT * FROM dondathang Where hien_trang = 2 {$dieukien}";
		$dondathang=mysqli_query($conn,$strSQL);
		$tongdoanhthu=0;
		while($row=mysqli_fetch_array($dondathang))
		{
		$strCTDH="SELECT * FROM ct_dondathang WHERE ma_dh={$row['ma_dh']}";
		$CTDH=mysqli_query($conn,$strCTDH);
		?>
				<?php
					//lay ten qua thong qua ma qua
					$strCTDH="SELECT * FROM ct_dondathang WHERE ma_dh={$row['ma_dh']}";
					$CTDH=mysqli_query($conn,$strCTDH);
					while($rowCTDH=mysqli_fetch_array($CTDH))
					{ $i+=1;?>
					<tr>
						<td align="center"><?php echo $i; ?></td>
						<td align="center">
						<?php
							$strSql_qua="SELECT * FROM qua WHERE ma_qua={$rowCTDH['ma_qua']}";
							$qua=mysqli_query($conn,$strSql_qua);
							$row_qua=mysqli_fetch_array($qua);
							echo $row_qua['ten_qua'];
						?></td>
						<td align="center"><?php echo $rowCTDH['sl_dat']; ?></td>
						<td align="center"><?php echo $rowCTDH['gia_ban']; ?></td>
						<td align="center"><?php echo $rowCTDH['gia_ban']*$rowCTDH['sl_dat'];
						$tongdoanhthu+=$rowCTDH['gia_ban']*$rowCTDH['sl_dat'];
						?></td>
					</tr>
		<?php
		}} ?>
		<th>
		Tổng doanh thu: 
		</th>
		<td>
		</td>
		<td>
		</td>
		<td>
		</td>
		<th width="200" align="center" style="border-left:#66A111 solid 1px;">
		<?php echo $tongdoanhthu?>
		</th>
		</table>

<script>
	function myFunction() {
		var bd = document.getElementById("txtngay_bd");
		var kt = document.getElementById("txtngay_kt");
		var get_option = document.getElementById("kieu_dt").value;
		if(get_option=="ngay")
			bd.setAttribute("type", "date");
		else bd.setAttribute("type", "hidden");
		if(get_option=="nhieu_ngay")
		{
			bd.setAttribute("type", "date");
			kt.setAttribute("type", "date");
		}
		else{
			// bd.setAttribute("type", "hidden");
			kt.setAttribute("type", "hidden");
		}
		
	}

	function myFunction2() {

		var get_option = document.getElementById("dang_dt").value;
		if(get_option=="dang_donhang")
			document.getElementById("table_donhang").style.display = "block";
		else document.getElementById("table_donhang").style.display = "none";
		if(get_option=="dang_sp")
			document.getElementById("table_sp").style.display = "block";
		else document.getElementById("table_sp").style.display = "none";
	}
	function setEndDay() {
		var get_startDay = document.getElementById("txtngay_bd").value;
		if(get_startDay!= null){
			document.getElementById("txtngay_kt").value=get_startDay;
			document.getElementById("txtngay_kt").min=get_startDay;
		}
	}
</script>