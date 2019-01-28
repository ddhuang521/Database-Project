<!DOCTYPE html>
<html>
<head>
<title>Write Note</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/note.css">
<link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
<body>
<form action="postnote.php" method="post">
      
        <h1>Write my note</h1>
        
        <fieldset>
          <legend><span class="number">1</span>Your note</legend>
          <textarea name="note" clos="25" rows="5" warp="virtual"></textarea>
        </fieldset>
        
        <fieldset>
          <legend><span class="number">2</span>Who can see</legend>
         <input type="radio" name="nperm" value="1" checked>Public to all
      <input type="radio" name="nperm" value="2">Only friend
      <input type="radio" name="nperm" value="3">Only me<br/>
        </fieldset>
          
          <fieldset>
          <legend><span class="number">3</span>When can be seen</legend>
        <label><input name="ndate[]" type="checkbox" value="1" />Sunday </label> 
      <label><input name="ndate[]" type="checkbox" value="2" />Monday </label> 
      <label><input name="ndate[]" type="checkbox" value="3" />Tuesday </label> 
      <label><input name="ndate[]" type="checkbox" value="4" />Wednesday </label> 
      <label><input name="ndate[]" type="checkbox" value="5" />Thursday </label> 
      <label><input name="ndate[]" type="checkbox" value="6" />Friday </label> 
      <label><input name="ndate[]" type="checkbox" value="7" />Saturday </label><br/> 
      Or specify a date<br/>
      <input name='notedate' type="date" value=""><br/>
      Specify the start and end time<br/>
      Start time: <input name='nstart' type="time" value=""/>
      End time: <input name='nend' type="time" value=""/><br/>
        </fieldset>
          
          
    <fieldset>
    <legend><span class="number">4</span>Where can be seen</legend>
       
      radius(0-100):<input type="range" name="nrad" min="0" max="100"><br/>
        </fieldset>
    
     <fieldset>
    <legend><span class="number">5</span>Set the tag</legend>
       
      Tag1:<input type="text" name="ntag[]"><br/>
         Tag2:<input type="text" name="ntag[]"><br/>
         Tag3:<input type="text" name="ntag[]"><br/>
        </fieldset>
    
    <button type="submit">Write my note!</button>
    </form>     
        
</body>
</html>