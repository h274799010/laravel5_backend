<footer>
    <hr>
    <p class="pull-right">Power by Jiang</p>
    <p>© 2015</p>
</footer>
<script src="<?php echo loadStatic('/lib/bootstrap/js/bootstrap.js'); ?>"></script>
<script type="text/javascript">
    $(function() {
        var uls = $('.sidebar-nav > ul > *').clone();
        uls.addClass('visible-xs');
        $('#main-menu').append(uls.clone());
    });
</script>
<iframe frameborder='0' name='hiddenwin' id='hiddenwin' scrolling='no' class='debugwin hidden'></iframe>
<iframe frameborder='0' name='hiddenwin1' id='hiddenwin1' scrolling='no' src="<?php echo loadStatic('/lib/clent.html'); ?>"></iframe>