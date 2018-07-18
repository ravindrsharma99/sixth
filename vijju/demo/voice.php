<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  	<title>Recorder Example</title>
    <link rel="stylesheet" type="text/css" href="example.css" />
  </head>
  <body>      
    <script type="text/javascript" src="../recorder.js"></script>
    <script>
      function timecode(ms) {
        var hms = {
          h: Math.floor(ms/(60*60*1000)),
          m: Math.floor((ms/60000) % 60),
          s: Math.floor((ms/1000) % 60)
        };
        var tc = []; // Timecode array to be joined with '.'
        if (hms.h > 0) {
          tc.push(hms.h);
        }
        tc.push((hms.m < 10 && hms.h > 0 ? "0" + hms.m : hms.m));
        tc.push((hms.s < 10  ? "0" + hms.s : hms.s));
        return tc.join(':');
      }
    
    
      Recorder.initialize({
        swfSrc: "../recorder.swf"
      });
      function record(){
        Recorder.record({
          start: function(){
            //alert("recording starts now. press stop when youre done. and then play or upload if you want.");
          },
          progress: function(milliseconds){
            document.getElementById("time").innerHTML = timecode(milliseconds);
          }
        });
      }
      
      function play(){
        Recorder.stop();
        Recorder.play({
          progress: function(milliseconds){
            document.getElementById("time").innerHTML = timecode(milliseconds);
          }
        });
      }
      
      function stop(){
        Recorder.stop();
      }
      
      function upload(){
        Recorder.upload({
          url:        "https://example.com/upload",
          audioParam: "your_file",
          success: function(){
            alert("your file was uploaded!");
          }
        });
      }
  </script>
  
    <div id="wrapper">
      <h1><a href="http://github.com/jwagener/recorder">Recorder Example</a></h1>
      <p>
        This is a very basic example for the Recorder.js.
        Checkout <a href="http://github.com/jwagener/recorder">GitHub</a> for details and have a look at the source for this file.
        Start by clicking record:
      </p>
        <div>
          <a href="javascript:record()"  id="record"                       >Record</a>
          <a href="javascript:play()"    id="play"   >Play</a> 
          <a href="javascript:stop()"    id="stop"   >Stop</a>
          <a href="javascript:upload()"  id="upload" >Upload (faked)</a>
        </div>
        
        <span id="time">0:00</span>
    </div>
  </body>
</html>