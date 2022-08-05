<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Glass Card Tutorial</title>
    
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
  </head>
  <body>
    <div class="card">
      <div class="content">
        <h2>01</h2>
        <h3>Glass Card</h3>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro
          delectus sint similique quisquam harum culpa.
        </p>
        <a href="#">More Detail</a>
      </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/vanilla-tilt.js') }}"></script>
    <script>
      VanillaTilt.init(document.querySelectorAll(".card"), {
        max: 25,
        speed: 400,
        glare: true,
        "max-glare": 1,
      });
    </script>
  </body>
</html>