

<form action="welcome.php" mathod="get" onsubmit="return checkInput()"> 
  <input type="text" name="name" id="name"> 
  <button type="submit">Save</button>
</form> 

<script> 
  function checkInput() { 
    var name = document.getElementById('name'); 
    if( name.value == "" ) { 
      alert('กรุณากรอกชื่อ'); 
      return false; 
    } 
    else{
       return true; 
    }
  } 
</script> 