/**
 *
 * @author: Lê Vĩnh Thiện - GMO Runsystem
 * @date: 11/07/16
 * 
 */
app.controller('QuestionController', function($scope, $http, $mdToast, $mdDialog) {

	$scope.data = null;
	$scope.toggle = true;
	$scope.toggleError = false;
	$scope.action = "ADD";
	$scope.levels = null;

	function httpGetLevels() {
		$http.get(app.baseUrl + 'admin/api/level')
			.then(function(response) {
				$scope.levels = response.data;
				console.log($scope.levels);
			});
	}

	httpGetLevels();
	$scope.checkLevel = function(q) {
		var result = $.grep($scope.levels, function(e) {
			return e.id === q.id;
		});
		return result[0].title;
	};

	function showMessage(e) {
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
			//.parent(angular.element(document.body))
			.position('bottom right')
			.hideDelay(3500)
		);

	}

	// post request
	function httpPost(string, data, stringSuccess, stringError, isRefresh) {
		$scope.toggleError = true;
		$http.post(app.baseUrl + string, data).then(function(response) {
			httpGetData();
			if (isRefresh === 1) showMessage(stringSuccess);
			$scope.toggle = true;
			$scope.toggleError = false;
		}, function(response) {
			if (isRefresh === 1) showMessage(stringError);
			$scope.toggleError = false;
		});
	}


	$scope.question = {
		category_id: $('.category_id').val(),
		question: '',
		levels_id: 0,
		answer: [{
			content: '',
			isRight: 1
		}]
	};

	function httpGetData() {
		console.log($scope.question);
		$http.get(app.baseUrl + 'admin/api/question/' + $scope.question.category_id)
			.then(function(response) {
				$scope.data = response.data;
				// console.log(1);
			});
	}

	$scope.toggleClick = function(e, v) {
		//console.log(e);
		$scope.action = v || '';
		if (e === null) {
			$scope.question = {
				category_id: $('.category_id').val(),
				question: '',
				levels_id: 0,
				answer: [{
					content: '',
					isRight: 1
				}]
			};
		} else {
			$http.get(app.baseUrl + 'admin/api/question/show/' + e.id)
				.then(function(response) {
					$scope.question = response.data;
					console.log(response.data);
				});

		}
		$scope.toggle = !$scope.toggle;

	};

	$scope.isRight = function(e) {
		for (var i = 0; i < $scope.question.answer.length; i++) {
			$scope.question.answer[i].isRight = e.$$hashKey === $scope.question.answer[i].$$hashKey ? 1 : 0;
		}
	};

	$scope.removeAnswer = function(e) {
		var index = $scope.question.answer.indexOf(e);
		$scope.question.answer.splice(index, 1);
	};

	$scope.addAnswer = function() {
		var answer = {
			content: '',
			isRight: 0
		};
		$scope.question.answer.push(answer);
	};

	$scope.saveQuestion = function() {
		if ($scope.action === 'ADD')
			httpPost('admin/api/question/store',
				$scope.question,
				'Thêm câu hỏi mới thành công',
				'Có lỗi xảy ra!', 1);
		else
			httpPost('admin/api/question/update',
				$scope.question,
				'Cập nhật câu hỏi thành công',
				'Có lỗi xảy ra!', 1);
	};

	$scope.deleteQuestion = function(e) {
		var confirm = $mdDialog.confirm()
			.title('Cảnh báo')
			.textContent('Bạn có muốn xóa câu hỏi này?')
			.ok('Đồng ý')
			.cancel('Hủy');
		$mdDialog.show(confirm).then(function() {
			httpPost("admin/api/question/delete", e, "Xóa câu hỏi thành công", "Lỗi! xin thử lại", 1);
		});
	};
	// auto run
	httpGetData();
});