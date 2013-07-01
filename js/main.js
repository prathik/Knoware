function KnoWareController($http, $scope) {
	$scope.user = {name: "Prathik Raj"};
	var page = 1;	
	$http.get('server/get-thesis/'+ page).success(function(data) {
		$scope.ideas = data;
	});

}
