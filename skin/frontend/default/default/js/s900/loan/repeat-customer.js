var loanForm,accountInfo;

angular.element(document).ready(function(){
   		 angular.bootstrap(document,['App']);

   		 loanForm = new varienForm('loan_form');
   		 accountInfo = new varienForm('account_info');
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

app.controller('AccountInfoController',function($scope,$rootScope){

	$scope.save = function(){

		if( accountInfo.validator.validate() && loanForm.validator.validate() ){
			new Ajax.Request($('account_info').action,{
				method: 'post',
				parameters: $scope.account,
				onComplete: function(res){
					
					if( !res.responseJSON.success){
						alert( res.responseJSON.error_msg.join('\n') );
					}else{
						console.log('loan.success');
						$rootScope.account = res.responseJSON.data;
						$rootScope.redirect = res.responseJSON.redirect;
						$rootScope.$broadcast('account.success');
						
					}
				},
				onFailure: function(){
					console.log('account.fail');
				}
			});
		}
			
	}

	$scope.check = function(){
		console.log($scope);
	}
});