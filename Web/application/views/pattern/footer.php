			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul>
							<li><a href="#">Dashboard</a></li>
							<li><a href="#">Cargas</a></li>
							<li><a href="#">Rastreamento</a></li>
						</ul>
					</nav>
					<p class="copyright pull-right">
						<?= SYSTEM_NAME; ?>
					</p>
				</div>
			</footer>
		</div>
	</div>

</body>
	<script src="<?= base_url(); ?>assets/js/jquery-3.1.0.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/js/custom-file-input.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/js/jquery.tablesorter.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/js/config-tablesorter.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/js/material.min.js" type="text/javascript"></script>
	<script src="<?= base_url(); ?>assets/js/chartist.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/bootstrap-notify.js"></script>
	<script src="<?= base_url(); ?>assets/js/material-dashboard.js"></script>
	<script src="<?= base_url(); ?>assets/js/demo.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyIn0nbXxWrWrdyV9plcwTO_bJ-Rm9y7w&callback=initMap" async defer></script>
	<script type="text/javascript">
    	$(document).ready(function(){
        	demo.initDashboardPageCharts();

			$("#procurar").focus(function() {
				$("#opcao").css("display", "block").fadeIn(3000);
			});
    	});
	</script>
</html>