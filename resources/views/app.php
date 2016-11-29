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
            <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">        
                <li><a href="">Locations</a></li>
                <li><a href="">Units</a></li>
                <li><a href="">Tennants</a></li>
                <li><a href="">Logout</a></li>
            </ul>
            </div>          
          </div>
        </nav>  
</head>
<body>
    <div class="container">     
        <div ng-view></div>
    </div>
</body>
<script src="js/all.js"></script>
</html>