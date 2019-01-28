<!DOCTYPE html>
<html>
<head>
<title>Set filter</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/note.css">
<link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
<body>
    <h1>Set my filter</h1>
<form action="applyfilter.php" method="post">
  
    <fieldset>
          <legend><span class="number">1</span>Who can see</legend>
         <input type="radio" name="fperm" value="1" checked>All
      <input type="radio" name="fperm" value="2">Only friend
        </fieldset>
     <fieldset>
         
          <legend><span class="number">2</span>When can be seen</legend>
     Specify a date<br/>
      <input name='filterdate' type="date" value=""><br/>
      Specify the start and end time<br/>
      Start time: <input name='fstart' type="time" value=""/>
      End time: <input name='fend' type="time" value=""/><br/>
        </fieldset>
    
      <fieldset>
          
    <legend><span class="number">3</span>Where can be seen</legend>
       
      Latitude:<input type="number" step="0.000001" name="flati"><br/>
      Longtitude:<input type="number" step="0.000001" name="flong"><br/>
      radius(0-100):<input type="range" name="frad" min="0" max="100"><br/>
        </fieldset>
    
    <fieldset>
    <legend><span class="number">4</span>Set tag and state</legend>
       
      Tag: <input type="text" name="ftag" value="-1"><br/>
      State: <input type="text" name="fstate" value="-1"><br/>
        </fieldset>
     
      <button type="submit">Set my filter!</button>
    
</form>
</body>
</html>
    