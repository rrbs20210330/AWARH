<?php include('components/header.php'); ?>

<style>
  @import url('https://fonts.googleapis.com/css?family=Roboto+Mono:300,500');

  #countUp {
    font-family: Georgia, "Times New Roman", Times, serif;
    display: flex;
    color: #00252e;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
  }

  .h2 {
    float: left;
    font-size: 40px;
    color: black;
    position: relative;
  }

  .h2 .span1 {
    position: absolute;
    right: 0;
    /**para que se coloque a la derecha*/
    width: 0;
    /*para que no tenga un ancho*/
    background-color: white;
    border-left: 1px solid #000;
    /*esto es lo que va a sevir como un cursor*/
    animation: maquina 4s steps(10);
    /* creamos la animacion y que nos dure 5 segundo y que sea repetitiva */
  }

  @keyframes maquina {
    from {
      width: 100%;
    }

    to {
      width: 0%;
    }
  }

  .text {
    font-weight: 300;
    text-align: center;
    font-size: 30px;
  }
</style>
<br><br><br><br><br>
<div class="container">
  <div class="row">
    <div class="xs-12 md-6 mx-auto">
      <div id="countUp">
        <!-- <div class="number">2395</div> -->
        <div class="text">
          <h2 class="h2">Error 404..<span class="span1">&nbsp;</span></h2>
          </h2>
        </div>
        <div class="text"> Lo sentimos, la pagina que busca en este momento no existe
        </div>
        <!-- <div class="text">Gastronomía se ve muy interesante si lo ves desde otro punto de vista</div> -->
      </div>
    </div>
  </div>
</div>

<?php
include('components/footer.php'); ?>