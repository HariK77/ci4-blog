<?= $this->extend('layouts/email') ?>

<?= $this->section('content') ?>

<tr>
    <td align="left" style="padding: 0 0 5px 25px; font-size: 18px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #aaaaaa;" class="padding-meta">Dear Admin,</td>
</tr>
<!-- <tr>
                                    <td align="left" style="padding: 0 0 5px 25px; font-size: 22px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #333333;" class="padding-copy">A fantastic library of information</td>
                                </tr> -->
<tr>

    <td align="left" style="padding: 10px 0 15px 25px; font-size: 16px; line-height: 24px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding-copy">New contact form Submission:
        <br><br>
        Name: <?= $data['name'] ?> <br> 
        Email: <?= $data['email'] ?> <br>
        Phone: <?= $data['phone'] ?> <br>
        Message: <?= $data['message'] ?> <br>
    </td>
</tr>
<!-- <tr>
    <td style="padding:0 0 45px 25px;" align="left" class="padding">
        <table border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
            <tr>
                <td align="center">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
                        <tr>
                            <td align="center" style="padding: 0;" class="padding-copy">
                                <table border="0" cellspacing="0" cellpadding="0" class="responsive-table">
                                    <tr>
                                        <td align="center"><a href="<?= base_url() ?>" target="_blank" style="font-size: 15px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #4FC1E9; border-top: 10px solid #4FC1E9; border-bottom: 10px solid #4FC1E9; border-left: 20px solid #4FC1E9; border-right: 20px solid #4FC1E9; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;" class="mobile-button">Visit Website &rarr;</a></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr> -->

<?= $this->endSection() ?>