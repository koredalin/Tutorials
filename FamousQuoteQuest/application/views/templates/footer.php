<?php
/**
 * @category View Footer
 * @description Main footer
 */
?>


<footer class="footer">
    <div>
        <p>&copy; Hristo Hristov</p>
        <p>Last update: 
            <?php 
            $lastUpdate=isset($lastUpdate) ? $lastUpdate : 'No date set.'; 
            echo $lastUpdate;
            ?>
        </p>
    </div>
</footer>

    </div>
</div>

</body>
</html>