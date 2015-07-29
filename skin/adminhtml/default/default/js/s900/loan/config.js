	
	var configForm,
		app = angular.module('App',['angular.filter']);

	app.factory('ConfigFactory',function($http){
		var factory = {};

		factory.getConfig = function(){
			return $http({url: GET_CONFIG_URL,method:'get'});
		}

		return factory;
	});

	app.factory('ReasonFactory',function($http){
		var factory = {},
			headers = {'Content-Type': 'application/x-www-form-urlencoded'},
			transformRequest = function(obj) {
		        var str = [];
		        for(var p in obj)
		        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
		        return str.join("&");
		    },
		 	urls

		factory.setUrls = function(u){
			urls = u;
			return this;
		}

		factory.get  = function(){
			return $http({
				url: urls.get,
				method:'get'
			});
		}
		factory._send = function(url,data){
			return $http({
				url: url,
				method:'post',
				headers: headers,
				transformRequest: transformRequest,
				data: data
			});
		}
		factory.create = function(data){
			return this._send(urls.create,data);
		}
		factory.delete = function(data){
			return this._send(urls.delete, data);
		}
		factory.edit = function(data){
			return this._send(urls.edit, data);
		}

		return factory;
	});

	app.controller('LoanReasonController',function($scope,$timeout,ReasonFactory){

		var orginalCat,
			hiddenRow = {},
			fromSubmit = false,
			isTriggered = false;


		$scope.categories = [];

		ReasonFactory.setUrls(REASON_URL)
					.get().success(function(data){
						$scope.categories = data.items
					});


		$scope.deleteReasonCat = function(catObj, event){
			event.preventDefault();
			var i = $scope.categories.indexOf(catObj) ;

			if( confirm('Are you sure you want to remove this category?') ){
				ReasonFactory.delete({form_key:FORM_KEY,cat_id: catObj.cat_id});
				$scope.categories.splice(i,1);
			}
		}

		$scope.addRootCat = function(){

			var title = window.prompt('Name of the root category');

			if(title){

				if( title.match('[a-zA-Z0-9]') ){
					ReasonFactory.create({cat_name:title,parent_id:0,form_key:FORM_KEY}).success(function(data){
						$scope.categories.push(data);
					});
					

				}
			}

		}



		$scope.addSubCat = function(){

			if( !$scope.selectedRoot){
				window.alert('Select a root category first');
			}else{
				var title = window.prompt('Name of the sub category');
				if(title){
					if( title.match('[a-zA-Z0-9]') ){
						ReasonFactory.create({form_key:FORM_KEY,cat_name:title,parent_id:$scope.selectedRoot.cat_id})
									.success(function(data){
										$scope.categories.push(data);
									});
					}
				}
			}
			
		}

		$scope.isSubCatHidden = function(i){
			return hiddenRow['row_'+i];
		}
		$scope.toogleSubCat = function(i){
			hiddenRow['row_'+i] = !hiddenRow['row_'+i]
		}
		$scope.selectRoot = function(cat){
			$scope.selectedRoot = cat;
		}
		$scope.editCat = function(cat){
			$scope.editedCat = cat;
			orginalCat = angular.extend({},cat);
		}

		$scope.cancelEdit = function(cat){
			
			
			$scope.categories[ $scope.categories.indexOf(cat) ] = orginalCat;
			$scope.editedCat = null;
			orginalCat = null;
			
			isTriggered = true;
			

		}

		$scope.saveCat = function(cat,eventName){
			if( isTriggered ){
				isTriggered = false;
				return;
			}

			ReasonFactory.edit({form_key:FORM_KEY,cat_id:cat.cat_id,cat_name:cat.cat_name})
						.success(function(data){
							$scope.categories[ $scope.categories.indexOf(cat) ] = cat;
							
						});
			
			$scope.editedCat = null;
			orginalCat = null;

			if(eventName == 'submit')
				isTriggered = true;

			
		}

	});
	app.directive('ngEscape',function(){
		return function(scope, elem, attrs){
			elem.bind('keyup',function(event){
				if(event.keyCode == 27){
					scope.$apply(function(){
						scope.$eval(attrs.ngEscape);
					});
				}
			});
		}
	});
    app.directive('ngFocusMe',function($timeout){
    	return function(scope, elem, attrs){
    		scope.$watch(attrs.ngFocusMe,function(newVal){
    			if(newVal){
    				$timeout(function () {
						elem[0].focus();
					}, 0);
    			}
    		});
    	}
    });





   app.controller('ConfigController',function($scope,$http,ConfigFactory){

   		$scope.durations= [];

   		$scope.AddDuration = function(){
   			$scope.durations.push({});
   		}

   		$scope.DeleteDuration = function(i){

   				$scope.durations.splice(i,1);
   		}

   		$scope.SaveConfig = function(){

   			document.getElementById('duration_options').value = angular.toJson($scope.durations);
   			document.getElementById('amount_options').value = angular.toJson($scope.loanAmount);
   			
   			if( configForm.submit() ){
   				$('loading-mask').show();
   			}
   			
   			
   		}

   		
   		
   		ConfigFactory.getConfig().success(function(data){
   			$scope.durations = data.duration_options;
   			$scope.loanAmount = data.amount_options;
   		});



   });

   angular.element(document).ready(function(){
   		 angular.bootstrap(document,['App']);
   		 configForm = new varienForm('config_form');
   });



    
  