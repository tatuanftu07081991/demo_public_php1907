<!-- Liên kết thư viện jQuery Form -->
    <script src="<?php echo $_DOMAIN; ?>scripts/bootstrap/js/jquery.form.min.js"></script>
    <script src="<?php echo $_DOMAIN; ?>scripts/form.js"></script>
    <script src="<?php echo $_DOMAIN; ?>scripts/department.js"></script>
    <?php
		 
		// Active sidebar
		// Lấy tham số tab
		if (isset($_GET['ac']))
		{
		    $ac = trim(addslashes(htmlspecialchars($_GET['ac'])));
		}
		else
		{
		    $ac = '';
		}
		 
		// Nếu có tham số tab
		if ($ac != '')
		{
		    // Tháo active của Bảng điều khiển
		    echo '<script>$(".sidebar ul a:eq(1)").removeClass("active");</script>';
		    // Active theo giá trị của tham số tab
		    if ($ac == 'profile')
		    {
		        echo '<script>$(".sidebar ul a:eq(2)").addClass("active");</script>';
		    }
		    else if ($ac == 'changePW')
		    {
		        echo '<script>$(".sidebar ul a:eq(3)").addClass("active");</script>';
		    }
		    else if ($ac == 'signup')
		    {
		        echo '<script>$(".sidebar ul a:eq(4)").addClass("active");</script>';
		    }
		    else if ($ac == 'departmentList')
		    {
		        echo '<script>$(".sidebar ul a:eq(6)").addClass("active");</script>';
		    }
		    else if ($ac == 'accounts')
			{
			    echo '<script>$(".sidebar ul a:eq(5)").addClass("active");</script>';
			}
			else if ($ac == 'equipment')
			{
			    echo '<script>$(".sidebar ul a:eq(7)").addClass("active");</script>';
			}
	
		}		 
	?>
</div>
</body>
</html>