app.controller('ProgressController', function($scope, $http, $mdToast, $interval) {
	$scope.success = false;
	$scope.preTest = true;
	$scope.timeOut = null;

	$scope.config = {
		time: 0,
		nums: 0,
		key: 0
	};
	$scope.question = {
		num: 0,
		question: null,
		answer: [],
		action: 'next'
	};
	$scope.result = {
		key: $('input.key').val(),
		num: 0,
		answer: 0,
		timeOut: 999999
	};

	function countDown(e) {
		if (e === 0) $interval.cancel($scope.timeOut);
		else {
			$scope.timeOut = $interval(function() {
				$scope.config.time--;
				if ($scope.config.time === 0) {
					$interval.cancel($scope.timeOut);
					$scope.result.timeOut = 1;
					next();
				}
			}, 1000);
		}
	}
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

	function next() {
		countDown(0);
		$scope.result.timeOut = $scope.config.time;
		$http.post(app.baseUrl + "api/test/next", $scope.result)
			.then(function(response) {
				$scope.question = response.data;
				$scope.preTest = false;
				$scope.result.answer = 0;
				countDown(1);
				// kết thúc test
				if (response.status === 202) {
					countDown(0);
					$scope.success = true;
				}
			}, function(response) {
				showMessage("Có lỗi xảy ra! vui lòng thử lại.");
			});
	}

	$scope.formatNumber = function(i) {
	    return Math.floor(i); 
	};
	$scope.nextQuestion = function() {
		$scope.result.num = $scope.question.num;
		if ($scope.question.num <= $scope.config.nums) next();
	};
	$scope.testStart = function(e) {
		var data = {
			key: $('input.key').val()
		};
		$http.post(app.baseUrl + "api/test/start", data)
			.then(function(response) {
				$scope.config = response.data;
				next();
			}, function(response) {
				showMessage("Có lỗi xảy ra! vui lòng thử lại.");
			});
	};
	// disable keyboard/ copy/ contextmenu
	$scope.disableFunction = function(){
		// context menu
		$(document).bind("contextmenu",function(e){
			showMessage("Vui lòng tuân thủ nội quy.");
		 	e.preventDefault();
		});
		// copy/ keyboard/ dev tools
		// $(document).keydown(function(ev) { 
		// 	showMessage("Vui lòng tuân thủ nội quy.");
		// 	return false;
		// });
	};
	$scope.disableFunction();
});