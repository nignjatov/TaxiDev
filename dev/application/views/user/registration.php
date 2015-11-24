
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
                <h5><b>6. Your Conduct</b></h5>
                <p>As a condition of your use of the website or any service provided by Taxi Deals, you warrant to Taxi Deals that you will not use the website of any Taxi Deals service for any purpose that is prohibited by the Terms and Conditions or that is illegal or unlawful. You agree to abide by all applicable laws and regulations.

                   Whilst not an exhaustive list, you agree not to:
                   <ul>
                   	<li>Use the website to offend others (which shall be judged in the absolute opinion of Taxi Deals);</li>
                   	<li>Publish, or in any way distribute or disseminate any information which is unlawful, obscene, defamatory, offensive or inappropriate (which shall be judged in the absolute opinion of Taxi Deals);</li>
                   	<li>Engage in, encourage participation or promote any contests, pyramid schemes, surveys, chain letters, spamming or unsolicited emailing through the website;</li>
                   	<li>Use automated scripting tools or software;</li>
                   	<li>Make available, using the website, any material you do not have a right to make available including any law or which contains viruses, or other computer codes, files or programs designed to interfere with the functioning of other software or hardware; or breach any laws or regulations applicable to your use of the website;</li>
                   	<li>Use the site to supply another service, or to obtain information which you either incorporate into your service or product to enhance your service or product or your business in any way such as creating potential customer lists. Any commercial use of the website requires the prior written approval of Taxi Deals.</li>
                   </ul>
                   Taxi Deals has no obligation to monitor your or anyone else's use of the website. However, Taxi Deals reserves the right at all times to monitor, retain and disclose any information as necessary to satisfy any applicable law, regulation, legal process or governmental request.</p>
                </br>

                <h5><b>7. User Indemnity</b></h5>
                <p>As a user of the website, you indemnify Taxi Deals for any loss or damage or costs arising (whether directly or indirectly) out of any breach of the Terms and Conditions or any other legal obligation by you or your use of or conduct on the website.</p>
                </br>

                <h5><b>8. Limitation of Liability</b></h5>
                <p>Taxi Deals excludes all conditions and warranties that may be implied by law. To the extent permitted by law, Taxi Deals's liability for breach of any warranty or condition (implied or otherwise) which cannot be excluded is restricted, at Taxi Deals's option, to the re-supply of the relevant Taxi Deals service or a refund in accordance with the Refund Policy published below.</br></br>

                   As a user of the website, you expressly agree and acknowledge that in no circumstances will Taxi Deals be liable to you for any indirect, incidental, special and/or consequential losses or damages or loss of profits of any nature arising (including but not limited to any act or omission by Taxi Deals) which result from:
                   <ul>
                   	<li>The use or access to or any inability to use or access the website or any material on the website;</li>
                   	<li>Unauthorised access to your user account, or internet transmissions or data; or</li>
                   	<li>Statements or conduct of any third party on the website.</li>
                   	<li>Excluding liability for negligence the maximum liability of Taxi Deals is equivalent to the total of any amounts you have paid to Taxi Deals in respect of goods or services supplied to you by Taxi Deals or $500, whichever is less.</li>
                   </ul></p>
                </br>

                <h5><b>9. Disclaimer</b></h5>
                <p>By using the website you agree to abide by and acknowledge the following disclaimer.</br></br>

                   Taxi Deals are not involved in the actual transaction between business users and customers who contract their services after first being introduced via the website.</br></br>

                   We have no control over the quality, safety or legality of the items or content posted on the website by any user, the truth or accuracy of any posting, the ability of businesses to provider services or the ability of customers to buy services. We cannot censure and do not guarantee that a customer or business user will actual complete a transaction or act lawfully in using the website.</br></br>

                   Taxi Deals cannot and does not confirm each business user's purported identity.</br></br>

                   In the event that you have a dispute with one or more users of the website, you release Taxi Deals (and our directors, agents, contractors, affiliates, parents, subsidiaries, and employees from claims, demands and damages of every kind and nature arising (whether directly or indirectly) out of such dispute.</br></br>

                   Taxi Deals sends emails and notices regarding the status of your matters and your user account. Our emails and notices do not represent any guarantee or endorsement of your transactions. You are responsible for completing all transactions in which you participate (including monitoring the status of, and complying with all relevant legal and other obligations). We do not control, endorse or approve the services provided by the users of the website.</br></br>

                   You acknowledge and release Taxi Deals in the event that you deal with underage persons or people acting under false pretense.</p>
                </br>

                <h5><b>10. Warranty</b></h5>
                <p>You agree to accept the sole responsibility for the legality of your actions used the laws which apply to you. You agree that Taxi Deals have no responsibility for the legality of the actions of users of the website or Taxi Deals services.</p>
                </br>

                <h5><b>11. Indemnity</b></h5>
                <p>You indemnify and release Taxi Deals and its directors, employees, agents, contractors, affiliates from and against any claims, demands, proceedings, losses and damages of every kind and nature including reasonable solicitor's fees, made by you or any third party due to or arising (whether directly or indirectly) out of your breach of these Terms and Conditions or your violation of and law or the rights of a third party.</p>
                </br>

                <h5><b>12. No Agency</b></h5>
                <p>You and Taxi Deals are independent contractors and no agency, partnership, joint venture, employee-employer or franchisee-franchisor relationship is created or intended by this Terms and Conditions agreement or your use of the website or Taxi Deals services.</p>
                </br>

                <h5><b>13. User Information</b></h5>
                <p>As a user of the website you must provide Taxi Deals with complete, up to date and accurate information as requested and it is your responsibility to inform Taxi Deals of any changes to that information. All personal information you provide to Taxi Deals as a user will be treated in accordance with the Personal Information &amp; Privacy Policy shown below.</br></br>

                   Taxi Deals reserve the right to modify or delete any general information you submit to the website in order to enhance the services we provide to you and other Taxi Deals users.</p>
                </br>

                <h5><b>14. Username &amp; Password</b></h5>
                <p>To become a member of Taxi Deals, you will nominate a username and password. You must use a valid email address.</br></br>

                   You are entirely responsible for all activities that occur under your username and password. You must ensure these remain confidential at all times.</br></br>

                   You must notify Taxi Deals immediately by email to support@taxideals.com.au if you become aware of any unauthorised use of your username and password.</br></br>

                   Each username and password must be used by a single individual and is not transferrable.</p>
                </br>

                <h5><b>15. Phone Recordings</b></h5>
                <p>Taxi Deals reserves the right to record phone calls between you and Taxi Deals employees or Taxi Deals users for training purposes.</p>
                </br>

                <h5><b>16. Personal Information &amp; Privacy</b></h5>
                <p>Taxi Deals collects personal information from a variety of sources, including from professional drivers, registered taxi operators, members of the public, advertisers, mailing lists, contractors and business partners.</br></br>

                   In general, the personal information Taxi Deals collects includes (but is not limited to) name, address, contact details and, where relevant, financial information, including credit card information, banking details and income information.</br></br>

                   Taxi Deals stores the personal information you enter on the website. Taxi Deals obtains most personal information through the website registration process outline above. You may, however, provide information through a variety of different means (for example if you contact Taxi Deals via email, respond to a survey published on the website or third party survey used by Taxi Deals, or answering questions asked by staff or agents of Taxi Deals over the phone).</br></br>

                   The website uses cookies which contain information by which Taxi Deals can identify your computer (or other devices you use to access the website) to our servers and the servers of third parties contracted by Taxi Deals including, but not limited to, third parties providing analytical and advertising services. You may configure your browser so that you are notified before a cookie is downloaded or so that your browser does not accept cookies. Taxi Deals may use information contained in cookies to make assumptions about the user of the device and to provide users of that device with focused advertising that Taxi Deals believes may be of interest, based on that information. You can disable cookies through your Internet browser.</br></br>

                   Taxi Deals endeavours to collect personal information about an individual only from that individual. In some circumstances Taxi Deals may obtain personal information from a third party. If you provide personal information about another person to Taxi Deals, Taxi Deals requires that you inform that person you have done so and provide them a copy of this Personal Information &amp; Privacy policy.</p>
                </br>

                <h5><b>17. How Taxi Deals uses your Personal Information</b></h5>
                <p>Taxi Deals may use your personal information for the primary purpose for which it is collected and for such other secondary purposes that are related to the primary purpose of collection. Taxi Deals generally uses personal information to:
                   <ul>
                   	<li>Personalise and customise your experience on the website;</li>
                   	<li>Help Taxi Deals manage and enhance its services;</li>
                   	<li>Communicate with you by email, SMS message or telephone; and</li>
                   	<li>Provide you with ongoing information about opportunities on the website which Taxi Deals believes you may be interested by email, SMS message or telephone.</li>
                   </ul></p>
                </br>

                <h5><b>18. Disclosure of Personal Information</b></h5>
                <p>Taxi Deals may use and disclose information relating to a user's racial or ethnic origin, membership of political bodies, religion, membership of a trade union or trade association, sexual preferences, criminal record and health only for the purpose for which it was provided or a directly related secondary purpose or as allowed by law unless the user has agreed otherwise.</p>
                </br>

                <h5><b>19. Management &amp; Security of Personal Information</b></h5>
                <p>Taxi Deals protects the personal information Taxi Deals holds from misuse, loss, unauthorised access, modification or disclosure by various means including firewalls, password access, secure servers and data encryption.</br></br>

                   Taxi Deals may retain any personal information you provide during your use of the website, including, but not limited to, copies of identification documents, for a minimum period of 12 months after your last interaction with the website. After 12 months Taxi Deals will delete, or anonymise, on your request, specific personal information from our servers, files, and databases, unless Taxi Deals are required by law to retain that information.</p>
                </br>

                <h5><b>20. Updating Personal Information</b></h5>
                <p>Taxi Deals endeavours to ensure the personal information it holds is accurate, complete and up-to-date. You can update your personal information by simply logging in and updating your profile page.</p>
                </br>

                <h5><b>21. Accessing Personal Information</b></h5>
                <p>You have the right to seek access to the personal information Taxi Deals holds about you and to advise Taxi Deals of any inaccuracy. There are some exceptions to this right set out in the Privacy Act.</br></br>

                   If you make an access request, Taxi Deals will ask you to verify your identity and specify what information you require. Taxi Deals may charge you a fee to cover the costs of meeting your request.</p>
                </br>

                <h5><b>22. License to Use Your Information</b></h5>
                <p>Solely to enable Taxi Deals to use the information you supply us with, so that we are not violating any rights you have in that information, you agree to grant us a non-exclusive, worldwide, irrevocable, perpetual, fee-free right to exercise the copyright and other intellectual property rights you have in that information in any format (including, but not limited to, any text, photographs, graphics, video or audio). You agree that Taxi Deals can use that content in any way, now and in the future. Taxi Deals also reserves the right not to use the content that you submit. You warrant that you have all of the necessary rights, including copyright, in the content you contribute, that your content is not defamatory and that it does not infringe any law within New South Wales or Australia. You indemnify Taxi Deals against any and all legal fees, damages and other expenses that may be incurred by Taxi Deals as a result of a breach of this warranty. Taxi Deals will only use your information in accordance with our Personal Information &amp; Privacy Policy.</p>
                </br>

                <h5><b>23. Feedback Ratings &amp; Comments</b></h5>
                <p>Deals allows users of the website to rate and comment on the performance of Taxi Deals business users whose business services they have contracted.</br></br>

                   Taxi Deals reserves the right to publish or not to publish those ratings and comments (feedback) on the website at its absolute discretion.</br></br>

                   Taxi Deals reserves the right to delete or modify feedback submitted on the website at any time for any reason.</br></br>

                   Taxi Deals will delete or modify if it is clear that, in the opinion of Taxi Deals, the feedback is factually incorrect or does not relate to the provision of business services by the business to the user who submitted feedback.</br></br>

                   Taxi Deals reserves the right to aggregate each businesses feedback into a percentage score and publish that score on the website.</br></br>

                   In Australia and other countries, feedback may be considered defamatory of the reputation and standing of individuals and businesses. You acknowledge and agree that Taxi Deals accepts no responsibility for liability, damage, injury or loss that may arise from feedback submitted to or published on the website, and you, by these Terms and Conditions, release forever and indemnify Taxi Deals from any liability it may incur arising out of (whether directly or indirectly) any feedback you post on the Taxi Deals website.</br></br>

                   Further you agree that, if you or anyone else commences or threatens any action or proceeding against Taxi Deals or makes any claim or demand against Taxi Deals as a result of any feedback you submit to the website, Taxi Deals may, in its absolute discretion, without any notice to you immediately cancel or suspend your membership of the website.</p>
                </br>

                <h5><b>24. Breaching our Terms and Conditions</b></h5>
                <p>Without limiting other remedies available to Taxi Deals at law, in equity or under this Terms and Conditions, we may, in our sole discretion, immediately issue a warning, temporarily suspend or terminate your membership and refuse to provide services to you if:
                   <ul>
                   	<li>You breach these Terms and Conditions or Personal Information &amp; Privacy policy;</li>
                   	<li>We are unable to verify or authenticate any information you provide to us; or</li>
                   	<li>We believe your actions may cause legal liability to you, Taxi Deals users or Taxi Deals.</li>
                   </ul></p>
                </br>

                <h5><b>25. Termination of Your Account with Taxi Deals</b></h5>
                <p>Taxi Deals may at its discretion terminate your use or, or access to, the website at any time. If this happens we may notify you by email. If your use of the website is terminated:
                   <ul>
                   	<li>You are no longer authorised to access the website or use any other Taxi Deals services with the email address you used to register with the site or any other email address you possess;</li>
                   	<li>You will continue to be subject to and bound by all restrictions imposed on you by the Terms and Conditions; and</li>
                   	<li>All licenses granted by you and all disclaimers by Taxi Deals and limitations of Taxi Deals's liability set out in the Terms and Conditions or elsewhere on the website will survive.</li>
                   </ul></p>
                </br>

                <h5><b>26. Customer Support &amp; Complaints Policy</b></h5>
                <p>Taxi Deals make a considerable investment in staff and technology to help answer customer support questions and respond to complaints. Our staff will endeavour to process questions or complaints from registered users of the website according to the following policy:
                   <ul>
                   	<li>Taxi Deals will attempt to resolve any customer complaints and answer any questions within 1 business day of the first contact made by a customer by email to support@taxideals.com.au</li>
                   	<li>All complaints and enquiries are logged and managed by the Taxi Deals Customer Relationship Management software.</li>
                   	<li>Technical complaints or product development suggestions will be considered for future software upgrades. Your suggestions may not result in changes to the software or Taxi Deals business practices.</li>
                   	<li>All other complaints are reviewed by Taxi Deals customer support representatives and may be escalated to a manager for resolution if required.</li>
                   	<li>Taxi Deals reserves the right not to respond to customer support questions or complaints that offend Taxi Deals employees or agents.</li>
                   	<li>Taxi Deals reserves the right not to respond to questions or complaints made by individuals who, in the opinion of Taxi Deals, are not current users of the website, or have been suspended from using the website.</li>
                   </ul></p>
                </br>

                <h5><b>27. Dispute Resolution Policy</b></h5>
                <p>Taxi Deals will use reasonable endeavours to mediate any dispute concerning the use by parties of the website.</br></br>

                   Disputes in relation to the actual services carried out by a business or any other issue will be referred, where appropriate, to external dispute resolution services or authorities.</p>
                </br>

                <h5><b>28. Suspension and Termination of Business User Accounts</b></h5>
                <p>Business users of the website may have their access to the website and Taxi Deals services suspended for any length of time for any breach of the Terms and Conditions, as well as, but not limited to, any of the following reasons:
                   <ul>
                   	<li>Providing false or inaccurate information during business registration or when quoting on the website;</li>
                   	<li>Providing false or inaccurate information to Taxi Deals employees or agents;</li>
                   	<li>Receiving in aggregate more than 2 negative feedback ratings or complaints from other website users in relation to services contracted by the users who initiate the negative feedback or complaint (2 strikes and you're out policy);</li>
                   	<li>Acting as an agent of another business or individual who is not a current paying business member of the website without the written approval of Taxi Deals; and,</li>
                   	<li>Submitting quotes via any means to any other person or entity for work that the business user is not qualified, or licenced to perform.</li>
                   </ul></p>
                </br>

                <h5><b>29. Cancellations of Paid Business Memberships</b></h5>
                <p>Users of the website that pay for membership (paying businesses) are entitled to contact, and offer quotes to, other website users who have submitted a job listing on the website matching the paying business' industry and geographic settings.</br></br>

                   Paying businesses can cancel their membership at any time by clicking Change Membership Details in the My Account tab and selecting Cancel My Membership. They can also email support@taxideals.com.au from the email address they use as their username to access the site.</br></br>

                   Paying businesses that have prepaid for any length of time will not be refunded for the unused portion of their membership in accordance with the Refunds Policy.</br></br>

                   Paying businesses who are billed on a recurring cycle will not be charged further provided they cancel online or advise Taxi Deals of their intention to cancel their membership before 5pm on the last business day before their next membership payment is due. Taxi Deals will publish the date of the next upcoming charges for recurring payments on the website within a paying business' user account.</p>
                </br>

                <h5><b>30. Refunds Policy</b></h5>
                <p>Paying businesses can access the quoting and messaging facilities on the website. Paying businesses agree that membership is non-refundable at the time that payment is made.</br></br>

                   If you are dissatisfied with the website or Taxi Deals services you are free to discontinue using the website, and as such membership fees or other payments you have made to Taxi Deals are not subject to refunds.</br></br>

                   Business members who buy Certification are not entitled to a refund if they are unable to complete our Training and Certification course or if they stop using the website.</br></br>

                   In the case of an event not specifically covered in the Refund Policy, refunds will be given at the discretion of Taxi Deals.</br></br>

                   Refunds paid in accordance with this Refund policy will be paid within 60 business days via the same method the payment to be refunded was made to Taxi Deals in the first instance.</br></br>

                   Business users who claim a refund from their credit card provider or bank without contacting our Customer Support team first (unauthorised refund) will have their paid membership immediately suspended. Taxi Deals may issue an invoice to recover up to the full value of any unauthorised refund to the relevant business user. Taxi Deals may contract a debt collection agency or use other legal means to recover unauthorised refunds. Taxi Deals may charge you interest plus any costs we incur as a result of collecting your payment.</p>
                </br>

                <h5><b>31. Verification</b></h5>
                <p>Paying businesses can pay to have business information verified by Taxi Deals including an Australian Business Number (ABN) and a physical business address.</br></br>

                   If a business user pays for verification services and submits documents to verify an ABN and physical business address (verified business), Taxi Deals will differentiate that verified business from other paying businesses for a period of time from the date the payment for Verification is received by Taxi Deals.</br></br>

                   Taxi Deals may use any appropriate icons, images or text on the business profile and in quotes submitted by a verified business to differentiate them from a business user who has not been verified. Taxi Deals may modify the icons, images or text used to differentiate verified businesses on the website at any time.</br></br>

                   If a business user pays for verification but cannot produce documents to verify they have an ABN or current physical business address, they are not entitled to display a Taxi Deals "Verified" badge on their business profile or quotes sent via the website.</br></br>

                   By purchasing Verification, a business represents that they have the documents required to obtain Verification on the Taxi Deals website. Taxi Deals will not issue a refund to businesses that cannot produce documents to verify they have an ABN or physical business address if the business requests a refund. Taxi Deals may terminate or suspend a business user's account if they are unable to produce documentation to verify their ABN or current physical business address.</p>
                </br>

                <h5><b>32. Certification</b></h5>
                <p>Paying businesses can pay to complete a training course and examination set by Taxi Deals and become a certified business.</br></br>

                   If a business user pays for certification services and completes any examinations to a standard set by Taxi Deals in its sole, Taxi Deals will differentiate that paying business from other paying businesses for the length of time that they choose to remain "Certified".</br></br>

                   Taxi Deals may use any appropriate icons, images or text on the business profile and in quotes submitted by a certified business to differentiate them from a business user who has not been certified. Taxi Deals may modify the icons, images or text used to differentiate certified businesses on the website at any time.</br></br>

                   If a business user pays for certification but does not complete the certification examinations to the standard of achievement set by Taxi Deals, they are not entitled to receive a refund for the certification payment in any month.</br></br>

                   A business who pays for certification can make an unlimited number of attempts to complete the certification examinations up until the time they reach the standard of achievement set by Taxi Deals.</p>
                </br>

                <h5><b>33. Updates to the Website</b></h5>
                <p>Taxi Deals may from time to time and at any time change or discontinue any feature of the website including content, hours or availability and equipment required for access.</p>
                </br>

                <h5><b>34. Arbitration</b></h5>
                <p>Any controversy or claim arising out of or in connection with these Terms and Conditions may at our discretion be settled by binding arbitration through a commercial dispute resolution centre selected by us. You agree to be bound by the ruling arbitrator. The costs of the dispute are borne by the originator of the dispute.</p>
                </br>

                <h5><b>35. Promotions &amp; Competitions</b></h5>
                <p>If Taxi Deals run promotions or competitions involving the awarding of prizes or other gifts, Taxi Deals may modify the Terms and Conditions and implement additional terms and conditions, which will be communicated to you by posting them on the website at the time of such promotions and competitions.</p>
                </br>

                <h5><b>36. Third Party Links &amp; Advertising</b></h5>
                <p>Taxi Deals may display advertisements, which may or may not contain hyperlinks or buttons which take you to websites operated by third parties. Taxi Deals does not endorse or recommend its advertisers, their products or services, or the information, products or services of any website linked to the website.</br></br>

                   If you contact a third party through the website, including via email, Taxi Deals accepts no responsibility for any actions taken by that third party in connection with you as the user.</p>
                </br>

                <h5><b>37. Notices</b></h5>
                <p>Except as explicitly stated otherwise, any notices shall be given by email to Taxi Deals on the following address: support@taxideals.com.au or taxidealsdesk@gmail.com</p>
                </br>

                <h5><b>38. Identity Check</b></h5>
                <p>As a business member of Taxideals.com.au you'll need to confirm your identity if you continue to quote on work for more than 7 days after first registering. If you can't confirm your identity by then you won't be entitled to a refund.</p>
                </br>

                <h5><b>39. Copyright</b></h5>
                <p>The Taxi Deals&#174; website is &#169; Copyright Taxi Deals Pty Ltd 2015</p>
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

                <h3 style="text-align: center;">Privacy</h3>

                <ol>
                	<li><strong>Personalised account</strong></li>
                </ol>
                <ul>
                	<li>Drivers and operators both have their personalised account.</li>
                	<li>Only you can access your business data.</li>
                	<li>Operators can have additional accounts linked to their business for employees upon request according to their package.</li>
                </ul>
                <ol start="2">
                	<li><strong>Manage your public profile</strong></li>
                </ol>
                <ul>
                	<li>You can decide what information will be available for your public profile as part of the operator directory.</li>
                	<li>You are in charge, deciding how you want to interact with potential drivers.</li>
                </ul>

                <h3 style="text-align: center;">Security</h3>

                <ol>
                	<li><strong>Industry standard data security encryption</strong></li>
                </ol>
                <ul>
                	<li>SSL certified</li>
                	<li>All the transactions and customer data is private and secured</li>
                	<li>Strong SHA-2 &amp; 2048-bit encryption</li>
                	<li>No information can be stolen and used while kept in your account</li>
                </ul>
                <ol start="2">
                	<li><strong>Australian registered entity</strong></li>
                </ol>
                <ul>
                	<li>You enjoy all the consumers rights under the Australian Consumer Law</li>
                	<li>We comply with all the regulations set out by the Australian Securities and Investment Commission</li>
                </ul>
                </div>
                <div class="modal-footer" style="display: block;">
                    <button type="button" data-dismiss="modal" class="col-sm-offset-10 col-sm-2 btn btn-info">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
