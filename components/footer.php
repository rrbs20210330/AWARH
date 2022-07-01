    </div> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src=" 	https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  
  <script>
    
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
    }
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
    } 
    if(window.history.replaceState){
      window.history.replaceState(null, null, window.location.href)
    }
    $(document).ready(function() {
        $('.userTable').DataTable();
    });
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    function confirmSave(){
      var res = confirm('¿Estás seguro?\nTus datos serán guardados')
      if(res){
        return true;
      }else{
        return false;
      }
    }
  
  </script>
  
  

  </body>
</html>


