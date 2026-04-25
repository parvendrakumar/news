<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation to join NewsPortal</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f6f9fc; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
                    <!-- Header -->
                    <tr>
                        <td align="center" style="padding: 40px 40px 30px 40px; background: linear-gradient(135deg, #c90000 0%, #a00000 100%);">
                            <?php if (!empty($site_logo)): ?>
                                <img src="<?= base_url('uploads/settings/' . $site_logo) ?>" alt="<?= esc($site_name) ?>" style="max-height: 50px; margin-bottom: 5px;">
                            <?php else: ?>
                                <h1 style="color: #ffffff; margin: 0; font-size: 28px; font-weight: 900; letter-spacing: -1px; text-transform: uppercase;"><?= esc($site_name) ?></h1>
                            <?php endif; ?>
                            <p style="color: rgba(255,255,255,0.8); margin: 5px 0 0 0; font-size: 12px; font-weight: 700; letter-spacing: 2px;">EDITORIAL INVITE</p>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="color: #1e293b; margin: 0 0 20px 0; font-size: 20px; font-weight: 800;">Welcome to the Team!</h2>
                            <p style="color: #475569; margin: 0 0 20px 0; font-size: 16px; line-height: 1.6;">
                                Hello <strong><?= esc($full_name) ?></strong>,
                            </p>
                            <p style="color: #475569; margin: 0 0 25px 0; font-size: 16px; line-height: 1.6;">
                                You have been officially invited to join the <strong><?= esc($site_name) ?></strong> editorial team as a <strong><?= ucfirst($role) ?></strong>. Your account has been prepared and is ready for use.
                            </p>
                            
                            <!-- Credentials Box -->
                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 25px; margin-bottom: 25px;">
                                <p style="color: #64748b; margin: 0 0 10px 0; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Your Login Credentials</p>
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="padding: 5px 0; color: #475569; font-size: 14px;"><strong>Username:</strong></td>
                                        <td style="padding: 5px 0; color: #1e293b; font-size: 14px; font-family: monospace; font-weight: bold;"><?= esc($username) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 5px 0; color: #475569; font-size: 14px;"><strong>Password:</strong></td>
                                        <td style="padding: 5px 0; color: #1e293b; font-size: 14px; font-family: monospace; font-weight: bold;"><?= esc($password) ?></td>
                                    </tr>
                                </table>
                            </div>
                            
                            <!-- Call to Action -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <a href="<?= base_url('login') ?>" style="display: inline-block; background-color: #c90000; color: #ffffff; padding: 16px 32px; border-radius: 12px; font-weight: 800; text-decoration: none; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 4px 6px rgba(201, 0, 0, 0.2);">Login to Dashboard</a>
                                    </td>
                                </tr>
                            </table>
                            
                            <p style="color: #94a3b8; margin: 30px 0 0 0; font-size: 13px; text-align: center; font-style: italic;">
                                For security reasons, please change your password after your first login.
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="padding: 30px 40px; background-color: #f8fafc; border-top: 1px solid #e2e8f0; text-align: center;">
                            <p style="color: #94a3b8; margin: 0; font-size: 12px;">
                                &copy; <?= date('Y') ?> <?= esc($site_name) ?> Editorial. All rights reserved.
                            </p>
                            <p style="color: #cbd5e1; margin: 5px 0 0 0; font-size: 11px;">
                                Sent via <?= esc($site_name) ?> Automated Security System
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
