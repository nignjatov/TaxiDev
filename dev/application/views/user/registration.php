
<body class="login-body">
<script type="text/javascript">document.title = '<?php echo config_item("site_title");?>: Registration';</script>
<div class="container">

    <form id="registration" class="form-signin signup_form">
        <h2 class="form-signin-heading">
            <em>TaxiDeals</em>
        </h2>
        <div class="login-wrap">
            <div class="user-login-info">
                <div class="form-group clearfix">
                    <div class="col-md-12"><p>Account information</p></div>
                </div>
                <div class="form-group clearfix">
                    <div class="col-md-6"><input name="first_name" type="text" class="form-control" placeholder="First Name" autofocus required maxlength="50"></div>
                    <div class="col-md-6"><input name="last_name" type="text" class="form-control" placeholder="Last Name" required maxlength="50"></div>
                </div>
                <div class="form-group clearfix">
                    <div class="col-md-6">
                        <input name="email_id" type="email" class="form-control" placeholder="Email" required maxlength="100">
                    </div>
                    <div class="col-md-6">
                        <input id="user_name" name="user_name" type="text" class="form-control" placeholder="User Name" required maxlength="50" min="6">
                        <span class="error length_error">User Name should be minimum 6 characters.</span>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <div class="col-md-6">
                        <input type="password" maxlength="20" required placeholder="Password" class="form-control" name="user_password" id="newPassword">
                    </div>
                    <div class="col-md-6 m-bot15">
                        <input type="password" maxlength="20" required placeholder="Re-type Password" class="form-control" id="confirmNewPassword">
                        <span class="error password_error" style="display: none;">These passwords don't match. Try again?</span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <label class="checkbox">
                    <input id="termsServiceAgreement" type="checkbox" value="agree this condition">
                        I agree to TaxiDeals's <a href="#" id="TermsOfServiceModalBtn">Terms of Service</a>
                        and <a href="#" id="PrivacyPolicyModalBtn">Privacy Policy</a>
                </label>
                <span class="error agreement_error">Please agree with the Terms of Service and Privacy Policy.</span>
                <button id="signup_button" class="btn btn-lg btn-login btn-block" type="submit">Sign Up</button>
            </div>
            <div class="clearfix">
            </div>
            <div class="registration clearfix">
                Already have an account?
                <a href="login">
                    Login!
                </a>
            </div>
            <!--<div class="loaderBox registrationLoaderBox">-->
            <!--<div class="three-quarters">-->
            <!--Loading...-->
            <!--</div>-->
            <!--</div>-->
        </div>
    </form>
</div>

<div class="modal fade" id="termsOfServiceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
                <h4 class="modal-title">Terms of service</h4>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">
                <h5><b>1. Registration</b></h5>
                <p>By completing the user registration process you agree to be bound by the terms and conditions below.</p>
                </br>
                <h5><b>2. Terms and conditions</b></h5>
                <p>Before you begin to use the services on the website we need to outline to you for you to read and understand, the terms and conditions of your use of the website and Taxi Deals services.</br></br>
                   The Terms and Conditions (as published on the website) together with any additional terms, conditions, notices and disclaimers published on the website and any documents available for download on the website (Terms and Conditions) regulate your use of the website and Taxi Deals services.</br></br>
                   Through your use of the website and Taxi Seeking services, you acknowledge and agree that the Terms and Conditions constitute the rules and conditions of access to, use of and supply of information from the website.</br></br>
                   Please take time to review this document. If you use or continue to use the website and/or services provided by Taxideals you acknowledge and agree that you accept to abide by and be bound by the Terms and Conditions and any changes made by Taxi Deals or any authorised officer, agent, employee or contractor of Taxi Deals to the Terms and Conditions from time to time.</br></br>
                   All terms and conditions that govern your use of the website (including disclaimers) may be amended by Taxi Deals from time to time by posting those amendments on the website without any notice to you. Those amendments apply to your next usage of the website. You are responsible for ensuring that you regularly review the website and these Terms and Conditions. Your continued use of the website after any such changes are made will be deemed to constitute your acceptance of those changes.</br></br>
                   If you object to any of the Terms and Conditions or any subsequent changes to them, or become dissatisfied with your use of the Taxi Deals service in any way, your only remedy is to immediately stop using the services of Taxi Deals and the website.</br></br>
                    A link to this Terms and Conditions Agreement is published on every page of the website.</p>
                </br>
                <h5><b>3. Taxideals.com.au and other Taxi Deals websites</b></h5>
                <p>The Taxideals.com.au website is owned and operated by Taxi Deals Pty Ltd (ACN 604 675 247).</br></br>
                   A link to this Terms and Conditions Agreement will be published on the user registration forms on all websites owned and operated by Taxi Deals (website).</br></br>
                   From time to time the website will generate automated emails to registered users, or website users will send emails and messages to one another through the website. Emails sent by the website or through the website are considered a part of the Taxi Deals website.</br></br>
                   If hyperlinks and other redirection tools taking the user to other websites operated by third parties appear on the website, you acknowledge that these websites (Outside Sites) are not controlled by Taxi Deals and do not form part the Taxi Deals website and agree that you will not hold Taxi Deals liable or in any way accountable for anything that occurs on Outside Sites.
                   </p>
                </br>
                <h5><b>4. Applicable law</b></h5>
                <p>The Terms and Conditions and all other specific and additional terms which govern your use or membership of and access to the website will be governed by the laws of New South Wales, Australia.</p>
                </br>
                <h5><b>5. General information only</b></h5>
                <p>The information, opinions and other similar statements and content published on the website are provided for information purposes only and are not intended as, nor do they constitute legal, financial, taxation, technical or expert advice or to be in any way relied upon by you without undertaking your own independent verification. Information provided on the website has been derived from sources believed to be accurate at the time of compilation and no warranty or representation is made as to the accuracy or authenticity of the content of the website.</br></br>
                   Taxi Deals and its directors, agents or employees do not accept and are by these Terms and Conditions released by you of any liability to you arising (whether directly or indirectly) out of the information provided on the website or anyone else through the website or any errors in, or omissions from information on the website.</br></br>
                   Taxi Deals does not make any representation or warranty that any user is reputable, or will act in good faith, or according to their terms of engagement; any information on the website will be complete, reliable or accurate; or your access to the website will be secure, available or uninterrupted.</br></br>
                   Taxi Deals disclaims and will not be liable for loss arising out of (whether directly or indirectly) and action or decision by you in reliance on the information on or provided to you through the website or provided by any business you engage on the website, nor any interruption, delay or impairment in the functioning, operation or availability of the website, exposure to or transmission of any computer virus, internet access difficulties in connection with the website, or malfunction in equipment or software.</br></br>
                   You should seek legal or other professional advice before acting or relying on the information set out on or provided to you through the website or provided by any business you engage on the website.</br></br>
                   Information on the website is for general information only.</br></br>
                   As a user of the website, you should make your own inquiries and obtain independent advice based on your specific circumstances prior to making any decisions.</p>
                </br>
                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                <h5><b></b></h5>
                <p></p>
                </br>

                </div>
                <div class="modal-footer" style="display: block;">
                    <button type="button" data-dismiss="modal" class="col-sm-offset-10 col-sm-2 btn btn-info">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="PrivacyPolicyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
                <h4 class="modal-title">Terms of service</h4>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">
                <p>Privacy policy text</p>
                </div>
                <div class="modal-footer" style="display: block;">
                    <button type="button" data-dismiss="modal" class="col-sm-offset-10 col-sm-2 btn btn-info">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
