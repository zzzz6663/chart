<?php
include 'header.php';

 


 ?>
 <div class="main-panel">
 	<?php 
  
 	 ?>
 	 <div class="content">
 	 	 <div class="container-fluid">
          <div class="row">
				<?php echo $content ;   ?>
				

 	 
		  </div>
		 </div>
 	 </div>
 </div>
	

 

<?php 
include 'footer.php';
 ?>


 







<!-- <div id="header">
	<div id="clock">
		<span dir="ltr"><?= jdate('y J F');?></span>
		<br>
		<?=  jdate('H:i:s');?>
	 
	</div>
	
	 <script type="text/javascript">
	 	
	 	function loadclock() {
	 		$("#clock").load(location.href + " #clock");
	 	}
	 	 setInterval(loadclock,100);
	 </script>
</div> -->
