app.controller('TestController', function($scope, $http, $mdToast, $window){
	// toast
	function showMessage(e, v) {
		var pinTo = {
			bottom: false,
			top: true,
			left: false,
			right: true
		};
		pinTo = angular.extend({}, pinTo);
		$mdToast.show(
			$mdToast.simple()
			.textContent(e)
			.parent(angular.element(document.body))
			.position('bottom right')
			.hideDelay(3500)
		);
	}
	$scope.testStart = function(e){
		var data = {id: e};
		$http.post(app.baseUrl + "api/test/gen", data)
		.then(function(response) {
			if(response.status === 200){
				$window.location.href = app.baseUrl + 'test/' + response.data.key + '/progress';
			}
		}, function(response) {
			showMessage("Bạn cần đăng nhập để bắt đầu");
		});
	};
});