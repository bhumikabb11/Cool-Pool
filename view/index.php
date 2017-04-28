<?php 
include "header.php";

?>

<script type="text/javascript">
	var title = "Home Page";
	$("title").html(title);
</script>
	<div class="container-fluid mainView">
		<div class="row mainDiv">
			<div class="col-lg-2">
				
			</div>
			<div class="col-lg-8">
				<div class="row mainContent">
					<div class="col-md-12">
						<h1><b>FIND YOUR PERFECT RIDESHARE</b></h1>
					</div>
				</div>
				<form>
					<div class="form-group">
						 <div class="input-group">
					      <input type="text" class="form-control mainSearch" placeholder="Search for...">
					      <span class="input-group-btn">
					        <button class="btn btn-default mainSearchBtn" type="submit">Go!</button>
					      </span>
					    </div><!-- /input-group -->
					</div>
				</form>
			</div>
			<div class="col-lg-2">
				
			</div>
		</div>
	</div>
<?php 
include "footer.php";
?>