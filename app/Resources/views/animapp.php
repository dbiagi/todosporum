<?php include 'includes/head.php'; ?>

<?php
if (empty($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}
?>
<link rel="stylesheet" href="css/icomoon.css">
<link rel="stylesheet" href="css/animapp.css">
<script src="js/jquery.mask.min.js"></script>
<script src="js/animapp.js"></script>
<div class="containerApp">
    <div id="ferramentas">
        <ul>
            <li><a class="icon-pincel" onclick="alertaFerramenta('Pincel')" title="Pincel"></a></li>
            <li><a class="icon-borracha" onclick="alertaFerramenta('Borracha')" title="Borracha"></a></li>
            <li><a class="icon-linha" onclick="alertaFerramenta('Linha')" title="Linha"></a></li>
            <li><a class="icon-retangulo" onclick="alertaFerramenta('Retângulo')" title="Retângulo"></a></li>
            <li><a class="icon-elipse" onclick="alertaFerramenta('Elipse')" title="Elipse"></a></li>
            <li><a class="icon-mover" onclick="alertaFerramenta('Mover')" title="Mover"></a></li>
            <li><a class="icon-redimensionar" onclick="alertaFerramenta('Redimensionar')" title="Redimensionar"></a></li>
            <li><a class="icon-balde" onclick="alertaFerramenta('Lata de tinta')" title="Lata de tinta"></a></li>
            <li><a class="icon-anexar" onclick="alertaFerramenta('Adicionar arquivo')" title="Adicionar arquivo"></a></li>
            <li><a class="icon-cor" onclick="alertaFerramenta('Cor')" title="Cor" style="color: #9d38da"></a></li>
        </ul>
    </div>
    <div id="acoes">
        <ul>
            <li>
                <a href=""><em class="aberto"></em> Mover</a>
                <ul class="aberto">
                    <li><span class="icon-tempo"></span><input type="text">/<input type="text"></li>
                </ul>
            </li>
            <li>
                <a href=""><em class="aberto"></em> Redimensionar</a>
                <ul class="aberto">
                    <li><span class="icon-tempo"></span><input type="text">/<input type="text"></li>
                </ul>
            </li>
        </ul>
    </div>
    <div id="principal">
        <div id="barra-topo">
            <div id="timer">00:00</div>
            <ul>
                <li><a class="icon-desfazer" title="Desfazer" onclick="alertaFerramenta('Desfazer')"></a></li>
                <li><a class="icon-refazer" title="Refazer" onclick="alertaFerramenta('Refazer')"></a></li>
                <li>
                    <form action=""></form>
                    <a class="icon-ok" title="Finalizar" onclick="alertaFerramenta('Finalizar Animação')"></a>
                </li>
                <li><a href="galeria-animapp.php" class="icon-fechar" title="Sair do App"></a></li>
            </ul>    
        </div>
        <div id="animapp">
            
        </div>
    </div>
    <div id="timeline">
        <div class="botoes">
            <a class="icon-rever" onclick="alertaFerramenta('Rever animação do Início')"></a>
            <a class="playpause icon-play"></a>
        </div>
        <div id="timebar">
            <div id="timebar-feito" style="width:80%"></div>
            <div id="timebar-block" style="width:50%"></div>
        </div>
    </div>
</div>