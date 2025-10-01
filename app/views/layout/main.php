<?php

/**
 * This is basically the header and the footer of the webpage,
 * Repetition to a degree sucks
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <title>{{Title}}</title> <!--This is a placeholder-->
        <script></script>
        <meta charset="UTF-8">
        <meta name="description">
        <link rel="icon" href="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/main.css">

<!--header junk, css files and what not-->
    </head>
    <body>

   


    <div class="header-main">

      <div class="header-left"> 
        <div class="header-logo">Insert Logo Here</div>
        <div class="header-title">Locomotive</div>
      </div>

      <div class="header-middle">
        <div class="header-middle-search-icon">
          <img src="/public/assets/search-icon.png" alt="Search Icon">
        </div>
        <div class="header-middle-search">
          <input type="text" placeholder="Search...">
          <button type="submit">Go</button>
        </div>
      </div>
      
      <div class="header-right">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Active</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
          </li>
          <li>
            <button onClick="logout()">Logout</button>
          </li>
        </ul>
          
      </div>
    </div>

    <div class="main-content-box">
      <div class="left-sidebar">
        left sidebar main
      </div>

      <div class="main-content-real">
        {{Content}} <!--This is a placeholder-->
      </div>

      <div class="right-sidebar">
        right sidebar main
      </div>

    </div>
      <script>

        function logout() {        
            fetch('/home/logout', {
            method: 'POST',
            headers: {
            'Content-Type': 'text/plain'
            },
            body: 'logout'}
            )
            .then(res => res.text())
            .then(data => 
            
            {
              console.log(data)
              window.location.href = '/';
            })
            .catch(err => console.error('Error:', err));
          
          };
      </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    </body>
</html>