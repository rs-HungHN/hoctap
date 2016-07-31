/**
 *
 * @author: Lê Vĩnh Thiện - GMO Runsystem
 * @date: 10/07/16
 * 
 */

var app = angular.module("elearning", ['ngMaterial', 'ngMessages', 'ui.tinymce']);
app.baseUrl = $('base').attr('href') + "/";
app.controller('CategoryController', function($window, $scope, $http, $mdDialog, $mdToast, $rootScope) {
	$scope.toggleCourse = false;
	$scope.toggleCourseAdd = false;
	$scope.toggleCourseEdit = false;
	$scope.focusData = null;
	$scope.newCourse = {
		title: "",
		nums: 0,
		time: 0,
		description: "",
		category_id: 0
	};
	$scope.config = {
		nums: [
			1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18,
			19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36,
			37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54,
			55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72,
			73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90,
			91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108,
			109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 126,
			127, 128, 129, 130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 140, 141, 142, 143, 144,
			145, 146, 147, 148, 149, 150, 151, 152, 153, 154, 155, 156, 157, 158, 159, 160, 161, 162,
			163, 164, 165, 166, 167, 168, 169, 170, 171, 172, 173, 174, 175, 176, 177, 178, 179, 180,
		],
		time:[
			60, 120, 180, 240, 300, 360, 420, 480, 540, 600, 660, 720, 780, 840, 900, 960, 1020, 1080,
			1140, 1200, 1260, 1320, 1380, 1440, 1500, 1560, 1620, 1680, 1740, 1800, 1860, 1920, 1980, 2040, 2100, 2160,
			2220, 2280, 2340, 2400, 2460, 2520, 2580, 2640, 2700, 2760, 2820, 2880, 2940, 3000, 3060, 3120, 3180, 3240,
			3300, 3360, 3420, 3480, 3540, 3600, 3660, 3720, 3780, 3840, 3900, 3960, 4020, 4080, 4140, 4200, 4260, 4320,
			4380, 4440, 4500, 4560, 4620, 4680, 4740, 4800, 4860, 4920, 4980, 5040, 5100, 5160, 5220, 5280, 5340, 5400,
			5460, 5520, 5580, 5640, 5700, 5760, 5820, 5880, 5940, 6000, 6060, 6120, 6180, 6240, 6300, 6360, 6420, 6480,
			6540, 6600, 6660, 6720, 6780, 6840, 6900, 6960, 7020, 7080, 7140, 7200, 7260, 7320, 7380, 7440, 7500, 7560,
			7620, 7680, 7740, 7800, 7860, 7920, 7980, 8040, 8100, 8160, 8220, 8280, 8340, 8400, 8460, 8520, 8580, 8640,
			8700, 8760, 8820, 8880, 8940, 9000, 9060, 9120, 9180, 9240, 9300, 9360, 9420, 9480, 9540, 9600, 9660, 9720,
			9780, 9840, 9900, 9960, 10020, 10080, 10140, 10200, 10260, 10320, 10380, 10440, 10500, 10560, 10620, 10680, 10740, 10800,
		]
	};
	/**
	 * lấy danh sách các category lớn
	 * @return {[void]}
	 */
	function getCategoryList() {
		$http.get(app.baseUrl + "admin/api/category").then(function(response) {
			$scope.categoryList = response.data;
		});
	}
	/**
	 * hiện thông báo giống Gmail
	 * @param  String e
	 * @return void
	 */
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
			.parent(angular.element(document.body))
			.position('bottom right')
			.hideDelay(3500)
		);
	}
	/**
	 * Fix kiểu dữ liệu tham chiếu
	 * @param  {[object]} e
	 * @return void
	 */
	$scope.focusCategory = function(e) {
		$scope.focusCate = JSON.parse(JSON.stringify(e));
		delete $scope.focusCate.sub;
	};
	// post request
	function httpPost(string, data, stringSuccess, stringError) {
		$http.post(app.baseUrl + string, data).then(function(response) {
			getCategoryList();
			showMessage(stringSuccess);
		}, function(response) {
			showMessage(stringError);
		});
	}
	/**
	 * Xóa category
	 * @param  {[object]} e
	 * @return void
	 */
	$scope.deleteCategory = function(e) {
		var msg = {
			title: "Bạn có muốn xóa chủ đề này không?" ,
			content: "Các tập câu hỏi sẽ bị xóa cùng."
		};
		/**
		 * showDialogConfirm
		 */
		var confirm = $mdDialog.confirm()
			.title(msg.title)
			.textContent(msg.content)
			.ok('Đồng ý')
			.cancel('Hủy');
		$mdDialog.show(confirm).then(function() {
			httpPost("admin/api/category/delete", e, "Xóa chủ đề thành công", "Lỗi! xin thử lại");
		});
	};
	/**
	 * Thêm mới một category
	 */
	$scope.addCategory = function() {
		$mdDialog.show({
				controller: DialogController,
				templateUrl: app.baseUrl + 'public/html/category.dialog.html',
				parent: angular.element(document.body),
				clickOutsideToClose: true
			})
			.then(function(response) {
				httpPost("admin/api/category/store", response, "Thêm chủ đề thành công", "Lỗi! xin thử lại");
			});
	};
	/**
	 * Chỉnh sửa một category
	 * @param  {[Object]} e
	 * @return void
	 */
	$scope.editCategory = function(e) {
		$rootScope.targetCategory = JSON.parse(JSON.stringify(e));
		$mdDialog.show({
				controller: DialogController,
				templateUrl: app.baseUrl + 'public/html/editcategory.dialog.html',
				parent: angular.element(document.body),
				clickOutsideToClose: true
			})
			.then(function(response) {
				httpPost("admin/api/category/update", response, "Cập nhật chủ đề thành công", "Lỗi! xin thử lại");
			});
	};
	/**
	 * chuyển hướng đến ngân hnagf câu hỏi tương ứng
	 * @param  {[Object]} e 
	 * @return void
	 */
	$scope.redirect = function(e) {
		//console.log(app.baseUrl + "admin/question/" + e.slug);
		$window.location.href = app.baseUrl + "admin/question/" + e.slug + "/" + e.id;
	};
	/**
	 * Thêm một chủ đề câu hỏi mới
	 * @param obj e
	 */
	$scope.addCourse = function(e){
		$scope.toggleCourse = true;
		$scope.toggleCourseAdd = true;
		$scope.focusData = e;
		$scope.newCourse.category_id = e.id;
	};
	/**
	 * cancel stage add
	 */
	$scope.cancelToggle = function(){
		$scope.toggleCourse = false;
		$scope.toggleCourseAdd = false;
		$scope.toggleCourseEdit = false;
		$scope.newCourse = {
			title: "",
			nums: 0,
			time: 0,
			description: "",
			category_id: 0
		};	
	};
	/**
	 * Chỉnh sửa một chủ đề
	 *
	 */
	$scope.editCourse = function(e){
		$scope.focusData = JSON.parse(JSON.stringify(e));
		$scope.toggleCourse = true;
		$scope.toggleCourseEdit = true;
	};
	/**
	 * new course
	 * @return {[type]} [description]
	 */
	$scope.saveCourse = function(){
		httpPost("admin/api/course/store", $scope.newCourse, "Thêm mới course thành công", "Lỗi! xin thử lại");
		//console.log($scope.newCourse);
		$scope.cancelToggle();
	};
	$scope.updateCourse = function(){
		httpPost("admin/api/course/update", $scope.focusData, "Chỉnh sửa course thành công", "Lỗi! xin thử lại");
		//console.log($scope.newCourse);
		$scope.cancelToggle();
	};
	/**
	 * Auto run
	 */
	$scope.categoryList = getCategoryList();

});
/**
 * DialogController để điều khiển form nhập liệu thêm mới/ sửa category
 * @param {[type]} $scope     [description]
 * @param {[type]} $mdDialog  [description]
 * @param {[type]} $rootScope [description]
 */
function DialogController($scope, $mdDialog, $rootScope) {
	$scope.targetCategory = $rootScope.targetCategory || null;
	/**
	 * Ẩn dialog
	 * @return {[type]} [description]
	 */
	$scope.hide = function() {
		$mdDialog.hide();
	};
	/**
	 * hủy dialog
	 * @return {[type]} [description]
	 */
	$scope.cancel = function() {
		$mdDialog.cancel();
	};
	/**
	 * [return_editcategory trả về một category sau khi chỉnh sửa]
	 * @param  {[type]} title       [tiêu đề]
	 * @param  {[type]} description [mô tả của category]
	 * @return {[void]}
	 */
	$scope.return_editcategory = function(title, description) {
		$mdDialog.hide({
			id: $scope.targetCategory.id,
			title: title,
			description: description
		});
	};
	/**
	 * [return_category Trả về category mới]
	 * @param  {[String]} title       [tiêu đề]
	 * @param  {[String]} description [mô tả]
	 * @return {[void]} 
	 */
	$scope.return_category = function(title, description) {
		$mdDialog.hide({title: title, description: description});
	};
}