<?php
function convertSize($size)
{
	$newsize = $size;
	$sizemark = "byte";
	if( $size >= 1024 ) { 
		   $newsize = $size / 1024;
		   $sizemark = "KB"; 
	}
	if( $newsize >= 1024 ) { 
		  $newsize = $newsize / 1024 ;
		  $sizemark = "MB"; 
	}
	if( $newsize >= 1024 ) { 
		  $newsize = $newsize / 1024 ;
		  $sizemark = "GB"; 
	}
	$point = strpos(  $newsize, '.' );
	$virgule = strpos(  $newsize, ',' );
	if( $point == false && $virgule == false ) {
		$newsize =  $newsize;
	} elseif( $point > 0 && $sizemark != "KB" ) {
		 $newsize = substr( $newsize, 0, $point + 3 );
	} elseif( $virgule > 0 && $sizemark != "KB" ) {
		 $newsize = substr( $newsize, 0, $virgule + 3 );
	} elseif( $point > 0 ) {
		 $newsize = substr( $newsize, 0, $point );
	} elseif( $virgule > 0 ) {
		$newsize = substr( $newsize, 0, $virgule );
	}
	return $newsize." $sizemark";
}
	
?>
	</div> <!-- //mid -->
	</div> <!-- //corps -->
	<div id="footer">
		<div id="copyright">
			Copyright © 2007 - 2012 Formula One Manager, all rights reserved
		</div>
		<div id="design">
			Designed by
		</div>
		
		<!--<div id="cat_foot">
			<div id="title">FOM</div>
		</div>-->
		<!--<hr>
		footer...<br /><br />
		config time: <?= $Bld['config_time'] ?> <br />
		global time: <?= number_format(microtime(true) - $Bld['microtime'], 4); ?> <br />
		mod:  <?= $Bld['site']['module'] ?> <br />
		arg1: <?= $Bld['site']['arg1'] ?><br />
		args: <?= $Bld['site']['args'] ?><br /><br />
		
		util.mémoire: <?= convertSize(Memory_get_usage()) ?><br />
		util.mémoire(true): <?= convertSize(Memory_get_usage(true)) ?><br />
		
		<?php $timeJS = microtime(true); ?>
		<!-- Analytics -->
		<!--<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-21063120-1']);
		_gaq.push(['_trackPageview']);

		(function() 
		{
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'static.f1m.fr/styles/defaut/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();

		</script>
		
		<?php $finalTimeJS = number_format(microtime(true) - $timeJS, 6); ?>
		analytics: <?= $finalTimeJS ?>
		-->
		
	</div>
	
	</div> <!-- #page -->
  </body>
</html>