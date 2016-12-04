<!DOCTYPE html>
<html class="no-js" lang="en" ng-app="ContactsApp">
<head>
<meta charset="UTF-8">
<title>Profile App</title>
    <link rel="stylesheet" href="css/app.css">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">           
          <a class="navbar-brand" href="#/">Contacts App</a>
        </div>                      
      </div>
    </nav>  
</head>
<body ng-cloak>
    <div class="container"> 
        <div ng-view></div>    
    </div>
</body>
<script src="js/all.js"></script>
</html>