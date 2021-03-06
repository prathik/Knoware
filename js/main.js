function navController($scope, $routeParams, $http) {
	$http.get( 'server/user/' ).success( function(data) {
		$scope.user = data;
	});

}

angular.module('knowareapp', []).
  config(['$routeProvider', function($routeProvider) {
  $routeProvider.
	when('/ideas', {templateUrl: 'template/home.html',   controller: HomeCntl}).
	when('/add', {templateUrl: 'template/add.html', controller: AddController}).
	when('/ideas/:id', {templateUrl: 'template/idea.html', controller: IdeaController}).
	when('/about', {templateUrl: 'template/about.html', controller: AboutPageController}).
      otherwise({redirectTo: '/ideas'});
}]);

function AboutPageController($scope, $routeParams, $http) {


}

function IdeaController($scope, $routeParams, $http) {

	$http.get("server/get-thesis/id/"+$routeParams.id).success(function(data) {
		$scope.idea = data;
	});

    $http.get("server/get-comments/" + $routeParams.id).success(function(data) {
	$scope.commentList = data;
    });
	$scope.approve = function(thesis) {
		$http.get("server/approve/" + thesis).success(function(data) {
			$scope.idea = data;
		});
	}
	$scope.reject = function(thesis) {
		$http.get("server/reject/" + thesis).success(function(data) {
			$scope.idea = data;
		});
	}
    
    
    $scope.addComment = function(comment) {
	if(typeof comment != 'undefined' && comment !== null) {
	    console.log(comment);
	    var data = new Object();
	    data.comment = comment;
	    $http.put("server/add-comment/" + $routeParams.id , data).success( function(data) {
		$scope.commentList = data;
		$scope.comment = null;
	    });
	}
    }
}

function AddController($scope, $routeParams, $http) {
	$scope.message = "<span class=\"label\">Enter the details and click Add</span>";
	var date = new Date();
	$scope.idea = {year: date.getFullYear(), day: date.getDate(), month: date.getMonth() +1, review_on: 1};
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

