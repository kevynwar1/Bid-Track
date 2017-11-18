			<!-- footer class="footer">
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
			</footer -->
		</div>
	</div>
</body>


<script src="<?= base_url(); ?>assets/js/custom-file-input.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/jquery.tablesorter.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/config-tablesorter.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/material.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/chartist.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap-notify.js"></script>
<script src="<?= base_url(); ?>assets/js/material-dashboard.js"></script>
<script src="<?= base_url(); ?>assets/js/demo.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyIn0nbXxWrWrdyV9plcwTO_bJ-Rm9y7w&callback=initMap" async defer>
</script>
<script type="text/javascript">
	demo = {
		initDashboardPageCharts: function(){
			dataDailySalesChart = {
				labels: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
				series: [
					<?php if($entrega == '0'): ?>
						[0, 0, 0, 0, 0, 0, 0]
					<?php else: ?>
						[37, 7, 21, 25, 12, 33, 38]
					<?php endif; ?>
				]
			};

			optionsDailySalesChart = {
				lineSmooth: Chartist.Interpolation.cardinal({
					tension: 0
				}),
				low: 0,
				high: 50,
				chartPadding: { top: 0, right: 0, bottom: 0, left: 0},
			}

			var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);
			md.startAnimationForLineChart(dailySalesChart);

			dataCompletedTasksChart = {
				labels: ['12am', '3pm', '6pm', '9pm', '12pm', '3am', '6am', '9am'],
				series: [[230, 750, 450, 300, 280, 240, 200, 190]]
			};

			optionsCompletedTasksChart = {
				lineSmooth: Chartist.Interpolation.cardinal({
					tension: 0
				}),
				low: 0,
				high: 1000,
				chartPadding: { top: 0, right: 0, bottom: 0, left: 0}
			}

			var completedTasksChart = new Chartist.Line('#completedTasksChart', dataCompletedTasksChart, optionsCompletedTasksChart);

			md.startAnimationForLineChart(completedTasksChart);

			var dataEmailsSubscriptionChart = {
				labels: ['Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out'],
				series: [
					<?php if($faturamento[0]->valor == FALSE): ?>
						[0, 0, 0, 0, 0, 0, 0, 0]
					<?php else: ?>
						[35, 33, 15, 77, 70, 35, 54, 43]
					<?php endif; ?>
				]
			};

			var optionsEmailsSubscriptionChart = {
				axisX: {
					showGrid: false
				},
				low: 0,
				high: 100,
				chartPadding: { top: 0, right: 5, bottom: 0, left: 0}
			};

			var responsiveOptions = [
				['screen and (max-width: 640px)', {
					seriesBarDistance: 5,
					axisX: {
						labelInterpolationFnc: function (value) {
							return value[0];
						}
					}
				}]
			];
			var emailsSubscriptionChart = Chartist.Bar('#emailsSubscriptionChart', dataEmailsSubscriptionChart, optionsEmailsSubscriptionChart, responsiveOptions);

			md.startAnimationForBarChart(emailsSubscriptionChart);
		}
	}

	$(document).ready(function(){
		demo.initDashboardPageCharts();
	});
</script>
</html>