function navController($scope ) {
	$scope.user = {name: "Prathik Raj"};

}

angular.module('knowareapp', []).
  config(['$routeProvider', function($routeProvider) {
  $routeProvider.
	when('/ideas', {templateUrl: 'template/home.html',   controller: HomeCntl}).
	when('/add', {templateUrl: 'template/add.html', controller: AddController}).
	when('/ideas/:id', {templateUrl: 'template/idea.html', controller: IdeaController}).
      otherwise({redirectTo: '/ideas'});
}]);

function IdeaController($scope, $routeParams, $http) {

	$http.get("server/get-thesis/id/"+$routeParams.id).success(function(data) {
		console.log(data);
		$scope.idea = data;
	});
}

function AddController($scope, $routeParams, $http) {
	$scope.message = "<span class=\"label\">Enter the details and click Add</span>";
	$scope.update = function(idea) {
		if(typeof idea != "undefined") {
			var count = 0;
			var flag = false;
			for(i in idea) {
				count++;
				if(idea[i] == "" || idea[i] == "undefined" || idea[i] == null || typeof idea[i] == "undefined") {
					flag = true;
				}
			}
			if(count == 6 && !flag) {
				$http.put("server/add-thesis", idea).success(function(data) {
					if(data.result == "Success") {		
						$scope.message = "<span class=\"label label-success\">Success! Your idea " + idea.title + " has been posted.</span>";
					} else {
						$scope.message = "<span class = \"label label-important\">There is a server-side issue in posting the data.</span>";
					}
				});
			} else {
				$scope.message = "<span class = \"label label-important\">Fill in all the fields.</span>";
			}
			
		} else {
			$scope.message = "<span class = \"label label-info\">Fill in all the fields.</span>";
		}
	}
}

function HomeCntl($scope, $routeParams, $http) {
        var page = 1;
        $http.get('server/get-thesis/'+ page).success(function(data) {
                $scope.ideas = data;
        });
  $scope.params = $routeParams;
}
 
