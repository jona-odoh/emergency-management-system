
<SCRIPT LANGUAGE="JavaScript">
currentTime=new Date();
//getHour() function will retrieve the hour from current time
if(currentTime.getHours()<12)
document.write("<b>Good Morning </b>");
else if(currentTime.getHours()<17)
document.write("<b>Good Afternoon </b>");
else 
document.write("<b>Good Evening </b>");
</SCRIPT>
