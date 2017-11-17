        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <?php
        foreach ($js as $script)
        {
            echo("<script src=\"$script\"></script>\n");
        }
        ?>
    </body>
</html>