<HTML>
<HEAD> <TITLE>Activity - Insert animated GIF to HTML</TITLE> 
<style type="text/css">
	
.container {
  position: relative;
  text-align: center;
  color: white;
}

/* Bottom left text */
.bottom-left {
  position: absolute;
  bottom: 8px;
  left: 16px;
}

/* Top left text */
.top-left {
  position: absolute;
  top: 8px;
  left: 16px;
}

/* Top right text */
.top-right {
  position: absolute;
  top: 8px;
  right: 16px;
}

/* Bottom right text */
.bottom-right {
  position: absolute;
  bottom: 8px;
  right: 16px;
}

/* Centered text */
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

body{

	background-color: #000000;
}


</style>

</HEAD>
<BODY >
<div class="container">
  <img src="pic1.jpg" alt="Snow" style="width:100%;">
  <div class="bottom-left">Bottom Left</div>
  <div class="top-left">Top Left</div>
  <div class="top-right">Top Right</div>
  <div class="bottom-right">Bottom Right</div>
  <div class="centered">Centered</div>
</div>	
</BODY>
</HTML>