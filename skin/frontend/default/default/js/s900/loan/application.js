var personalForm,loanForm;
angular.element(document).ready(function(){
   		 angular.bootstrap(document,['App']);

   		 personalForm = new varienForm('personal_form');
   		 loanForm = new varienForm('loan_form');
});

var app = angular.module('App',['angular.filter']);
app.controller('LoanApplicationController',function($scope,$rootScope){

	$scope.reasonCategory = reasonCategory;
	$scope.durationOptions = durationOptions;

	$rootScope.$on('account.success',function(){
		console.log('sending.loan');
		
		$scope.loan.account_id = $rootScope.account.id;
		$scope.loan.status = -1;

		new Ajax.Request($('loan_form').action,{
			method: 'post',
			parameters: $scope.loan,
			onComplete: function(res){
				if( !res.responseJSON.success){
					alert( res.responseJSON.error_msg.join('\n') );
				}else{

					console.log('loan.success');
					window.location.replace( $rootScope.redirect );
				}
			},
			onFailure: function(){
				console.log('loan.fail');
			}
		});
	});

	$scope.setDurationInterest = function(){
		$scope.loan.interest = $scope.selectedDuration.interest;
		$scope.loan.duration = $scope.selectedDuration.duration_length + ' ' + $scope.selectedDuration.duration_unit;
	}

	

	
});

app.controller('PersonalDetailsController',function($scope,$rootScope){
	

	$scope.save = function(){
		if( loanForm.validator.validate() && personalForm.validator.validate()   ){
			

			if(!$rootScope.account){
				new Ajax.Request($('personal_form').action,{
					method: 'post',
					parameters: $scope.account,
					onComplete: function(res){
						
						if(!res.responseJSON.success){
							alert(res.responseJSON.error_msg.join('\n'));
						}else{
							$rootScope.account = res.responseJSON.data;
							$rootScope.redirect = res.responseJSON.redirect;
							$rootScope.$broadcast('account.success');
							console.log('account.success');
						}


					},
					onFailure: function(){
						console.log('account.fail');
					}
				});
			}else{
				$rootScope.$broadcast('account.success');
			}
				
		}
	}
});