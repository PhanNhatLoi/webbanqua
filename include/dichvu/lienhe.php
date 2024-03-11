
<div style="width:587px; margin-left:3px; margin-right:3px;">
	<table width="587" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td style="height:25px; background:url(images/trang.jpg) repeat-x;" align="center" class="ht" colspan="3">
					Liên Hệ
			</td>
		</tr>
		<tr>
				<td>
				<table width="587" height="120" cellpadding="0" cellspacing="0" border="0" style="border:#CCCCCC 1px solid; margin-top:3px;
						background:url(images/lienhe.jpg) no-repeat right;">
					<tr>
					<td>
<script language="JavaScript" type="text/javascript">
	function kiemtra()
	{
		var ten=frm.txtten.value;
		var sdtlh=frm.sdtlh.value;
		var mail=frm.txtemail.value;
		var dia=frm.txtdc.value;
		var nd=frm.txtnd.value;
		
		if(ten=="")
		{
			document.all('loihoten').innerHTML="Họ Tên bat buoc phai nhap !"
			frm.txtten.style.backgroundColor='#FFFFCC'
			frm.txtten.focus()
			return false
		}
		else
		{
			document.all('loihoten').innerHTML=""
			frm.txtten.style.backgroundColor='#FFFFFF'
			
		}
		
		kieu=/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/
		lt=kieu.test(sdtlh)
		
		if(sdtlh=="")
		{
			document.all('loisdt').innerHTML="Bạn Chưa Nhập Số Điện Thoại !"
			frm.sdtlh.style.backgroundColor='#FFFFCC'
			frm.sdtlh.focus()
			return false
		}
		else
		{	
			if(lt==false)
			{
				document.all('loisdt').innerHTML="Bạn Phải Nhập Bằng Số Và Có Từ 10 Đến 11 Chữ Số!"
				frm.sdtlh.style.backgroundColor='#FFFFCC'
				frm.sdtlh.focus()
				return false
			}
			else
			{
			document.all('loisdt').innerHTML=""
			frm.sdtlh.style.backgroundColor="#FFFFFF"
			}
			
		}
		
		dangmail= /^[\w.-]+@[\w.-]+\.[A-Za-z]{2,4}$/
		kq=dangmail.test(mail)
		if(mail=="")
		{
			document.all('loimail').innerHTML="Bạn Chưa Nhập Email !"
			frm.txtemail.style.backgroundColor="#FFFFCC"
			frm.txtemail.focus()
			return false
		}
		else
		{	
			if(kq==true)
			{
			document.all('loimail').innerHTML=""
			frm.txtemail.style.backgroundColor="#FFFFFF"
			}
			else
			{
			document.all('loimail').innerHTML="Bạn Nhập Sai Dạng Email - Email Có Dạng Ví Dụ Như: tenban@gmail.com"
			frm.txtemail.style.backgroundColor="#FFFFCC"
			frm.txtemail.focus()
			return false
			}
			
		}
		
		if(dia=="")
		{
			document.all('loidiachi').innerHTML="Bạn Chưa Nhập Địa Chỉ !"
			frm.txtdc.style.backgroundColor="#FFFFCC"
			frm.txtdc.focus()
			return false
		}
		else
		{	

			document.all('loidiachi').innerHTML=""
			frm.txtdc.style.backgroundColor="#FFFFFF"
		}
		if(nd=="")
		{
			document.all('loind').innerHTML="Bạn Chưa Gửi Yêu Cầu !"
			frm.txtnd.style.backgroundColor="#FFFFCC"
			frm.txtnd.focus()
			return false
		}
		else
		{	

			document.all('loind').innerHTML=""
			frm.txtnd.style.backgroundColor="#FFFFFF"
		}
		
		return true
	}

</script>

<?php

	if(isset($_SESSION['makhachhang']))
	{
		$makhachhang=$_SESSION['makhachhang'];
		
		$strSQL="SELECT * FROM khach_hang WHERE ma_kh={$makhachhang}";
		$khachang=mysqli_query($conn,$strSQL);
		$row=mysqli_fetch_array($khachang);
	}

?>
			
  <form id="frm" name="frm" method="post" action="" onsubmit="return kiemtra()">
 <?php include_once('xl_lienhe.php'); ?>
    <table cellpadding="4" cellspacing="0" border="0" align="center" width="450">
      <tr>
	  	<td colspan="2" height="60" style="background:url(images/thutin.jpg) no-repeat left;" align="center">
			&nbsp;&nbsp;Mọi thắc mắc yêu cầu vui lòng điền đầy đủ thông tin ở bên dưới
		</td>
		</tr>
		<tr>
	 
       		<td width="120">Họ Tên</td>
        	<td width="330"><input name="txtten" type="text" id="txtten" size="40" value="<?php echo $_SESSION['hovaten']; ?>" />
      			  &nbsp;&nbsp;<font color="#FF6600">*</font><br />
			<span id="loihoten" style="color:#FF6600;"></span>		
			</td>
      </tr>
      <tr>
	 
       		<td width="120">Số điện thoại</td>
        	<td width="330"><input name="sdtlh" type="text" id="sdtlh" size="40" value="" />
      			  &nbsp;&nbsp;<font color="#FF6600">*</font><br />
			<span id="loisdt" style="color:#FF6600;"></span>		
			</td>
      </tr>
      <tr>
        	<td align="left">Email</td>
       		 <td><input name="txtemail" type="text" id="txtemail" size="40" value="<?php if($_SESSION['hovaten']!= "") echo $row['email']; ?>" />
      			  &nbsp;&nbsp;<font color="#FF6600">*</font><br />
		<span id="loimail" style="color:#FF0000;"></span>		</td>
      </tr>
      <tr>
       		 <td>Giới Tính</td>
      	 	 <td>
			<select name="gioitinh">
				<option value="1">Chưa Xác Định</option>
				<option value="2" selected>Nam</option>
				<option value="3">Nữ</option>
				
			</select>		
			</td>
      </tr>
	   <tr>
        	<td>Địa Chỉ</td>
       		 <td><input name="txtdc" id = "txtdc" style="border-right:none; height:40px" value="<?php if($_SESSION['hovaten']!= "") echo $row['dia_chi']; ?>"/>
				 &nbsp;&nbsp;<font color="#FF6600">*</font>
		<br />
		<span id="loidiachi" style="color:#FF6600;"></span>		</td>
      </tr>
	  <tr>
        	<td align="left">Nội dung</td>
       		 <td><input name="txtnd" id = "txtnd" style="border-right:none; height:40px" value=""/>
				 &nbsp;&nbsp;<font color="#FF6600">*</font>
		<br />
		<span id="loind" style="color:#FF6600;"></span>		</td>
      </tr>
        <td colspan="2" align="center">
		 	<input name="goiham" type="hidden" value="lienhe" />
			<input name="view" type="hidden" value="xllienhe" />

			 <input type="submit" name="Submit" value="Gửi Đi" style="background:#FFFFFF;" onclick="kiemtra()"/>	
			</td>     
      </tr>
    </table>
  </form>

				</td>
			</tr>
		</table>
		
				</td>
		</tr>
  </table>
</div>
