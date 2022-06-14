<?php
include("components/header.php");
?>


<br/>
<button class="btn btn-success" onclick="functionUno()">Chargues</button>
<button class="btn btn-primary" onclick="functionDos()">Activities</button>
<button class="btn btn-dark" onclick="functionTres()">Positions</button>
<button class="btn btn-danger" onclick="functionCuatro()">Users</button>


<!-- DIV 1 CHARGUES --> 
<div id="div1" class="container-fluid">
efe3

</div>


                             <!----------------- DIV 2 ACTIVITIES ------------------------> 
<div id="div2" class="container-fluid">

efe
</div>
                        <!----------------- DIV 3 POSITIONS ------------------------> 

<div id="div3" class="container-fluid">
efe2

</div>
<div id="div4" class="container-fluid">
<label >TEST</label>
</div>


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



<?php
include("components/footer.php");
?>
