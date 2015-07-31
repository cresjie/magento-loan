$j(function(){
	
	
	

	

	var app = angular.module('App',[]);
	app.controller('LoanAmountController',function($scope){
		$scope.currentStep = 1;
		$scope.loan = {};

		$j('#amount_slider').slider({
			value: parseInt(amountOptions.minimum),
			min: parseInt(amountOptions.minimum),
			max: parseInt(amountOptions.maximum),
			step: parseInt(amountOptions.offset),
			slide:function(e,ui){
				$j('#amount_container').html('$' + ui.value);
				$scope.loan.amount = ui.value;
				$scope.$apply();
			}
		});

		$j('#amount_container').html('$' + $j('#amount_slider').slider('value') );

		$scope.loan.amount = $j('#amount_slider').slider('value');
		$scope.durationOptions = durationOptions;

		$scope.getWeeks = function(duration){
			switch(duration.duration_unit){
				case 'weeks':
					return duration.duration_length * 1;
					break;
				case 'month(s)':
					return duration.duration_length * 4;
					break ;
				case 'year(s)':
					return duration.duration_length * 52;
					break;
				default:
					return 0;
					break;


			}
		}

		$scope.getWeeklyPayment = function(duration){
			return Math.round( ($scope.loan.amount + this.getFee(duration) ) /  this.getWeeks(duration) );
		}
		$scope.getFee = function(duration){
			return Math.round($scope.loan.amount * (duration.interest/100));
		}
		$scope.setDuration = function(duration){
			$scope.loan.duration = duration.duration_length + ' ' + duration.duration_unit;
			$scope.loan.i_duration = $scope.durationOptions.indexOf(duration);

		}

		$scope.nextStep = function(){
			if(typeof $scope.loan.i_duration == 'undefined'){
				return alert('Please select how would pay us');
			}
			$scope.currentStep++;
		}

		$scope.submit = function(url){
			window.location.href = url + '?amount=' + $scope.loan.amount + '&i_duration=' + $scope.loan.i_duration;
			
		}

		

	});

	

});

angular.element(document).ready(function(){
   		 angular.bootstrap(document,['App']);
  });
