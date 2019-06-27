<script type="text/javascript">
	
	$(document).ready(function(){
		activaTab('Judul');
		loadpanel('Judul');
		//loadpanel('Subjek');
	});
	
	
	
	
</script>

		<ul class="nav nav-tabs">
		    <li ><a href="#Judul" data-toggle="tab" onclick="activaTab('Judul');loadpanel('Judul');"> <i class="fa fa-file fa-fw"></i> Judul</a></li>
		    <li><a href="#Subjek" data-toggle="tab" onclick="activaTab('Subjek');loadpanel('Subjek');"> <i class="fa fa-quote-right fa-fw"></i>Subjek </a></li>
		    <li ><a href="#Penerbit" data-toggle="tab" onclick="activaTab('Penerbit');loadpanel('Penerbit');"> <i class="fa fa-pencil-square fa-fw"></i> Penerbit</a></li>
		    <li ><a href="#ISSN" data-toggle="tab" onclick="activaTab('ISSN');loadpanel('ISSN');"> <i class="fa fa-database fa-fw"></i> ISSN</a></li>
		    
		</ul>
		<div class="tab-content" id="tabs">
		    <div class="tab-pane" id="Judul" name="Judul"></div>
		    <div class="tab-pane" id="Subjek" name="Subjek"></div>
			<div class="tab-pane" id="Penerbit" name="Penerbit"></div>
			<div class="tab-pane" id="ISSN" name="ISSN"></div>		
		</div>
	