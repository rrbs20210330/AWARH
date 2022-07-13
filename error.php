<?php include('components/header.php'); ?>

<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto+Mono:300,500');

body {
    background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/257418/andy-holmes-698828-unsplash.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    min-height: 100vh;
    min-width: 100vw;
    font-family: "Roboto Mono", "Liberation Mono", Consolas, monospace;
    color: rgba(255,255,255,.87);
}

.mx-auto {
    margin-left: auto;
    margin-right: auto;
}

.container,
.container > .row,
.container > .row > div {
    height: 100%;
}

#countUp {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    
    .number {
        font-size: 4rem;
        font-weight: 500;
        
        + .text {
            margin: 0 0 1rem;
        }
    }
    
    .text {
        font-weight: 300;
        text-align: center;
    }
}
</style>
<div class="container">
    <div class="row">
        <div class="xs-12 md-6 mx-auto">
            <div id="countUp">
                <!-- <div class="number">1347</div> -->
                <div class="text">Error</div>
                <div class="text">La pagina que estas buscando no existe.</div>
                <!-- <div class="text">Gastronomía se ve muy interesante si lo ves desde otro punto de vista</div> -->
            </div>
        </div>
    </div>
</div>            
            
<?php
include('components/footer.php');?>