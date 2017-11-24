        <script src="js/ext/jquery-3.2.1.min.js"></script>
        <script src="js/ext/popper.min.js"></script>
        <script src="js/ext/bootstrap.min.js"></script>
        <?php
        foreach ($js as $script)
        {
            echo("<script src=\"$script\"></script>\n");
        }
        ?>
    </body>
</html>