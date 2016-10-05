<!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"
    integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY"
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"
    integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB"
    crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/js/bootstrap.min.js"
    integrity="sha384-ux8v3A6CPtOTqOzMKiuo3d/DomGaaClxFYdCu2HPMBEkf6x2xiDyJ7gkXU0MWwaD"
    crossorigin="anonymous"></script>

    <script type="text/javascript">

      $("#switchSignUp").click(function(evt){
        evt.stopPropagation();
        evt.preventDefault();
        if($('input[name=signUp]').val() == '0'){
            $('input[name=signUp]').val('1');
            $('input[name=submit]').val("Sign Up");
            $("#switchSignUp").text("Log In");
        } else {
          $('input[name=signUp]').val('0');
          $('input[name=submit]').val("Log In");
          $("#switchSignUp").text("Sign Up");
        }
      } );


     $(document).delegate('#diary_content', 'keydown', function(e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode == 9) {
          e.preventDefault();
          var start = $(this).get(0).selectionStart;
          var end = $(this).get(0).selectionEnd;

          // set textarea value to: text before caret + tab + text after caret
          $(this).val($(this).val().substring(0, start)
                      + "\t"
                      + $(this).val().substring(end));

          // put caret at right position again
          $(this).get(0).selectionStart =
          $(this).get(0).selectionEnd = start + 1;
        }
      } );

      $("#diary_content").on('input propertychange', function(){
        $.ajax({
              method: "POST",
              url: "updateDatabase.php",
              data: { content: $("#diary_content").val()}
            });

      } );




    </script>

  </body>
</html>
