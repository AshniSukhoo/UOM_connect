<?php include('partials/_email-header.php'); ?>
    <!-- EMAIL CONTAINER // -->
    <table bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="500" id="emailBody">
        <tbody>

        <?php include('partials/_logo-email.php'); ?>

        <!-- MODULE ROW // -->
        <tr>
            <td align="center" valign="top">
                <!-- CENTERING TABLE // -->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#FFFFFF">
                    <tbody><tr>
                        <td align="center" valign="top">
                            <!-- FLEXIBLE CONTAINER // -->
                            <table border="0" cellpadding="0" cellspacing="0" width="500" class="flexibleContainer">
                                <tbody><tr>
                                    <td align="center" valign="top" width="500" class="flexibleContainerCell">
                                        <table border="0" cellpadding="30" cellspacing="0" width="100%">
                                            <tbody><tr>
                                                <td align="center" valign="top">

                                                    <!-- CONTENT TABLE // -->
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tbody><tr>
                                                            <td valign="top" class="textContent">
                                                                <h3 style="color:#5F5F5F;line-height:125%;font-family:Helvetica,Arial,sans-serif;font-size:20px;font-weight:normal;margin-top:0;margin-bottom:3px;text-align:left;">
                                                                    New Message From UOM-Connect,
                                                                </h3>
                                                                <div style="text-align:justify;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;">
                                                                    <br/>
                                                                    First Name: <?=$contact->first_name?>.
                                                                    <br/><br/>
                                                                    Last Name: <?=$contact->last_name?>
                                                                    <br/><br>
                                                                    Email: <?=$contact->last_name?>
                                                                    <br/><br/>
                                                                    Message:
                                                                    <br/>
                                                                    <?=nl2br($contact->message)?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody></table>
                                                    <!-- // CONTENT TABLE -->
                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                </tbody></table>
                            <!-- // FLEXIBLE CONTAINER -->
                        </td>
                    </tr>
                    </tbody></table>
                <!-- // CENTERING TABLE -->
            </td>
        </tr>
        <!-- // MODULE ROW -->
        </tbody>
    </table>
    <!-- // END -->
<?php include('partials/_email-footer.php'); ?>
