
<html>
<head>

<script type="text/javascript">
	function cancelForm() {
		document.forms["loginform"]["usrname"].value = "";
		document.forms["loginform"]["pwd"].value = "";

	}
</script>

</head>

<body>
	<div style="margin-left: 300px;">

		<h1>BoX Office Employee Panel</h1>
		<div id="area">
			<form name="loginform" action="CheckLogin" method="post">


				Employee Id :&nbsp;&nbsp;<input name="usrname" id="usrname"
					type="text" required="required" /><br /> <br /> Password
				&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<input name="pwd" id="pwd"
					type="password" required="required" /><br /> <br /> <input
					type="submit" id="buttonsubmit" value="LOGIN" /> <input
					type="button" id="buttoncancel" value="Back to HOME Panel"
					ONCLICK="window.location.href='index.htm'" /> <br>
				<%
					if (request.getAttribute("error_msg") != null) {
						out.print(request.getAttribute("error_msg"));
					}
				%>
			</form>
			<h3>
				Please login with<br> Employee Id : employee1 and Password :
				boxoffice

			</h3>

			<a id="newuser" href="">Don't have account! Register Now ? (Will
				be implemented Later !)</a> <br /> <a id="frgetpwd" href="">Forgot
				your Password ? (Will be implemented Later !)</a><br /> <br /> <br />
		</div>
	</div>
</body>
</html>
