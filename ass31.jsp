 <%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Insert title here</title>
</head>
<body>

</body>
</html>
<jsp:useBean id="obj" class="ass.demo"> 
   <jsp:setProperty property="store" name="obj" value="2"/> 
 <jsp:getProperty property="eid" name="obj"/>
<jsp:getProperty property="ename" name="obj"/>
<jsp:getProperty property="image" name="obj"/>
<jsp:getProperty property="dob" name="obj"/>

</jsp:useBean>