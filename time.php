<!DOCTYPE html>
<html>
<head>
<title>Time</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/note.css">
<link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
<body>
<form action="addtime.php" method="post">
      
        <h1>Choose your time</h1>
        
      <fieldset>
      <legend><span class="number">1</span>Specify date and time</legend>
        
      <br/>
      Date: <input type="date" name="udate"><br/>
     Time: <input type="time" name="utime"><br/>
    </fieldset>
    
    <fieldset>
    <legend><span class="number">2</span>User state</legend>
       
      User state:<input type="text" name="state"><br/>
        </fieldset>
    
    <button type="submit">Add</button>
    
    </form>     
        
</body>
</html>