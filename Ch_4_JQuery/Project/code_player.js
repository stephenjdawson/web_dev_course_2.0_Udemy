function containedWidth(){
  var numItems = $(".navbar-active").length;
  var containerWidth = $("#container").width();
  var cW = (containerWidth/numItems);
//  alert(containerWidth);
//  alert(numItems);
//  alert(cW);
  return cW;
}

$(document).delegate('.code-input', 'keydown', function(e) {
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

function addClass(css){
  var cssTest = /(#*\.*[A-Za-z0-9_-]*\s*\{)/g;
  css =  css.replace(cssTest, "#code-output $1");
//  css = css.replace(/fixed/g, "static");
//  css = css.replace(/absolute/g, "static");
// alert(css);
  return css;
}

$(document).ready(function() {

     $("#html-toggle").click(function() {
       $("#html-toggle").toggleClass("navbar-active");
        $(".contained, .code-input").css({width: containedWidth()});
          $('#html-section, #html-input').animate({
               width: 'toggle'
            }, 0
         );
     });

     $("#css-toggle").click(function() {
       $("#css-toggle").toggleClass("navbar-active");
        $(".contained, .code-input").css({width: containedWidth()});
          $('#css-section, #css-input').animate({
               width: 'toggle'
             }, 0
          );
     });

     $("#js-toggle").click(function() {
       $("#js-toggle").toggleClass("navbar-active");
       $(".contained, .code-input").css({width: containedWidth()});
          $('#js-section, #js-input').animate({
               width: 'toggle'
             }, 0
          );
     });

     $("#output-toggle").click(function() {
       $("#output-toggle").toggleClass("navbar-active");
       $(".contained, .code-input").css({width: containedWidth()});
          $('#output-section, #code-output').animate({
               width: 'toggle'
             }, 0
          );
     });

    $(window).resize(function(){
      $(".contained, .code-input").css({width: containedWidth()});
    });

} );

$("#update-html").click(function(){
    var text = $("#html-input").val();
    //maybe use .this and create a callable function? try later!
    $("iframe").contents().find("body").html(text + "<script type='text/javascript'></script>");
//    $("#code-output").html(text);
} );

$("#update-css").click(function(){
    //alert($("#css-input").val());
    var text = $("#css-input").val();
   $("iframe").contents().find("head").html("<style type='text/css'>" + text + "</style>");
  //  $("style").html(addClass(text));
} );

$("#update-js").click(function(){
  //  var text = $("#js-input").val();
document.getElementById("code-output").contentWindow.eval($("#js-input").val());
 // $("body script").html("<script type=text/javascript>" + text + "</script>");
} );
