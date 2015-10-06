<!DOCTYPE html>
<html>

<head>
    <title>LifeData Invoice</title>
</head>

<body style="margin: 0; padding: 0; font-family: Roboto, Open Sans, Tahoma, sans-serif;">
<div style="background-color: #ebf2f6; overflow: hidden;">
    <div style="width: 600px; margin: 0px auto;">
        <div style="background: #333938 url('http://taxideals.com.au/dev/application/views/img/taxideals_logo_admin.png') no-repeat scroll center center; border-bottom: medium none; height: 110px; padding: 0; width: 600px; margin-bottom:30px;"><em>TaxiDeals</em></div>
        <h2 style="font-size: 18px; color:#27b46e; margin: 0;">Invoice - <?php echo $invoice_id?></h2>
        <h4 style="font-size: 14px; color: #2e3b4e; margin: 10px 0;"><?php echo $first_name . " " . $last_name;?></h4>
        <h4 style="font-size: 14px; color: #2e3b4e; margin: 10px 0; padding-bottom: 20px;">Period - <?php echo $start_date . " to " . $end_date;?></h4>
    </div>
</div>
<div style="background-color: #f6f9fb; overflow: hidden;">
    <div style="width: 600px; margin: 0px auto; padding: 0px 0 20px 0">
        <h4 style="font-size: 14px; color: #2e3b4e; margin: 25px 0 0 0;">We appreciate your business.</h4>
        <p style="margin: 10px 0 0 0; color: #4e5561; font-size: 14px; line-height: 25px;">Thanks for being a customer. A detailed summary of your invoice is below. If you have questions, we're happy to help. Email <a href="mailto:support@taxideals.com.au" style="color: #27b46e; text-decoration: underline;">support@taxideals.com.au</a> or contact us through other <a href="https://support.taxideals.com.au/" target="_blank" style="color: #27b46e; text-decoration: underline;">support channels</a>.</p>
        <table style="width: 100%; margin-top: 15px; color: #4e5561;">
            <tbody>
            <tr>
                <th>
                    <h4 style="color: #2e3b4e; padding:0; margin: 0px; text-align: left;">Invoice Summary</h4>
                </th>
            </tr>
            <tr>
                <td style="font-size:13px; padding: 8px 0">Description</td>
                <td style="font-size: 13px; text-align: right; padding: 8px 0">Amount</td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #dde0e2; padding: 8px 0"><?php echo $plan?></td>
                <td style="border-top: 1px solid #dde0e2; text-align: right; padding: 8px 0">$<?php echo $amount?></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #dde0e2; padding: 8px 0">Discount</td>
                <td style="border-top: 1px solid #dde0e2; padding: 8px 0; text-align: right;">$<?php echo $discount?></td>
            </tr>
            <tr>
                <td style="border-top: 2px solid #dde0e2; text-align: right; padding: 8px 0">Total</td>
                <td style="border-top: 2px solid #dde0e2; text-align: right; padding: 8px 0"><?php echo $total_amount?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div style="background-color: #ebf2f6;">
    <div style="width: 600px; margin: 0px auto; padding: 20px 0">
        <h4 style="color: #2e3b4e; margin: 0px;">Thats all</h4>
        <p style="color: #4e5561; font-size: 14px; line-height: 25px; margin: 10px 0 0;">If this paid invoice is correct, you don't need to take further action. Your credit card ending in <b><?php echo $last4?></b> has been charged.</p>
    </div>
</div>
</body>
</html>