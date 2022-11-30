</div><!-- fim content-->
<!--==============================footer=================================-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <ul class="nav footermenu">
                  <li <?php if($nav == 'home')echo ' class="active"';?>><a href="<?php echo base_url('home');?>">Home</a></li>
                  <li <?php if($nav == 'sobre')echo ' class="active"';?>><a href="<?php echo base_url('sobre');?>">Sobre Nós</a></li>
                  <li <?php if($nav == 'servico')echo ' class="active"';?>><a href="<?php echo base_url('servico');?>">Nossos Serviços</a></li>
                  <li <?php if($nav == 'produto')echo ' class="active"';?>><a href="<?php echo base_url('produto');?>">Produtos</a></li>
                  <li <?php if($nav == 'contato')echo ' class="active"';?>><a href="<?php echo base_url('contato');?>">Contato</a></li>
                </ul> 
                <hr class="linefooter">
                <p class="footerpriv"><a href="home_view">&copy; Site</a> <span id="copyright-year"></span> | <a href="i#">Politica de Privacidade</a> | Desenvolvimento <a href="http://klsystems.com.br" title="KL Systems" target="_blank">KL Systems</a><!-- FOOTER_LINK --></p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>