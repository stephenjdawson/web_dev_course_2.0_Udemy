function colorSet(){
  var letters = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++ ) {
  color += letters[Math.floor(Math.random() * 16)];
    }
  return color;
  }

function randomIntegerInclusive(min, max){
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min + 1)) + min;
  }

function shapeSet(){
  var randomNumber = Math.random() >= 0.5;
  if (randomNumber == true){
    return 0.5;
  }else{
    return 0;
  }
}

var startTime = Date.now();

function startButton() {
startTime = Date.now();
}

function stopButton() {
    if (startTime) {
        var endTime = Date.now();
        var difference = endTime - startTime;
      //  alert("Reaction time is:" + difference + " ms.")
        return difference;
        startTime = null;
    } else {
      //  alert('Click shape to start.');
    }
}

document.getElementById("shape").onclick = function(){
  var time = stopButton();
  var startTime = startButton();
  var shapeDim = randomIntegerInclusive(50, 150);
  var shapeChoice = shapeDim * shapeSet();
  var shapeX = randomIntegerInclusive(20,80);
  var shapeY = randomIntegerInclusive(20,80);
  document.getElementById("shape").style.height = shapeDim +"px";
  document.getElementById("shape").style.width = shapeDim +"px";
  document.getElementById("shape").style.borderRadius = shapeChoice +"px";
  document.getElementById("shape").style.top = shapeY +"%";
  document.getElementById("shape").style.left = shapeX + "%";
  document.getElementById("shape").style.backgroundColor = colorSet();
  document.getElementById("timeInterval").innerHTML =  time + " ms";
}
