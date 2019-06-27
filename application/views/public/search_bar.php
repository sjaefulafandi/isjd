<script type="text/javascript">
	
	$(document).ready(function(){
		activaTab('artikel');
		loadpanel('artikel');
	});
	
	
</script>

		<ul class="nav nav-tabs">
		    <li ><a href="#artikel" data-toggle="tab" onclick="activaTab('artikel');loadpanel('artikel');"> <i class="fa fa-file fa-fw"></i> Judul</a></li>
		    <li><a href="#artikel_author" data-toggle="tab" onclick="activaTab('Subjek');loadpanel('artikel_author');"> <i class="fa fa-pencil fa-fw"></i>Pengarang </a></li>
		    <li ><a href="#artikel_bidang" data-toggle="tab" onclick="activaTab('artikel_bidang');loadpanel('artikel_bidang');"> <i class="fa fa-cubes fa-fw"></i> Bidang</a></li>
		</ul>
		<div class="tab-content" id="tabs">
		    <div class="tab-pane" id="artikel" name="artikel">
				<div id="paneltarget"></div>	    
		    </div>
		    <div class="tab-pane" id="artikel_author" name="artikel_author"> 
				<div id="paneltargetauthor"></div>	
			</div>
			<div class="tab-pane" id="artikel_bidang" name="artikel_bidang"> 
				<div id="paneltargetbidang"></div>	
			</div>
		
		</div>
	