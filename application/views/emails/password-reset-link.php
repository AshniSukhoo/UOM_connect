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
                                                                    Hi <?=$fullName?>,
                                                                </h3>
                                                                <div style="text-align:justify;font-family:Helvetica,Arial,sans-serif;font-size:15px;margin-bottom:0;color:#5F5F5F;line-height:135%;">
                                                                    <br/>
                                                                    You are receiving this email because a change of password has been requested on our site.
                                                                    <br/><br/>
                                                                    If you are at the root of this request click on the button to continue the process. Otherwise you do not need to
                                                                    perform any action this link will expire in 48hr.
                                                                    <br/><br>
                                                                    See you soon on UOM-Connect.
                                                                    <br/>
                                                                    UOM-Connect Team.
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

        <!-- MODULE ROW // -->
        <tr>
            <td align="center" valign="top">
                <!-- CENTERING TABLE // -->
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody><tr style="padding-top:0;">
                        <td align="center" valign="top">
                            <!-- FLEXIBLE CONTAINER // -->
                            <table border="0" cellpadding="30" cellspacing="0" width="500" class="flexibleContainer">
                                <tbody><tr>
                                    <td style="padding-top:0;" align="center" valign="top" width="500" class="flexibleContainerCell">
                                        <!-- CONTENT TABLE // -->
                                        <table border="0" cellpadding="0" cellspacing="0" width="50%" class="emailButton" style="background-color: #3B5999;">
                                            <tbody><tr>
                                                <td align="center" valign="middle" class="buttonContent" style="padding-top:15px;padding-bottom:15px;padding-right:15px;padding-left:15px;">
                                                    <a style="color:#FFFFFF;text-decoration:none;font-family:Helvetica,Arial,sans-serif;font-size:20px;line-height:135%;" href="<?=$resetLink?>" target="_blank">Reset Password</a>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                        <!-- // CONTENT TABLE -->
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
