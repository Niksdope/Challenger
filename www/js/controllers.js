angular.module('starter.controllers', ['ionic', 'ngStorage'])

.controller('DashCtrl', function($scope, $localStorage, $http) {
    $scope.$storage = $localStorage;
    
    var date = new Date();
    $scope.date = date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
    console.log($scope.date);
    
    $scope.updateChallenges = function(){
        $scope.count = 0;
        if ($scope.$storage.toggles != undefined)
        {
            if($scope.$storage.toggles[0].checked == true)
            {
                $scope.count++;
            }
            if($scope.$storage.toggles[1].checked == true)
            {
                $scope.count++;
            }
            if($scope.$storage.toggles[2].checked == true)
            {
                $scope.count++;
            }
            if($scope.$storage.toggles[3].checked == true)
            {
                $scope.count++;
            }
            if($scope.$storage.toggles[4].checked == true)
            {
                $scope.count++;
            }
            if($scope.$storage.toggles[5].checked == true)
            {
                $scope.count++;
            }
            if($scope.$storage.toggles[6].checked == true)
            {
                $scope.count++;
            }
            if($scope.$storage.toggles[7].checked == true)
            {
                $scope.count++;
            }
            if($scope.$storage.toggles[8].checked == true)
            {
                $scope.count++;
            }
            if($scope.$storage.toggles[9].checked == true)
            {
                $scope.count++;
            }
        }
        else {
            $scope.count = 0;
        }
        
        $scope.email = $scope.$storage.email;
        console.log($scope.count, $scope.email);
        
        
        $http({
            method: 'GET',
            url: 'http://ngurins.cloudapp.net/update.php',
            params: {completed: parseInt($scope.count), email: $scope.email}
        }).success(function(data){
            // Update localStorage variables
            delete $scope.$storage.toggles;
            $scope.$storage.date = $scope.date;
            console.log("Update successful");
        }).error(function(data) {
            console.log("Failed to update");
            console.log(data);
        })
    }
    
    if ($scope.$storage.date == undefined)
    {
        console.log("No date found in $storage");
        $scope.$storage.date = $scope.date;
    }
    else {
        if ($scope.$storage.date == $scope.date)
        {
            console.log("Same day, continue with same chals");
        }
        else{
            console.log("Day has changed, sending data back and retrieving new chals");
            $scope.updateChallenges();
        }
    }
    
})

.controller('ChallengesCtrl', function($scope, $http, $localStorage, $state) {
    
    $scope.$storage = $localStorage;
    $scope.chals = [];

    $scope.getData = function() {
        $http({
            method: 'GET',
            url: 'http://ngurins.cloudapp.net/project.php',
            params: {email : $scope.$storage.email}
        }).success(function(data) {
            $scope.challenges = data;
            
            if ($scope.$storage.toggles == undefined)
            {
                 $scope.chals = [
                    { text: $scope.challenges[0].challenge, checked: false},
                    { text: $scope.challenges[1].challenge, checked: false},
                    { text: $scope.challenges[2].challenge, checked: false},
                    { text: $scope.challenges[3].challenge, checked: false},
                    { text: $scope.challenges[4].challenge, checked: false},
                    { text: $scope.challenges[5].challenge, checked: false},
                    { text: $scope.challenges[6].challenge, checked: false},
                    { text: $scope.challenges[7].challenge, checked: false},
                    { text: $scope.challenges[8].challenge, checked: false},
                    { text: $scope.challenges[9].challenge, checked: false}
                ];   
                
                $scope.$storage.toggles = $scope.chals;
            }
            else {
                $scope.chals = [
                    { text: $scope.challenges[0].challenge, checked: $scope.$storage.toggles[0].checked },
                    { text: $scope.challenges[1].challenge, checked: $scope.$storage.toggles[1].checked },
                    { text: $scope.challenges[2].challenge, checked: $scope.$storage.toggles[2].checked },
                    { text: $scope.challenges[3].challenge, checked: $scope.$storage.toggles[3].checked },
                    { text: $scope.challenges[4].challenge, checked: $scope.$storage.toggles[4].checked },
                    { text: $scope.challenges[5].challenge, checked: $scope.$storage.toggles[5].checked },
                    { text: $scope.challenges[6].challenge, checked: $scope.$storage.toggles[6].checked },
                    { text: $scope.challenges[7].challenge, checked: $scope.$storage.toggles[7].checked },
                    { text: $scope.challenges[8].challenge, checked: $scope.$storage.toggles[8].checked },
                    { text: $scope.challenges[9].challenge, checked: $scope.$storage.toggles[9].checked }
                ];
            } 
        })
          .error(function(data) {
            console.log("No one found by that name");
        })
    }
    
    $scope.updateStorage = function() {
        $scope.$storage.toggles = $scope.chals;
    }
    
    
})

.controller('RegistryCtrl', function($scope, $http, $localStorage, $state) {
    
    $scope.registerVars = {};
    $scope.loginVars = {};
    
    $scope.$storage = $localStorage;
    
    if($scope.$storage.loggedIn == true){
        console.log($scope.$storage.loggedIn);
        $state.go('tab.dash');
    }
    
    $scope.register = function() {
        if ($scope.registerVars.email != undefined && $scope.registerVars.password != undefined)
        {
            $http({
                method: 'GET',
                url: 'http://ngurins.cloudapp.net/register.php',
                params: {email : $scope.registerVars.email,
                        password : $scope.registerVars.password}
            }).success(function(data) {
                // Set localStorage values for new user
                if (data != 'fail'){
                    $scope.response = "Registartion successful. Welcome";
                    $scope.$storage.email = $scope.registerVars.email;
                    $scope.$storage.loggedIn = true;
                    $scope.$storage.type = 'normal';
                    
                    $state.go('tab.dash');
                }
                else {
                    $scope.response = "User already exists";
                }

                // Navigate to dash
                
            }).error(function(data) {
                $scope.response = "Registration failed";
            })
        }
        else {
            $scope.response = "* E-mail address and password are required";
        }
    }
    
    $scope.login = function () {
        if ($scope.loginVars.email == undefined || $scope.loginVars.password == undefined){
        $scope.response = "* E-mail and password are required";
        }
        else{
            $http({
            method: 'GET',
            url: 'http://ngurins.cloudapp.net/login.php',
            params: {email : $scope.loginVars.email,
                    password : $scope.loginVars.password}
        }).success(function(data) {
            $scope.$storage = $localStorage;

            if(data != 'normal' && data != 'admin'){
                $scope.response = data;
                console.log(data);
            }
            else {
                $scope.response = "Log in successful";
                $scope.$storage.email = $scope.loginVars.email;
                $scope.$storage.loggedIn = true;
                $scope.$storage.type = data;

                $state.go('tab.dash');
            }   
        })
          .error(function(data) {
            $scope.response = "Login failed";
        })
        }
        
    }
})

.controller('AccountCtrl', function($scope, $localStorage, $state, $http) {
    $scope.$storage = $localStorage;
    $scope.user = {};
    
    console.log($scope.$storage.type)
    
    if($scope.$storage.type == 'admin')
    {
        $scope.user.admin = false;
    }
    else {
        $scope.user.admin = true;
    }
    
    $scope.logOut = function(){
        console.log("Signing out");
        $scope.$storage.loggedIn = false;
        delete $scope.$storage.email;
        delete $localStorage.type;
        
        console.log("Return to login/register page");
        $state.go('register');
    }
    
   
    $scope.addChallenge = function() {
        console.log("Submitting");
        if($scope.user.challenge != undefined){
            $http({
            method: 'GET',
            url: 'http://ngurins.cloudapp.net/createChallenge.php',
            params: {challenge : $scope.user.challenge}
            }).success(function(data) {
                $scope.response = data;
                console.log("Success");
            })
              .error(function(data) {
                $scope.response = data;
                console.log("Fail");
            })
        }
        else {
            $scope.response = "Can't add an empty challenge";
        }
    }
    
    $scope.getStatistics = function() {
        $http({
        method: 'GET',
        url: 'http://ngurins.cloudapp.net/statistics.php',
        params: {email : $scope.$storage.email}
        }).success(function(data) {
            $scope.statistics = data;
            $scope.percentage = ($scope.statistics.completed / $scope.statistics.total) * 100;
            $scope.percentage = $scope.percentage.toFixed(2);
        })
          .error(function(data) {
            console.log("Failed to get statistics");
        })
    }
});