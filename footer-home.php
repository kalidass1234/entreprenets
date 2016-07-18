<footer>
                <div class="container">
                    <div class="foot-widget">
                        <ul class="foot-nav">
                            <?php
                            $getInfoByTableName = getInfoByTableName("manage_pages");
                            foreach ($getInfoByTableName as $records) {
                                $counts = mysql_num_rows(mysql_query("select * from manage_content WHERE page_id='" . $records['id'] . "'"));
                                ?>

                                <li><a href="<?= $records['page_url']; ?>"><?= $records['page_name']; ?> <?php if ($counts > 0) { ?><i class="ui--caret fontawesome-angle-down px18"></i><?php } ?></a>

                                    <?php /*
                                    //$counts = mysql_num_rows(mysql_query("select * from manage_content WHERE page_id='".$records['id']."'"));
                                    if ($counts > 0) {
                                        ?>
                                        <ul class="sub-menu">

                                            <?php
                                            $cond = " page_id='" . $records['id'] . "'";
                                            $getInfoByTableNameID = getInfoByTableNameID("manage_content", $cond);
                                            foreach ($getInfoByTableNameID as $record) {
                                                ?>
                                                <li id="menu-item-1427" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children level-1 sub-level-item has-child to-right"><a href="<?= $record['page_url']; ?>">- <?= $record['page_name'] ?></a>

                                                </li>

                                            <?php } ?>
                                        </ul>

                                    <?php } */?>
                                </li>

                            <?php } ?>
<!--                            <li><a href="#">HOME</a></li>
                            <li><a href="#">WHAT IS BMC NETWORK? </a></li>
                            <li><a href="#">HOW IT WORKS? </a></li>
                            <li><a href="#">BUSINESS</a></li>
                            <li><a href="#">PACKAGE</a></li>
                            <li><a href="#">ABOUT US</a></li>
                            <li><a href="#">NEWS & ARTICLES </a></li>-->
                        </ul>
                        <p>No Part Of This Website, Photographs Or Text May Be Reproduced Without Written Permission.</p>
                        <p>Entreprenets System All Rights Reserved © 2016</p>
                        <div class="foot-social">
                            <ul>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>

        </div>

    </body>
</html>