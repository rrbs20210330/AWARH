    </div> 
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
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

    var grafica = document.getElementById("grafica");
    var myPirChart = new Chart(grafica,{
      type: 'pie',
      data: {
        labels: ['Empleados','Candidatos','Convocatorias'],
        datasets: [{
          label: "Reportes",
          data:[20,30,10],
          backgroundColor: ["#00ced1","#ee82ee","#ffa500"]
        }]
      },
    });

    
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
        $('#userTable').DataTable();
    });

    var grafica = document.getElementById("grafica");
    var myPirChart = new Chart(grafica,{
      type: 'pie',
      data: {
        labels: ['Empleados','Candidatos','Convocatorias'],
        datasets: [{
          label: "Reportes",
          data:[20,30,10],
          backgroundColor: ["#00ced1","#ee82ee","#ffa500"]
        }]
      },
    });
  </script>
  <script type="text/javascript">
    function functionUno() {
        var x = document.getElementById("div1");
        var y = document.getElementById("div2");
        var q = document.getElementById("div3");
        var c = document.getElementById("div4");

        if (x.style.display == "none" || y.style.display=="block" || q.style.display=="block" || c.style.display=="block") {
            y.style.display = "none";
            x.style.display = "block";
            q.style.display = "none";
            c.style.display = "none"
        }
        else{
            x.style.display= "none";
        }
    }

    function functionDos() {
        var x = document.getElementById("div1");
        var y = document.getElementById("div2");
        var q = document.getElementById("div3");
        var c = document.getElementById("div4");

        if (x.style.display == "block" || y.style.display=="none" || q.style.display=="block" || c.style.display=="block") {
            y.style.display = "block";
            x.style.display = "none";
            q.style.display = "none";
            c.style.display = "none";
        }
        else{
            y.style.display= "none";
        }
    }
    
    
    function functionTres() {
        var x = document.getElementById("div1");
        var y = document.getElementById("div2");
        var q = document.getElementById("div3");
        var c = document.getElementById("div4");
        
        if (x.style.display == "block" || y.style.display=="block" || q.style.display=="none" || c.style.display=="block") {
            y.style.display = "none";
            q.style.display = "block";
            x.style.display = "none";
            c.style.display = "none"

        }
        else{
            q.style.display= "none";
        }
    }

    function functionCuatro() {
        var x = document.getElementById("div1");
        var y = document.getElementById("div2");
        var q = document.getElementById("div3");
        var c = document.getElementById("div4");

        if (x.style.display == "block" || y.style.display=="block" || q.style.display=="block" || c.style.display=="none") {
            y.style.display = "none";
            x.style.display = "none";
            q.style.display = "none";
            c.style.display = "block";
        }
        else{
            c.style.display= "none";
        }
    }
    element = document.getElementById("div1");
    element2 = document.getElementById("div2");
    element3 = document.getElementById("div3");
    element4 = document.getElementById("div4");


    element.style.display = 'none';
    element2.style.display = 'none';
    element3.style.display = 'none';
    element4.style.display = 'none';
    
  </script>
 
  </body>
</html>


