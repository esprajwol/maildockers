<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('localizations')->truncate();

        $localizations = [
            ['key' => 'email_organization', 'value' => 'Email\'s Messages into an Organised Document', 'language_id' => 1],
            ['key' => 'home', 'value' => 'Home', 'language_id' => 1],
            ['key' => 'features', 'value' => 'Features', 'language_id' => 1],
            ['key' => 'privacy_and_policy', 'value' => 'Privacy & Policy', 'language_id' => 1],
            ['key' => 'terms_service', 'value' => 'Terms of Service', 'language_id' => 1],
            ['key' => 'articles', 'value' => 'Articles', 'language_id' => 1],
            ['key' => 'contact', 'value' => 'Contact', 'language_id' => 1],
            ['key' => 'video', 'value' => 'Video', 'language_id' => 1],
            ['key' => 'app_description', 'value' => 'Awesome app to search and extract conversations from Email in a few clicks, generating a professional document with selected keywords highlighted.', 'language_id' => 1],
            ['key' => 'best_for_lawyers', 'value' => 'Best for lawyers!', 'language_id' => 1],
            ['key' => 'google_approval', 'value' => 'Approved by Google\'s Security Team', 'language_id' => 1],
            ['key' => 'gdpr_compliance', 'value' => 'Fully Compliant with GDPR', 'language_id' => 1],
            ['key' => 'email_to_pdf', 'value' => 'Email to pdf generator', 'language_id' => 1],
            ['key' => 'address_prompt', 'value' => 'Enter the addresses of both parties for correspondence', 'language_id' => 1],
            ['key' => 'and', 'value' => 'and', 'language_id' => 1],
            ['key' => 'user_google_email', 'value' => 'Your Email (Any Google Suite)', 'language_id' => 1],
            ['key' => 'user_microsoft_email', 'value' => 'Your Outlook (Any Microsoft Package)', 'language_id' => 1],
            ['key' => 'colleague_email', 'value' => 'Your Colleague\'s Email (Any Email)', 'language_id' => 1],
            ['key' => 'google_support', 'value' => 'We support all types of mailboxes that work with Google Suite.  including Gmail, and any other private domain names under the Google Suite package.', 'language_id' => 1],
            ['key' => 'microsoft_support', 'value' => 'We support all types of mailboxes that work with Microsoft. Including Outlook and Hotmail, and other private domain names under the Microsoft package.', 'language_id' => 1],
            ['key' => 'search_keywords', 'value' => 'Keywords', 'language_id' => 1],
            ['key' => 'keyword_instruction', 'value' => 'Separate keywords with commas', 'language_id' => 1],
            ['key' => 'keyword_example', 'value' => 'keyword a, keyword b, keyword c', 'language_id' => 1],
            ['key' => 'exclude_keywords', 'value' => 'Keywords to Exclude?', 'language_id' => 1],
            ['key' => 'search_timeframe', 'value' => 'Time Frame', 'language_id' => 1],
            ['key' => 'starts', 'value' => 'Starts', 'language_id' => 1],
            ['key' => 'ends', 'value' => 'Ends', 'language_id' => 1],
            ['key' => 'search_attachments', 'value' => 'Attachments', 'language_id' => 1],
            ['key' => 'search_attachments', 'value' => 'קבצים מצורפים', 'language_id' => 2],
            ['key' => 'i_want_a_list_of_all_attachments_only_no_email_correspondence', 'value' => 'I want a list of all attachments only, no email correspondence', 'language_id' => 1],
            ['key' => 'i_want_a_list_of_all_attachments_only_no_email_correspondence', 'value' => 'אני רוצה רשימה של כל הקבצים המצורפים בלבד, ללא התכתבות במייל', 'language_id' => 2],
            ['key' => 'i_want_all_the_correspondence_plus_the_list_of_all_attachments', 'value' => 'I want all the correspondence plus the list of all attachments', 'language_id' => 1],
            ['key' => 'i_want_all_the_correspondence_plus_the_list_of_all_attachments', 'value' => 'אני רוצה את כל ההתכתבות בתוספת רשימת כל הקבצים המצורפים', 'language_id' => 2],
            ['key' => 'document_language', 'value' => 'Document\'s language', 'language_id' => 1],
            ['key' => 'english', 'value' => 'English', 'language_id' => 1],
            ['key' => 'hebrew', 'value' => 'Hebrew', 'language_id' => 1],
            ['key' => 'generate_pdf', 'value' => 'Generate PDF', 'language_id' => 1],
            ['key' => 'feature_list', 'value' => 'Features', 'language_id' => 1],
            ['key' => 'support_languages', 'value' => 'Supports all languages', 'language_id' => 1],
            ['key' => 'support_google_suite', 'value' => 'Supports any Google suite mailboxes', 'language_id' => 1],
            ['key' => 'quick_generation', 'value' => 'Ready in seconds', 'language_id' => 1],
            ['key' => 'keyword_highlighting', 'value' => 'Highlights keywords', 'language_id' => 1],
            ['key' => 'export_options', 'value' => 'Export/ Save/ Print/ Share', 'language_id' => 1],
            ['key' => 'more', 'value' => 'More', 'language_id' => 1],
            ['key' => 'privacy_section', 'value' => 'Privacy', 'language_id' => 1],
            ['key' => 'google_security_approval', 'value' => 'Approved by Google’s security team!', 'language_id' => 1],
            ['key' => 'gdpr_statement', 'value' => 'Fully compliant with GDPR!', 'language_id' => 1],
            ['key' => 'no_document_storage', 'value' => 'We do not keep your document', 'language_id' => 1],
            ['key' => 'no_user_info_storage', 'value' => 'We do not store any information about you', 'language_id' => 1],
            ['key' => 'content_privacy', 'value' => 'We can’t read any content from your email', 'language_id' => 1],
            ['key' => 'user_document_view', 'value' => 'Only you can view the document', 'language_id' => 1],
            ['key' => 'testimonial_1_name', 'value' => 'Tom Brown, UK', 'language_id' => 1],
            ['key' => 'testimonial_1_text', 'value' => 'LegalPDF is a fantastic product, so simple and quick to use and helped me win my case', 'language_id' => 1],
            ['key' => 'testimonial_2_name', 'value' => 'Jack Evans, USA', 'language_id' => 1],
            ['key' => 'testimonial_2_text', 'value' => 'I just saved hours of endless manual labour with just a few simple clicks! I highly recommend this product to anyone looking to convert a casual conversation into a formal document', 'language_id' => 1],
            ['key' => 'testimonial_3_name', 'value' => 'Laura Williams, UK', 'language_id' => 1],
            ['key' => 'testimonial_3_text', 'value' => 'I am so happy that this tool exists! Worked so quickly and beautifully, did exactly what was advertised – THANK YOU LegalPDF!', 'language_id' => 1],
            ['key' => 'latest_articles', 'value' => 'Latest Articles', 'language_id' => 1],
            ['key' => 'converter_gmail_to_pdf', 'value' => 'Gmail To Pdf Converter Online', 'language_id' => 1],
            ['key' => 'export_emails_to_pdf', 'value' => 'Export Emails From Gmail To Pdf', 'language_id' => 1],
            ['key' => 'save_multiple_emails', 'value' => 'Save Multiple Emails As Pdf Gmail', 'language_id' => 1],
            ['key' => 'save_single_email', 'value' => 'Save Email From Gmail As Pdf', 'language_id' => 1],
            ['key' => 'save_gmail_email', 'value' => 'Save A Gmail As Pdf', 'language_id' => 1],
            ['key' => 'london', 'value' => 'LONDON', 'language_id' => 1],
            ['key' => 'jerusalem', 'value' => 'JERUSALEM', 'language_id' => 1],
            ['key' => 'address_london', 'value' => '18 Elington Road, E8 3PA', 'language_id' => 1],
            ['key' => 'address_jerusalem', 'value' => '24 Yehoshua Bin Nun St', 'language_id' => 1],
            ['key' => 'copyright_notice', 'value' => 'Copyright 2020 © ', 'language_id' => 1],
            ['key' => 'company_name', 'value' => 'LegalPDF All Rights Reserved', 'language_id' => 1],
            ['key' => 'privacy_policy', 'value' => 'Privacy Policy', 'language_id' => 1],
            ['key' => 'terms_of_service', 'value' => 'Terms of Service', 'language_id' => 1],
            ['key' => 'google_api_services', 'value' => 'Google API Services', 'language_id' => 1],
            ['key' => 'google_api_services_notice', 'value' => 'In order to use our site, you must use the verification and consent of the', 'language_id' => 1],
            ['key' => 'read_more', 'value' => 'Read more...', 'language_id' => 1],
            ['key' => 'doc_generation_notice', 'value' => 'We are creating the document - please be patient, this may take some time.', 'language_id' => 1],
            ['key' => 'message_extraction_notice', 'value' => 'Extract message number', 'language_id' => 1],
            ['key' => 'done', 'value' => 'Done!', 'language_id' => 1],
            ['key' => 'doc_ready', 'value' => 'The document is ready', 'language_id' => 1],
            ['key' => 'download_continue', 'value' => 'Download & Continue', 'language_id' => 1],
            ['key' => 'download_logout', 'value' => 'Download & Logout', 'language_id' => 1],
            ['key' => 'incorrect_email_warning', 'value' => 'Incorrect information for example@gmail.com', 'language_id' => 1],
            ['key' => 'retry_prompt', 'value' => 'Please try again', 'language_id' => 1],
            ['key' => 'logout', 'value' => 'Logout', 'language_id' => 1],
            ['key' => 'fast_free', 'value' => 'FAST & FREE', 'language_id' => 1],
            ['key' => 'fast_free_description', 'value' => 'The tool is completely free and there is no usage limit. Moreover, there is minimal input required by the user - only sender and receiver information, and the tool does the heavy lifting. This product produces a well-formatted and ready-to-use document within minutes.', 'language_id' => 1],
            ['key' => 'trustworthy', 'value' => 'TRUSTWORTHY', 'language_id' => 1],
            ['key' => 'trustworthy_description', 'value' => 'LegalPDF is reliable and secure. Our team worked closely with Google\'s Security Team, and we have been approved by them. We are also fully GDPR compliant - so you can use this tool with peace of mind.', 'language_id' => 1],
            ['key' => 'multilingual_any_mailbox', 'value' => 'MULTILINGUAL & ANY MAILBOX', 'language_id' => 1],
            ['key' => 'multilingual_any_mailbox_description', 'value' => 'This tool can extract information from emails and chats in any language, including languages that do not use the modern English alphabet such as Arabic, Mandarin, Hebrew, and many more. LegalPDF can also extract information from any mailbox, not just the inbox.', 'language_id' => 1],
            ['key' => 'privacy_focus', 'value' => 'PRIVACY', 'language_id' => 1],
            ['key' => 'privacy_description', 'value' => 'Consumer privacy is a top priority at LegalPDF. We do not require or store any customer information. Registration is not required, and the service is totally anonymous. To protect customers, we delete all generated documents once they are delivered.', 'language_id' => 1],
            ['key' => 'page_not_found', 'value' => 'Page Not Found (404)', 'language_id' => 1],
            ['key' => 'terms_intro', 'value' => 'Please Read These Terms and Conditions Carefully Before Using this Site', 'language_id' => 1],
            ['key' => 'terms_summary', 'value' => 'These terms tell you the rules for using our website', 'language_id' => 1],
            ['key' => 'our_site', 'value' => 'our site', 'language_id' => 1],
            ['key' => 'info_links', 'value' => 'Click on the links below to go straight to more information on each area:', 'language_id' => 1],
            ['key' => 'contact_us', 'value' => 'Who we are and how to contact us', 'language_id' => 1],
            ['key' => 'site_usage_confirmation', 'value' => 'By using our site you accept these terms', 'language_id' => 1],
            ['key' => 'applicable_terms', 'value' => 'There are other terms that may apply to you', 'language_id' => 1],
            ['key' => 'terms_changes', 'value' => 'We may make changes to these terms', 'language_id' => 1],
            ['key' => 'site_changes', 'value' => 'We may make changes to our site', 'language_id' => 1],
            ['key' => 'site_suspension', 'value' => 'We may suspend or withdraw our site', 'language_id' => 1],
            ['key' => 'uk_only', 'value' => 'Our site is only for users in the UK', 'language_id' => 1],
            ['key' => 'account_safety', 'value' => 'You must keep your account details safe', 'language_id' => 1],
            ['key' => 'site_material_usage', 'value' => 'How you may use material on our site', 'language_id' => 1],
            ['key' => 'disclaimer', 'value' => 'Do not rely on information on our site', 'language_id' => 1],
            ['key' => 'third_party_links', 'value' => 'We are not responsible for websites we link to', 'language_id' => 1],
            ['key' => 'user_content_policy', 'value' => 'User-generated content is not approved by us', 'language_id' => 1],
            ['key' => 'liability_summary', 'value' => 'When we are responsible for loss or damage suffered by you', 'language_id' => 1],
            ['key' => 'upload_rules', 'value' => 'Rules about uploading content to our site', 'language_id' => 1],
            ['key' => 'user_rights_grant', 'value' => 'Rights you are giving us to use material you upload', 'language_id' => 1],
            ['key' => 'virus_protection', 'value' => 'We are not responsible for viruses, and you must not introduce them', 'language_id' => 1],
            ['key' => 'linking_rules', 'value' => 'Rules about linking to our site', 'language_id' => 1],
            ['key' => 'dispute_resolution', 'value' => 'Which country’s laws apply to any disputes', 'language_id' => 1],
            ['key' => 'company_operator_info', 'value' => 'is a site operated by ', 'language_id' => 1],
            ['key' => 'company_registration', 'value' => '(“We”). Our registered office is at', 'language_id' => 1],
            ['key' => 'contact_email', 'value' => 'To contact us, please email ', 'language_id' => 1],
            ['key' => 'site_terms_acceptance', 'value' => 'By using our site, you confirm that you accept these terms of use and that you agree to comply with them.', 'language_id' => 1],
            ['key' => 'terms_disagreement', 'value' => 'If you do not agree to these terms, you must not use our site.', 'language_id' => 1],
            ['key' => 'print_terms_recommendation', 'value' => 'We recommend that you print a copy of these terms for future reference.', 'language_id' => 1],
            ['key' => 'additional_terms', 'value' => 'These terms of use refer to the following additional terms, which also apply to your use of our site:', 'language_id' => 1],
            ['key' => 'cookie_policy', 'value' => 'Cookie Policy', 'language_id' => 1],
            ['key' => 'cookie_policy_description', 'value' => ', which sets out information about the cookies on our site.', 'language_id' => 1],
            ['key' => 'terms_revision', 'value' => 'We amend these terms from time to time. Every time you wish to use our site, please check these terms to ensure you understand the terms that apply at that time.', 'language_id' => 1],
            ['key' => 'site_update_notice', 'value' => 'We may update and change our site from time to time to reflect changes to our services, our users’ needs, and our business priorities.', 'language_id' => 1],
            ['key' => 'site_availability', 'value' => 'We do not guarantee that our site, or any content on it, will always be available or be uninterrupted. We may suspend, withdraw, or restrict availability of all or any part of our site for business and operational reasons. We will try to give reasonable notice of any suspension or withdrawal.', 'language_id' => 1],
            ['key' => 'user_access_responsibility', 'value' => 'You are responsible for ensuring that all persons accessing our site through your internet connection are aware of these terms and other applicable terms and conditions, and that they comply with them.', 'language_id' => 1],
            ['key' => 'intellectual_property_notice', 'value' => 'We are the owner or the licensee of all intellectual property rights on our site and the material published on it. Those works are protected by copyright laws and treaties around the world. All such rights are reserved.', 'language_id' => 1],
            ['key' => 'terms_info_notice', 'value' => 'For further information, please refer to each respective section.', 'language_id' => 1],
            ['key' => 'personal_use_print_download', 'value' => 'You may print off one copy, and may download extracts, of any page(s) from our site for your personal use and you may draw the attention of others within your organisation to content posted on our site.', 'language_id' => 1],
            ['key' => 'no_modification_of_materials', 'value' => 'You must not modify the paper or digital copies of any materials you have printed off or downloaded in any way, and you must not use any illustrations, photographs, video or audio sequences or any graphics separately from any accompanying text.', 'language_id' => 1],
            ['key' => 'author_credit_required', 'value' => 'Our status (and that of any identified contributors) as the authors of content on our site must always be acknowledged.', 'language_id' => 1],
            ['key' => 'no_commercial_use_without_license', 'value' => 'You must not use any part of the content on our site for commercial purposes without obtaining a licence to do so from us or our licensors.', 'language_id' => 1],
            ['key' => 'breach_consequence_action', 'value' => 'If you print off, copy or download any part of our site in breach of these terms of use, your right to use our site will cease immediately and you must, at our option, return or destroy any copies of the materials you have made.', 'language_id' => 1],
            ['key' => 'general_information_disclaimer', 'value' => 'The content on our site is provided for general information only. It is not intended to amount to advice on which you should rely. You must obtain professional or specialist advice before taking, or refraining from, any action on the basis of the content on our site.', 'language_id' => 1],
            ['key' => 'content_accuracy_disclaimer', 'value' => 'Although we make reasonable efforts to update the information on our site, we make no representations, warranties or guarantees, whether express or implied, that the content on our site is accurate, complete or up to date.', 'language_id' => 1],
            ['key' => 'third_party_links_info_only', 'value' => 'Where our site contains links to other sites and resources provided by third parties, these links are provided for your information only. Such links should not be interpreted as approval by us of those linked websites or information you may obtain from them.', 'language_id' => 1],
            ['key' => 'no_control_over_third_party_content', 'value' => 'We have no control over the contents of those sites or resources.', 'language_id' => 1],
            ['key' => 'consumer_business_liability_disclaimer', 'value' => 'Whether you are a consumer or a business user:', 'language_id' => 1],
            ['key' => 'liability_limit_exception', 'value' => 'We do not exclude or limit in any way our liability to you where it would be unlawful to do so. This includes liability for death or personal injury caused by our negligence or the negligence of our employees, agents or subcontractors and for fraud or fraudulent misrepresentation.', 'language_id' => 1],
            ['key' => 'product_liability_differences', 'value' => 'Different limitations and exclusions of liability will apply to liability arising as a result of the supply of any products to you, which will be set out in our Terms and conditions of supply.', 'language_id' => 1],
            ['key' => 'business_user_liability_exclusion', 'value' => 'If you are a business user:', 'language_id' => 1],
            ['key' => 'implied_conditions_disclaimer', 'value' => 'We exclude all implied conditions, warranties, representations or other terms that may apply to our site or any content on it.', 'language_id' => 1],
            ['key' => 'non_liability_for_loss_damage', 'value' => 'We will not be liable to you for any loss or damage, whether in contract, tort (including negligence), breach of statutory duty, or otherwise, even if foreseeable, arising under or in connection with:', 'language_id' => 1],
            ['key' => 'inability_to_use_site', 'value' => 'use of, or inability to use, our site; or', 'language_id' => 1],
            ['key' => 'reliance_on_content_disclaimer', 'value' => 'use of or reliance on any content displayed on our site.', 'language_id' => 1],
            ['key' => 'specific_non_liability', 'value' => 'In particular, we will not be liable for:', 'language_id' => 1],
            ['key' => 'no_liability_for_loss_of_profits', 'value' => 'loss of profits, sales, business, or revenue;', 'language_id' => 1],
            ['key' => 'no_liability_for_business_interruption', 'value' => 'business interruption;', 'language_id' => 1],
            ['key' => 'no_liability_for_anticipated_savings_loss', 'value' => 'loss of anticipated savings;', 'language_id' => 1],
            ['key' => 'no_liability_for_business_opportunity_loss', 'value' => 'loss of business opportunity, goodwill or reputation; or', 'language_id' => 1],
            ['key' => 'no_liability_for_indirect_consequential_damage', 'value' => 'any indirect or consequential loss or damage.', 'language_id' => 1],
            ['key' => 'consumer_user_disclaimer', 'value' => 'If you are a consumer user:', 'language_id' => 1],
            ['key' => 'personal_use_only_disclaimer', 'value' => 'Please note that we only provide our site for domestic and private use. You agree not to use our site for any commercial or business purposes, and we have no liability to you for any loss of profit, loss of business, business interruption, or loss of business opportunity.', 'language_id' => 1],
            ['key' => 'defective_content_liability', 'value' => 'If defective digital content that we have supplied, damages a device or digital content belonging to you and this is caused by our failure to use reasonable care and skill, we will either repair the damage or pay you compensation. However, we will not be liable for damage that you could have avoided by following our advice to apply an update offered to you free of charge or for damage that was caused by you failing to correctly follow installation instructions or to have in place the minimum system requirements advised by us.', 'language_id' => 1],
            ['key' => 'personal_info_use', 'value' => 'How We May Use Your Personal Information', 'language_id' => 1],
            ['key' => 'personal_info_usage_terms', 'value' => 'We will only use your personal information as set out in our', 'language_id' => 1],
            ['key' => 'no_site_security_guarantee', 'value' => 'We do not guarantee that our site will be secure or free from bugs or viruses.', 'language_id' => 1],
            ['key' => 'user_responsibility_for_security', 'value' => 'You are responsible for configuring your information technology, computer programmes and platform to access our site. You should use your own virus protection software.', 'language_id' => 1],
            ['key' => 'no_misuse_of_site', 'value' => 'You must not misuse our site by knowingly introducing viruses, trojans, worms, logic bombs or other material that is malicious or technologically harmful. You must not attempt to gain unauthorised access to our site, the server on which our site is stored, or any server, computer or database connected to our site. You must not attack our site via a denial-of-service attack or a distributed denial-of service attack. By breaching this provision, you would commit a criminal offence under the Computer Misuse Act 1990. We will report any such breach to the relevant law enforcement authorities and we will co-operate with those authorities by disclosing your identity to them. In the event of such a breach, your right to use our site will cease immediately.', 'language_id' => 1],
            ['key' => 'home_page_link_permission', 'value' => 'You may link to our home page, provided you do so in a way that is fair and legal and does not damage our reputation or take advantage of it.', 'language_id' => 1],
            ['key' => 'no_unauthorized_association', 'value' => 'You must not establish a link in such a way as to suggest any form of association, approval or endorsement on our part where none exists.', 'language_id' => 1],
            ['key' => 'no_linking_from_non_owned_sites', 'value' => 'You must not establish a link to our site in any website that is not owned by you.', 'language_id' => 1],
            ['key' => 'no_site_framing', 'value' => 'Our site must not be framed on any other site, nor may you create a link to any part of our site other than the home page.', 'language_id' => 1],
            ['key' => 'right_to_withdraw_linking_permission', 'value' => 'We reserve the right to withdraw linking permission without notice.', 'language_id' => 1],
            ['key' => 'contact_for_content_use', 'value' => 'If you wish to link to or make any use of content on our site other than that set out above, please contact ', 'language_id' => 1],
            ['key' => 'jurisdiction_and_governing_law', 'value' => 'These terms of use, their subject matter and their formation (and any non-contractual disputes or claims) are governed by English law. We both agree to the exclusive jurisdiction of the courts of England and Wales.', 'language_id' => 1],
            ['key' => 'divorce_considerations', 'value' => 'The end of a relationship can signal that it’s time to consider filing for divorce. You may have been fighting with your spouse for the last couple of weeks, months or even years. Every person on this planet has a limit as to what they can take and put up with in a relationship. When you reach this point, you will want to know how to file for divorce. The love may be gone between the two of you. There may be abuse by one spouse to the other. The welfare of the children, if there are any, may be at stake also. Filing for divorce may be your only option.', 'language_id' => 1],
            ['key' => 'divorce_trend_reasons', 'value' => 'These days you will see that divorce cases are increasing day by day due to change in trends and ego clashes. People are also getting divorced because they cannot provide financial stability to each other. With recession and other economical drawbacks, divorce instances have become a daily routine.', 'language_id' => 1],
            ['key' => 'divorce_legal_considerations', 'value' => 'Many legal questions about divorce may be clouding your head, and here we will help you fine tune the different areas of divorce law so that you can make some sound judgements as to what the next steps are in your marriage from a legal and financial perspective.', 'language_id' => 1],
            ['key' => 'divorce_general_advice_disclaimer', 'value' => 'Each divorce situation is different and this article offers some general suggestions but cannot tell you what you should do you in your specific situation and is not to be taken as legal advice or advice from a professional, counselor, or physician.', 'language_id' => 1],
            ['key' => 'legalpdf_usage_for_divorce', 'value' => 'For such divorce cases, people need to convert gmail to pdf. It is necessary for legal purposes. LegalPDF is the best option for you to convert messages and emails into a formal document. It will also save attachments inside the PDF document. These connection doesn’t need verification while opening, so it can easily be shared to anybody with no issues.', 'language_id' => 1],
            ['key' => 'legalpdf_gmail_conversion', 'value' => 'LegalPDF permits users of Gmail to save significant documents into PDF format for future reference. In case you are a Gmail user you don’t have to get to and download external software or application, you can simply convert Gmail to PDF through LegalPDF and save it.', 'language_id' => 1],
            ['key' => 'pdf_format_advantages', 'value' => 'Almost every association likes to present any file in PDF format. This is because the PDF document is the stage-free file format. What’s more, it can store different information things, like messages, contacts, attachments, schedules, pictures, structures, illustrations, and so on. This is what makes it the most helpful document format for sharing or submitting information.', 'language_id' => 1],
            ['key' => 'generate_new', 'value' => 'Generate New', 'language_id' => 1],
            ['key' => 'generate_new', 'value' => 'צור חדש', 'language_id' => 2],
            ['key' => 'pdf_goto_list', 'value' => 'Page', 'language_id' => 1],
            ['key' => 'pdf_goto_list', 'value' => 'לדף רשימה' ,  'language_id' => 2],

            ['key' => 'email_organization', 'value' => 'הודעות דואר אלקטרוני למסמך מסודר', 'language_id' => 2],
            ['key' => 'home', 'value' => 'בית', 'language_id' => 2],
            ['key' => 'features', 'value' => 'מאפיינים', 'language_id' => 2],
            ['key' => 'privacy_and_policy', 'value' => 'מדיניות הפרטיות', 'language_id' => 2],
            ['key' => 'terms_service', 'value' => 'תנאי השירות', 'language_id' => 2],
            ['key' => 'articles', 'value' => 'מאמרים', 'language_id' => 2],
            ['key' => 'contact', 'value' => 'איש קשר', 'language_id' => 2],
            ['key' => 'video', 'value' => 'וִידֵאוֹ', 'language_id' => 2],
            ['key' => 'app_description', 'value' => 'אפליקציה מדהימה לחיפוש וחילוץ שיחות מהמייל בכמה קליקים, ויוצרת מסמך מקצועי עם מילות מפתח נבחרות מודגשות.', 'language_id' => 2],
            ['key' => 'best_for_lawyers', 'value' => 'הכי טוב לעורכי דין!', 'language_id' => 2],
            ['key' => 'google_approval', 'value' => 'אושר על ידי צוות האבטחה של Google', 'language_id' => 2],
            ['key' => 'gdpr_compliance', 'value' => 'תואם באופן מלא ל-GDPR', 'language_id' => 2],
            ['key' => 'email_to_pdf', 'value' =>  'דואר אלקטרוני למחולל pdf', 'language_id' => 2],
            ['key' => 'address_prompt', 'value' =>  'הזן את הכתובות של שני הצדדים להתכתבות','language_id' => 2],
            ['key' => 'and', 'value' => 'ו', 'language_id' => 2],
            ['key' => 'user_google_email', 'value' => 'האימייל שלך (כל חבילת Google)', 'language_id' => 2],
            ['key' => 'user_microsoft_email', 'value' => 'האאוטלוק שלך (כל חבילת Microsoft)', 'language_id' => 2],
            ['key' => 'colleague_email', 'value' =>  'האימייל של הקולגה שלך (כל אימייל)', 'language_id' => 2],
            ['key' => 'google_support', 'value' =>  "אנחנו תומכים בכל סוגי תיבות הדוא'ל שעובדות עם גוגל, לרבות ג'מייל, ושאר סיומות דומיינים פרטיים תחת חבילת גוגל סוויט.", 'language_id' => 2],
            ['key' => 'microsoft_support', 'value' =>  'אנחנו תומכים בכל סוגי תיבות הדואל שעובדות עם מייקרוסופט, לרבות אווטלוק והוטמייל, ושאר סיומות דומיינים פרטיים תחת חבילת מייקרוסופט.', 'language_id' => 2],
            ['key' => 'search_keywords', 'value' => 'חיפוש מילות מפתח', 'language_id' => 2],
            ['key' => 'keyword_instruction', 'value' => 'פרד מילות מפתח באמצעות פסיקים', 'language_id' => 2],
            ['key' => 'keyword_example', 'value' => 'מילת מפתח ראשונה, מילת מפתח שנייה וכן הלאה.','language_id' => 2],
            ['key' => 'exclude_keywords', 'value' => 'מילות מפתח להחריג?','language_id' => 2],
            ['key' => 'search_timeframe', 'value' => 'חפש בתוך מסגרת זמן מסוימת','language_id' => 2],
            ['key' => 'starts', 'value' => 'מתחיל', 'language_id' => 2],
            ['key' => 'ends', 'value' => 'מסתיים', 'language_id' => 2],
            ['key' => 'document_language', 'value' => 'שפת המסמך','language_id' => 2],
            ['key' => 'english', 'value' => 'אנגלית', 'language_id' => 2],
            ['key' => 'hebrew', 'value' => 'עִברִית', 'language_id' => 2],
            ['key' => 'generate_pdf', 'value' => 'לִיצוֹר', 'language_id' => 2],
            ['key' => 'feature_list', 'value' => 'מאפיינים', 'language_id' => 2],
            ['key' => 'support_languages', 'value' => 'תומך בכל השפות','language_id' => 2],
            ['key' => 'support_google_suite', 'value' => 'תומך בכל תיבות הדואר של Google Suite', 'language_id' => 2],
            ['key' => 'quick_generation', 'value' => 'מוכן תוך שניות','language_id' => 2],
            ['key' => 'keyword_highlighting', 'value' => 'מדגיש מילות מפתח','language_id' => 2],
            ['key' => 'export_options', 'value' => 'ייצוא/ שמור/ הדפס/ שתף','language_id' => 2],
            ['key' => 'more', 'value' => 'יותר', 'language_id' => 2],
            ['key' => 'privacy_section', 'value' => 'פְּרָטִיוּת', 'language_id' => 2],
            ['key' => 'google_security_approval', 'value' => 'אושר על ידי צוות האבטחה של Google!','language_id' => 2],
            ['key' => 'gdpr_statement', 'value' => 'תואם לחלוטין ל-GDPR!','language_id' => 2],
            ['key' => 'no_document_storage', 'value' => 'איננו שומרים מידע אודותיך','language_id' => 2],
            ['key' => 'no_user_info_storage', 'value' => 'איננו שומרים מידע אודותיך','language_id' => 2],
            ['key' => 'content_privacy', 'value' => 'אנחנו לא יכולים לקרוא שום תוכן מהאימייל שלך','language_id' => 2],
            ['key' => 'user_document_view', 'value' => 'רק אתה יכול לראות את המסמך', 'language_id' => 2],
            ['key' => 'testimonial_1_name', 'value' => 'טום בראון, בריטניה', 'language_id' => 2],
            ['key' => 'testimonial_1_text', 'value' => 'LegalPDF הוא מוצר פנטסטי, כל כך פשוט ומהיר לשימוש ועזר לי לנצח במקרה שלי','language_id' => 2],
            ['key' => 'testimonial_2_name', 'value' => 'ג\'ק אוונס, ארה\"ב','language_id' => 2],
            ['key' => 'testimonial_2_text', 'value' => 'פשוט חסכתי שעות של עבודה ידנית אינסופית בכמה לחיצות פשוטות! אני ממליץ בחום על מוצר זה לכל מי שמחפש להמיר שיחה סתמית למסמך רשמי','language_id' => 2],
            ['key' => 'testimonial_3_name', 'value' => 'לורה וויליאמס, בריטניה','language_id' => 2],
            ['key' => 'testimonial_3_text', 'value' =>'אני כל כך שמח שהכלי הזה קיים! עבד כל כך מהר ויפה, עשה בדיוק מה שפורסם - תודה לך LegalPDF!', 'language_id' => 2],
            ['key' => 'latest_articles', 'value' => 'כתבות אחרונות', 'language_id' => 2],
            ['key' => 'converter_gmail_to_pdf', 'value' => 'ממיר Gmail ל-Pdf מקוון', 'language_id' => 2],
            ['key' => 'export_emails_to_pdf', 'value' => 'ייצוא אימיילים מג\'ימייל ל-PDF','language_id' => 2],
            ['key' => 'save_multiple_emails', 'value' => 'שמור הודעות דוא"ל מרובות כ-Pdf Gmail','language_id' => 2],
            ['key' => 'save_single_email', 'value' => 'שמור אימייל מ-Gmail כ-Pdf', 'language_id' => 2],
            ['key' => 'save_gmail_email', 'value' => 'שמור את Gmail כ-PDF', 'language_id' => 2],
            ['key' => 'london', 'value' => 'לונדון', 'language_id' => 2],
            ['key' => 'jerusalem', 'value' => 'ירושלים', 'language_id' => 2],
            ['key' => 'address_london', 'value' => '18 Elington Road, E8 3PA', 'language_id' => 2],
            ['key' => 'address_jerusalem', 'value' => 'רח\' יהושע בן נון 24', 'language_id' => 2],
            ['key' => 'copyright_notice', 'value' => 'זכויות יוצרים 2020 ©','language_id' => 2],
            ['key' => 'company_name', 'value' => 'LegalPDF כל הזכויות שמורות', 'language_id' => 2],
            ['key' => 'privacy_policy', 'value' => 'ומדיניות הפרטית', 'language_id' => 2],
            ['key' => 'terms_of_service', 'value' => 'תנאי השירות','language_id' => 2],
            ['key' => 'google_api_services', 'value' => 'שירותי Google API', 'language_id' => 2],
            ['key' => 'google_api_services_notice', 'value' => 'על מנת להשתמש באתר שלנו, עליך להשתמש באימות ובהסכמה של','language_id' => 2],
            ['key' => 'read_more', 'value' => 'קרא עוד...', 'language_id' => 2],
            ['key' => 'doc_generation_notice', 'value'  => 'שליפת הודעות דוא"ל... תהליך זה עשוי לקחת זמן מה, אנא התאזרו בסבלנות.','language_id' => 2],
            ['key' => 'message_extraction_notice', 'value' => 'חלץ את מספר ההודעה', 'language_id' => 2],
            ['key' => 'done', 'value' => 'בוצע!', 'language_id' => 2],
            ['key' => 'doc_ready', 'value' => 'המסמך מוכן', 'language_id' => 2],
            ['key' => 'download_continue', 'value' => 'הורד והמשך', 'language_id' => 2],
            ['key' => 'download_logout', 'value' => 'הורד והתנתק', 'language_id' => 2],
            ['key' => 'incorrect_email_warning', 'value' => 'מידע שגוי עבור example@gmail.com', 'language_id' => 2],
            ['key' => 'retry_prompt', 'value' => 'בבקשה נסה שוב', 'language_id' => 2],
            ['key' => 'logout', 'value' => 'להתנתק', 'language_id' => 2],
            ['key' => 'fast_free', 'value' => 'מהיר ובחינם', 'language_id' => 2],
            ['key' => 'fast_free_description', 'value' => 'הכלי חינמי לחלוטין ואין הגבלת שימוש. יתרה מכך, יש מינימום מאוד קלט הנדרש על ידי המשתמש - רק מידע וכלי שולח ומקבל מבצעים את המשימות הכבדות. מוצר זה מייצר מסמך מעוצב היטב ומוכן לשימוש תוך דקות.', 'language_id' => 2],
            ['key' => 'trustworthy', 'value' => 'אָמִין', 'language_id' => 2],
            ['key' => 'trustworthy_description', 'value' => 'LegalPDF אמין ומאובטח. הצוות שלנו עבד בשיתוף פעולה הדוק עם צוות האבטחה של גוגל ואושרנו על ידם. אנחנו גם תואמים לחלוטין ל-GDPR - כך שמשתמשים כמוך יכולים להשתמש בכלי הפנטסטי הזה בראש שקט.','language_id' => 2],
            ['key' => 'multilingual_any_mailbox', 'value' => 'רב לשוני וכל תיבת דואר', 'language_id' => 2],
            ['key' => 'multilingual_any_mailbox_description', 'value' => 'כלי זה מסוגל לחלץ מידע ממיילים וצ \' אטים בכל שפה לרבות שפות שאינן משתמשות באלפבית האנגלי המודרני כמו ערבית, מנדרינית, עברית ועוד רבות אחרות. LegalPDF מסוגל גם לחלץ מידע מכל תיבת דואר, לא רק מתיקיית תיבת הדואר הנכנס.','language_id' => 2],
            ['key' => 'privacy_focus', 'value' => 'פְּרָטִיוּת', 'language_id' => 2],
            ['key' => 'privacy_description', 'value' => 'פרטיות הצרכן היא אחד מהעדיפויות העליונות שלנו ב-LegalPDF. אנו לא דורשים או מאחסנים מידע לקוח בעת השימוש בכלי - אין צורך ברישום, אנונימי לחלוטין. יתרה מכך, כדי להגן על הלקוחות שלנו אנו מוחקים את כל המסמכים שנוצרו ברגע שהלקוח קיבל את הקובץ.', 'language_id' => 2],
            ['key' => 'page_not_found', 'value' => 'דף לא נמצא (404)','language_id' => 2],
            ['key' => 'terms_intro', 'value' => 'אנא קרא את התנאים וההגבלות הללו בעיון לפני השימוש באתר זה','language_id' => 2],
            ['key' => 'terms_summary', 'value' => 'תנאים אלה אומרים לך את הכללים לשימוש באתר שלנו באתר שלנו.','language_id' => 2],
            ['key' => 'our_site', 'value' => 'האתר שלנו','language_id' => 2],
            ['key' => 'info_links', 'value' => 'לחץ על הקישורים למטה כדי לעבור ישר למידע נוסף על כל אזור:','language_id' => 2],
            ['key' => 'contact_us', 'value' => 'מי אנחנו ואיך ליצור איתנו קשר', 'language_id' => 2],
            ['key' => 'site_usage_confirmation', 'value' => 'בשימוש באתר שלנו אתה מסכים לתנאים אלה','language_id' => 2],
            ['key' => 'applicable_terms', 'value' => 'ישנם תנאים נוספים שעשויים לחול עליך','language_id' => 2],
            ['key' => 'terms_changes', 'value'  => 'אנו עשויים לבצע שינויים בתנאים אלה','language_id' => 2],
            ['key' => 'site_changes', 'value' => 'אנו עשויים לבצע שינויים באתר האינטרנט שלנו','language_id' => 2],
            ['key' => 'site_suspension', 'value'  => 'אנו עשויים להשעות או לבטל את האתר שלנו','language_id' => 2],
            ['key' => 'uk_only', 'value' => 'האתר שלנו מיועד רק למשתמשים בבריטניה','language_id' => 2],
            ['key' => 'account_safety', 'value' => 'עליך לשמור את פרטי החשבון שלך בטוחים','language_id' => 2],
            ['key' => 'site_material_usage', 'value' => 'כיצד תוכל להשתמש בחומר באתר שלנו','language_id' => 2],
            ['key' => 'disclaimer', 'value' => 'אל תסתמך על מידע באתר שלנו','language_id' => 2],
            ['key' => 'third_party_links', 'value' => 'איננו אחראים לאתרים שאנו מקשרים אליהם','language_id' => 2],
            ['key' => 'user_content_policy', 'value'=> 'תוכן שנוצר על ידי משתמשים אינו מאושר על ידינו','language_id' => 2],
            ['key' => 'liability_summary', 'value' => 'איפה אנחנו אחראים לאובדן או לנזק שנגרמו לך', 'language_id' => 2],
            ['key' => 'upload_rules', 'value' => 'כללים לגבי העלאת תוכן לאתר שלנו','language_id' => 2],
            ['key' => 'user_rights_grant', 'value' => 'זכויות שאתה נותן לנו להשתמש בחומר שאתה מעלה','language_id' => 2],
            ['key' => 'virus_protection', 'value' => 'אנחנו לא אחראים על וירוסים ואסור לכם להציג אותם','language_id' => 2],
            ['key' => 'linking_rules', 'value' => 'כללים לגבי קישור לאתר שלנו','language_id' => 2],
            ['key' => 'dispute_resolution', 'value' => 'חוקי איזו מדינה חלים על כל מחלוקת','language_id' => 2],
            ['key' => 'company_operator_info', 'value'  => 'הוא אתר המופעל על ידי', 'language_id' => 2],
            ['key' => 'company_registration', 'value' => '("אָנוּ"). המשרד הרשום שלנו נמצא ב', 'language_id' => 2],
            ['key' => 'contact_email', 'value' => 'ליצירת קשר נא לשלוח מייל', 'language_id' => 2],
            ['key' => 'site_terms_acceptance', 'value'  => 'בשימוש באתר שלנו, אתה מאשר שאתה מסכים לתנאי שימוש אלה וכי אתה מסכים לציית להם.','language_id' => 2],
            ['key' => 'terms_disagreement', 'value'=> 'אם אינך מסכים לתנאים אלה, אסור לך להשתמש באתר שלנו.', 'language_id' => 2],
            ['key' => 'print_terms_recommendation', 'value' => 'אנו ממליצים להדפיס עותק של תנאים אלה לעיון עתידי.','language_id' => 2],
            ['key' => 'additional_terms', 'value' => 'תנאי שימוש אלה מתייחסים לתנאים הנוספים הבאים, החלים גם על השימוש שלך באתר שלנו:','language_id' => 2],
            ['key' => 'cookie_policy', 'value' =>  'מדיניות קובצי Cookie', 'language_id' => 2],
            ['key' => 'cookie_policy_description', 'value' =>  ', המגדיר מידע על העוגיות באתר שלנו.', 'language_id' => 2],
            ['key' => 'terms_revision', 'value' => 'אנו מתקנים תנאים אלה מעת לעת. בכל פעם שתרצה להשתמש באתר שלנו, אנא עיין בתנאים אלה כדי לוודא שאתה מבין את התנאים החלים באותו זמן.','language_id' => 2],
            ['key' => 'site_update_notice', 'value' => 'אנו עשויים לעדכן ולשנות את האתר שלנו מעת לעת כדי לשקף שינויים בשירותים שלנו, צרכי המשתמשים שלנו וסדרי העדיפויות העסקיים שלנו.','language_id' => 2],
            ['key' => 'site_availability', 'value' => 'איננו מבטיחים שהאתר שלנו, או כל תוכן בו, תמיד יהיה זמין או ללא הפרעה. אנו עשויים להשעות או לבטל או להגביל את הזמינות של כל האתר או חלק ממנו מסיבות עסקיות ותפעוליות. אנו נשתדל לתת לך הודעה סבירה על כל השעיה או נסיגה.', 'language_id' => 2],
            ['key' => 'user_access_responsibility', 'value' => 'אתה גם אחראי לוודא שכל האנשים שניגשים לאתר שלנו דרך חיבור האינטרנט שלך מודעים לתנאי השימוש הללו ולתנאים והגבלות רלוונטיים אחרים, ושהם מצייתים להם.', 'language_id' => 2],
            ['key' => 'intellectual_property_notice', 'value' =>'אנו הבעלים או בעלי הרישיון של כל זכויות הקניין הרוחני באתר שלנו, ובחומר המתפרסם בו. יצירות אלה מוגנות על ידי חוקי זכויות יוצרים ואמנות ברחבי העולם. כל הזכויות הללו שמורות.', 'language_id' => 2],
            ['key' => 'terms_info_notice', 'value' => 'למידע נוסף, עיין בכל סעיף בהתאמה.', 'language_id' => 2],
            ['key' => 'personal_use_print_download', 'value' => 'אתה רשאי להדפיס עותק אחד, ורשאי להוריד תמציות, של כל עמוד(ים) מהאתר שלנו לשימושך האישי ואתה רשאי למשוך את תשומת לבם של אחרים בארגון שלך לתוכן המתפרסם באתר שלנו.', 'language_id' => 2],
            ['key' => 'no_modification_of_materials', 'value' =>  'אין לשנות את הנייר או העותקים הדיגיטליים של חומרים כלשהם שהדפיסתם או הורדתם בכל דרך, ואין להשתמש באיורים, תמונות, רצפי וידאו או אודיו או כל גרפיקה בנפרד מכל טקסט נלווה.', 'language_id' => 2],
            ['key' => 'author_credit_required', 'value' => 'יש להכיר תמיד במעמדנו (ושל כל תורמים מזוהים) כמחברי התוכן באתר שלנו.', 'language_id' => 2],
            ['key' => 'no_commercial_use_without_license', 'value' => 'אין להשתמש באף חלק מהתוכן באתר שלנו למטרות מסחריות מבלי לקבל רישיון לעשות זאת מאיתנו או מבעלי הרישיונות שלנו.', 'language_id' => 2],
            ['key' => 'breach_consequence_action', 'value' => 'אם תדפיס, תעתיק או תוריד כל חלק מהאתר שלנו תוך הפרה של תנאי שימוש אלה, זכותך להשתמש באתר שלנו תיפסק מיד ועליך, לפי בחירתנו, להחזיר או להרוס כל עותקים של החומרים שיצרת.', 'language_id' => 2],
            ['key' => 'general_information_disclaimer', 'value' => 'התוכן באתר שלנו מסופק למידע כללי בלבד. אין הכוונה להסתכם בעצה שעליה אתה צריך להסתמך. עליך לקבל ייעוץ מקצועי או מומחה לפני נקיטת או הימנעות מכל פעולה על בסיס התוכן באתר שלנו.', 'language_id' => 2],
            ['key' => 'content_accuracy_disclaimer', 'value' => 'למרות שאנו עושים מאמצים סבירים לעדכן את המידע באתר שלנו, איננו מציגים מצגים, אחריות או ערבויות, בין אם מפורשות או משתמעות, כי התוכן באתר שלנו מדויק, מלא או עדכני.','language_id' => 2],
            ['key' => 'third_party_links_info_only', 'value' => 'כאשר האתר שלנו מכיל קישורים לאתרים ומשאבים אחרים המסופקים על ידי צדדים שלישיים, קישורים אלה מסופקים למידע שלך בלבד. אין לפרש קישורים כאלה כאישור מאתנו לאותם אתרים מקושרים או מידע שאתה עשוי לקבל מהם.', 'language_id' => 2],
            ['key' => 'no_control_over_third_party_content', 'value' => 'אין לנו שליטה על התוכן של אתרים או משאבים אלה.', 'language_id' => 2],
            ['key' => 'consumer_business_liability_disclaimer', 'value' => 'בין אם אתה צרכן או משתמש עסקי:','language_id' => 2],
            ['key' => 'liability_limit_exception', 'value' => 'אנו לא שוללים או מגבילים בשום צורה את אחריותנו כלפיך כאשר זה יהיה בלתי חוקי לעשות זאת. זה כולל אחריות למוות או פציעה אישית שנגרמה מרשלנות שלנו או רשלנות של העובדים, הסוכנים או קבלני המשנה שלנו וכן בגין הונאה או מצג שווא במרמה.', 'language_id' => 2],
            ['key' => 'product_liability_differences', 'value' => 'מגבלות שונות והחרגות אחריות יחולו על אחריות הנובעת כתוצאה מאספקת מוצרים כלשהם לך, אשר יפורסמו בתנאי האספקה ​​שלנו.', 'language_id' => 2],
            ['key' => 'business_user_liability_exclusion', 'value' => 'אם אתה משתמש עסקי:', 'language_id' => 2],
            ['key' => 'implied_conditions_disclaimer', 'value' =>  'אנו לא כוללים את כל התנאים המשתמעים, התחייבויות, מצגים או תנאים אחרים שעשויים לחול על האתר שלנו או כל תוכן בו.', 'language_id' => 2],
            ['key' => 'non_liability_for_loss_damage', 'value' => 'לא נהיה אחראים כלפיך לכל אובדן או נזק, בין אם בחוזה, בנזיקין (כולל רשלנות), הפרת חובה חקוקה או בכל דרך אחרת, גם אם צפויה, הנובעת מכוח או בקשר עם:', 'language_id' => 2],
            ['key' => 'inability_to_use_site', 'value' => 'אל תסתמך על מידע באתר זה', 'language_id' => 2],
            ['key' => 'reliance_on_content_disclaimer', 'value' => 'שימוש או הסתמכות על כל תוכן המוצג באתר שלנו.', 'language_id' => 2],
            ['key' => 'specific_non_liability', 'value' => 'בפרט, לא נהיה אחראים ל:', 'language_id' => 2],
            ['key' => 'no_liability_for_loss_of_profits', 'value' => 'אובדן רווחים, מכירות, עסקים או הכנסות;', 'language_id' => 2],
            ['key' => 'no_liability_for_business_interruption', 'value' =>  'הפרעה עסקית;', 'language_id' => 2],
            ['key' => 'no_liability_for_anticipated_savings_loss', 'value' => 'אובדן חיסכון צפוי;', 'language_id' => 2],
            ['key' => 'no_liability_for_business_opportunity_loss', 'value' => 'אובדן הזדמנות עסקית, מוניטין או מוניטין; אוֹ', 'language_id' => 2],
            ['key' => 'no_liability_for_indirect_consequential_damage', 'value' => 'כל הפסד או נזק עקיף או תוצאתי.', 'language_id' => 2],
            ['key' => 'consumer_user_disclaimer', 'value' => 'אם אתה משתמש צרכני:', 'language_id' => 2],
            ['key' => 'personal_use_only_disclaimer', 'value' => 'שימו לב שאנו מספקים את האתר שלנו רק לשימוש ביתי ופרטי. אתה מסכים לא להשתמש באתר שלנו למטרות מסחריות או עסקיות כלשהן, ואין לנו כל אחריות כלפיך לכל אובדן רווח, אובדן עסק, הפרעה עסקית או אובדן הזדמנות עסקית.', 'language_id' => 2],
            ['key' => 'defective_content_liability', 'value' => 'אם תוכן דיגיטלי פגום שסיפקנו, פוגע במכשיר או בתוכן דיגיטלי השייך לך והדבר נגרם מאי ניצול זהירות ומיומנות סבירים, אנו נתקן את הנזק או נשלם לך פיצוי. עם זאת, לא נהיה אחראים לנזק שהייתם יכולים להימנע על ידי ביצוע העצה שלנו להחיל עדכון המוצע לכם ללא תשלום או לנזק שנגרם עקב אי ביצוע נכון של הוראות ההתקנה או התקנת המערכת המינימלית. הדרישות המומלצות על ידינו.', 'language_id' => 2],
            ['key' => 'personal_info_use', 'value' =>  'כיצד אנו עשויים להשתמש במידע האישי שלך', 'language_id' => 2],
            ['key' => 'personal_info_usage_terms', 'value' => 'אנו נשתמש רק במידע האישי שלך כמפורט במדיניות הפרטיות שלנו.', 'language_id' => 2],
            ['key' => 'no_site_security_guarantee', 'value' => 'אנחנו לא מבטיחים שהאתר שלנו יהיה מאובטח או נקי מבאגים או וירוסים.','language_id' => 2],
            ['key' => 'user_responsibility_for_security', 'value' => 'אתה אחראי להגדיר את טכנולוגיית המידע, תוכניות המחשב והפלטפורמה שלך כדי לגשת לאתר שלנו. עליך להשתמש בתוכנה משלך להגנה מפני וירוסים.', 'language_id' => 2],
            ['key' => 'no_misuse_of_site', 'value' => 'אין לעשות שימוש לרעה באתר שלנו על ידי הכנסת וירוסים, סוסים טרויאניים, תולעים, פצצות לוגיות או חומר אחר שהוא זדוני או מזיק מבחינה טכנולוגית. אין לנסות לקבל גישה בלתי מורשית לאתר שלנו, לשרת בו מאוחסן האתר שלנו או לכל שרת, מחשב או מסד נתונים המחוברים לאתר שלנו. אין לתקוף את האתר שלנו באמצעות התקפת מניעת שירות או התקפת מניעת שירות מבוזרת. על ידי הפרת הוראה זו, אתה תעבור עבירה פלילית על פי חוק השימוש לרעה במחשב 1990. אנו נדווח על כל הפרה כזו לרשויות אכיפת החוק הרלוונטיות ונשתף פעולה עם הרשויות הללו על ידי חשיפת זהותך בפניהן. במקרה של הפרה כזו, זכותך להשתמש באתר שלנו תיפסק באופן מיידי.', 'language_id' => 2],
            ['key' => 'home_page_link_permission', 'value' => 'אתה רשאי לקשר לדף הבית שלנו, בתנאי שתעשה זאת בצורה הוגנת וחוקית ואינה פוגעת במוניטין שלנו או מנצלת זאת.', 'language_id' => 2],
            ['key' => 'no_unauthorized_association', 'value' => 'אסור ליצור קישור באופן שיציע כל צורה של שיוך, אישור או אישור מצידנו, כאשר לא קיים.', 'language_id' => 2],
            ['key' => 'no_linking_from_non_owned_sites', 'value' =>  'אין ליצור קישור לאתר שלנו בכל אתר אינטרנט שאינו בבעלותך.','language_id' => 2],
            ['key' => 'no_site_framing', 'value' => 'אסור למסגר את האתר שלנו באף אתר אחר, כמו כן אין ליצור קישור לחלק כלשהו באתר שלנו מלבד דף הבית.', 'language_id' => 2],
            ['key' => 'right_to_withdraw_linking_permission', 'value' =>  'אנו שומרים לעצמנו את הזכות לבטל את הרשאת הקישור ללא הודעה מוקדמת.','language_id' => 2],
            ['key' => 'contact_for_content_use', 'value' =>'אם ברצונך לקשר או לעשות שימוש כלשהו בתוכן באתר שלנו מלבד זה שצוין לעיל, אנא צור קשר עם info@legalpdf.co.','language_id' => 2],
            ['key' => 'jurisdiction_and_governing_law', 'value' => 'תנאי שימוש אלה, הנושא שלהם והיווצרותם (וכל מחלוקת או תביעה שאינה חוזית) כפופים לחוק האנגלי. שנינו מסכימים לסמכות השיפוט הבלעדית של בתי המשפט של אנגליה ווילס.', 'language_id' => 2],
            ['key' => 'divorce_considerations', 'value' => 'סיום מערכת יחסים יכול לאותת שהגיע הזמן לשקול הגשת תביעת גירושין. ייתכן שרבת עם בן הזוג שלך בשבועיים, חודשים או אפילו שנים האחרונים. לכל אדם על הפלנטה הזו יש גבול לגבי מה הוא יכול לסבול ולסבול במערכת יחסים. כשתגיעו לנקודה זו, תרצו לדעת כיצד להגיש תביעת גירושין. ייתכן שהאהבה נעלמה בין שניכם. ייתכן שיש התעללות מבן זוג אחד לשני. גם טובת הילדים, אם בכלל, עלולה להיות בסיכון. הגשת תביעת גירושין עשויה להיות האפשרות היחידה שלך.', 'language_id' => 2],
            ['key' => 'divorce_trend_reasons', 'value' => 'בימים אלו תראו שמקרי הגירושין הולכים ומתרבים מיום ליום עקב שינוי בטרנדים והתנגשויות אגו. אנשים גם מתגרשים כי הם לא יכולים לספק יציבות כלכלית זה לזה. עם מיתון וחסרונות כלכליים אחרים, מקרי גירושין הפכו לשגרה יומיומית.', 'language_id' => 2],
            ['key' => 'divorce_legal_considerations', 'value' => 'שאלות משפטיות רבות בנושא גירושין עשויות להעיב על ראשך, וכאן אנו נעזור לך לכוונן את התחומים השונים של דיני הגירושין, כך שתוכל לבצע כמה שיפוט נכון לגבי הצעדים הבאים בנישואיך מבחינה משפטית וכלכלית.', 'language_id' => 2],
            ['key' => 'divorce_general_advice_disclaimer', 'value' => 'כל מצב של גירושין שונה ומאמר זה מציע כמה הצעות כלליות אך אינו יכול לומר לך מה עליך לעשות במצבך הספציפי ואין לראות בו כייעוץ משפטי או ייעוץ מאיש מקצוע, יועץ או רופא.', 'language_id' => 2],
            ['key' => 'legalpdf_usage_for_divorce', 'value' => 'עבור מקרי גירושין כאלה, אנשים צריכים להמיר את gmail ל-pdf. זה הכרחי למטרות משפטיות. LegalPDF הוא האפשרות הטובה ביותר עבורך להמיר הודעות ומיילים למסמך רשמי. זה גם ישמור קבצים מצורפים בתוך מסמך ה-PDF. חיבור אלה אינם זקוקים לאימות בזמן הפתיחה, כך שניתן לשתף אותם בקלות עם כל אחד ללא בעיות.', 'language_id' => 2],
            ['key' => 'legalpdf_gmail_conversion', 'value' => 'LegalPDF מאפשר למשתמשי Gmail לשמור מסמכים משמעותיים בפורמט PDF לעיון עתידי. במקרה שאתה משתמש Gmail אתה לא צריך להגיע ולהוריד תוכנה או אפליקציה חיצונית, אתה יכול פשוט להמיר את Gmail ל-PDF דרך LegalPDF ולשמור אותו.','language_id' => 2],
            ['key' => 'pdf_format_advantages', 'value' => 'כמעט כל ארגון אוהב להציג קבצים בפורמט PDF. הסיבה לכך היא שמסמך PDF הוא פורמט קובץ חסר תלות בפלטפורמה. בנוסף, הוא יכול לאחסן פריטי מידע שונים, כגון הודעות, אנשי קשר, קבצים מצורפים, לוחות זמנים, תמונות, טפסים, איורים ועוד. זו הסיבה שהופך אותו לפורמט המסמך הכי שימושי לשיתוף או להגשת מידע.', 'language_id' => 2],

            // Added for PDF file 
            ['key' => 'fast_and_secure', 'value' => 'FAST & SECURED', 'language_id' => 1],
            ['key' => 'fast_and_secure', 'value' => 'מאובטח ומהיר', 'language_id' => 2],

            ['key' => 'order_details', 'value' => 'Order details', 'language_id' => 1],
            ['key' => 'order_details', 'value' => 'פרטי ההזמנה', 'language_id' => 2],

            ['key' => 'ordered_by', 'value' => 'Ordered by', 'language_id' => 1],
            ['key' => 'ordered_by', 'value' => 'הוזמן על ידי:', 'language_id' => 2],

            ['key' => 'pdf_date', 'value' => 'Date', 'language_id' => 1],
            ['key' => 'pdf_date', 'value' => 'תאריך:', 'language_id' => 2],

            ['key' => 'pdf_at', 'value' => 'at', 'language_id' => 1],
            ['key' => 'pdf_at', 'value' => 'ב-', 'language_id' => 2],


            ['key' => 'pdf_msg_short', 'value' => 'The following conversations are in order from newest to oldest', 'language_id' => 1],
            ['key' => 'pdf_msg_short', 'value' => 'ההתכתבויות הבאות מסודרות מהחדש ביותר בראש המסמך ועד הישן ביותר בתחתית המסמך', 'language_id' => 2],

            ['key' => 'pdf_doc_between', 'value' => 'The following document contains conversations between:', 'language_id' => 1],
            ['key' => 'pdf_doc_between', 'value' => 'המסמך הבא מכיל התכתבויות שבין הצדדים הבאים:', 'language_id' => 2],


            ['key' => 'pdf_no_conversation', 'value' => 'Number of conversations', 'language_id' => 1],
            ['key' => 'pdf_no_conversation', 'value' => 'מספר מיילים:', 'language_id' => 2],


            ['key' => 'pdf_platform', 'value' => 'Platform', 'language_id' => 1],
            ['key' => 'pdf_platform', 'value' => 'פלטפורמה:', 'language_id' => 2],


            ['key' => 'pdf_list_all_attachments', 'value' => 'Number of attachments', 'language_id' => 1],
            ['key' => 'pdf_list_between_two_parties', 'value' => 'List of all attachments sent between the two parties', 'language_id' => 1],
            
            ['key' => 'pdf_list_all_attachments', 'value' => 'מספר קבצים מצורפים' , 'language_id' => 2],
            ['key' => 'pdf_list_between_two_parties', 'value' => 'רשימה של כל הקבצים המצורפים שנשלחו בין שני הצדדים', 'language_id' => 2],


            ['key' => 'pdf_short', 'value' => 'This is an official document produced by LegalPDF. The Document authentically reflects email correspondence between the two parties mentioned below.', 'language_id' => 1],
            ['key' => 'pdf_short', 'value' => 'זהו מסמך רשמי מוכן לעיון ושימוש בבית המשפט. \n המסמך מכיל את כל המידע שהוזמן על ידי הלקוח הרשום מטה.', 'language_id' => 2],

            ['key' => 'date_time', 'value' => 'Date & Time', 'language_id' => 1],
            ['key' => 'date_time', 'value' => 'תאריך ושעה', 'language_id' => 2],

            ['key' => 'downloads_page', 'value' => 'Download Page', 'language_id' => 1],
            ['key' => 'downloads_page', 'value' => 'עמוד הורדות', 'language_id' => 2],

            ['key' => 'target_mail', 'value' => 'Target Mail', 'language_id' => 1],
            ['key' => 'target_mail', 'value' => 'דואר יעד', 'language_id' => 2],

            ['key' => 'keywords', 'value' => 'Keywords', 'language_id' => 1],
            ['key' => 'keywords', 'value' => 'מילות מפתח', 'language_id' => 2],

            ['key' => 'download_pdf', 'value' => 'Download PDF', 'language_id' => 1],
            ['key' => 'download_pdf', 'value' => 'הורד PDF', 'language_id' => 2],

            ['key' => 'estimate_time_to_finish', 'value' => 'Estimate Time To Finish', 'language_id' => 1],
            ['key' => 'estimate_time_to_finish', 'value' => 'הערכת זמן לסיום', 'language_id' => 2],

            ['key' => 'notify_me_when_document_is_ready', 'value' => 'Notify me when document is ready', 'language_id' => 1],
            ['key' => 'notify_me_when_document_is_ready', 'value' => 'הודע לי כשהמסמך מוכן', 'language_id' => 2],

            ['key' => 'calculating_estimated_time', 'value' => 'Calculating Estimated Time', 'language_id' => 1],
            ['key' => 'calculating_estimated_time', 'value' => 'חישוב זמן משוער','language_id' => 2],

            ['key' => 'your_requested_document_is_ready_to_download', 'value' => 'Your requested document is ready to download.', 'language_id' => 1],
            ['key' => 'your_requested_document_is_ready_to_download', 'value' => 'המסמך המבוקש מוכן להורדה.', 'language_id' => 2],

            ['key' => 'click_here_to_access_it', 'value' => 'Click here to access it.', 'language_id' => 1],
            ['key' => 'click_here_to_access_it', 'value' => 'לחץ כאן כדי לגשת אליו.', 'language_id' => 2],

            ['key' => 'thank_you', 'value' => 'Thank you!', 'language_id' => 1],
            ['key' => 'thank_you', 'value' => 'תודה לך!', 'language_id' => 2],

            ['key' => 'platform', 'value' => 'Platform', 'language_id' => 1],
            ['key' => 'platform', 'value' => 'פּלַטפוֹרמָה', 'language_id' => 2],

            ['key' => 'failed', 'value' => 'Failed', 'language_id' => 1],
            ['key' => 'failed', 'value' => 'נִכשָׁל', 'language_id' => 2],

            ['key' => 'estimate_time_to_finish', 'value' => 'Estimated Time to Finish', 'language_id' => 1],
            ['key' => 'estimate_time_to_finish', 'value' => 'זמן משוער לסיום', 'language_id' => 2],

            ['key' => 'patient_working_text', 'value' => 'Please be patient with us, we are still working on it.', 'language_id' => 1],
            ['key' => 'patient_working_text', 'value' => 'אנא התאזרו איתנו בסבלנו, אנחנו עדיין עובדים על זה. ', 'language_id' => 2],

            ['key' => 'seconds_remaining_text', 'value' => 'seconds remaining', 'language_id' => 1],
            ['key' => 'seconds_remaining_text', 'value' => 'שניות שנותרו', 'language_id' => 2],

            ['key' => 'process_taking_longer_expected', 'value' => 'The process is taking a bit longer than expected. Please bear with us for just a few more seconds as we finalize everything.', 'language_id' => 1],
            ['key' => 'process_taking_longer_expected', 'value' => 'התהליך לוקח קצת יותר זמן מהצפוי. אנא סבלו איתנו רק עוד כמה שניות כשאנחנו מסיימים הכל.', 'language_id' => 2],

            ['key' => 'unfortunately_we_couldnt_generate_the_document_that_you_requested', 'value' => 'Unfortunately, we couldn\'t generate the document that you requested.', 'language_id' => 1],
            ['key' => 'unfortunately_we_couldnt_generate_the_document_that_you_requested', 'value' => 'לצערנו, לא הצלחנו ליצור את המסמך שביקשת.', 'language_id' => 2],

            ['key' => 'submit_a_report_and_request_a_refund', 'value' => 'Submit a report and request a refund', 'language_id' => 1],
            ['key' => 'submit_a_report_and_request_a_refund', 'value' => 'שלח דוח ובקש החזר', 'language_id' => 2],

            ['key' => 'try_to_generate_the_document_again_free_of_charge', 'value' => 'Try to generate the document again (free of charge)', 'language_id' => 1],
            ['key' => 'try_to_generate_the_document_again_free_of_charge', 'value' => 'נסה ליצור את המסמך שוב (ללא תשלום)', 'language_id' => 2],

            ['key' => 'generating', 'value' => 'Generating', 'language_id' => 1],
            ['key' => 'generating', 'value' => 'יוצר', 'language_id' => 2],

            ['key' => 'done', 'value' => 'Done!', 'language_id' => 1],
            ['key' => 'done', 'value' => 'בוצע!', 'language_id' => 2],

            ['key' => 'unknown_platform', 'value' => 'Unknown Platform', 'language_id' => 1],
            ['key' => 'unknown_platform', 'value' => 'פלטפורמה לא ידועה', 'language_id' => 2],

            ['key' => 'refund', 'value' => 'Refund', 'language_id' => 1],
            ['key' => 'refund', 'value' => 'הֶחזֵר', 'language_id' => 2],

            ['key' => 'no_record', 'value' => 'You don\'t have any orders.', 'language_id' => 1],
            ['key' => 'no_record', 'value' => 'אין לך פקודות.', 'language_id' => 2],

            ['key' => 'logged_as', 'value' => 'logged as', 'language_id' => 1],
            ['key' => 'logged_as', 'value' => 'מחובר בתור', 'language_id' => 2],

            ['key' => 'pdf_attachment_label', 'value' => 'Attachments within this message', 'language_id' => 1],
            ['key' => 'pdf_attachment_label', 'value' => 'מחובר בתור', 'language_id' => 2],

            ['key' => 'pdf_attachment_label_none', 'value' => 'none', 'language_id' => 1],
            ['key' => 'pdf_attachment_label_none', 'value' => 'מחובר בתו', 'language_id' => 2],


            ['key' => 'we_found', 'value' => 'We Found', 'language_id' => 1],
            ['key' => 'we_found', 'value' => 'מצאנו', 'language_id' => 2],

            ['key' => 'correspondences', 'value' => 'Correspondences', 'language_id' => 1],
            ['key' => 'correspondences', 'value' => 'התכתבויות', 'language_id' => 2],

            ['key' => 'coupon_number', 'value' => 'Coupon Number', 'language_id' => 1],
            ['key' => 'coupon_number', 'value' => 'מספר קופון', 'language_id' => 2],

            ['key' => 'valid_coupon', 'value' => 'Valid Coupon', 'language_id' => 1],
            ['key' => 'valid_coupon', 'value' => 'קופון תקף', 'language_id' => 2],

            ['key' => 'invalid_coupon', 'value' => 'Invalid Coupon', 'language_id' => 1],
            ['key' => 'invalid_coupon', 'value' => 'קופון לא חוקי', 'language_id' => 2],

            ['key' => 'please_wait_download_link', 'value' => 'Please wait while we send the download link to your mail', 'language_id' => 1],
            ['key' => 'please_wait_download_link', 'value' => 'אנא המתן בזמן שאנו שולחים את קישור ההורדה לדואר שלך', 'language_id' => 2],

            ['key' => 'payment_policy', 'value' => 'Payment Policy', 'language_id' => 1],
            ['key' => 'payment_policy', 'value' => 'מדיניות תשלום', 'language_id' => 2],

            ['key' => 'terms_of_service_payments_agreement', 'value' => 'Terms of service and payments agreement', 'language_id' => 1],
            ['key' => 'terms_of_service_payments_agreement', 'value' => 'תנאי שירות והסכם תשלומים', 'language_id' => 2],

            ['key' => 'last_update_on', 'value' => 'Last update on', 'language_id' => 1],
            ['key' => 'last_update_on', 'value' => 'עדכון אחרון ב', 'language_id' => 2],

            ['key' => 'decline', 'value' => 'Decline', 'language_id' => 1],
            ['key' => 'decline', 'value' => 'יְרִידָה', 'language_id' => 2],

            ['key' => 'accept', 'value' => 'Accept', 'language_id' => 1],
            ['key' => 'accept', 'value' => 'לְקַבֵּל', 'language_id' => 2],

            ['key' => 'try_again', 'value' => 'Try Again', 'language_id' => 1],
            ['key' => 'try_again', 'value' => 'נסה שוב', 'language_id' => 2],

            ['key' => 'policy_terms', 'value' => 'You must approve the terms of our services and the payments we charge you.', 'language_id' => 1],
            ['key' => 'policy_terms', 'value' => 'עליך לאשר את תנאי השירותים שלנו ואת התשלומים שאנו גובים ממך.', 'language_id' => 2],

            ['key' => 'policy_terms', 'value' => 'You must approve the terms of our services and the payments we charge you. <br> <br> confidentiality and privacy -<br> In order to use our system, you will be asked to enter two email addresses. The first address must be legally owned by you! You will be prompted to provide access by username and password.<br>Once you entered both addresses, and opened read access to your mailbox, you basically gave us access to send our feature into your mailbox.<br> You undertake here that the main mailbox is your absolute and legal ownership.<br><br> Once you have registered to the site, we save your login information in the "logged in" state. We do this to make it easier for you in case you want to produce several documents, or simply use the site more than once. So we simply save you a new registration process every time. You can always choose to disconnect from the site, by clicking the "Exit" button. As long as you haven\'t clicked the logout button, you will be in the online state. We save your user information in a cookie, in accordance with the rules of global regulation, and according to your consent to the use of cookies.<br> <br>From the moment you register on the website, you will be asked by Google or Microsoft to confirm granting permissions to our system, log in to your email and read the correspondence. Please note, the permission we are asking for is read only. We will never be able to send an email on your behalf or do any active action within your email box. We can only read correspondence.<br> <br> If you do not approve the permission to read, then we will not be able to produce the document for you.<br> <br> You should know that absolutely, we do not have access to the documents that you produce through our website.<br> We don\'t save your documents, we don\'t read them, we don\'t send them and we don\'t use them in any way.<br> To be honest, the process of creating the document is done on your device, not on our servers. So you can rest assured that the privacy of your information is fully preserved. <br><br> We do not have human access to the email boxes you have entered. That means no human being can read your email correspondence. In order to read the correspondence and compile them into a document, we run software that knows how to do this.<br> <br> Our software went through a very long and deep process in order to receive security approvals from Google and Microsoft. The process that these companies required of us, is actually to make sure that we do not have human access to your correspondence, but only software. And in any case, the process of producing the aforementioned document is done outside of our servers - on your device.<br> <br> We read the correspondence according to your search settings, such as: correspondence between you and the other address you entered into our system, correspondence between a specified date range, correspondence that contains or excludes certain keywords you have chosen.<br> <br> We do save the addresses that you enter and indicate for which you want to generate a document. But we promise you not to use the addresses in any way. We also do not transfer the addresses to any third party.<br> The documents we generating - <br> We generate the documents by code in the PHP language. It is one of the leading programming languages in the world. <br> The document we produce is a PDF.<br> <br> FYI, a PDF document is not editable! Once we have created the document, you will not be able to edit it in any way.<br> <br>', 'language_id' => 1],
            ['key' => 'policy_terms', 'value' => 'עליך לאשר את תנאי השירותים שלנו ואת התשלומים שאנו גובים ממך. <br> <br> סודיות ופרטיות -<br> כדי להשתמש במערכת שלנו, תתבקש להזין שתי כתובות דוא"ל. הכתובת הראשונה חייבת להיות בבעלותך החוקית! תתבקש לספק גישה לפי שם משתמש וסיסמה.<br>לאחר שהזנת את שתי הכתובות ופתחת גישת קריאה לתיבת הדואר שלך, בעצם נתת לנו גישה לשלוח את התכונה שלנו לתיבת הדואר שלך.<br> אתה מתחייב כאן שה תיבת הדואר הראשית היא הבעלות המוחלטת והחוקית שלך.<br><br> לאחר שנרשמת לאתר, אנו שומרים את פרטי ההתחברות שלך במצב "מחובר". אנו עושים זאת כדי להקל עליכם במקרה שתרצו להפיק מספר מסמכים, או פשוט להשתמש באתר יותר מפעם אחת. אז אנחנו פשוט חוסכים לך תהליך רישום חדש בכל פעם. תמיד תוכל לבחור להתנתק מהאתר, על ידי לחיצה על כפתור "יציאה". כל עוד לא לחצת על כפתור היציאה, אתה תהיה במצב מקוון. אנו שומרים את פרטי המשתמש שלך בעוגייה, בהתאם לכללי הרגולציה העולמית, ובהתאם להסכמתך לשימוש בעוגיות.<br> <br>מרגע ההרשמה לאתר, תתבקש על ידי Google או Microsoft כדי לאשר מתן הרשאות למערכת שלנו, היכנס לדוא"ל שלך וקרא את ההתכתבות. שימו לב, ההרשאה שאנו מבקשים היא לקריאה בלבד. לעולם לא נוכל לשלוח דוא"ל בשמך או לבצע פעולה פעילה כלשהי בתוך תיבת הדוא"ל שלך. אנחנו יכולים לקרוא רק התכתבות.<br> <br> אם לא תאשר את הרשאת הקריאה, לא נוכל להפיק את המסמך עבורך.<br> <br> עליך לדעת שבאופן מוחלט, אנחנו לא עושים זאת. תהיה לך גישה למסמכים שאתה מפיק דרך האתר שלנו.<br> אנחנו לא שומרים את המסמכים שלך, אנחנו לא קוראים אותם, אנחנו לא שולחים אותם ואנחנו לא משתמשים בהם בשום צורה.<br> למען האמת, תהליך יצירת המסמך נעשה במכשיר שלך, לא בשרתים שלנו. אז אתה יכול להיות סמוך ובטוח שפרטיות המידע שלך נשמרת במלואה. <br><br> אין לנו גישה אנושית לתיבות הדוא"ל שהזנת. זה אומר שאף אדם לא יכול לקרוא את התכתובת הדוא"ל שלך. על מנת לקרוא את ההתכתבות ולהרכיב אותן למסמך, אנו מפעילים תוכנה שיודעת לעשות זאת.<br> <br> התוכנה שלנו עברה תהליך ארוך ועמוק מאוד על מנת לקבל אישורי אבטחה מגוגל וממיקרוסופט. התהליך שחברות אלו דרשו מאיתנו, הוא למעשה לוודא שאין לנו גישה אנושית להתכתבות שלכם, אלא רק תוכנה. ובכל מקרה, תהליך הפקת המסמך הנ"ל נעשה מחוץ לשרתים שלנו - במכשיר שלך.<br> <br> אנו קוראים את ההתכתבות לפי הגדרות החיפוש שלך, כגון: התכתבות בינך לבין הכתובת האחרת שלך שהוכנסו למערכת שלנו, התכתבות בין טווח תאריכים מוגדר, התכתבות המכילה או לא כוללת מילות מפתח מסוימות שבחרת.<br> <br> אנו שומרים את הכתובות שהזנת ומציינים עבורן ברצונך ליצור מסמך. אבל אנחנו מבטיחים לכם לא להשתמש בכתובות בשום צורה. אנחנו גם לא מעבירים את הכתובות לשום צד שלישי.<br> המסמכים שאנו מייצרים - <br> אנו יוצרים את המסמכים לפי קוד בשפת PHP. זוהי אחת משפות התכנות המובילות בעולם. <br> המסמך שאנו מפיקים הוא PDF.<br> <br> לידיעתך, מסמך PDF אינו ניתן לעריכה! לאחר שיצרנו את המסמך, לא תוכל לערוך אותו בשום אופן.<br> <br>', 'language_id' => 2],

            ['key' => 'policy_terms1', 'value' => 'Depending on your settings, we allow you to highlight certain keywords. We do this automatically. This means that you may find yellow markings in the document.<br> <br> The duration of the production time of the document depends on the amount of correspondence that our system found in your mailbox. Naturally, the more correspondences there are, the longer the duration will be.<br> Please be patient, sometimes it can take long minutes. <br> <br> We declare here that we cannot guarantee that our system was able to locate all the correspondence you requested. In other words, since our system is technological, the success rate depends on several different factors such as the type of your device, the type of your browser, the amount of correspondence there is, the quality of your device\'s connection to the Internet, the load on our servers, and more. We hereby declare that sometimes our system may not be able to collect 100 percent of all the correspondence you requested. <br> If you are sure that there is a real gap between the amount of correspondence we found, and the amount of authentic correspondence that exists in your email box - please contact us and we will be very happy to try to help find all the correspondence, or alternatively, refund your payment. Contact us at the contact details written below.<br> <br> As mentioned, the document that we produce for you is a collection of all the correspondence between the two addresses that you entered, and according to the settings that you chose. We do not do any additional manipulation on the document. The document faithfully and blindly reflects all correspondence.<br> Payments and costs -<br> The price we demand for each document varies from time to time. We do guarantee that the price we will show you at the time of payment is the absolute price charged to your credit card. <br><br> We declare that we have no access at all to your credit card. In order to clear your credit card, and collect payment for our services, we use Stripe, one of the leading clearing companies in the world. We send them the cost of the service, and you will be required to fill in the credit information.<br> You should know, the page for filling out the credit information is not on our website, but on the clearing company\'s website. From here you will know that your credit information is protected in the strictest manner under the custody of the clearing company.<br> <br> Once our system has generated the requested document for you, you will first be asked to pay for it. If you do not agree to pay for the document, then it will be deleted and you will not have access to it. In order to download the document you have to pay.<br> <br> If you would like an invoice-receipt, you can contact us and we will issue one for you easily and happily.<br> <br> If the currency that we present on the website does not match the currency in your bank account, then the credit company will convert the transaction to the currency that represents your bank account. The currency conversion and payment may naturally result in the payment of normal conversion interest, according to the same currency value at the time you created the document. <br> <br> We charge a single per-document fee. That is, as soon as we have created a document, and it is not possible to edit it, and you have already paid for it, then from here on, as much as you want additional documents, you will be required to pay for each one of them. If you want to produce several different documents, you must go through the document production process and payment, for each document separately.<br> <br>', 'language_id' => 1],
            ['key' => 'policy_terms1', 'value' => 'בהתאם להגדרות שלך, אנו מאפשרים לך להדגיש מילות מפתח מסוימות. אנחנו עושים זאת אוטומטית. המשמעות היא שאתה עשוי למצוא סימנים צהובים במסמך.<br> <br> משך זמן הפקת המסמך תלוי בכמות ההתכתבויות שהמערכת שלנו מצאה בתיבת הדואר שלך. באופן טבעי, ככל שיהיו יותר התכתבויות, משך הזמן יהיה ארוך יותר.<br> אנא התאזר בסבלנות, לפעמים זה יכול לקחת דקות ארוכות. <br> <br> אנו מצהירים כאן שאיננו יכולים להבטיח שהמערכת שלנו הצליחה לאתר את כל התכתובות שביקשת. במילים אחרות, מכיוון שהמערכת שלנו היא טכנולוגית, שיעור ההצלחה תלוי במספר גורמים שונים כמו סוג המכשיר שלך, סוג הדפדפן שלך, כמות ההתכתבויות שיש, איכות החיבור של המכשיר שלך לאינטרנט, לטעון על השרתים שלנו, ועוד. אנו מצהירים בזאת כי לעיתים ייתכן שהמערכת שלנו לא תוכל לאסוף 100 אחוז מכל התכתובות שביקשת. <br> אם אתה בטוח שיש פער אמיתי בין כמות ההתכתבויות שמצאנו, לבין כמות ההתכתבויות האותנטיות שקיימת בתיבת המייל שלך - אנא צור איתנו קשר ונשמח מאוד לנסות לעזור למצוא את כל התכתבות, או לחילופין, החזר את התשלום שלך. צרו קשר בפרטי ההתקשרות הכתובים למטה.<br> <br> כאמור, המסמך שאנו מפיקים עבורכם הוא אוסף של כל ההתכתבויות בין שתי הכתובות שהזנת, ולפי ההגדרות שבחרת. אנחנו לא עושים שום מניפולציה נוספת על המסמך. המסמך משקף נאמנה ועיוור את כל ההתכתבויות.<br> תשלומים ועלויות -<br> המחיר שאנו דורשים עבור כל מסמך משתנה מעת לעת. אנו מתחייבים שהמחיר שנראה לך בזמן התשלום הוא המחיר המוחלט שנגבה מכרטיס האשראי שלך. <br><br> אנו מצהירים שאין לנו גישה כלל לכרטיס האשראי שלך. על מנת לסלק את כרטיס האשראי שלך, ולגבות תשלום עבור שירותינו, אנו משתמשים ב-Stripe, אחת מחברות הסליקה המובילות בעולם. אנו שולחים להם את עלות השירות, ואתם תדרשו למלא את פרטי האשראי.<br> כדאי שתדעו, עמוד מילוי פרטי האשראי אינו נמצא באתר שלנו, אלא באתר חברת הסליקה. מכאן תדעו שפרטי האשראי שלכם מוגנים בצורה המחמירה ביותר במשמורת חברת הסליקה.<br> <br> לאחר שהמערכת שלנו הפיקה עבורכם את המסמך המבוקש, תחילה תתבקשו לשלם עבורו. אם לא תסכים לשלם עבור המסמך, אזי הוא יימחק ולא תהיה לך גישה אליו. על מנת להוריד את המסמך עליך לשלם.<br> <br> אם תרצה קבלה על חשבונית, תוכל ליצור איתנו קשר ואנו נפיק לך אחת בקלות ובשמחה.<br> <br> אם המטבע שאנו מציגים באתר אינו תואם את המטבע בחשבון הבנק שלך, אזי חברת האשראי תמיר את העסקה למטבע המייצג את חשבון הבנק שלך. המרת המטבע והתשלום עלולים לגרום באופן טבעי לתשלום ריבית המרה רגילה, לפי אותו ערך מטבע בזמן יצירת המסמך. <br> <br> אנו גובים עמלה אחת למסמך. כלומר, ברגע שיצרנו מסמך, ואין אפשרות לערוך אותו, וכבר שילמתם עליו, אז מכאן ואילך, ככל שתרצו מסמכים נוספים, תידרשו לשלם עבור כל אחד מהם. אם ברצונך להפיק מספר מסמכים שונים, עליך לעבור את תהליך הפקת המסמכים והתשלום, עבור כל מסמך בנפרד.<br> <br>', 'language_id' => 2],

            ['key' => 'policy_terms2', 'value' => 'Once you have paid for a document, there is no technical possibility of going back. That is, ifyou think that the payment you paid is incorrect, or that the service you received is insufficient and does not deserve payment, please contact us with the details below. We promise to do as much as possible to serve you in the best possible way.<br> <br> Once you have paid for a document, it cannot be edited, nor changed, nor replaced, nor canceled. Once the document is created and paid for, there is no going back.<br> Note that, the last point at which you can regret creating the document, or change it, or edit it, is before you have paid. In order to do so, you can simply refresh the page, and start the process of defining the search again. You may also need to re-register.<br> <br> Please note, we cannot be held responsible for mistakes made on your part. If you create a document with incorrect data such as the second email address, or incorrect keywords, or incorrect dates, you will not be able to change this data after you have created the document. <br> <br> If you think a mistake has been made on our part, please contact us and we will try to help correct it as much as possible.<br><br> For service, inquiries or help,<br>You can contact us using the email address:<br>Support-LegalPDf@gmail.com', 'language_id' => 1],
            ['key' => 'policy_terms2', 'value' => 'לאחר ששילמת עבור מסמך, אין אפשרות טכנית לחזור אחורה. כלומר, אם אתה חושב שהתשלום ששילמת שגוי, או שהשירות שקיבלת אינו מספק ואינו ראוי לתשלום, אנא צור איתנו קשר עם הפרטים למטה. אנו מבטיחים לעשות ככל האפשר כדי לשרת אותך בצורה הטובה ביותר.<br> <br> לאחר ששילמת עבור מסמך, לא ניתן לערוך אותו, לא לשנות אותו, לא להחליפו ולא לבטל אותו. לאחר יצירת המסמך ותשלום עבורו, אין דרך חזרה.<br> שים לב, הנקודה האחרונה שבה אתה יכול להתחרט על יצירת המסמך, או לשנות אותו, או לערוך אותו, היא לפני ששילמת. על מנת לעשות זאת, תוכלו פשוט לרענן את העמוד, ולהתחיל שוב בתהליך הגדרת החיפוש. ייתכן שתצטרך גם להירשם מחדש.<br> <br> שים לב, איננו יכולים לשאת באחריות לטעויות שנעשו מצידך. אם תיצור מסמך עם נתונים שגויים כגון כתובת הדוא"ל השנייה, או מילות מפתח שגויות, או תאריכים שגויים, לא תוכל לשנות נתונים אלה לאחר יצירת המסמך. <br> <br> אם אתה חושב שנעשתה טעות מצידנו, אנא צור איתנו קשר ואנו ננסה לעזור לתקן אותה ככל האפשר.<br><br> לשירות, פניות או עזרה,<br> אתה יכול ליצור איתנו קשר באמצעות כתובת הדוא"ל:<br>Support-LegalPDf@gmail.com', 'language_id' => 2],

            ['key' => 'thank_you_for_choosing', 'value' => 'Thank you for choosing', 'language_id' => 1],
            ['key' => 'thank_you_for_choosing', 'value' => 'תודה שבחרתם', 'language_id' => 2],

            ['key' => 'the_payment_was_successfully_received', 'value' => 'The payment was successfully received!', 'language_id' => 1],
            ['key' => 'the_payment_was_successfully_received', 'value' => 'התשלום התקבל בהצלחה!', 'language_id' => 2],

            ['key' => 'request_refund', 'value' => 'Request Refund', 'language_id' => 1],
            ['key' => 'request_refund', 'value' => 'בקש החזר', 'language_id' => 2],

            ['key' => 'request_refund_title', 'value' => 'Do you want to request a refund for this order?', 'language_id' => 1],
            ['key' => 'request_refund_title', 'value' => 'האם ברצונך לבקש החזר עבור הזמנה זו?', 'language_id' => 2],

            ['key' => 'no', 'value' => 'No', 'language_id' => 1],
            ['key' => 'paid', 'value' => 'Paid!', 'language_id' => 1],
            ['key' => 'no', 'value' => 'לֹא', 'language_id' => 2],
            ['key' => 'paid', 'value' => 'בתשלום!', 'language_id' => 2],
            
            ['key' => 'yes', 'value' => 'Yes', 'language_id' => 1],
            ['key' => 'yes', 'value' => 'כֵּן', 'language_id' => 2],

            ['key' => 'regenerate_pdf', 'value' => 'Regenerate PDF', 'language_id' => 1],
            ['key' => 'regenerate_pdf', 'value' => 'צור מחדש PDF', 'language_id' => 2],

            ['key' => 'requesting_please_wait', 'value' => 'Requesting, please wait...', 'language_id' => 1],
            ['key' => 'requesting_please_wait', 'value' => 'מבקש, אנא המתן...', 'language_id' => 2],

            ['key' => 'close', 'value' => 'Close', 'language_id' => 1],
            ['key' => 'close', 'value' => 'לִסְגוֹר', 'language_id' => 2],
            
            ['key' => 'pdf_regeneration_success', 'value' => 'PDF regeneration started successfully!', 'language_id' => 1],
            ['key' => 'pdf_regeneration_success', 'value' => 'חידוש PDF החל בהצלחה!', 'language_id' => 2],

            ['key' => 'pdf_regeneration_error', 'value' => 'PDF regeneration failed.', 'language_id' => 1],
            ['key' => 'pdf_regeneration_error', 'value' => 'חידוש PDF נכשל.', 'language_id' => 2],

            ['key' => 'refund_request_success', 'value' => 'We\'ve got your refund request. We will check your request, and will let you know by email.', 'language_id' => 1],
            ['key' => 'refund_request_success', 'value' => 'קיבלנו את בקשת ההחזר שלך. אנו נבדוק את בקשתך ונודיע לך במייל.', 'language_id' => 2],

            ['key' => 'provide_order_id', 'value' => 'Please provide proper order id.', 'language_id' => 1],
            ['key' => 'provide_order_id', 'value' => 'אנא ספק מזהה הזמנה תקין.', 'language_id' => 2],

            ['key' => 'session_request_expired', 'value' => 'Session expired. Please log in again.', 'language_id' => 1],
            ['key' => 'session_request_expired', 'value' => 'פג תוקף ההפעלה. נא להיכנס שוב.', 'language_id' => 2],

            ['key' => 'order_fail_mail_message', 'value' => 'Unfortunately, we couldn\'t generate the document that was requested by', 'language_id' => 1],
            ['key' => 'order_fail_mail_message', 'value' => 'לצערנו, לא הצלחנו ליצור את המסמך שהתבקש על ידי', 'language_id' => 2],

            ['key' => 'user_email', 'value' => 'User Email', 'language_id' => 1],
            ['key' => 'user_email', 'value' => 'דוא"ל משתמש', 'language_id' => 2],

            ['key' => 'order_fail_mail_title', 'value' => 'Order Fail Email', 'language_id' => 1],
            ['key' => 'order_fail_mail_title', 'value' => 'אימייל נכשל בהזמנה', 'language_id' => 2],

            ['key' => 'target_mail', 'value' => 'Target Email', 'language_id' => 1],
            ['key' => 'target_mail', 'value' => 'דוא"ל יעד', 'language_id' => 2],

            ['key' => 'order_created_at', 'value' => 'Order created at', 'language_id' => 1],
            ['key' => 'order_created_at', 'value' => 'הזמנה נוצרה ב', 'language_id' => 2],

            ['key' => 'order_failed_at', 'value' => 'Order failed at', 'language_id' => 1],
            ['key' => 'order_failed_at', 'value' => 'ההזמנה נכשלה ב' , 'language_id' => 2],

            ['key' => 'order_pdf_mail_subject', 'value' => 'LegalPdf Downloadable PDF File.', 'language_id' => 1],
            ['key' => 'order_pdf_mail_subject', 'value' => 'קובץ PDF להורדה משפטי.' , 'language_id' => 2],

            ['key' => 'order_pdf_generation_failed', 'value' => 'Pdf Generation Failed Mail', 'language_id' => 1],
            ['key' => 'order_pdf_generation_failed', 'value' => 'דואר נכשל ביצירת Pdf' , 'language_id' => 2],


            ['key' => 'payments', 'value' => 'Payments', 'language_id' => 1],
            ['key' => 'payments', 'value' => 'תשלומים', 'language_id' => 2],            

            ['key' => 'todays', 'value' => 'today\'s', 'language_id' => 1],
            ['key' => 'todays', 'value' => 'של היום', 'language_id' => 2],            

            ['key' => 'from_yesterday', 'value' => 'from yesterday', 'language_id' => 1],
            ['key' => 'from_yesterday', 'value' => 'מאתמול', 'language_id' => 2],            

            ['key' => 'yesterday', 'value' => 'Yesterday', 'language_id' => 1],
            ['key' => 'yesterday', 'value' => '', 'language_id' => 2],            

            ['key' => 'from_day_before_yesterday', 'value' => 'from day before yesterday', 'language_id' => 1],
            ['key' => 'from_day_before_yesterday', 'value' => 'מיום שלשום', 'language_id' => 2],            

            ['key' => 'last_week', 'value' => 'Last Week', 'language_id' => 1],
            ['key' => 'last_week', 'value' => 'שבוע שעבר', 'language_id' => 2],            

            ['key' => 'from_previous_week', 'value' => 'from previous week', 'language_id' => 1],
            ['key' => 'from_previous_week', 'value' => 'מהשבוע הקודם', 'language_id' => 2],            

            ['key' => 'this_month', 'value' => 'This Month', 'language_id' => 1],
            ['key' => 'this_month', 'value' => 'החודש הזה', 'language_id' => 2],            

            ['key' => 'from_last_month', 'value' => 'from last month', 'language_id' => 1],
            ['key' => 'from_last_month', 'value' => 'מהחודש שעבר', 'language_id' => 2],            

            ['key' => 'last_12_months', 'value' => 'Last 12 Months', 'language_id' => 1],
            ['key' => 'last_12_months', 'value' => '12 החודשים האחרונים', 'language_id' => 2],            

            ['key' => 'from_last_year', 'value' => 'from last year', 'language_id' => 1],
            ['key' => 'from_last_year', 'value' => 'מהשנה שעברה', 'language_id' => 2],            

            ['key' => 'payment_list', 'value' => 'Payment List', 'language_id' => 1],
            ['key' => 'payment_list', 'value' => 'רשימת תשלומים', 'language_id' => 2],            

            ['key' => 'per_page_collon', 'value' => 'Per Page:', 'language_id' => 1],
            ['key' => 'per_page_collon', 'value' => 'לכל עמוד:', 'language_id' => 2],            

            ['key' => '50', 'value' => '50', 'language_id' => 1],
            ['key' => '50', 'value' => '50', 'language_id' => 2],            

            ['key' => '100', 'value' => '100', 'language_id' => 1],
            ['key' => '100', 'value' => '100', 'language_id' => 2],            

            ['key' => '200', 'value' => '200', 'language_id' => 1],
            ['key' => '200', 'value' => '200', 'language_id' => 2],            

            ['key' => '400', 'value' => '400', 'language_id' => 1],
            ['key' => '400', 'value' => '400', 'language_id' => 2],            

            ['key' => 'select_quick_type', 'value' => 'Select Quick Type', 'language_id' => 1],
            ['key' => 'select_quick_type', 'value' => 'בחר סוג מהיר', 'language_id' => 2],            

            ['key' => 'today', 'value' => 'Today', 'language_id' => 1],
            ['key' => 'today', 'value' => 'הַיוֹם', 'language_id' => 2],            

            ['key' => 'yesterday', 'value' => 'Yesterday', 'language_id' => 1],
            ['key' => 'yesterday', 'value' => 'אֶתמוֹל', 'language_id' => 2],            

            ['key' => 'last_week', 'value' => 'Last Week', 'language_id' => 1],
            ['key' => 'last_week', 'value' => 'שבוע שעבר', 'language_id' => 2],            

            ['key' => 'this_month', 'value' => 'This Month', 'language_id' => 1],
            ['key' => 'this_month', 'value' => 'החודש הזה', 'language_id' => 2],            

            ['key' => 'select_date_range', 'value' => 'Select Date Range', 'language_id' => 1],
            ['key' => 'select_date_range', 'value' => 'בחר טווח תאריכים', 'language_id' => 2],            

            ['key' => 'sl', 'value' => 'SL', 'language_id' => 1],
            ['key' => 'sl', 'value' => 'SL', 'language_id' => 2],            

            ['key' => 'date', 'value' => 'Date', 'language_id' => 1],
            ['key' => 'date', 'value' => 'תַאֲרִיך', 'language_id' => 2],            

            ['key' => 'order_by', 'value' => 'Order by', 'language_id' => 1],
            ['key' => 'order_by', 'value' => 'הזמינו לפי', 'language_id' => 2],            

            ['key' => 'target', 'value' => 'Target', 'language_id' => 1],
            ['key' => 'target', 'value' => 'יַעַד', 'language_id' => 2],            

            ['key' => 'messages', 'value' => 'Messages', 'language_id' => 1],
            ['key' => 'messages', 'value' => 'הודעות', 'language_id' => 2],            

            ['key' => 'price', 'value' => 'Price', 'language_id' => 1],
            ['key' => 'price', 'value' => 'מְחִיר', 'language_id' => 2],            

            ['key' => 'data_fetching', 'value' => 'Data Fetching...', 'language_id' => 1],
            ['key' => 'data_fetching', 'value' => 'שואב נתונים.....', 'language_id' => 2],

            ['key' => 'dashboards', 'value' => 'Dashboards', 'language_id' => 1],
            ['key' => 'dashboards', 'value' => 'לוחות מחוונים', 'language_id' => 2],

            ['key' => 'profile', 'value' => 'Profile', 'language_id' => 1],
            ['key' => 'profile', 'value' => 'פּרוֹפִיל', 'language_id' => 2],

            ['key' => 'partner_details', 'value' => 'Partner Details', 'language_id' => 1],
            ['key' => 'partner_details', 'value' => 'פרטי שותף', 'language_id' => 2],

            ['key' => 'bank_details', 'value' => 'Bank Details', 'language_id' => 1],
            ['key' => 'bank_details', 'value' => 'פרטי בנק', 'language_id' => 2],

            ['key' => 'website_design', 'value' => 'Website Design', 'language_id' => 1],
            ['key' => 'website_design', 'value' => 'עיצוב אתר', 'language_id' => 2],

            ['key' => 'logo', 'value' => 'Logo', 'language_id' => 1],
            ['key' => 'logo', 'value' => 'סֵמֶל', 'language_id' => 2],

            ['key' => 'title', 'value' => 'Title', 'language_id' => 1],
            ['key' => 'title', 'value' => 'כּוֹתֶרֶת', 'language_id' => 2],

            ['key' => 'language', 'value' => 'Language', 'language_id' => 1],
            ['key' => 'language', 'value' => 'שָׂפָה', 'language_id' => 2],

            ['key' => 'description', 'value' => 'Description', 'language_id' => 1],
            ['key' => 'description', 'value' => 'תֵאוּר', 'language_id' => 2],

            ['key' => 'articles', 'value' => 'Articles', 'language_id' => 1],
            ['key' => 'articles', 'value' => 'מאמרים', 'language_id' => 2],

            ['key' => 'q_and_a', 'value' => 'Q & A', 'language_id' => 1],
            ['key' => 'q_and_a', 'value' => 'שאלות ותשובות', 'language_id' => 2],

            ['key' => 'links', 'value' => 'Links', 'language_id' => 1],
            ['key' => 'links', 'value' => 'קישורים', 'language_id' => 2],

            ['key' => 'videos', 'value' => 'Videos', 'language_id' => 1],
            ['key' => 'videos', 'value' => 'סרטונים', 'language_id' => 2],

            ['key' => 'click_here', 'value' => 'Click Here', 'language_id' => 1],
            ['key' => 'click_here', 'value' => 'לחץ כאן', 'language_id' => 2],

            ['key' => 'contact_details', 'value' => 'Contact Details', 'language_id' => 1],
            ['key' => 'contact_details', 'value' => 'פרטי יצירת קשר', 'language_id' => 2],

            ['key' => 'payments', 'value' => 'Payments', 'language_id' => 1],
            ['key' => 'payments', 'value' => 'תשלומים', 'language_id' => 2],

            ['key' => 'traffic', 'value' => 'Traffic', 'language_id' => 1],
            ['key' => 'traffic', 'value' => 'תְנוּעָה', 'language_id' => 2],

            ['key' => 'total_visits', 'value' => 'Total Visits', 'language_id' => 1],
            ['key' => 'total_visits', 'value' => 'סך הביקורים', 'language_id' => 2],

            ['key' => 'unique_visits', 'value' => 'Unique Visits', 'language_id' => 1],
            ['key' => 'unique_visits', 'value' => 'ביקורים ייחודיים', 'language_id' => 2],

            ['key' => 'refund_requests', 'value' => 'Refund Requests', 'language_id' => 1],
            ['key' => 'refund_requests', 'value' => 'בקשות להחזר', 'language_id' => 2],

            ['key' => 'partner_price_setting', 'value' => 'Partner Price Setting', 'language_id' => 1],
            ['key' => 'partner_price_setting', 'value' => 'הגדרת מחיר שותף', 'language_id' => 2],

            ['key' => 'ex_dot_price', 'value' => 'Ex. Price', 'language_id' => 1],
            ['key' => 'ex_dot_price', 'value' => 'לְשֶׁעָבַר. מְחִיר', 'language_id' => 2],

            ['key' => 'edit_price', 'value' => 'Edit Price', 'language_id' => 1],
            ['key' => 'edit_price', 'value' => 'ערוך מחיר', 'language_id' => 2],

            ['key' => 'order_date', 'value' => 'Order Date', 'language_id' => 1],
            ['key' => 'order_date', 'value' => 'תאריך הזמנה', 'language_id' => 2],

            ['key' => 'requested_date', 'value' => 'Requested Date', 'language_id' => 1],
            ['key' => 'requested_date', 'value' => 'תאריך מבוקש', 'language_id' => 2],

            ['key' => 'requested_by', 'value' => 'Requested by', 'language_id' => 1],
            ['key' => 'requested_by', 'value' => 'מתבקש על ידי', 'language_id' => 2],

            ['key' => 'status', 'value' => 'Status', 'language_id' => 1],
            ['key' => 'status', 'value' => 'סטָטוּס', 'language_id' => 2],

            ['key' => 'action', 'value' => 'Action', 'language_id' => 1],
            ['key' => 'action', 'value' => 'פְּעוּלָה', 'language_id' => 2],

            ['key' => 'search_KeywordAtach', 'value' => 'I want to see all correspondence,and to highlight the keywords', 'language_id' => 1],
            ['key' => 'search_KeywordAtach', 'value' =>'אמילות המפתחההתכתבות ולהדגיש אתני רוצה לראות את כל', 'language_id' => 2],

            ['key' => 'search_KeywordInclude', 'value' => 'I want correspondence that includes these highlighted  keywords only,and to see no other emails', 'language_id' => 1],
            ['key' => 'search_KeywordInclude', 'value' =>'אהאלה בלבד, והודעות דוא"ל אחרותלא לראותהמפתח המודגשות ני רוצה התכתבות הכוללת את מילות', 'language_id' => 2],
        ];  

        DB::table('localizations')->insert($localizations);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
